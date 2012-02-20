<?php

/**
 * Cria um botão para ser adicionado na grid.
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 * @version 0.1
 * @copyright GPL © 2012, Diogo Alexsander Cavilha.
 */

class Bolt_Grid_Field_Button extends Bolt_Grid_Field_FieldDefault {
	/**
	 * Indica se o botão irá submeter algum dado ou não.
	 * @access private
	 * @name $submit
	 */
	private $submit;
	
	/**
	 * Label do botão.
	 * @access private
	 * @name $label
	 */
	private $label;
	
	/**
	 * Link do botão.
	 * @access private
	 * @name $link
	 */
	private $link;
	
	/**
	 * Ícone do botão.
	 * @access private
	 * @name $icon
	 */
	private $icon;
	
	/**
	 * Mensagem de confirmação que é exibida quando o botão é clicado.
	 * @access private
	 * @name $message
	 */
	private $message;
	
	/**
	 * Método construtor.
	 */
	public function __construct() {
		$this->setSubmit( false );
	}
	
	/**
	 * Verifica se o botão possui alguma mensagem vinculada.
	 * @return boolean
	 */
	public function existsMessage() {
		return ( $this->message ) ? true : false;
	}
	
	/**
	 * Verifica se o botão possui a propriedade submit.
	 * @return boolean
	 */
	public function isSubmit() {
		return ( $this->submit ) ? true : false;
	}
	
	/**
	 * Adiciona ao botão, a propriedade de poder submeter algum dado.
	 * @param boolean $flag
	 */
	public function setSubmit( $flag ) {
		$this->submit = $flag;
		return $this;
	}
	
	/**
	 * Seta a label do botão.
	 * @param string $label Label do botão.
	 */
	public function setLabel( $label ) {
		$this->label = $label;
		return $this;
	}
	
	/**
	 * Seta o link do botão.
	 * @param string $link Link do botão.
	 * @return void
	 */
	public function setLink( $link ) {
		$this->link = $link;
		return $this;
	}
	
	/**
	 * Seta o ícone do botão.
	 * @param string $icon Link do botão.
	 * @return void
	 */
	public function setIcon( $icon ) {
		$this->icon = $icon;
		return $this;
	}

	/**
	 * Vincula uma mensagem de confirmação ao botão.
	 * @param string $message.
	 */
	public function addMessage( $message ) {
		$this->message = $message;
		return $this;
	}
	
	/**
	 * Retorna o link do botão.
	 * @return string $this->link
	 */
	public function getLink() {
		return $this->link;
	}
	
	/**
	 * Retorna o ícone do botão.
	 * @return string $this->icon
	 */
	public function getIcon() {
		return $this->icon;
	}
	
	/**
	 * Retorna a label do botão.
	 * @return string $this->label
	 */
	public function getLabel() {
		return $this->label;
	}
	
	/**
	 * Retorna a mensagem de validação vinculada ao botão.
	 * @return string $this->message.
	 */
	public function getMessage() {
		return $this->message;
	}
}