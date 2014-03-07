<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class group_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'groups';
    }
    
    public function create($data)
    {
        $this->db->insert($this->table, $data);

        if($this->db->affected_rows())
        {
            //now join group
            //groupJoinData
            $dataGroup = array('userId' => $data['creatorId'], 'groupId' => $this->db->insert_id());
            $this->join($dataGroup, FALSE);
            $this->db->close();
            return TRUE;
        }
        else
        {
            $this->db->close();
            return FALSE;
        }
    }
    
    public function join($data, $checkFLAG = TRUE)
    {
        if($checkFLAG && $this->_checkIfExist($data) > 0)
        {
            log_message('error', 'should not be here');
            return FALSE; //already exist
        }
        else 
        {
            $this->db->insert('users_groups', $data);
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
    }
    
    private function _checkIfExist($data)
    {
        $this->db->select('userId');
        $this->db->from('users_groups');
        $this->db->where($data);
        return ($this->db->count_all_results());        
    }

}