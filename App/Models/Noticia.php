<?php

namespace App\Models;

use MF\Model\Model;

class Noticia extends Model {

	private $titulo;
	private $id;
	private $data;
	private $texto;
	private $imagem;#url da imagem

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo,$valor){
		$this->$atributo = $valor;
	}

	public function salvarNoticia(){

		$query = "insert into noticias(titulo, texto, imagem,data) values (:titulo,  :texto , :imagem ,:data)";
		$stmt = $this->db->prepare($query);

		$stmt->bindValue(':titulo', $this->titulo);
		$stmt->bindValue(':texto', $this->texto);
		$stmt->bindValue(':data', $this->data); 
		$stmt->bindValue(':imagem', $this->imagem); 
		$stmt->execute() or die(print_r($stmt->errorInfo(),true));
		return $this;
	}

	public function getAllIndex(){

		$query = " select * from noticias ORDER BY id DESC LIMIT 5";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getAll(){

		$query = " select * from noticias ORDER BY id DESC LIMIT 15";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getUltimaNoticia(){
		$query = "select id, titulo, texto, data, imagem from noticias ORDER BY id DESC";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	#recupera uma unica noticia que foi clicada
	public function getNoticia($id_noticia){

		$query = "select id, titulo, texto, data, imagem from noticias where id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $id_noticia);
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}	

	#recupera 4 notcias para a pagina principal
	public function getIndex(){

		$query = " select count(*) from noticias ORDER BY id DESC ";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

}
?>