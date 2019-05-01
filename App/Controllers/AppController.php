<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

/**
 * 
 */
class AppController extends Action{
	
	public function timeline(){
		#inicio timeline
		$this->validaAuth();

		#instancia a classe membro
		$membro = Container::getModel('Membros');
		#recupera e seta o id da sessão no objeto membro
		$membro->__set('id_membro', $_SESSION['id']);
		#verifica se o id setado é difetente de vazio
		if ($membro->__get('id_membro') != '') {
			
			$id_equipe = $membro->verificaMembro();
			$membro->__set('id_equipe',$id_equipe);

			#desabilita o botão de criar equipe
			$this->view->botaoEquipe = true;
			
			$equipe = Container::getModel('Equipe');
			$equipe->__set('id',$id_equipe['id_equipe']);
			$equipe->getEquipe();
			/*
			echo '<br>';
			echo '<br>';
			echo '<pre>';
			print_r($membro->recuperaMembros());
			echo '</pre>';
			*/

			$membros = array();
			$membros = $membro->recuperaMembros();
			$this->view->membros = $membros;
			#recuperando nome da equipe
			$this->view->nomeEquipe = $equipe->nome;
			$this->view->id_lider = $equipe->id_lider;
			#recuperar membros da equipe


		}else{
			#habilita o botão de criar equipe
			$this->view->botaoEquipe = false; }


		$tweet = Container::getModel('Tweet');

		$tweet->__set('id_usuario',$_SESSION['id']);

			#recuperando os tweets
		$tweets = $tweet->getAll();

		$this->view->tweets = $tweets;

		#instanciando usuarios ara recuperar suas informações
		$usuario = Container::getModel('Usuario');
		#setando o id com o valor do id da sessão do usuario logado
		$usuario->__set('id',$_SESSION['id']);

		#dessa forma poderemos utilizar esses atributos dentro da view timeline
		$this->view->info_usuario = $usuario->getInfoUsuario();

		#caso de sucesso
		$this->render('timeline');

	}

	#Criar equipe
	public function criarEquipe(){
		$this->validaAuth();

		$equipe = Container::getModel('Equipe');

		$this->view->erroCadastroEquipe = false;

		@$equipe->__set('nome',$_POST['nome_equipe']);

		$id_usuario_lider = $_SESSION['id'];

		if ($equipe->__get('nome') != '') {
			# code...
		
			$equipe->salvarEquipe($id_usuario_lider);
		header('Location:	 /timeline');

		}

		$this->render('criaEquipe');
	}


	public function tweet(){

		$this->validaAuth();

		$acao = isset($_GET['apagar']) ? $_GET['apagar'] : '';
		$id_tweet = isset($_GET['id_tweet']) ? $_GET['id_tweet'] : '';

			#instanciando model
		$tweet = Container::getModel('Tweet');

		$tweet->__set('tweet', $_POST['tweet']);
			#recupera id do usuario atraves da global SESSION
		$tweet->__set('id_usuario', $_SESSION['id']);

		$tweet->salvar();

		if($acao == 'apagar'){
			$tweet->apagarTweet($id_tweet);
		}

		header('Location:/timeline');


		###################################
	}

	#valida se usuario está logado
	public function validaAuth(){

		session_start();

		if (!isset($_SESSION['id']) || $_SESSION['id'] == ''|| !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
			header('Location:/?login=erro');
		}else {
			return true;
		}
	}

	#quem seguir
	public function quemSeguir(){
		#verifica se usuário está conectado
		$this->validaAuth();
		#se o indice da globar get estiver setado vamos atribuir o valor a variavel, caso contrario atribui vazio
		$pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';

		$usuarios = array();

		if ($pesquisarPor != '') {
			$usuario = Container::getModel('Usuario');
			$usuario->__set('nome', $pesquisarPor);
			$usuario->__set('id',$_SESSION['id']);
			$usuarios = $usuario->getAll();
		}

		$this->view->usuarios = $usuarios;

		$this->render('quemSeguir');
	}

	public function acao(){

		$this->validaAuth();

		$seguir = Container::getModel('Seguir');

		$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
		$id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : ''; #usuario que iremos seguir
		$seguir->__set('id_usuario_seguindo',$id_usuario_seguindo);
		$seguir->__set('id',$_SESSION['id']);

		if ($acao == 'seguir') {
			$seguir->seguirUsuario();
		}else if ($acao == 'deixar_de_seguir') {
			$seguir->deixarSeguirUsuario();
		}

		header('Location:	 /quem_seguir');
	}
}



?>