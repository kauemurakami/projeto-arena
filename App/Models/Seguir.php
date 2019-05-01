<?php

namespace App\Models;

use MF\Model\Model;

class Seguir extends Model {

	private $id_usuario_seguindo;#usuario que sera seguido
	private $id;#usuario atual da sessão

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo,$valor){
		$this->$atributo = $valor;
	}

	#Seguir
	public function seguirUsuario(){
		$query = "
		insert into 
			usuarios_seguidores(id_usuario, id_usuario_seguindo)
		values(:id_usuario, :id_usuario_seguindo)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id')); #usuario atual da sessão
		$stmt->bindValue(':id_usuario_seguindo', $this->__get('id_usuario_seguindo')); #usuario que iremos seguir
		$stmt->execute();

		return true;
	}	

	#Deixar de seguir
	public function deixarSeguirUsuario(){

		$query = "
		delete from
			usuarios_seguidores
		where
			id_usuario = :id_usuario and id_usuario_seguindo = :id_usuario_seguindo";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id')); #usuario atual da sessão
		$stmt->bindValue(':id_usuario_seguindo', $this->__get('id_usuario_seguindo')); #usuario que iremos seguir
		$stmt->execute();

		return true;
	}

}

?>
