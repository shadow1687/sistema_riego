<?php
require_once APPPATH.'models/Model_Generic.php';
class Sist_Riego extends Model_Generic {

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

	public function get_modulo_status($serial){
		$query="SELECT IFNULL(estado,0) estado FROM modulo WHERE serial='{$serial}' and ts>(sysdate() - INTERVAL 5 MINUTE);";
		$result=$this -> qry_exec($query,$this ->db,'value',array("manage_exception" => TRUE));
		if($result["success"] && $result["result"]!=NULL){
			return $result["result"];
		}
		else{
			if(!$result["success"]){
				return $result["msg"];
			}
			else{//inactivo
				return 0;
			}
		}
	}

	public function get_modulo_cliente($id_cliente){
		$qry="Select ";
	}

	// public function set_mensajes($mensaje)
	// {
	// 	$qry="INSERT INTO prueba VALUES(0,'{$mensaje}',sysdate());";
	// 	$res=$this -> db -> query($qry);
	// 	return $res;
	// }

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
						ip='{$ip}',
						ts=sysdate()
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
