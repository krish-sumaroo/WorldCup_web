<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    function  __construct()
    {
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
    
    public function regisGCM()
    {
        $registrationId = $this->input->post('regisId');
        $uid = $this->input->post('uid');
        $this->user->saveRegis($registrationId, $uid);        
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
     
     public function pushTest()
     {
         $uid = $this->input->POST('uid');
         
         //$uid = '357157053190069';
         $uid = 'b26cee37382e797';
         $regisId = $this->user->getRegisId($uid);
         
         //print_r($regisId);
         
         $regisId = array('APA91bFQgcuKxE47jn1JppKbBkBBmq1i_a5U456m-KrrZlJnKIarIGwHS3Zrnxz19yACGddT0BGLldcB9OiJ-YwoxXzYLTQrtwNaBeHnnL7KB-BLLjw8yxmP0rt5SxK38-gsTlXeQ86CBM4G9pMGdTGOV60p28bTrA');
         
         //$regisId = array('APA91bFrYoomCiq7la_u35DsNCMjrJbspLCoyWArF8VnnG1B4Vsht4Ltf7OwckZzzCJ1IqY_hcZgtDj1nwI8lhVCG29fU2_Nw3mfY17472F7gT3yJ1r4hFdKgcVLgdESTX7LAvzIgj7yR6vthUOHhr1ahr7FkbUF2m4jptWKx71QboDjU14GYXw');
         
         $this->load->library('pushlib');
         $message=array('msg' => 'test');
         $this->pushlib->sendMessage($regisId, $message);
     }
     
     public function login()
     {
         $username = $this->input->post('username');
         $password = $this->input->post('password');
         $uid = $this->input->post('uid');
         
//         $username = 'a@a.comp';
//         $password = 't';
//         $uid = 'b26cee37382e797ertyreergggrgrg';
         
         log_message('error', 'uid =>'.print_r($this->input->post(), true));
         
         $params = array('username' => $username,
                         'password' => md5($password));
         
         $result = $this->user->login($params);
         if($result)
         {
             if($uid != $result->uid)
             {
                 $this->user->update(['uid' => $uid], $result->id);
             }
             $response['status'] = true;
             $response['id'] = $result->id;
             $response['profile'] = $result->status;
             $response['favTeamId'] = $result->teamId;
             $response['score'] = $result->score;
         }
         else {
             $response['status'] = false;
         }
         
         echo json_encode($response);
     }

    public function userAc()
    {
        $uid = $this->input->post('uid');
        $result = $this->user->activate('D123');
        $response = $this->dbHelper->buildResponse($result);
        echo $response;
    }
    

}