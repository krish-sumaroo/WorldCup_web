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

}