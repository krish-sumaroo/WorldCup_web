<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actions extends CI_Controller {
    function  __construct()
    {
        parent::__construct();
        $this->load->model('game_model','game');
    }
    
    
    private function _checkMoves($userId, $gameId)
    {
        $nMoves = $this->game->getGamesMovesForUser($userId, $gameId);
        $sMoves = $this->game->getSMovesForUser($userId);
       
        if($nMoves['nMoves'] == 0 && $sMoves == 0)
        {
            return false;
        }
        else
        {
            $arr['nMoves'] = $nMoves;
            $arr['sMoves'] = $sMoves;
            return $arr;
        }
    }
    
    public function score()
    {  
        $gameId = $this->input->post('gameId');
        $team1Id = $this->input->post('team1Id');
        $team2Id = $this->input->post('team2Id');
        $team1Score = $this->input->post('team1Score');
        $team2Score = $this->input->post('team2Score');
        $userId = $this->input->post('userId');
        
        log_message('error', 'posts=>'.print_r($this->input->post(), true));
        
         //test save array //
//            $gameId = 3;
//            $team1Id = 1;
//            $team2Id = 2;
//            $team1Score = 3;
//            $team2Score = 0;
//            $userId = 2;
        
        $moves = $this->_checkMoves($userId, $gameId);
        
        log_message('error', 'moves =>'.print_r($moves, true));
        
        if($moves)
        {
            // register score and update points
            $saveArray = array();
            $saveArray['gameId'] = $gameId;
            $saveArray['team1Id'] = $team1Id;
            $saveArray['team2Id'] = $team2Id;
            $saveArray['team1Score'] = $team1Score;
            $saveArray['team2Score'] = $team2Score;
            $saveArray['userId'] = $userId; 
            
            $result = $this->game->registerScore($saveArray);
            
            $newNMove = $moves['nMoves']['nMoves'];
            $newSMove = $moves['sMoves']->sMoves;
            if($result)
            {
               $nMoveLeft = $moves['nMoves']['nMoves'];
               if( $newNMove > 0)
               {
                    $newNMove = $newNMove - 1;
                    $sMoveLeft = $newSMove;
                    $this->game->updateNMove($moves['nMoves']['id'],$newNMove);
                    
                    log_message('error', 'normal');
               }
               else
               {
                   $sMoveLeft = $newSMove - 1;
                   $this->game->updateSMove($userId, $sMoveLeft);
                   log_message('error', 'special'.$sMoveLeft);
                   
               }
               $response['status'] = true;
               $response['nMove'] = $newNMove;
               $response['sMove'] = $sMoveLeft;
            }
            else
            {
                $response['status'] = false;
                $response['errorCode'] = 401;
                $response['msg'] = 'Error saving';
            }            
        }
        else
        {
            $response['status'] = false;
            $response['errorCode'] = 402;
            $response['msg'] = 'No moves found';
        }
        
        
        log_message('error', 'reponse =>'.print_r($response, true));
        echo json_encode($response);
    }
    
    public function action()
    {
        $actionId = $this->input->post('actionId');
        $playerId = $this->input->post('playerId');
        $userId = $this->input->post('userId');
        $gameId = $this->input->post('gameId');
        
//        $actionId = 1;
//        $playerId = 2;
//        $userId = 2;
//        $gameId = 2;
        
        $moves = $this->_checkMoves($userId, $gameId);        
        
        if($moves)
        {
            // register score and update points
            $saveArray = array();
            $saveArray['actionId'] = $actionId;
            $saveArray['playerId'] = $playerId;
            $saveArray['userId'] = $userId;
            $result = $this->game->registerAction($saveArray); 
            
            $newNMove = $moves['nMoves']['nMoves'];
            $newSMove = $moves['sMoves']->sMoves;

            if($result)
            {

               if( $newNMove > 0)
               {
                    $newNMove = $newNMove - 1;
                    $this->game->updateNMove($moves['nMoves']['id'],$newNMove);
                    $sMoveLeft = $newSMove;
               }
               else
               {
                  $sMoveLeft = $newSMove - 1;
                  $this->game->updateSMove($userId, $sMoveLeft);
               }
               $response['status'] = true;
               $response['nMove'] = $newNMove;
               $response['sMove'] = $sMoveLeft;
            }
            else
            {
                $response['status'] = false;
                $response['errorCode'] = 401;
                $response['msg'] = 'Error saving';
            }
        }
        else
        {
            $response['status'] = false;
            $response['errorCode'] = 402;
            $response['msg'] = 'No moves found';
        }
        
        log_message('error', 'reponse =>'.print_r($response, true));
       echo json_encode($response); 
    }
}