<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data=array();


		$data["estado"]=1;
		//$this -> load -> view("login");
		$this->load->view('portal',$data);
	}

	public function load_variables(){
		$js_to_load=array( );
		array_push($js_to_load,$this->base_url()."/../js/jquery v3.1.1.js");
		array_push($js_to_load,$this->base_url()."/../js/logn.js");
		$data=array();
		$data["js_to_load"]=$js_to_load;
		$this -> load -> view('init',data["js_to_load"]);
	}
}
