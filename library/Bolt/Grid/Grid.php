<?php

/**
 * Cria um DataGrid com dados recebidos em um array.
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 * @version 0.2
 * @copyright GPL © 2012, Diogo Alexsander Cavilha.
 */

class Bolt_Grid_Grid {
	/**
	 * Armazena o nome do formulário que contém a grid.
	 * @access private
	 * @name $gridFormName
	 */
	private $gridFormName;
	
	/**
	 * Formulário em que a grid é colocada, caso exista a submissão de algum dos seus dados.
	 * @access private
	 * @name $gridForm
	 */
	private $gridForm;
	
	/**
	 * Objeto DOM para criar a estrutura da grid.
	 * @access private
	 * @name $dom
	 */
	private $dom;
	
	/**
	 * Estrutura da tabela que simula a grid.
	 * @access private
	 * @name $domTable
	 */
	private $domTable;
	
	/**
	 * Linha da grid.
	 * @access private
	 * @name $domTr
	 */
	private $domTr;
	
	/**
	 * Corpo da grid. Onde são exibidos os dados.
	 * @access private
	 * @name $domTbody
	 */
	private $domTbody;

	/**
	 * Estrutura externa da grid.
	 * É a primeira camada estrutural da grid. Armazena toda a grid.
	 * @access private
	 * @name $struct
	 */
	private $struct;
	
	/**
	 * Cabeçalho de botões da grid.
	 * @access private
	 * @name $headerButtons
	 */
	private $header;
	
	/**
	 * Helper para criação de links.
	 * @access private
	 * @name $helperUrl
	 */
	private $helperUrl;
	
	/**
	 * Dados que devem ser listados na grid.
	 * @access private
	 * @name $data
	 */
	private $data = array();
	
	/**
	 * Array com o nome de cada índice do array que deve ser consultado para ser exibido na grid.
	 * @access private
	 * @name $columnField
	 */
	private $columnField = array();
	
	/**
	 * Array com os botões que devem ser exibidos no header da grid.
	 * @access private
	 * @name $headerButtons
	 */
	private $headerButtons = array();
	
	/**
	 * Construtor da classe.
	 * Recebe um array contendo os dados que devem ser listados na grid.
	 * @param array $data Dados.
	 */
	public function __construct( array $data ) {
		$this->data	= $data;
		
		//Obtém um DOM Object para criar a estrutura da grid. 
		$this->dom = new DOMDocument();
		
		//Objeto para auxiliar na criação de links.
		$this->helperUrl = new Zend_View_Helper_Url();
		
		//Inicia a estrutura da grid.
		$this->struct = $this->dom->createElement( 'div' );
		
		$attrId = $this->dom->createAttribute( 'id' );
		$attrId->value = 'struct_grid';
		
		$this->struct->appendChild( $attrId );
		
		//Inicia a estrutura do cabeçalho de botões.
		$this->header = $this->dom->createElement( 'div' );
		
		$attrId = $this->dom->createAttribute( 'id' );
		$attrId->value = 'grid_header_buttons';
		
		$this->header->appendChild( $attrId );
		$this->struct->appendChild( $this->header );
		
		//Cria a estrutura da tabela.
		$this->domTable = $this->dom->createElement( 'table' );
		
		//Cria e adiciona o thead na tabela.
		$domThead = $this->dom->createElement( 'thead' );
		$this->domTable->appendChild( $domThead );
		
		//Cria e adiciona um tr na thead da tabela.
		$this->domTr = $this->dom->createElement( 'tr' );
		$domThead->appendChild( $this->domTr );
		
		//Cria e adiciona um tbody na tabela.
		$this->domTbody = $this->dom->createElement( 'tbody' );
		$this->domTable->appendChild( $this->domTbody );
		
		//Cria a classe com valor 'grid corner' para adicionar na grid.
		$class = $this->dom->createAttribute( 'class' );
		$class->value = 'grid';
		$this->domTable->appendChild( $class );
		
		//Cria a propriedade cellspacing com valor 0 (zero) para a grid.
		$cellspacing = $this->dom->createAttribute( 'cellspacing' );
		$cellspacing->value = '0';
		$this->domTable->appendChild( $cellspacing );
	}
	
