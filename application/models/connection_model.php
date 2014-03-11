<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class connection_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->table = 'connections';
    }
    
    public function connect($data)
    {
        $this->db->where($data);
        $this->db->update($this->table, array('status' => '1'));
        
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
    
    public function getConnections($data)
    {
       $this->db->select('u.id, u.name as name');
       $this->db->from('connections c');
       $this->db->join('users u', 'c.user2 = u.id');
       $this->db->where($data);

       $query = $this->db->get();

	if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $result[] = $row;
            }
            $this->db->close();
            return $result;
        }
        else
        {
            return FALSE;
        }
    }
}