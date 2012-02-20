<?php

/**
 * Cria um checkbox para ser adicionado na grid.
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 * @version 0.1
 * @copyright GPL © 2012, Diogo Alexsander Cavilha.
 */

class Bolt_Grid_Field_Checkbox extends Bolt_Grid_Field_FieldDefault {
	/**
	 * Nome do elemento.
	 * @access private
	 * @name $name 
	 */
	private $name;
	
	/**
	 * Seta o nome do checkbox.
	 * @param string $name Nome do checkbox.
	 * @return void
	 */
	public function setName( $name ) {
		$this->name = $name;
		return $this;
	}

	public function setField( $field ) {
		parent::setField( $field );
		parent::setId( $field );
	}
	
	/**
	 * Retorna o nome do checkbox.
	 * @return string $this->name
	 */
	public function getName() {
		return $this->name;
	}
}