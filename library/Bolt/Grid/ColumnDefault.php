<?php

/**
 * Contém os métodos e atributos comuns a todas as colunas da grid.
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 * @version 0.1
 * @copyright GPL © 2012, Diogo Alexsander Cavilha.
 */

class Bolt_Grid_ColumnDefault {
	/**
	 * Título da coluna.
	 * @access private
	 * @name $columnLabel
	 */
	private $columnLabel;
	
	/**
	 * Campo da tabela que deve ter seu valor listado na coluna.
	 * @access private
	 * @name $columnField
	 */
	private $columnField;
	
	/**
	 * Largura da coluna.
	 * @access private
	 * @name $columnWidth
	 */
	private $columnWidth;
	
	/**
	 * Alinhamento dos valores da coluna.
	 * @access private
	 * @name $align
	 */
	private $align;
	
	/**
	 * Método construtor.
	 * Seta as configurações de cada coluna da grid.
	 * @param string $label	Título da coluna.
	 * @param string $field	Campo da tabela que deve ser consultado.
	 * @param integer $width Largura da coluna.
	 * @param string $align	Alinhamento dos valores na coluna.
	 * @return void
	 */
	public function __construct( $label, $field, $width, $align = 'left' ) {
		$this->setColumnLabel( $label );
		$this->setColumnField( $field );
		$this->setColumnWidth( $width );
		$this->setAlign( $align );
	}
	
	/**
	 * Seta o título da coluna.
	 * @param string $label Título da coluna.
	 * @return void
	 */
	protected function setColumnLabel( $label ) {
		$this->columnLabel = $label;
	}
	
	/**
	 * Seta o nome do campo da tabela que deve ter seu valor listado na coluna.
	 * @param string $field Nome do campo.
	 * @return void
	 */
	protected function setColumnField( $field ) {
		$this->columnField = $field;
	}
	
	/**
	 * Seta a largura da coluna.
	 * @param integer $width Largura da coluna
	 * @return void
	 */
	protected function setColumnWidth( $width ) {
		$this->columnWidth = $width;
	}
	
	/**
	 * Seta o alinhamento dos valores da coluna.
	 * @param string $align Alinhamento
	 * @return void
	 */
	protected function setAlign( $align ) {
		$this->align = $align;
	}
	
	/**
	 * Retorna a label da coluna.
	 * @return string $this->columnLabel Label da coluna.
	 */
	public function getColumnLabel() {
		return $this->columnLabel;
	}
	
	/**
	 * Retorna o nome do campo da tabela que deve ter seu valor listado na coluna.
	 * @return string $this->columnField Nome do campo.
	 */
	public function getColumnField() {
		return $this->columnField;
	}
	
	/**
	 * Retorna a largura da coluna.
	 * @return integer $this->columnWidth Largura da coluna.
	 */
	public function getColumnWidth() {
		return $this->columnWidth;
	}
	
	/**
	 * Retorna o alinhamento dos valores da coluna.
	 * @return integer $this->columnAlign Alinhamento.
	 */
	public function getAlign() {
		return $this->align;
	}
}