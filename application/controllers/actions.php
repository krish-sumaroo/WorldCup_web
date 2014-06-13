<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actions extends CI_Controller {
    function  __construct()
    {
        parent::__construct();
        $this->load->model('game_model','game');
        $this->_gameStatus = $this->config->gameStatus;
    }
    
    private function _calcScorePoints($gameStatus, $timestamp)
    {
        if($gameStatus->startedF == 0)
        {
            //not started yet -> full points
            $points = 50;
        }
        elseif($gameStatus->startedF == 1 ) //1st half
        {
            $gameTime = $gameStatus->started1Time;
            $gameTimeUNIX  = strtotime($gameTime);
            $timeDiff = $timestamp - $gameTimeUNIX;
            
            switch($timeDiff)
            {
                case ($timeDiff > 0 && $timeDiff < 900) :
                    $points = 40;
                    break;
                case ($timeDiff > 901 && $timeDiff < 1800):
                    $points = 35;
                    break;
                case ($timeDiff > 1801 && $timeDiff < 3900):
                    $points = 30;
                    break;
            }
        }
        elseif($gameStatus->startedF == 2)
        {
            $gameTime = $gameStatus->started2Time;
            $gameTimeUNIX  = strtotime($gameTime);
            $timeDiff = $timestamp - $gameTimeUNIX;
            
            switch($timeDiff)
            {
                case ($timeDiff > 0 && $timeDiff < 900) :
                    $points = 25;
                    break;
                case ($timeDiff > 901 && $timeDiff < 1500):
                    $points = 20;
                    break;
                case ($timeDiff > 1501 && $timeDiff < 2100):
                    $points = 10;
                    break;
                case ($timeDiff > 2101 && $timeDiff < 2400):
                    $points = 5;
                    break;
                case ($timeDiff > 2400):
                    $points = 2;
                    break;
            }           
        }
        return $points;
    }

    private function _checkGameValid($gameId)
    {
        $gameStatus = $this->game->getGameStatus($gameId);
        if(!$gameStatus || $gameStatus->startedF == 3)
        {
            return false;
        }
        else
        {
            return $gameStatus;
        }
    }
    
    private function _checkGameValidX($gameId)
    {
        $gameStatus = $this->game->getGameStatus($gameId);
        
        if($gameStatus)
        {
            if($gameStatus->startedF == 3) //game is over
            {
                $status['status'] = false;
            }
            elseif($gameStatus->startedF == 0) //not started give full points
            {
                $status['status'] =  true;
                $status['points'] = 50;
            }
            else
            {
                $status['status'] = true;
                $status['points'] = $this->_calcScorePoints($gameStatus->startedF);
            }
        }
        else
        {
            //gameId doesn't exist
            $status['status'] = false;
        }
        
        return $status;
    }
    
    
    private function _checkMoves($userId, $gameId)
    {
        $nMoves = $this->game->getGamesMovesForUser($userId, $gameId);
        $sMoves = $this->game->getSMovesForUser($userId);
       
        log_message('error', 'sMoves =>'.print_r($sMoves, true));
        
        if($nMoves['nMoves'] == 0 && $sMoves->sMoves == 0)
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
        $timestampAction = time();
        
        $gameId = $this->input->post('gameId');
        $team1Id = $this->input->post('team1Id');
        $team2Id = $this->input->post('team2Id');
        $team1Score = $this->input->post('team1Score');
        $team2Score = $this->input->post('team2Score');
        $userId = $this->input->post('userId');
        
        $gameValid = $this->_checkGameValid($gameId);
        if(!$gameValid)
        {
            $response['status'] = false;
            $response['errorCode'] = 401;
            $response['msg'] = 'Game is over';
            echo json_encode($response);
            return false;
        }
        
        $points = $this->_calcScorePoints($gameValid,$timestampAction);
        
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
        
        $playerTeamId = $this->game->getTeamIdFromPlayer($playerId);
        
//        $actionId = 1;
//        $playerId = 2;
//        $userId = 2;
//        $gameId = 2;
        
        $moves = $this->_checkMoves($userId, $gameId);     
        
        //log_message('error', 'moves =>'.print_r($moves));
        
        if($moves)
        {               
            $newNMove = $moves['nMoves']['nMoves'];
            $newSMove = $moves['sMoves']->sMoves;
            $teamId = $moves['sMoves']->teamId;
            
            
            $saveArray = array();
            
            if($teamId == $result)
            {
                $saveArray['score'] = 20;
            }            
            // register score and update points
            
            $saveArray['actionId'] = $actionId;
            $saveArray['playerId'] = $playerId;
            $saveArray['userId'] = $userId;
            $result = $this->game->registerAction($saveArray); 
         

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