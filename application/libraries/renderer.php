<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Renderer
{
	function __construct()
	{
		$this->CI =& get_instance();
	}

	public function renderPage($view)
	{
		$view['topBar'] = $this->CI->load->view('main/topBar',null,true);
		$this->CI->load->view('main',$view);
	}


}
