<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	#home
	public function index() {
		#cuida da validade do login na index.phtml
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';

		#Renderizando Noticias
		$noticia = Container::getModel('Noticia');

		$noticias = $noticia->getAllIndex();

		$this->view->noticias = $noticias;

		$this->render('index');
	}
	
	#inscrever-se
	public function inscreverse() {


		$this->view->usuario = array(
			'nome' => '',
			'email' => '',
			'senha' => ''
		);

		$this->view->erroCadastro = false;

		$this->render('inscreverse');
	}

	#registrar
	public function registrar() {

		#recebe dados do formulário
		$usuario = Container::getModel('Usuario');
		#seta os atributos no objeto usuário
		$usuario->__set('nome',$_POST['nome']);
		$usuario->__set('email',$_POST['email']);
		$usuario->__set('senha',md5($_POST['senha']));

		if ($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0) {
			#chama o método para verificar duplicidade no baxo (dois usuarios iguais)
			#chama o método responsável por salvar o usuário
			$usuario->salvar();		
				#cria view
			$this->render('cadastro');
		}else {

			$this->view->usuario = array(
				'nome' => $_POST['nome'],
				'email' => $_POST['email'],
				'senha' => $_POST['senha']
			);

			$this->view->erroCadastro = true;
			$this->render('inscreverse');
		}
		
		#erro

		#sucesso
	}
}


?>