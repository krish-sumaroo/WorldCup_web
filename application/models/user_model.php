<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    public function addUser($data)
    {
        $this->db->insert($this->table, $data);

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
    
    public function login($data)
    {
        $this->db->select(array('uid', 'id','status','teamId','score'));
        $this->db->where($data);
        $this->db->from($this->table);
        
        $results = $this->db->get()->row(); 

        if(count($results) > 0)
        {
            return $results;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function saveRegis($regisId, $uid)
    {
        $this->db->where('uid', $uid);
        $this->db->update($this->table, array('regisId' => $regisId));
    }

    public function checkAvailability($field, $uName)
    {        
        $this->db->where($field, $uName);
        $this->db->from($this->table);
        if($this->db->count_all_results() > 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    public function update($saveArray, $userId)
    {
        $this->db->where('id', $userId);
        $this->db->update($this->table, $saveArray);
    }


    public function getRegisId($uid)
    {
        $this->db->select('regisId');
        $this->db->where('uid', $uid);
        $this->db->from($this->table);
        
        $data =  $this->db->get()->row();
        return $data;
    }

    public function activate($uid)
    {
        $this->db->where('uid', $uid);
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

    public function findUserByUsername($username)
    {
       $this->db->select('id');
       $this->db->from('users');
       $this->db->where(array('name' => $username));

       $query = $this->db->get();
       if ($query->num_rows() > 0)
        {
            $uName = $query->row('id');
            $this->db->close();
            return $uName;
        }
        else
        {
            return FALSE;
        }
    }
}