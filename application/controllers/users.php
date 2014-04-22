<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connections extends CI_Controller {

    function  __construct(){
        parent::__construct();

        //get userId from nonce
        $this->userConnected = 1; //test value
        $this->load->model('user_model','user');
    }

    public function checkName()
    {
        $uName = $this->input->post('nickname');
        $result = $this->user->checkAvailability('name',$uName);
        echo json_encode(['status' => $result]);
    }
    
    public function checkEmail()
    {
        $email = $this->input->post('email');
        $result = $this->user->checkAvailability('email',$email);
        echo json_encode(['status' => $result]);       
    }

    public function join()
    {
        $name = $this->input->post('name');
        $uid = $this->input->post('uid');
        $email = $this->input->post('email');
        $country = $this->input->post('country');
        
        if($this->user->checkAvailability('email',$email) && $this->user->checkAvailability('name',$uName))
        {
            $saveArray = array('name' => $name,
                           'uid'  => $uid,
                           'countryId' => $country,
                           'email' => $email,
                           'name' => $name
                            );
            $result = $this->user->addUser($saveArray);
            $response = $this->dbHelper->buildResponse($result);
            echo $response;
        }
        else
        {
            $response['status'] = 'V_F';
            $response['msg'] = "Email or Username already exists";
            echo json_encode($response);
        }
        
        
     }

    public function userAc()
    {
        $uid = $this->input->post('uid');
        $result = $this->user->activate('D123');
        $response = $this->dbHelper->buildResponse($result);
        echo $response;
    }
}