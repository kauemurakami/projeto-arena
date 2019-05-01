<?php

namespace App\Models;

use MF\Model\Model;

class Equipe extends Model {

	private $nome;
	private $id;# id da equipe
	private $id_usuario_lider;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo,$valor){
		$this->$atributo = $valor;
	}

	public function salvarEquipe($id){

		$query = "insert into equipe(nome, id_usuario_lider)values(:nome, :id_usuario_lider)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', $this->__get('nome'));
		$stmt->bindValue(':id_usuario_lider',$id);
		$stmt->execute();

		return $this;
	}

	#recuperando membros
	public function recuperaMembro(){
		$query = "
		SELECT 
			u.nome
		FROM
		 usuarios AS u
		JOIN 
			membros AS m
		ON 
			u.id != m.id_membro and m.id_equipe = :id
		";
		$stmt->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->execute();

	}

	#recupera equipe do usuario
	public function getEquipe(){
		$query = "
		select
			id, nome, id_usuario_lider
		from 
			equipe 
		where 
			id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->execute();

		$equipe = $stmt->fetch(\PDO::FETCH_ASSOC);

			if ($equipe['id'] != '' && $equipe['nome'] != '') {
			$this->__set('id',$equipe['id']);
			$this->__set('nome',$equipe['nome']);
			$this->__set('id_lider',$equipe['id_usuario_lider']);
		}	
		return $this;
	}


	#adicionando membros
	public function adicionarMembro(){
		$query = "
		insert into 
			equipe(id, id_usuario_membro)
		values(:id, :id_usuario_membro)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id')); #usuario atual da sessão
		$stmt->bindValue(':id_usuario_membro', $this->__get('id_usuario_membro')); #usuario que iremos seguir
		$stmt->execute();

		return true;
	}

	#Deixar de participar
	public function deixarSeguirUsuario(){

		$query = "
		select from
			equipe
		where
			id = :id and id_usuario_membro = :id_usuario_membro";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id')); #usuario atual da sessão
		$stmt->bindValue(':id_usuario_seguindo', $this->__get('id_usuario_seguindo')); #usuario que iremos seguir
		$stmt->execute();

		return true;
	}
}
?>