<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class NoticiaController extends Action {

	#Função quando clicada uma noticia individualmente
	public function noticia() {

		#Renderizando Noticias
		$noticia = Container::getModel('Noticia');

		$id_noticia = $_GET['noticia'];
		$this->view->noticia = $noticia->getNoticia($id_noticia);

		$this->render('noticia_completa');
	}
	
	#Função quando chamado +Ver Todas as noticias
	public function verTodasAsNoticias(){

		$noticia = Container::getModel('Noticia');

		$this->view->noticias = $noticia->getAll();
		$this->view->noticia = $noticia->getUltimaNoticia();

/*
		echo "<pre>";
		print_r($this->view->noticias);
		print_r($this->view->noticia);
		echo "</pre>";
*/

		$this->render('todas_noticias');
	}
}




?>