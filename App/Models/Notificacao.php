<?php

namespace App\Models;

use MF\Model\Model;

class Notificacao extends Model {

	private $remetente;
	private $assunto;
	private $status;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo,$valor){
		$this->$atributo = $valor;
	}



}
?>