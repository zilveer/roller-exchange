<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseController extends CI_Controller{
	public $layout = "home-layout";

	function __construct()
	{
		parent::__construct();
		$this->load->library(['session','email','user_agent','apis','curl']);
		$this->load->helper(['functions','url']);
		$this->api_setup();
	}
	

	/*
	Get Layout 
	*/
	public function getLayout(){
		$file = VIEWPATH.$this->layout.".php";
		if(file_exists($file)){
			return true;
		}
		return false;
	}

	/*
	Return View
	*/
	public function view($layout, $data=[]){
		
		
		if($this->getLayout()){

			$data = $this->load->view($layout, $data, true);
			return $this->load->view($this->layout,["content" => $data, "flash" => $this->get_flash(), "header" => ""]);
		}else{
			return $this->load->view($layout, $data);
		}
	}

	public function get_flash(){

	}


	public function api_setup(){
		$server_ip = gethostbyname($_SERVER['SERVER_NAME']);
		if($server_ip == "127.0.0.1" || $server_ip == "::1"){
			$config['server'] = "http://127.0.0.1:4444/api/";
		}else{
			$config['server'] = "http://api.btcrip.co/api/";
		}
		$config['send_cookies'] = "";
		$config['api_name'] = "";
		$config['api_key'] = "";
		$config['http_auth'] = "";
		$config['http_user'] = "";
		$config['http_pass'] = "";
		$config['ssl_verify_peer'] = "";
		$config['ssl_cainfo'] = "";
		$this->apis->initialize($config);
        
	}
	
}

class AdminController extends BaseController{
	function __construct()
	{
		parent::__construct();
	}
}

class HomeController extends BaseController{
	function __construct()
	{
		parent::__construct();
	}
}

class ApiController extends CI_Controller{
}
