<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getTeamDetails()
    {
       $this->db->select('t.id, t.name as teamName, t.coach, p.id as playerId, p.name as playerName, p.position, p.number');
       $this->db->from('teams t');
       $this->db->join('players p', 't.id = p.teamId');
       $query = $this->db->get();

           $result = array();
           $prevId = '';
           $counter = 0;
           foreach ($query->result() as $row)
           {
               if($row->id != $prevId)
               {
                   $counter ++;
                   $result[$counter] = array(
                                'id'  => $row->id,
                                'teamName' => $row->teamName,
                                'coach'    => $row->coach
                   );

                   $result[$counter]['player'][] = array(
                                    'id' => $row->playerId,
                                    'name' => $row->playerName,
                                    'position' => $row->position,
                                    'number'   => $row->number
                   );


               }
               else
               {
                   $result[$counter]['player'][] = array(
                                    'id' => $row->playerId,
                                    'name' => $row->playerName,
                                    'position' => $row->position,
                                    'number'   => $row->number
                   );
               }
              $prevId = $row->id;
           }
           return $result;
    }
}