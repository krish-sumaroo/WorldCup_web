<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stats extends CI_Controller {

    function  __construct()
    {
        parent::__construct();
        //get userId from nonce
        $this->load->model('user_model','user');
    }
    
    
    public function country()
    {
        $uid = $this->input->post('uid');
        
        //$uid = '357157053190069';
        $country = $this->user->getCountryForUser($uid);
        log_message('error', 'country');
        $data = $this->user->getCountryStats($country);        
        //print_r($data);
        echo json_encode($data);    
    }
    
    public function general()
    {
        $uid = $this->input->post('uid');
        
        //$uid = '357157053190069';
        $data = $this->user->getGeneralStats($uid);
        //print_r($data);
        echo json_encode($data);  
    }
    
    public function friends()
    {
        $uid = $this->input->post('uid');        
        //$uid = '357157053190069';
        
        $userId = $this->user->getIdForUser($uid);
        $data = $this->user->getFriendsStats($uid, $userId);
        //print_r($data);
        echo json_encode($data);  
    }

    public function testC()
    {
        $array[] = array('position' => 1, 'name' => 'Mauritius', 'score' => 2500);
        $array[] = array('position' => 2, 'name' => 'Beau-Vallon', 'score' => 250);   
        $array[] = array('position' => 3, 'name' => 'Beau-Bassin', 'score' => 225);   
        $array[] = array('position' => 4, 'name' => 'Beau-Songes', 'score' => 200);   
        $array[] = array('position' => 5, 'name' => 'Beau-pakoner', 'score' => 125); 
        echo json_encode($array);        
    }
    
    public function general_test()
    {
        $array[] = array('position' => 1, 'name' => 'Mauritius', 'score' => 2500);
        $array[] = array('position' => 2, 'name' => 'Beau-Vallon', 'score' => 250);   
        $array[] = array('position' => 3, 'name' => 'Beau-Bassin', 'score' => 225);   
        $array[] = array('position' => 4, 'name' => 'Beau-Songes', 'score' => 200);   
        $array[] = array('position' => 5, 'name' => 'Beau-pakoner', 'score' => 125); 
        echo json_encode($array);        
    }
    
    public function friends_test()
    {
        $array[] = array('position' => 1, 'name' => 'Mauritius', 'score' => 2500);
        $array[] = array('position' => 2, 'name' => 'Beau-Vallon', 'score' => 250);   
        $array[] = array('position' => 3, 'name' => 'Beau-Bassin', 'score' => 225);   
        $array[] = array('position' => 4, 'name' => 'Beau-Songes', 'score' => 200);   
        $array[] = array('position' => 5, 'name' => 'Beau-pakoner', 'score' => 125); 
        echo json_encode($array);        
    }
    
//     public function getCountryStats()
//    {
//        echo "hello";
//        $sql = "select u.country, sum(u.score) as score, c.name from users u
//                JOIN country c ON u.country = c.id
//                group by u.country
//                ORDER by score desc";
//        $query = $this->db->query($sql);
//        return $query->result_array();
//    }
}