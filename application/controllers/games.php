<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Games extends CI_Controller {

    function  __construct(){
        parent::__construct();
        $this->load->model('game_model','game');
        //get userId from nonce
    }

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

}
