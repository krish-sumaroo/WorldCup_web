<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DbHelper
{
	function __construct()
	{
		$this->CI =& get_instance();
	}

	public function buildResponse($result)
	{
            $response = array();
            if($result)
            {
                $response['status'] = 'S';
                $response['msg'] = "Success";
            }
            else
            {
               $response['status'] = 'S_F';
               $response['msg'] = "Error saving"; 
            }
            
            return json_encode($response);
	}


}