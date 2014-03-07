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
}