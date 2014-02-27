<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource extends CI_Controller {

    function  __construct(){
        parent::__construct();

    }

    public function initialise()
    {
        $this->load->model('resource_model','resource');

        $result = $this->resource->getTeamDetails();

        log_message('error', 'details =>'.print_r($result, true));
        log_message('error', 'json =>'.  json_encode($result));
    }


}