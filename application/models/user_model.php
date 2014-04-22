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

    public function checkAvailability($field, $uName)
    {
        $this->db->where($field, $uName);
        $this->db->from($this->table);
        if($this->db->count_all_results() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
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