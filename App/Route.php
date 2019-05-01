<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		#Home
		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		#Inscrever-se
		$routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);

		#noticia
		$routes['noticia'] = array(
			'route' => '/noticia',
			'controller' => 'NoticiaController',
			'action' => 'noticia'
		);

		#+ver todas as noticias
		$routes['todas_noticias'] = array(
			'route' => '/todas_noticias',
			'controller' => 'NoticiaController',
			'action' => 'verTodasAsNoticias'
		);


		#Registrar
		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		#Autenticar
		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['inserir_noticia'] = array(
			'route' => '/inserir_noticia',
			'controller' => 'AdministradorController',
			'action' => 'inserirNoticia'
		);
		#Inserir noticia
		
		#Sair
		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);
		
		#Timeline
		$routes['timeline'] = array(
			'route' => '/timeline',
			'controller' => 'AppController',
			'action' => 'timeline'
		);

		#TimelineAministrador
		$routes['timelineAdministrador'] = array(
			'route' => '/timelineAdministrador',
			'controller' => 'AdministradorController',
			'action' => 'timelineAdministrador'
		);


		#Tweet
		$routes['tweet'] = array(
			'route' => '/tweet',
			'controller' => 'AppController',
			'action' => 'tweet'
		);
		
		#Quem seguir
		$routes['quem_seguir'] = array(
			'route' => '/quem_seguir',
			'controller' => 'AppController',
			'action' => 'quemSeguir'
		);

		#Acao Seguir / deixar de seguir
		$routes['acao'] = array(
			'route' => '/acao',
			'controller' => 'AppController',
			'action' => 'acao'
		);



		#Criar equipe
		$routes['criar_equipe'] = array(
			'route' => '/criarequipe',
			'controller' => 'AppController',
			'action' => 'criarEquipe'
		);


		$this->setRoutes($routes);
	}

}

?>