	/**
	 * Cria a estrutura externa que servirá como base para a grid.
	 * Nesta estrutura se encontra também o cabeçalho de botões.
	 * Obs: Se for necessário adicionar um componente antes ou depois da grid, este componente deve ser
	 * adicionado à estrutura neste método, no atributo privado 'struct'.
	 * @return void
	 */
	private function doStruct() {
		//Caso existam botões para adicionar no cabeçalho, adiciona o cabeçalho.
		if ( !empty( $this->headerButtons ) ) {
			foreach ( $this->headerButtons as $button ) {	
				$bt = $this->dom->createElement( 'a', $button->getLabel() );
				
				if ( $button->existsMessage() ) {
					$attrOnClick = $this->dom->createAttribute( 'onClick' );
					$attrOnClick->value = "if (confirm('" . $button->getMessage() . "')) { document.{$this->gridFormName}.submit(); }";
					$bt->appendChild( $attrOnClick );
				}
				
				$attrHref = $this->dom->createAttribute( 'href' );
				
				//Caso este botão tenha que submeter algum dado da grid, nenhuma rota é adicionada a ele, pois 
				//seu evento será o form.submit, que será disparado no clique.
				if ( $button->isSubmit() ) {
					$attrHref->value = '#';
				} else {
					$attrHref->value = $this->helperUrl->url( $button->getLink(), 'default', true );
				}
				
				$bt->appendChild( $attrHref );
				$this->header->appendChild( $bt );
			}
		}
		
		//Aqui é onde toda a estrutura é encaixada.
		$this->struct->appendChild( $this->domTable );
		
		if ( !is_null( $this->gridForm ) ) {
			$this->gridForm->appendChild( $this->struct );
			$this->dom->appendChild( $this->gridForm );
		} else {
			$this->dom->appendChild( $this->struct );
		}
	}
	
	/**
	 * Adiciona botões no header da grid.
	 * @param array $buttons Botões que irão aparecer no header da grid.
	 * @return void
	 */
	public function addButtonHeader( array $buttons ) {
		//Validação dos parâmetros.
		if ( !isset( $buttons ) || !is_array( $buttons ) ) {
			throw new Exception( 'O parâmetro deve ser um array.' );
		}
		
		if ( empty( $buttons ) ) {
			throw new Exception( 'O array não pode estar vazio' );
		}
		//Fim da validação dos parâmetros.
		
		$this->headerButtons = $buttons;
		return $this;
	}
	
	/**
	 * Seta o nome e o action do form da grid.
	 * Obs: A grid necessita invocar este método somente se algum botão do cabeçalho submeter algum dado.
	 * @param string $name Nome do formulário.
	 * @param array $action Action do formulário.
	 */
	public function addForm( $name, $action ) {
		//Validação dos parâmetros.
		if ( !isset( $name ) || empty( $name ) ) {
			throw new Exception(' Deve ser informado um nome para o formulário.' );
		}
		
		if ( is_array( $name ) ) {
			throw new Exception( 'O primeiro parâmetro deve ser uma string.' );
		}
		
		if ( !isset( $action ) || empty( $action ) ) {
			 throw new Exception( 'Deve ser informado um action para o formulário.' );
		}
		
		if ( !is_array( $action ) ) {
			throw new Exception( 'O segundo parâmetro deve ser um array' );
		}
		//Fim da validação dos parâmetros.
		
		$this->setGridFormName( $name );
		
		$this->gridForm = $this->dom->createElement( 'form' );
		
		$attrName = $this->dom->createAttribute( 'name' );
		$attrName->value = $name;
		
		$attrAction = $this->dom->createAttribute( 'action' );
		$attrAction->value = $this->helperUrl->url( $action, 'default', true );
		
		$attrMethod = $this->dom->createAttribute( 'method' );
		$attrMethod->value = 'post';
		
		$this->gridForm->appendChild( $attrName );
		$this->gridForm->appendChild( $attrAction );
		$this->gridForm->appendChild( $attrMethod );
		
		return $this;
	}
	
