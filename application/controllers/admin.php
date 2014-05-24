<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    function  __construct(){
        parent::__construct();
        $this->load->model('game_model','game');
        $this->load->model('user_model','user');
    }
    

    public function gamesDetails()
    {
        
        $gameData = $this->game->getNextGame();
    }

    public function chooseTeam()
    {     
        $gameData = $this->game->getNextGame();
        $data['gameInfo'] = $gameData;
        $data['team1'] = $this->game->getTeamInfo($gameData->team1);
        $data['team2'] = $this->game->getTeamInfo($gameData->team2);
        $data['team1Players'] = $this->game->getFullPlayers($gameData->team1);
        $data['team2Players'] = $this->game->getFullPlayers($gameData->team2);        
        $master['view'] = $this->load->view('chooseTeam', $data, true);
        $master['js'] = array('chooseTeam');
        $this->load->view('main',$master);

    }
    
    /**** function to give all users new moves for new game ******/
    public function initialisePoints()
    {
        $gameId = $this->input->post('gameId');
        // make sure no actions have been recorded to prevent any errors
        $check = $this->user->allClear($gameId);
        
        if($check)
        {
            $this->user->initialisePointsForUsers($gameId);
        }
    }

}