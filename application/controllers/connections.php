<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connections extends CI_Controller {

    function  __construct(){
        parent::__construct();      

        //get userId from nonce
        $this->userConnected = 1; //test value
    }
    
    /* sendInvite to user
     * send invite using username
     */
    public function sendInvite()
    {
        $this->load->model('connection_model','connection');
        $this->load->model('user_model','user');
        $username = $this->input->post('uName');
        
        $userNameId = $this->user->findUserByUsername($username);
        
        $response = array();
        
        if($userNameId)
        {
            $connect = array('user1' => $uid, 'user2' => $userNameId);
            $result = $this->connection->connect($connect);
            $response = $this->dbHelper->buildResponse($result);
        }
        else
        {
            $resp['status'] = 'U_X';
            $resp['msg'] = "Username doesn't exist";
            $response = json_encode($resp);
        }       
       echo $response;
    }
    
    /* accept invite */
    public function acceptInvite()
    {
        $this->load->model('connection_model','connection');
        $uid2 = $this->input->post('uid');
        $connect = array('user1' => $uid, 'user2' => $uid2);
        $result = $this->connection->acceptInvite($connect);
        $response = $this->dbHelper->buildResponse($result);
        echo $response;
    }   

}