	/**
	 * Seta a propriedade name do formulário, caso haja formulário.
	 * @param $name Nome do formulário.
	 * @return void
	 */
	private function setGridFormName( $name ) {
		$this->gridFormName = $name;
	}
	
	/**
	 * Seta a largura da grid.
	 * @param integer $width Largura da grid em px.
	 * @return void
	 */
	public function setWidth( $width ) {
		//Validação dos parâmetros.
		if ( !isset( $width ) ) {
			throw new Exception( 'Um número inteiro entre 1 e 100 deve ser informado.' );
		}
		//Final da validação dos parâmetros.
		
		if ( $width != 0 ) {
			if ( $width > 100 ) {
				$width = 100;
			}
			
			$attrWidth = $this->dom->createAttribute( 'width' );
			$attrWidth->value = $width . '%';

			$this->domTable->appendChild( $attrWidth );
		}
		return $this;
	}
	
	/**
	 * Adiciona um componente na grid.
	 * Exemplo: botão, link, checkbox.
	 * @param Bolt_Grid_Header $Header Configuração do cabeçalho da coluna.
	 * @param object $Component Componente que deve ser exibido na coluna.
	 * @return void
	 */
	public function addColumn( Bolt_Grid_Header $Header, $Component ) {
		$this->setColumnField( $Component->getId() );
		$this->createHeader( $Header );

		$i = 0;
		$componentProperty 	= array();
		
		while ( $i < count( $this->data ) ) {
			//Armazena o componente a ser exibido.
			$componentProperty['component'] = $Component;
			
			//Armazena os atributos comuns a todos os componentes.
			$componentProperty['align']	= $Component->getAlign();
			$componentProperty['id']	= $Component->getId();
			
			//Checkbox
			if ( $Component instanceof Bolt_Grid_Field_Checkbox ) {
				$componentProperty['value']	= $this->data[$i][$Component->getField()];
			}
			
			//Botão
			if ( $Component instanceof Bolt_Grid_Field_Button ) {
				if ( is_array( $this->data[$i][$Component->getField()] ) ) {
					$buttonId = (object) $this->data[$i][$Component->getField()];
					$value = $buttonId->value;
				} else {
					$value = $this->data[$i][$Component->getField()];
				}
				
				//Monta o link do botão.
				$url = $Component->getLink();
				$url[$Component->getField()] = $value;
				
				$componentProperty['link']	= $this->helperUrl->url( $url, 'default', true );
			}
			
			//String
			if ( $Component instanceof Bolt_Grid_Field_String ) {
				$componentProperty['value']	= $this->data[$i][$Component->getField()];
			}	
			
			$this->data[$i][$Component->getId()] = $componentProperty;
			
			
			$i++;
		}
		return $this;
	}
	
	/**
	 * Cria a estrutura do cabealho da grid.
	 * @param Bolt_Grid_Header $Header Objeto com as configurações do cabeçalho da coluna.
	 * @return void
	 */
	private function createHeader( Bolt_Grid_Header $Header ) {
		$domTh = $this->dom->createElement( 'th', $Header->getLabel() );
		
		$attrAlign = $this->dom->createAttribute( 'align' );
		$attrAlign->value = $Header->getAlign();
		
		$domTh->appendChild( $attrAlign );
		$this->domTr->appendChild( $domTh );
		
		$attrWidth = $this->dom->createAttribute( 'width' );
		$attrWidth->value = $Header->getWidth() . 'px';
		$domTh->appendChild( $attrWidth );
	}
	
	/**
	 * Efetua uma busca de forma recursiva no value do componente.
	 * Essa rotina é necessária caso o valor do mesmo campo seja exibido em mais de uma coluna por componentes
	 * diferentes.
	 * @param string $value Valor do componente.
	 */
	private function getValue( $value )
	{
		if ( isset( $value['value'] ) && is_array( $value['value'] ) ) {
			$this->getValue( $value['value'] );
		}
		return $value['value'];
	}
	
