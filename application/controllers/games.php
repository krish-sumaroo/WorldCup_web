<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Games extends CI_Controller {

    function  __construct(){
        parent::__construct();
        $this->load->model('game_model','game');
        //get userId from nonce        
    }
    
    
    public function country()
    {
        //echo "here";
        $this->load->model('user_model','user');
        $stats = $this->user->getCountryStats();        
        print_r($stats);      
    }

    /*
    public function getGames()
    {
        $result = $this->game->getNext2Days();
        if($result)
        {
            $response['status'] = 'SUCCESS';
            $response['data'] = $result;
        }
        else
        {
            $response['status'] = 'NO_DATA';
            $response['message'] = 'No match found';
        }

        echo json_encode($response);
    }
    */
    public function getGame()
    {        
        $userId = $this->input->post('userId');
        //$userId = 65;
        $result = $this->game->activeGame($userId);   
        if(count($result) > 0)
        {
            $response['status'] = 'SUCCESS';
            $response['data'] = $result;
        }
        else
        {
            $response['status'] = 'ERROR';
        }
        log_message('error', 'gme =>'.print_r($response, true));
        echo json_encode($response);
    }
    
    public function getTeams()
    {
        $result = $this->game->getTeams();
        if(count($result) > 0)
        {
            $response['status'] = 'SUCCESS';
            $response['data'] = $result;
        }
        else
        {
            $response['status'] = 'ERROR';
        }
        
        echo json_encode($response);
    }
    
    public function getActivePlayers()
    {
        $result = $this->game->getActivePlayers();
        if(count($result) > 0)
        {
            $response['status'] = 'SUCCESS';
            $response['data'] = $result;
        }
        else
        {
            $response['status'] = 'ERROR';
        }
        
        echo json_encode($response);
    }
    
     public function info()
    {
        $result = $this->game->getNextGame();
        //print_r($result);
        
        $arr['gameId'] = $result->id;        
        echo json_encode($arr);
    }
    
    

}
