<?php

class Sist_Riego extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_mensajes()
	{

		$qry="SELECT * FROM prueba;";
		$res=$this -> db -> query($qry);
		return $res->result_array();
	}

	public function set_mensajes($mensaje)
	{
		$qry="INSERT INTO prueba VALUES(0,'{$mensaje}',sysdate());";
		$res=$this -> db -> query($qry);
		return $res;
	}

	public function registrarAlta($id,$ssid,$pass,$ip){
		//verifico si el ESP8266 ya existe
		$qry="SELECT 1 FROM riego_config WHERE id='{$id}'";
		$existe=$this -> db -> query($qry);
		//var_dump($existe -> result_id -> num_rows );exit;
		if($existe -> result_id -> num_rows==NULL){//si no existe agrego el nuevo registro
			$qry = "INSERT INTO riego_config VALUES ('{$id}','{$ssid}','{$pass}','{$ip}','',1,sysdate());";
		}
		else{//si existe reemplazo la configuración
			$qry=" UPDATE riego_config
					SET ssid='{$ssid}',
						pass='{$pass}',
						ip='{$ip}'
					WHERE
						id='{$id}';";
		}
		//var_dump($qry);exit;
		$res=$this -> db -> simple_query($qry);
		if($res){
			return array("success" => TRUE,"msg" => "", "result" => "t|a|r|e|a");
		}
		else{
			return array("success" => FALSE,"msg" => "Error al registrar el alta.", "result" => null);
		}
	}
}