	/**
	 * Cria a estrutura da grid com os dados.
	 * @return void
	 */
	private function createDataGrid() {
		foreach ( $this->data as $field ) {
			$domTr = $this->dom->createElement( 'tr' );
			$this->domTbody->appendChild( $domTr );
			
			foreach ( $this->columnField as $key => $value ) {
				//Verifica se o valor existe no array antes de listar, para se certificar de que este valor realmente deve ser exibido na grid.
				if ( array_key_exists( $value, $field ) ) {	
					$Component = $field[$value]['component'];
					
					//Botão
					if ( $Component instanceof Bolt_Grid_Field_Button ) {
						$button = (object) $field[$value];
						
						$domImg  = $this->dom->createElement( 'img' ); 
						
						$attrSrc = $this->dom->createAttribute( 'src' );
						$attrSrc->value = $Component->getIcon();
						
						$domImg->appendChild( $attrSrc );

						$domLink = $this->dom->createElement( 'a' );
						$attrHref = $this->dom->createAttribute( 'href' );
						$attrHref->value = $button->link;
						
						$domLink->appendChild( $domImg );
						$domLink->appendChild( $attrHref );
						
						if ( $Component->existsMessage() ) {
							$attrOnClick = $this->dom->createAttribute( 'onClick' );
							$attrOnClick->value = "return confirm('" . $Component->getMessage() . "');";
							$domLink->appendChild( $attrOnClick );
						}
						
						$domTd = $this->dom->createElement( 'td' );
						$attrAlign = $this->dom->createAttribute( 'align' );
						$attrAlign->value = $button->align;
						
						$domTd->appendChild( $attrAlign );
						$domTd->appendChild( $domLink );
						$domTr->appendChild( $domTd );
					}
					
					//Checkbox
					if ( $Component instanceof Bolt_Grid_Field_Checkbox ) {
						$checkbox = (object) $field[$value];
						
						$inputCheckbox = $this->dom->createElement( 'input' );

						$attrType = $this->dom->createAttribute( 'type' );
						$attrType->value = 'checkbox';

						$attrName = $this->dom->createAttribute( 'name' );
						$attrName->value = $Component->getName() . '[]';

						$attrValue = $this->dom->createAttribute( 'value' );
						$attrValue->value = $checkbox->value;
						
						$inputCheckbox->appendChild( $attrType );
						$inputCheckbox->appendChild( $attrName );
						$inputCheckbox->appendChild( $attrValue );
							
						$attrAlign = $this->dom->createAttribute( 'align' );
						$attrAlign->value = $Component->getAlign();
						
						$domTd = $this->dom->createElement( 'td' );
						$domTd->appendChild( $attrAlign );
						$domTd->appendChild( $inputCheckbox );
						$domTr->appendChild( $domTd );
					}
					
					//String
					if ( $Component instanceof Bolt_Grid_Field_String ) {
						$string = (object) $field[$value];
						
						if ( is_array( $string->value ) ) {
							$value = $this->getValue( $field[$value] );
							$value = $value['value'];
						} else {
							$value = $string->value;
						}
						
						$attrAlign = $this->dom->createAttribute( 'align' );
						$attrAlign->value = $Component->getAlign();
						
						$domTd = $this->dom->createElement( 'td', $value );

						$domTd->appendChild( $attrAlign );
						$domTr->appendChild( $domTd );
					}
				}
			}
		}
	}
	
	/**
	 * Cria a estrutura completa da grid e retorna seu HTML.
	 * @return string $HTML Estrutura HTML da grid.
	 */
	public function toHtml() {
		$this->doStruct();
		$this->createDataGrid();
		return $this->dom->saveHTML();
	}
	
	/**
	 * Seta qual o índice do array que deve ter seu valor exibido na grid.
	 * @param string $field
	 * @return void
	 */
	private function setColumnField( $field ) {
		$this->columnField[] = $field;

		//Zend_Debug::dump( $this->columnField );
		
	}
}