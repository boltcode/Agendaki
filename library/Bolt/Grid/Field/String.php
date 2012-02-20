<?php

/**
 * Cria uma string para ser adicionado na grid.
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 * @version 0.1
 * @copyright GPL © 2012, Diogo Alexsander Cavilha.
 */

class Bolt_Grid_Field_String extends Bolt_Grid_Field_FieldDefault {
	/**
	 * Método construtor.
	 * Seta as configurações da string que é exibida na coluna.
	 * @param string $field	Campo da tabela que vai ser exibido.
	 * @param string $align	Alinhamento dos valores na coluna.
	 * @param string $align	Identificação do componente.
	 */	
	public function __construct( $field, $id, $align = 'left' ) {
		//parent::__construct( $align, $field, $field );
		
		//$this->setAlign( $align );
		//$this->setField( $field );
		//$this->setId( $field );
		
		parent::setAlign( $align );
		parent::setField( $field );
		parent::setId( $id );
	}
}