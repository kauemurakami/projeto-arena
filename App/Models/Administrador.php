<?php


namespace App\Models;

use MF\Model\Model;

class Administrador extends Model {

	private $id;
	private $id_administrador;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}


	//Autenticar
	public function verificaAdministrador(){
		$query = 
			"SELECT
				id_administrador 
			FROM 
				administrador
		";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

}
?>