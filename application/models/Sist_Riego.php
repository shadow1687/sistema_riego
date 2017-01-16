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

	public function get_modulo_cliente(id_cliente){
		$qry="Select "
	}

	public function set_mensajes($mensaje)
	{
		$qry="INSERT INTO prueba VALUES(0,'{$mensaje}',sysdate());";
		$res=$this -> db -> query($qry);
		return $res;
	}

	public function registrarAlta($id,$ssid,$pass,$ip){
		//verifico si el ESP8266 ya existe
		$qry="SELECT 1 FROM modulo WHERE serial='{$id}'";
		$existe=$this -> db -> query($qry);
		//var_dump($existe -> result_id -> num_rows );exit;
		if($existe -> result_id -> num_rows==NULL){//si no existe agrego el nuevo registro
			$qry = "INSERT INTO modulo VALUES ('{$id}','{$ip}','{$ssid}','{$pass}',1,1,null,1,sysdate());";
		}
		else{//si existe reemplazo la configuración
			$qry=" UPDATE modulo
					SET ssid='{$ssid}',
						password='{$pass}',
						ip='{$ip}'
					WHERE
						serial='{$id}';";
		}

		$res=$this -> db -> simple_query($qry);
		if($res){
			return array("success" => TRUE,"msg" => "", "result" => "t|a|r|e|a");
		}
		else{
			return array("success" => FALSE,"msg" => "Error al registrar el alta.", "result" => null);
		}
	}
}
