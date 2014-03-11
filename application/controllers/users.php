<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connections extends CI_Controller {

    function  __construct(){
        parent::__construct();      

        //get userId from nonce
        $this->userConnected = 1; //test value
    }

    public function join()
    {
            $this->load->model('user_model','user');
            $name = $this->input->post('name');
            $uid = $this->input->post('uid');
            $country = $this->input->post('country');
            $saveArray = array('name' => $name,
                               'uid'  => $uid,
                               'countryId' => $country
                                );
            $result = $this->user->addUser($saveArray);
            $response = $this->dbHelper->buildResponse($result);
            echo $response;
     }
     
    public function userAc()
    {
        $this->load->model('user_model', 'user');
        $uid = $this->input->post('uid');
        $result = $this->user->activate('D123');
        $response = $this->dbHelper->buildResponse($result);
        echo $response;
    }
}