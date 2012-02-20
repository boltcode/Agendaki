<?php

/**
 * Classe com os métodos e atributos que são comuns a todos os tipos de dado exibidos nas colunas da grid.
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 * @version 0.1
 * @copyright GPL © 2012, Diogo Alexsander Cavilha.
 */

class Bolt_Grid_Field_FieldDefault {
	/**
	 * Alinhamento do componente na coluna.
	 * @access private
	 * @name $aliign
	 */
	private $align;
	
	/**
	 * Nome do campo da tabela que deve ter seu valor listado na coluna.
	 * @access private
	 * @name $field
	 */
	private $field;
	
	/**
	 * ID do botão.
	 * Este valor será usado como índice do array que contém todos os dados que serão exibidos na grid.
	 * @access private
	 * @name $id
	 */
	private $id;
	
	/**
	 * Método construtor.
	 * Seta as configurações do tipo de dado que é exibido na grid.
	 * @param string $align Alinhamento do botão na coluna.
	 * @param string $field Campo da tabela que é exibido na grid.
	 * @param string $id Identificador do componente.
	 */
	//public function __construct( $align, $field, $id ) {
	//	$this->setAlign( $align );
	//	$this->setField( $field );
	//	$this->setId( $id );
	//}
	
	/**
	 * Seta o alinhamento do componente.
	 * @param string $align Alinhamento.
	 * @return void
	 */
	public function setAlign( $align ) {
		$this->align = $align;
		return $this;
	}
	
	/**
	 * Seta o nome do campo da tabela que deve ter seu valor listado na coluna.
	 * @param string $field Nome do campo da tabela.
	 * @return void
	 */
	public function setField( $field ) {
		$this->field = $field;
		return $this;
	}
	
	/**
	 * Seta o identificador do componente.
	 * @param string $id
	 * @return void
	 */
	public function setId( $id ) {
		$this->id = $id;
		return $this;
	}
	
	/**
	 * Retorna o identificador do componente.
	 * @return string $this->id Identificador do componente.
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Retorna o alinhamento do componente.
	 * @return string $this->align Alinhamento do componente.
	 */
	public function getAlign() {
		return $this->align;
	}
	
	/**
	 * Retorna o nome do campo da tabela.
	 * @return string $this->field Nome do campo da tabela.
	 */
	public function getField() {
		return $this->field;
	}
}