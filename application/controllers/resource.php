<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource extends CI_Controller {

    function  __construct(){
        parent::__construct();
        
        date_default_timezone_set("UTC");

        //get userId from nonce

        $this->userConnected = 1; //test value

    }
        
    
    public function test()
        {
        

echo date("Y-m-d H:i:s", time()); 
        
            $gameTime = '2014-06-14 09:05:00';

                //echo strtotime($gameTime);
                
                echo date('Y/m/d H:i:s');
        
        }


    public function initialise()
    {
        $this->load->model('resource_model','resource');
        $result = $this->resource->getTeamDetails();

        //log_message('error', 'details =>'.print_r($result, true));
        //log_message('error', 'json =>'.  json_encode($result));
        $data['teamDetails'] = $result;

        //print_r($result, true);
        $json = json_encode($data);
        $data['json'] = json_decode($json);
        echo $json;

        $this->load->view('generic', $data);
    }

    /*  activate user
     *  - no ads
     */    

    public function join()
    {
        $this->load->model('connection_model','connection');
        //get from session -- uid is always the 1 who's logged in
        $uid = $this->userConnected;
        //$uid2 = 3;
        $uid2 = $this->input->post('uid');

        //get hash for connection
        $connect = array('user1' => $uid, 'user2' => $uid2);
        $result = $this->connection->connect($connect);
        $this->_testResult($result);
    }  
    

    public function listConnections()
    {
        $this->load->model('connection_model','connection');
        $result = $this->connection->getConnections(array('user1' => $this->userConnected));

        $jsonResponse = json_encode($result);
        echo $jsonResponse;
    }
    


    
    
    public function date()
    {
        echo date('m/d/Y h:i:s a');
        
        $date = new DateTime();
        echo $date->getTimestamp();
        
        echo "<br />";
        
        echo "time =>".time();
        
        echo "<br />";
        
        $timestamp=1402678347;
        echo gmdate("Y-m-d\TH:i:s\Z", $timestamp);
        echo "<br />";
        echo gmdate("Y-m-d H:i:s", $timestamp);
    }


    private function _testResult($result)
    {
        var_dump($result);
    }


}
