<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    function  __construct()
    {
        parent::__construct();

        //get userId from nonce
        $this->userConnected = 1; //test value
        $this->load->model('user_model','user');
        $this->product = array(
            '10SKU' => 10,
            '25SKU' => 25,
            '50SKU' => 50,
            'android.test.purchased' => 10
        );
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
        $response = $this->user->checkUsername($email);
        
        if($response)
        {
            $response['status'] = true;
        }
        else
        {
            $response['status'] = false;
        }
       echo json_encode($response);  
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
        
//        $username = 'test4';
//        $password = 'elo';        
//        $nickname = 'what4';
//        $favTeam = 1;
//        $uid = '34546346';
//        $country = 'jupiter';          
     
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
           
            $response['status'] = true;
            $response['id'] = $result;
            $response['profile'] = 0;
            $response['favTeamId'] = $favTeam;
            $response['score'] = 0;
            
            echo json_encode($response);
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
             //update user uid and reset the rest with same uid
             $this->user->resetUID($uid,$result->id);
             
             /*
             if($uid != $result->uid)
             {
                 $this->user->update(['uid' => $uid], $result->id);
             }
              * 
              */
             $response['status'] = true;
             $response['id'] = $result->id;
             $response['profile'] = $result->status;
             $response['favTeamId'] = $result->teamId;
             $response['score'] = $result->score;
         }
         else {
             $response['status'] = false;
         }
         
         
         log_message('error', 'profile =>'.print_r($response, true));
         echo json_encode($response);
     }

    public function userAc()
    {
        $uid = $this->input->post('uid');
        $result = $this->user->activate('D123');
        $response = $this->dbHelper->buildResponse($result);
        echo $response;
    }
    
    public function search()
    {
        $search = $this->input->post('search');
        $userId = $this->input->post('user');
        
        //$search = 'boul';
        //$userId = 43;

        $result = $this->user->findMatch($search, $userId);
        echo json_encode($result);
    }
    
    public function sendInvite()
    {
        $userId = $this->input->post('user');
        $friendId = $this->input->post('friend');
        
        //$userId = 43;
        //$friendId = 31;
        
        $status = $this->user->sendInvite($userId, $friendId);  
    
        echo json_encode(array('status' => $status));
    }
     
    public function friends()
    {
        $userid = $this->input->post('user');
        
        //$userid = 46;
        
        $friends = $this->user->listFriends($userid);
        
        log_message('error','friends =>'.print_r($friends, true));
        
//        echo "<pre>";
//        print_r($friends);
//        echo "</pre>";
        
        echo json_encode($friends);
    }
    
    public function decline()
    {
        $userid = $this->input->post('user');
        $friendId = $this->input->post('friend');
        
        //$userid = 46;
        
        $friends = $this->user->decline($userid, $friendId);        
        echo json_encode($friends);
    }


    public function acceptInvite()
    {
        $userId = $this->input->post('user');
        $friendId = $this->input->post('friend');
        
        //$userId = 31;
        //$friendId = 43;
        
        $status = $this->user->accept($userId, $friendId);
        
        echo json_encode(array('status' => $status));
    }
    
    public function purchase()
    {
        $uid = $this->input->post('uid');
        $transac = $this->input->post('transac');
       
        //$uid = '357157053190069';
        //$transac = '{"packageName":"com.competition.worldcupv1","orderId":"transactionId.android.test.purchased","productId":"android.test.purchased","developerPayload":"","purchaseTime":0,"purchaseState":0,"purchaseToken":"inapp:com.competition.worldcupv1:android.test.purchased"}';
        $strClean = explode("PurchaseInfo:", $transac)[1];
        $arr = json_decode($strClean);
        
        //log_message('error', 'purchases =>'.print_r($arr, true));        
        $productId = $arr->productId;
        $purchaseToken = $arr->purchaseToken;
        $orderId = $arr->orderId;
        $purchaseTime = $arr->purchaseTime;
        
        $this->user->savePurchase($uid, $productId, $purchaseToken,$orderId, $purchaseTime);
        
        $moves = $this->product[$productId];
        
        //using hardcoded values la
        //$uid = '357157053190069';
        //$moves = 10;
        
        $this->user->addMoves($moves, $uid);
        
        $arr = array('status' => true);
        echo json_encode($arr);
    }
    
    public function testString()
    {
        
        $string = 'PurchaseInfo:{"packageName":"com.competition.worldcupv1","orderId":"transactionId.android.test.purchased","productId":"android.test.purchased","developerPayload":"","purchaseTime":0,"purchaseState":0,"purchaseToken":"inapp:com.competition.worldcupv1:android.test.purchased"}';
        //$string = '{"packageName":"com.competition.worldcupv1","orderId":"transactionId.android.test.purchased","productId":"android.test.purchased","developerPayload":"","purchaseTime":0,"purchaseState":0,"purchaseToken":"inapp:com.competition.worldcupv1:android.test.purchased"}';
        
        $strClean = explode("PurchaseInfo:", $string)[1];
        log_message('error','string =>'.$strClean);
        $arr = json_decode($strClean);
        
        log_message('error', 'transac =>'.print_r($arr, true));
        $productId = $arr->productId;
        $purchaseToken = $arr->purchaseToken;
        $orderId = $arr->orderId;
        $purchaseTime = $arr->purchaseTime;
        
        
        $moves = $this->product[$productId];
        echo $moves;
        
//        echo "<pre>";
//        print_r($arr);
//        echo "</pre";
    }
    

}