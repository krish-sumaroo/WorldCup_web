<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    function  __construct(){
        parent::__construct();

        //get userId from nonce
        $this->userConnected = 1; //test value
        $this->load->model('user_model','user');
    }

    public function checkNick()
    {
        $uName = $this->input->post('nickname');
        $result = $this->user->checkAvailability('nickname',$uName);
        echo json_encode(['status' => $result]);
    }
    
    public function checkUsername()
    {
        $email = $this->input->post('username');
        $result = $this->user->checkAvailability('username',$email);
        echo json_encode(['status' => $result]);       
    }

    public function join()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');        
        $nickname = $this->input->post('nickname');
        $favTeam = $this->input->post('favTeam');
        $uid = $this->input->post('uid');
        $country = $this->input->post('country');
     
        if($this->user->checkAvailability('username',$username) && $this->user->checkAvailability('nickname',$nickname))
        {
            $saveArray = array('username' => $username,
                           'password' => md5($password), 
                           'uid'  => $uid,
                           'country' => $country,
                           'nickname' => $nickname,
                           'teamId' => $favTeam
                            );
            
            $result = $this->user->addUser($saveArray);
            $response = $this->dbhelper->buildResponse($result);
            echo $response;
        }
        else
        {
            $response['status'] = false;
            $response['msg'] = "Username or Nickname already exists";
            echo json_encode($response);
        }       
     }
     
     public function login()
     {
         $username = $this->input->post('username');
         $password = $this->input->post('password');
         
         $params = array('username' => $username,
                         'password' => md5($password) );
         
         $result = $this->user->login($params);
     }

    public function userAc()
    {
        $uid = $this->input->post('uid');
        $result = $this->user->activate('D123');
        $response = $this->dbHelper->buildResponse($result);
        echo $response;
    }
}