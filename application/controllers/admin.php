<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    function  __construct(){
        parent::__construct();
        $this->load->model('game_model','game');
    }
    
    public function gamesDetails()
    {
        
        $gameData = $this->game->getNextGame();
    }

}