<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Push extends CI_Controller {
    
    function  __construct()
    {
        parent::__construct();
        $this->load->library('pushlib');
        $this->load->model('user_model','user');
    }
    
    public function finalPlayerList()
    {
        $uid = $this->input->POST('uid');
         
         //$uid = '357157053190069';
         $uid = 'b26cee37382e797';
         //$regisId = $this->user->getRegisId($uid);
         
         //print_r($regisId);
         
         $regisId = array('APA91bFQgcuKxE47jn1JppKbBkBBmq1i_a5U456m-KrrZlJnKIarIGwHS3Zrnxz19yACGddT0BGLldcB9OiJ-YwoxXzYLTQrtwNaBeHnnL7KB-BLLjw8yxmP0rt5SxK38-gsTlXeQ86CBM4G9pMGdTGOV60p28bTrA');
         
         //$regisId = array('APA91bFrYoomCiq7la_u35DsNCMjrJbspLCoyWArF8VnnG1B4Vsht4Ltf7OwckZzzCJ1IqY_hcZgtDj1nwI8lhVCG29fU2_Nw3mfY17472F7gT3yJ1r4hFdKgcVLgdESTX7LAvzIgj7yR6vthUOHhr1ahr7FkbUF2m4jptWKx71QboDjU14GYXw');
         
         $payload = array('action' => 1, 'msg' => 'hello there', 'timestamp' => 1256321, 'gameId' => 1);
         
         //$payload = array('action' => 1, 'msg' => 'final list available', 'timestamp' => 1256321, 'gameId' => 1);
         $this->pushlib->sendMessage($regisId, $payload);
    }
    
    
    public function gameOver_test()
    {
        $uid = $this->input->POST('uid');
         
         //$uid = '357157053190069';
         $uid = 'b26cee37382e797';
         //$regisId = $this->user->getRegisId($uid);
         
         //print_r($regisId);
         
         $regisId = array('APA91bFQgcuKxE47jn1JppKbBkBBmq1i_a5U456m-KrrZlJnKIarIGwHS3Zrnxz19yACGddT0BGLldcB9OiJ-YwoxXzYLTQrtwNaBeHnnL7KB-BLLjw8yxmP0rt5SxK38-gsTlXeQ86CBM4G9pMGdTGOV60p28bTrA');
         
         //$regisId = array('APA91bFrYoomCiq7la_u35DsNCMjrJbspLCoyWArF8VnnG1B4Vsht4Ltf7OwckZzzCJ1IqY_hcZgtDj1nwI8lhVCG29fU2_Nw3mfY17472F7gT3yJ1r4hFdKgcVLgdESTX7LAvzIgj7yR6vthUOHhr1ahr7FkbUF2m4jptWKx71QboDjU14GYXw');
         
         $payload = array('action' => 2, 'msg' => 'game over', 'timestamp' => 1256321, 'gameId' => 2);
         $this->pushlib->sendMessage($regisId, $payload);
    }
    
    public function testScore()
    {
        $regisId = array('APA91bFQgcuKxE47jn1JppKbBkBBmq1i_a5U456m-KrrZlJnKIarIGwHS3Zrnxz19yACGddT0BGLldcB9OiJ-YwoxXzYLTQrtwNaBeHnnL7KB-BLLjw8yxmP0rt5SxK38-gsTlXeQ86CBM4G9pMGdTGOV60p28bTrA',
                        'APA91bFrYoomCiq7la_u35DsNCMjrJbspLCoyWArF8VnnG1B4Vsht4Ltf7OwckZzzCJ1IqY_hcZgtDj1nwI8lhVCG29fU2_Nw3mfY17472F7gT3yJ1r4hFdKgcVLgdESTX7LAvzIgj7yR6vthUOHhr1ahr7FkbUF2m4jptWKx71QboDjU14GYXw');
         
         //$regisId = array('APA91bFrYoomCiq7la_u35DsNCMjrJbspLCoyWArF8VnnG1B4Vsht4Ltf7OwckZzzCJ1IqY_hcZgtDj1nwI8lhVCG29fU2_Nw3mfY17472F7gT3yJ1r4hFdKgcVLgdESTX7LAvzIgj7yR6vthUOHhr1ahr7FkbUF2m4jptWKx71QboDjU14GYXw');
         
         $payload = array('action' => 3, 'msg' => 'You, Murder and Kraft just won 50pts', 'score' => 1256);
         $this->pushlib->sendMessage($regisId, $payload);
    }
    
    public function gameOver()
    {
        //test value
        $gameId = 2;
        $team1 = 'Brazil';
        $team2 = 'Croatia';
        
        $finArr = array();
        
        // end test
        
        $msg = $team1." VS ".$team2." has ended";        
        
        $regisIds = $this->user->getRegisIds();

        $regisChunks = array_chunk($regisIds, 996);       
       
        foreach($regisChunks as $regisBatch)
        {
            foreach($regisBatch as $regisId)
            {
                //print_r($regisId['regisId']);
               array_push($finArr, $regisId['regisId']); 
            }
            
            $payload = array('action' => 2,  'msg' => $msg, 'timestamp' => time(), 'gameId' => $gameId);
            $this->pushlib->sendMessage($finArr, $payload);
        }       
    }  
    
     public function action()
    {
         sleep(3);
         //$gameId = 
         echo "test";
    }
   
}