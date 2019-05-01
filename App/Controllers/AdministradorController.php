<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

/**
 * 
 */
class AdministradorController extends Action{
	
	#timelineAdministrador
	######
	public function timelineAdministrador(){

		#inicio timeline
		$this->validaAuth();
		#instanciando usuarios ara recuperar suas informações
		$usuario = Container::getModel('Usuario');
		#setando o id com o valor do id da sessão do usuario logado
		$usuario->__set('id',$_SESSION['id']);

		#dessa forma poderemos utilizar esses atributos dentro da view timeline
		$this->view->info_usuario = $usuario->getInfoUsuario();

		#caso de sucesso
		$this->render('timelineAdministrador');

	}

	public function inserirNoticia(){

		$this->validaAuth();

		$noticia = Container::getModel('Noticia');

		if(isset($_POST['titulo']) && $_POST['texto']){

			date_default_timezone_set("Brazil/East");
			$data = date('Y-m-d');
			$noticia->__set('data',$data);
			$noticia->__set('titulo', $_POST['titulo']);
			$noticia->__set('texto', $_POST['texto']);
			$noticia->__set('imagem',$_FILES['imagem']);

			$destino = '../public/imagens_noticias/';

			$arquivo = $noticia->imagem;
			if(!(empty($arquivo))){
				$arquivo1 = $arquivo;
				$arquivo_minusculo = strtolower($arquivo1['name']);
				$caracteres = array("ç","~","^","]","[","{","}",";",":","´",",",">","<","-","/","|","@","$","%","ã","â","á","à","é","è","ó","ò","+","=","*","&","(",")","!","#","?","`","ã"," ","©");
				$arquivo_tratado = str_replace($caracteres,"",$arquivo_minusculo);
				$destino = $destino.$arquivo_tratado;
				print_r($arquivo_tratado);
				if(move_uploaded_file($arquivo1['tmp_name'],$destino)){
					echo "<script>window.alert('Arquivo enviado com sucesso.');</script>";
				}else{
					echo "<script>window.alert('Erro ao enviar o arquivo');</script>";
				}
			}
			$noticia->__set('imagem', $arquivo_tratado);
			$noticia->salvarNoticia();

		}
		
		//$noticia->salvarNoticia();

		$this->render('timelineAdministrador');

	}


	#valida se usuario está logado
	public function validaAuth(){

		session_start();

		if (!isset($_SESSION['id']) || $_SESSION['id'] == '') {
			header('Location:	 /?login=erro');
		}else {
			return true;
		}
	}
}


?>