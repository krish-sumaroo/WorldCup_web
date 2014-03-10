<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource extends CI_Controller {

    function  __construct(){
        parent::__construct();
        
        //get userId from nonce
        
        $this->userConnected = 1; //test value

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


    public function crUser()
    {
        $this->load->model('user_model','user');
        $name = $this->input->post('name');
        $uid = $this->input->post('uid');
        $country = $this->input->post('country');
        $saveArray = array('name' => $name,
                           'uid'  => $uid,
                           'countryId' => $country
                            );
        $response = $this->user->addUser($saveArray);
        echo json_encode(array('status' => $response));
    }

    /*  activate user
     *  - no ads
     */
    public function userAc()
    {
        $this->load->model('user_model', 'user');
        $uid = $this->input->post('uid');
        $response = $this->user->activate('D123');
        echo json_encode(array('status' => $response));
    }
    
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
    
    private function _testResult($result)
    {
        var_dump($result);
    }

    
}