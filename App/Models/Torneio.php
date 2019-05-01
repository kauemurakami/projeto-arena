<?php

namespace App\Models;

use MF\Model\Model;

class Torneio extends Model {

	private $id_torneio;
	private $nome;
	private $organizador;
	private $data_inscricao;
	private $data_realizacao;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}

	#recupera torneio
	public function getAll(){

		$query = " select * from torneio ORDER BY id_torneio ASC ";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	#salva torneio
	public function salvaTorneio(){
		$query = "insert into torneio(nome, data_inscricao, data_realizacao, organizador)
							values(:nome, :data_inscricao, data_realizacao, :organizador)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', $this->__get('nome'));
		$stmt->bindValue(':organizador', $this->__get('organizador'));
		$stmt->bindValue(':data_inscricao', $this->__get('data_inscricao'));
		$stmt->bindValue(':data_realizacao', $this->__get('data_realizacao'));
		$stmt->execute();

		return $this;
	}


	#apagar torneio
	public function apagarTorneio($id){
		$query = "
		delete from
			torneio
		where
			id_torneio = :id_torneio ";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_torneio', $id);
		$stmt->execute();

		return true;
	}


}




?>