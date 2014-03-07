<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testcases extends CI_Controller {

    function  __construct(){
        parent::__construct();
        $this->load->model('user_model','user');
    }
    
    public function insertUser()
    {        
        $name = 'aaa';
        $uid = 'C123';
        $country = '5';
        $saveArray = array('name' => $name,
                           'uid'  => $uid,
                           'countryId' => $country
                            );
        $response = $this->user->addUser($saveArray);
    }
    
    public function activateUser()
    {
         $uid = 'C123';
         $response = $this->user->activate($uid);
    }
    
    public function index()
    {
        echo "herer";
    }
    
    public function createGroup()
    {
        $this->load->model('group_model','group');
        $groupName = 'group1';
        
        //get userId from nonce
        $saveArray = array('name' => $groupName, 'creatorId' => '1');
        $result = $this->group->create($saveArray);
    }
    
    public function joinGroup()
    {
        $this->load->model('group_model','group');
        
        $groupId = '4';
        $userid = '2';
        $data = array('userId' => $userid, 'groupId' => $groupId);
        $this->group->join($data);
    }
}
