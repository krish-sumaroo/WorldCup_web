<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dbhelper
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
                $response['status'] = true;
                $response['msg'] = "Success";
            }
            else
            {
               $response['status'] = false;
               $response['msg'] = "Error saving"; 
            }
            
            return json_encode($response);
	}


}