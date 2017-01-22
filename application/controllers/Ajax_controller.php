<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_controller extends CI_Controller {

	public function login_control()
	{
		extract($this -> input -> post(),EXTR_OVERWRITE);
    $res=$this -> modelo_login -> control($user,$pass);

    if($res["success"]){
      $this -> load -> model("Sist_Riego");
  		$data["modulos"]=$this -> Sist_Riego -> get_modulo($res["result"]);
      this -> load -> view("portal",$data);
    }
    else{//error
        this -> load -> view("template_error",$data);
    }
	}
}
