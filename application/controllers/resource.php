<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource extends CI_Controller {

    function  __construct(){
        parent::__construct();

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
                           'country' => $country
                            );
        $response = $user->addUser($saveArray);
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




}