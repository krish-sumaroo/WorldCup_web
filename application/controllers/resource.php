<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource extends CI_Controller {

    function  __construct(){
        parent::__construct();
        
        //get userId from nonce
        
        $this->userId = 1; //test value

    }

    public function initialise()
    {
        $this->load->model('resource_model','resource');
        $result = $this->resource->getTeamDetails();

        log_message('error', 'details =>'.print_r($result, true));
        log_message('error', 'json =>'.  json_encode($result));
    }


    public function crUser()
    {
        $this->load->model('user_model','user');
        $name = $this->input->post('name');
        $uid = $this->input->post('uid');
        $country = $this->input->post('country');
        $saveArray = array('name' => $name,
                           'uid'  => $uid,
                           'countryId' => $country
                            );
        $response = $this->user->addUser($saveArray);
    }

    /*  activate user
     *  - no ads
     */
    public function userAc()
    {
        $this->load->model('user_model', 'user');
        $uid = $this->input->post('uid');
        $response = $this->user->activate($uid);
    }
    
    public function createGroup()
    {
        $this->load->model('group_model','group');
        $groupName = $this->input->post('group');
        
        //get userId from nonce
        $saveArray = array('name' => $groupName, 'creatorId' => $userId);
        $this->group->create($saveArray);
    }
    
    public function joinGroup($grpId)
    {
        $this->load->model('group_model','group');
        
        $groupId = $this->input->post('grpId');
        $data = array('userId' => $this->userId, 'groupId' => $groupId);
        $this->group->join($data);
    }
    
}