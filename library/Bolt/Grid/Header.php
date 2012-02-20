<?php

/**
 * Adiciona o cabeçalho da grid.
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 * @version 0.1
 * @copyright GPL © 2012, Diogo Alexsander Cavilha.
 */

class Bolt_Grid_Header {
	
	/**
	 * Título da coluna.
	 * @access private
	 * @name $label
	 */
	private $label;
	
	/**
	 * Alinhamento do título na coluna.
	 * @access private
	 * @name $align
	 */
	private $align;
	
	/**
	 * Largura da coluna.
	 * @access private
	 * @name $width
	 */
	private $width;
	
	/**
	 * Método construtor.
	 * Adiciona as configurações de cada coluna da grid.
	 * @param string $label
	 * @param string $align
	 * @param integer $width
	 */
	public function __construct( $label, $align, $width ) {
		$this->setLabel( $label );
		$this->setAlign( $align );
		$this->setWidth( $width );
	}
	
	/**
	 * Seta o título da coluna.
	 * @param string $label
	 * @return void
	 */
	private function setLabel( $label ) {
		$this->label = $label;
	}
	
	/**
	 * Seta o alinhamento da coluna.
	 * @param string $align
	 * @return void
	 */
	private function setAlign( $align ) {
		$this->align = $align;
	}
	
	/**
	 * Seta a largura da coluna.
	 * @param string $width
	 * @return void
	 */
	private function setWidth( $width ) {
		$this->width = $width;
	}
	
	/**
	 * Retorna o título da coluna.
	 * @return string $this->label
	 */
	public function getLabel() {
		return $this->label;
	}
	
	/**
	 * Retorna o alinhamento da coluna.
	 * @return string $this->align
	 */
	public function getAlign() {
		return $this->align;
	}
	
	/**
	 * Retorna a largura da coluna.
	 * @return string $this->width
	 */
	public function getWidth() {
		return $this->width;
	}
}