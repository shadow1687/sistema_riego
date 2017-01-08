<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require('Logger.php');

const TAREA_COMPLETA = 1;

class Interact extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this -> load -> model("Sist_Riego");

	}

	public function registrar()
	{
		extract($this -> input -> post(),EXTR_OVERWRITE);
		Logger::debug($command,$id,$ssid,$pass,$ip);
		
		switch($command){
			case "start":{//se conecto un ESP8266
								$alta=$this -> Sist_Riego -> registrarAlta($id,$ssid,$pass,$ip);
								if($alta["sucess"]){
									//envio tarea del dia
									echo $alta["result"];
									//echo $this -> Sist_Riego -> sendSchedule($id);
								}
								else{//adeams del log no podemos hacer nada ya que lo que no se hizo no se puede recuperar
									Logger::warn($alta);
								}
			};break;
			case "complete":{//ESP8266 completo una tarea
								$reg=$this -> Sist_Riego -> registrarTarea($id,$tarea,TAREA_COMPLETA);
								if($reg["sucess"]){
									//envio tarea del dia
									echo $this -> Sist_Riego -> sendSchedule($id);
								}
								else{//adeams del log no podemos hacer nada ya que lo que no se hizo no se puede recuperar
									Logger::warn($reg["msg"]);
								}
			}break;
			case "prueba":{
							echo $this -> Sist_Riego -> set_mensajes($mensaje);
			}break;
		}
	}
}
?>