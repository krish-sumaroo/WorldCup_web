<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }
    
    private function getCountry($country)
    {
        $sql = "SELECT id from country WHERE name = '".$country."'";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            $rst =  $query->row();
            return $rst->id;
        }
        else
        {
            $this->db->insert('country', ['name' => $country]);
            return $this->db->insert_id();            
        }
    }

    public function addUser($data)
    {
        $countryId = $this->getCountry($data['country']);
        $data['country'] = $countryId;       
        
        $this->db->insert($this->table, $data);

        if($this->db->affected_rows())
        {            
            $newId = $this->db->insert_id();
            $this->db->close();
            return $newId;
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
    
    public function checkUsername($username)
    {
        $sql = "SELECT id, status as profile, teamId as favTeamId, score "
                . "FROM users WHERE username = '".$username."'";
        
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            return $query->row_array();
        }
        else
        {
            return false;
        }
        

//             $response['id'] = $result->id;
//             $response['profile'] = $result->status;
//             $response['favTeamId'] = $result->teamId;
//             $response['score'] = $result->score;
    }
    
    public function findMatch($search, $userId)
    {
       $sql = "select u.id, u.username, u.nickname,  IFNULL(c.status, 0) as friend"
              ." FROM connections c"
              ." RIGHT JOIN users u ON c.user2 = u.id"
              ." WHERE c.user1 = $userId"
              ." AND u.username LIKE '%$search%' OR u.nickname LIKE '%$search%'"
              ." AND u.id <> $userId";
        
        //echo $sql."<br />";
        log_message('error', 'findmatch => '.$sql);
        $query = $this->db->query($sql);
        return $query->result_array();        
    }
    
    public function sendInvite($userId, $friendId)
    {
        $this->db->trans_start();
        $this->db->query("INSERT INTO connections(user1,user2, status) VALUES ($userId, $friendId, 3)");
        $this->db->query("INSERT INTO connections(user1,user2, status) VALUES ($friendId, $userId, 2)");
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE)
        { 
            return false;
        }
        else
        {
            return true;
        }
    }
    
    public function listFriends($userId)
    {
        $sql = "select c.user2, c.status, u.nickname
                FROM connections c
                JOIN users u ON c.user2 = u.id
                WHERE c.user1 = $userId AND c.status <> 3";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function decline($userId, $friendId)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM connections WHERE user1 = $userId AND user2 = $friendId");
        $this->db->query("DELETE FROM connections WHERE user1 = $friendId ANd user2 = $userId");
        $this->db->trans_complete();

        if($this->db->trans_status())
        { 
            return true;
        }
        else {
            return false;
        }
    }


    public function accept($userId, $friend)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE connections SET status = 1 WHERE user1 = $userId AND user2 = $friend");
        $this->db->query("UPDATE connections SET status = 1 WHERE user1 = $friend AND user2 = $userId");
        $this->db->trans_complete();

        if($this->db->trans_status())
        { 
            return true;
        }
        else {
            return false;
        }
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
    
    public function resetUID($uid, $userId)
    {
        $sql = "UPDATE users SET uid = null WHERE uid = '$uid'";
        $this->db->query($sql);
        
        $sql2 = "UPDATE users SET uid = '$uid' WHERE id = $userId";
        $this->db->query($sql2);
    }


    public function getRegisId($uid)
    {
        $this->db->select('regisId');
        $this->db->where('uid', $uid);
        $this->db->from($this->table);
        
        $data =  $this->db->get()->row();
        return $data;
    }
    
    public function getRegisIds()
    {
        $sql = "SELECT DISTINCT(regisId) from users WHERE regisId is not null";
        $query = $this->db->query($sql);
        return $query->result_array();
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
    
    public function getCountryForUser($uid)
    {
        $sql = "SELECT country FROM users WHERE uid = '".$uid."'";
        $query = $this->db->query($sql);
        return $query->row('country');
    }
    
    public function getIdForUser($uid)
    {
        $sql = "SELECT id FROM users WHERE uid = '".$uid."'";
        $query = $this->db->query($sql);
        return $query->row('id');
    }


    public function getCountryStats_old($country)
    {
        $sql = "select u.country, sum(u.score) as score, c.name,
                (case when (u.country = '$country') then 1 else 0 end) as status,
                @curRank := @curRank + 1 AS rank     
                from users u, , (SELECT @curRank := 0) r                
                JOIN country c ON u.country = c.id
                group by u.country
                ORDER by score desc";
        echo $sql;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getCountryStats($country)
    {
        $sql = "select name as nickname, score, (case when (id = '$country') then 1 else 0 end) as status, 
                @curRank := @curRank + 1 AS rank 
                from country, (SELECT @curRank := 0) r
                ORDER by score desc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getGeneralStats($uid)
   {
       $sql = "select nickname, score, (case when (uid = '$uid') then 1 else 0 end) as status,
               @curRank := @curRank + 1 AS rank  
                from users, (SELECT @curRank := 0) r
                ORDER by score desc
                limit 100";
       
       $query = $this->db->query($sql);
       return $query->result_array();
    }
    
    public function getFriendsStats($uid, $userId)
    {
        $sql = "select nickname, score, (case when (uid = '$uid') then 1 else 0 end) as status,
                @curRank := @curRank + 1 AS rank
                from users, (SELECT @curRank := 0) r
                where uid = '$uid'
                or id IN (
                select user2 from connections 
                where user1 = $userId
                )
                ORDER by score desc ";
        $query = $this->db->query($sql);
       return $query->result_array();       
    }
    
    public function addMoves($moves, $uid)
    {
        $sql = "UPDATE users SET sMoves = sMoves + $moves, status = 1 WHERE uid = '$uid'";
        //echo $sql;
        log_message('error', 'sql =>'.$sql);
        $query = $this->db->query($sql);
        
    }
    
    public function savePurchase($uid, $token)
    {
        $sql = "INSERT INTO purchases(string, uid) VALUES('$uid', '$token')";
        $query = $this->db->query($sql);
    }
}