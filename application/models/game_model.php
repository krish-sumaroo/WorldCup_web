<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class game_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'games';
        $this->_defaultMove = 10;
    }

    public function getNext2Days()
    {
        $sql = "select m.id, m.stage, m.team1, m.team2, m.venue, m.matchDate from games  as m
                INNER JOIN
                (
                        SELECT gameDate from gamesdates g
                        where gamedate >= NOW()
                        limit 1
                ) as g1

                ON m.matchDate = g1.`gameDate`
                ORDER BY matchDate ASC";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            $result = array();
            foreach ($query->result() as $row)
            {
               $result[] = ['id' => $row->id,
                            'stage' => $row->stage,
                            'teamA' => $row->team1,
                            'teamB' => $row->team2,
                            'venue' => $row->venue,
                            'matchDate' => $row->matchDate];
            }
            $this->db->close();
            return $result;
        }
        else
        {
            //close connection
            $this->db->close();
            return FALSE;
        }

    }    
    
    public function getTeams()
    {
       $sql = "SELECT * FROM teams";
       $query = $this->db->query($sql);
       return $query->result_array();
    }
    
    private function _getActivePlayersForTeam($gameId, $teamId)
    {
        $teamSql = "SELECT g.playerId as id, p.name, p.position, p.number 
                        FROM gameplayers g
                        JOIN players p ON p.id = g.playerId 
                        WHERE g.gameId = ".$gameId." AND g.teamId = ".$teamId;

        $query = $this->db->query($teamSql);
        return $query->result_array();
    }


    public function getActivePlayers()
    {
        $sql = "SELECT id, team1, team2, matchDate, playerInfo FROM games 
                WHERE startedF = 0
                ORDER BY matchDate LIMIT 1";
        $query = $this->db->query($sql);
        $result = $query->row();
        
        log_message('error', 'gameInfo =>'.print_r($result, true));
        
        $gameInfo = array();
        
        if($result->playerInfo == 3) // list of players is final
        {
            $gameInfo['team1']['players'] = $this->_getActivePlayersForTeam($result->id, $result->team1);
            $gameInfo['team2']['players'] = $this->_getActivePlayersForTeam($result->id, $result->team2);
        }
        else //return full list
        {
            $gameInfo['team1']['players'] = $this->getFullPlayers($result->team1);
            $gameInfo['team2']['players'] = $this->getFullPlayers($result->team2);
        }
        return $gameInfo;
    }
    
    public function getNextGameWithDetails()
    {
       $sql = "SELECT g.id, g.team1, g.team2, g.matchDate, g.playerInfo FROM games g
                JOIN teams t ON t.id = g
                WHERE startedF = 0
                ORDER BY matchDate LIMIT 1";
        $query = $this->db->query($sql);
        return $query->row(); 
    }


    public function getNextGame()
    {
        $sql = "SELECT id, team1, team2, matchDate, playerInfo FROM games 
                WHERE startedF = 0
                ORDER BY matchDate LIMIT 1";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function getFullPlayers($teamId)
    {
        $sql = "SELECT * FROM players WHERE teamId = ".$teamId;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getTeamInfo($teamId)
    {
        $sqlTm1 = "SELECT id, name, flag FROM teams WHERE id = ".$teamId;
        $queryTm1 = $this->db->query($sqlTm1);
        return $queryTm1->row();  
    }


    public function activeGame($userId)
    {
        $result = $this->getNextGame();        
        $activeGameId = $result->id;
        
        $gameInfo = array();
        //get userMoves for game
        $moves = $this->getGamesMovesForUser($userId, $activeGameId);
        $sMoves = $this->getSMovesForUser($userId);
        $gameInfo['nMoves'] = $moves['nMoves'];
        $gameInfo['sMoves'] = $sMoves;        
       
        $datetime = new DateTime($result->matchDate);
        $gameInfo['time'] = $datetime->format(DateTime::ISO8601);
        $gameInfo['BOid'] = $result->id;
        
        $rstTm1 = $this->getTeamInfo($result->team1);
        $gameInfo['team1'] = array('id' => $rstTm1->id, 'flag' => $rstTm1->flag);
        
        $rstTm2 = $this->getTeamInfo($result->team2);
        $gameInfo['team2'] = array('id' => $rstTm2->id, 'flag' => $rstTm2->flag);
        
        //get playersInfo
        if($result->playerInfo == 3) // list of players is final
        {
            $gameInfo['team1']['players'] = $this->_getActivePlayersForTeam($activeGameId, $result->team1);
            $gameInfo['team2']['players'] = $this->_getActivePlayersForTeam($activeGameId, $result->team2);
        }
        else //return full list
        {
            $gameInfo['team1']['players'] = $this->getFullPlayers($result->team1);
            $gameInfo['team2']['players'] = $this->getFullPlayers($result->team2);
        }
        
        return $gameInfo;
    }
    
    public function getSMovesForUser($userId)
    {
        $this->db->select('sMoves');
        $this->db->where('id', $userId);
        $this->db->from('users');
        $result =  $this->db->get()->row();

        return $result->sMoves;
    }
    
    public function getGamesMovesForUser($userId, $gameId)
    {
        $sql = "SELECT id, nMoves FROM user_game_details
                WHERE userId = ".$userId." 
                AND gameId = ".$gameId;
        $query = $this->db->query($sql);
        if($query->num_rows() > 0)
        {            
            return $query->row_array();
        }
        else
        {
            $newId = $this->insertMovesForUser($userId, $gameId);
            return array('id' => $newId, 'nMoves' => $this->_defaultMove);
        }
         
    }
    
    public function insertMovesForUser($userId, $gameId)
    {
        $this->db->insert('user_game_details', array('userId' => $userId, 'gameId' => $gameId, 'nMoves' => $this->_defaultMove));
        return $this->db->insert_id();
    }
    
    public function registerScore($data)
    {
        $this->db->insert('userScoreAction', $data);
        
        log_message('error', 'insert score =>'.$this->db->last_query());

        if($this->db->affected_rows())
        {
            $this->db->close();
            return TRUE;
        }
        else
        {
            $this->db->close();
            return FALSE;
        }
    }
    
    public function registerAction($data)
    {
        $this->db->insert('userPlayerAction', $data);

        if($this->db->affected_rows())
        {
            $this->db->close();
            return TRUE;
        }
        else
        {
            $this->db->close();
            return FALSE;
        }
    }


    public function updateNMove($id, $moves)
    {
        $sql = 'UPDATE user_game_details SET nMoves = '.$moves." WHERE id = ".$id;
        $this->db->query($sql);
     }
    
    public function updateSMove($userId, $moves)
    {
       $sql = 'UPDATE users SET sMoves = '.$moves." WHERE id = ".$userId;  
       $this->db->query($sql);
    }

}