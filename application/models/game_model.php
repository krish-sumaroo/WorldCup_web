<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class game_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'games';
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
        $teamSql = "SELECT g.playerId, p.name, p.position, p.number 
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
        
        $gameInfo = array();
        
        if($result->playerInfo) // list of players is final
        {
            $gameInfo['team1']['players'] = $this->_getActivePlayersForTeam($result->id, $result->team1);
            $gameInfo['team2']['players'] = $this->_getActivePlayersForTeam($result->id, $result->team2);
        return $gameInfo;
        }
        else //return full list
        {
            $gameInfo['team1']['players'] = $this->getFullPlayers($result->team1);
            $gameInfo['team2']['players'] = $this->getFullPlayers($result->team2);
        }
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
        return $query->result();
    }
    
    public function getTeamInfo($teamId)
    {
        $sqlTm1 = "SELECT id, name, flag FROM teams WHERE id = ".$teamId;
        $queryTm1 = $this->db->query($sqlTm1);
        return $queryTm1->row();  
    }


    public function activeGame()
    {
        $result = $this->getNextGame();
        
        $gameInfo = array();
        $datetime = new DateTime($result->matchDate);
        $gameInfo['time'] = $datetime->format(DateTime::ISO8601);
        $gameInfo['BOid'] = $result->id;
        
        $rstTm1 = $this->getTeamInfo($result->team1);
        $gameInfo['team1'] = array('id' => $rstTm1->id, 'flag' => $rstTm1->flag);
        
        $rstTm2 = $this->getTeamInfo($result->team2);
        $gameInfo['team2'] = array('id' => $rstTm1->id, 'flag' => $rstTm1->flag);
        
        if($result->playerInfo)
        {
            //get playersInfo
            $gameInfo['playersInfoStatus'] = true;            
            $gameInfo['team1']['players'] = $this->_getActivePlayersForTeam($result->id, $result->team1);
            $gameInfo['team2']['players'] = $this->_getActivePlayersForTeam($result->id, $result->team2);
        }
        else
        {
            $gameInfo['playersInfoStatus'] = false;
        }        
//        echo "<pre>";
//        print_r($gameInfo);
//        echo "</pre>";
        
        return $gameInfo;
    }

}