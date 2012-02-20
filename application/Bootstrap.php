<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	/**
	 * Layout do sistema.
	 */
	public function _initLayout() {
		Zend_Layout::startMvc(
			array(
				'layout'		=> 'frontend',
				'layoutPath'	=> APPLICATION_PATH . '/views/scripts/layouts'
			)
		);
	}
	
	/**
	 * Inicia o autoloader para carregar as classes dinamicamente em tempo de execução ao instanciar um objeto.
	 */
	public function _initAutoloader() {
		require_once 'Zend/Loader/Autoloader.php';
		$loader = Zend_Loader_Autoloader::getInstance();
		$loader->setFallbackAutoloader( true );
	}
	
	/**
	 * Setar o idioma pt-BR nas mensagens de validação.
	 * Obs: Para funcionar corretamente, é necessário copiar o diretório 'resources\languages' para o diretório 'application' do projeto.
	 */
	protected function _initTranslate() {
		try {
			$translate = new Zend_Translate(
				'Array',
				APPLICATION_PATH . '/languages/pt_BR/Zend_Validate.php',
				'pt_BR'
			);
	
			Zend_Validate_Abstract::setDefaultTranslator( $translate );
		} catch( Exception $e ) {
			throw new Exception( $e->getMessage() );
		}
	}

}