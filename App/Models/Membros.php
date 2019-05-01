<?php

namespace App\Models;

use MF\Model\Model;

class Membros extends Model {

	private $id_equipe;
	private $id_membro;

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}

	public function __get($atributo){
		return $this->$atributo;
	}

	public function adicionaMembro(){

	}
	public function removeMembro(){
	
	}

	public function recuperaMembros(){
	
		$query = "
		SELECT 
			u.nome, u.id
		FROM
		 usuarios AS u
		JOIN 
			membros AS m 
		ON 
			u.id = m.id_membro
		";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_membro',$this->__get('id_membro'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function contaMembros(){
		$query = "
		select
			*
		count(*)
		as
			qt_membros
		from
			membros
		where
		 	id_membro = id_equipe
		";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_membro',$this->__get('id_membro'));
		$stmt->bindValue(':id_equipe',$this->__get('id_equipe'));
		$stmt->execute();
	}

	#verifica se o usuario é membro de alguma equipe
	public function verificaMembro(){
		$query = "
		select 
			id_equipe 
		from 
			membros
 	  where
 	  	id_membro = :id_membro ";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_membro',$this->__get('id_membro'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

}
?>