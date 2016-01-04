<?php

class ILO_Helper_Menu extends ILO_Helper_Abstract
{
    /**
     *
     * @var array
     */
    protected $_itens = array(
	array(
	    'label' => 'Painel',
	    'url'   => '/index/',
	    'id'    => 40
	),
	array(
	    'label' => 'Administrativo',
	    'id'    => 41,
	    'itens' => array(
		array( 
		    'label' => 'Módulo',
		    'url'   => '/admin/modulo/',
		    'id'    => 2
		),
		array( 
		    'label' => 'Formulário',
		    'url'   => '/admin/formulario/',
		    'id'    => 3
		),
		array( 
		    'label' => 'Usuário',
		    'url'   => '/admin/usuario/',
		    'id'    => 1
		),
		array( 
		    'label' => 'Permissão',
		    'url'   => '/admin/permissao/',
		    'id'    => 30
		),
		array( 
		    'label' => 'Auditoria',
		    'url'   => '/admin/auditoria/',
		    'id'    => 110
		),
                array( 
		    'label' => 'Suku',
		    'url'   => '/admin/suku/',
		    'id'    => 100
		),
                array( 
		    'label' => 'Aldeia',
		    'url'   => '/admin/village/',
		    'id'    => 102
		)
	    )
	),
	array(
	    'label' => 'Contrato',
	    'id'    => 48,
	    'itens' => array(
		array( 
		    'label' => 'Contrato',
		    'url'   => '/beneficiario/contrato/',
		    'id'    => 48,
                    'itens' => array(
                            array(
                                'label' => 'Novo',
                                'url'   => '/beneficiario/contrato/geral',
                                'id'    => 17
                            ),
                            array(
                                'label' => 'Listar',
                                'url'   => '/beneficiario/contrato/',
                                'id'    => 9
                            )
                        )
		),
		array( 
		    'label' => 'Beneficiário',
		    'url'   => '/beneficiario/beneficiario/',
		    'id'    => 47
		)
	    )
	),
	array(
	    'label' => 'Treinamento',
	    'id'    => 210,
	    'itens' => array(
		array( 
		    'label' => 'Unidades de competência',
		    'url'   => '/treinamento/competencia/',
		    'id'    => 697
		),
		array( 
		    'label' => 'Registro curso',
		    'url'   => '/treinamento/curso/',
		    'id'    => 691
		),
		array( 
		    'label' => 'Registro participantes',
		    'url'   => '/treinamento/participantes/',
		    'id'    => 271
		),
		array( 
		    'label' => 'Registro turma',
		    'url'   => '/treinamento/treinamento/',
		    'id'    => 272
		)
	    )
	),
	array(
	    'label' => 'Empresa',
	    'id'    => 273,
	    'itens' => array(
		array( 
		    'label' => 'Registro empresa',
		    'url'   => '/empresa/registro/',
		    'id'    => 274
		)
	    )
	),
	array(
	    'label' => 'M&E',
	    'id'    => 999,
	    'itens' => array(
		array( 
		    'label' => 'Snapshot',
		    'url'   => '/me/snapshot/',
		    'id'    => 618
		),
		array( 
		    'label' => 'Questionnaire Config',
		    'url'   => '/me/questionnaireconfig/',
		    'id'    => 668
		),
                array( 
		    'label' => 'Questionnaire',
		    'url'   => '/me/questionnaire/',
		    'id'    => 669
		)
	    )
	),
	array(
	    'label' => 'Relatórios',
	    'url'   => '/relatorio/',
	    'id'    => 407
	)
    );
   
    /**
     *
     * @var DOMDocument
     */
    protected $_dom;
    
    /**
     * 
     */
    public function __invoke()
    {
	return $this->render();
    }
    
    /**
     *
     * @return string
     */
    public function __toString()
    {
	return $this->render();
    }
    
    /**
     *
     * @return type 
     */
    public function render()
    {
	$this->_dom =  new DOMDocument();
	
	$divMainMenu = $this->_dom->createElement( 'div' );
	$divMainMenu->setAttribute( 'id', 'main_menu' );
	$this->_dom->appendChild( $divMainMenu );
	
	$divInner = $this->_dom->createElement( 'div' );
	$divInner->setAttribute( 'class', 'inner' );
	$divMainMenu->appendChild( $divInner );
	
	$ulPrincipal = $this->_dom->createElement( 'ul' );
	$divInner->appendChild( $ulPrincipal );
	
	// Pega caminho atual
	$pathAtual = ILO_Router_Dispatcher::getPathAtual();
	
	$itens = $this->_itens;
	
	foreach ( $itens as $item ) {
	    
	    $append = true;
	    
	    $li = $this->_dom->createElement( 'li' );
	    $a = $this->_dom->createElement( 'a' );
	    
	    $urlMenu = empty( $item['url'] ) ? 'javascript:;' : BASE . $item['url'];
	    $a->setAttribute( 'href', $urlMenu );
	    $li->appendChild( $a );
	    
	    // Cria conteudo
	    $spanMiddle = $this->_dom->createElement( 'span' );
	    $span = $this->_dom->createElement( 'span' );
	    $emMiddle = $this->_dom->createElement( 'em' );
	    
	    $emMiddle->appendChild( $this->_dom->createTextNode( ILO_Util_Translate::get(  $item['label'], $item['id'] ) ) );
	    $spanMiddle->appendChild( $emMiddle );
	    $spanMiddle->appendChild( $span );
	    $spanMiddle->setAttribute( 'class', 'm' );
	    
	    // Adiciona spans no link
	    $a->appendChild( $this->_span( 'l' ) );
	    $a->appendChild( $spanMiddle );
	    $a->appendChild( $this->_span( 'r' ) );
	    
	    // Marca link como selecionado
	    $selected = ( !empty( $item['url'] ) && $item['url'] == $pathAtual ) ? true : false;
	    
	    if ( !empty( $item['itens'] ) ) {
		
		$ulSub = $this->_dom->createElement( 'ul' );
		
		$append = false;
		
		foreach ( $item['itens'] as $sub ) {
		    
		    // Verifica se tem permissão
		    if ( !ILO_Auth_Permissao::has( $sub['url'] ) )
			continue;
		    
		    $liSub = $this->_dom->createElement( 'li' );		    
		    $aSub = $this->_dom->createElement( 'a' );	    
                    
		    $urlMenuSub = empty( $sub['url'] ) ? 'javascript:;' : BASE . $sub['url'];
		    $aSub->setAttribute( 'href', $urlMenuSub );
                    
		    $liSub->appendChild( $aSub );	
                    
                    if( !empty( $sub['itens'] ) ){
                        	    
                        $ulSubSub = $this->_dom->createElement( 'ul' );
                        
                        $liSub->appendChild( $ulSubSub );
                        
                        foreach( $sub['itens'] as $subSub ){
                            
                            $aSubSub = $this->_dom->createElement( 'a' );
                            $liSubSub = $this->_dom->createElement( 'li' );
                            $liSubSub->setAttribute( 'class', 'subSub' );
                            
                            $aSubSub->setAttribute( 'href',  BASE . $subSub['url'] );
                            $liSubSub->appendChild( $aSubSub );
                            $aSubSub->appendChild( $this->_dom->createTextNode( ILO_Util_Translate::get(  $subSub['label'], $subSub['id'] ) ) );                            
                        
                            $ulSubSub->appendChild( $liSubSub );                            
                            
                        }
                    }
                    
		    // Cria conteudo
		    $spanMiddleSub = $this->_dom->createElement( 'span' );
		    $spanSub = $this->_dom->createElement( 'span' );
		    $emMiddleSub = $this->_dom->createElement( 'em' );
		    
		    $emMiddleSub->appendChild( $this->_dom->createTextNode( ILO_Util_Translate::get(  $sub['label'], $sub['id'] ) ) );
		    $spanMiddleSub->appendChild( $emMiddleSub );
		    $spanMiddleSub->appendChild( $spanSub );
		    $spanMiddleSub->setAttribute( 'class', 'm' );

		    // Adiciona spans no link
		    $aSub->appendChild( $this->_span( 'l' ) );
		    $aSub->appendChild( $spanMiddleSub );
		    $aSub->appendChild( $this->_span( 'r' ) );
		    
		    $selectedSub = ( !empty( $sub['url'] ) && $sub['url'] == $pathAtual ) ? true : false;
		    
		    if ( $selectedSub ) {
			
			$selected = true;
			$aSub->setAttribute( 'class', 'selected_lk' );
		    }
                    
		    $ulSub->appendChild( $liSub );
		    
		    if ( $selected )
			$ulSub->setAttribute( 'class', 'visible' );
		    
		    $append = true;
		}
		
		$li->appendChild( $ulSub );
	    }
	    
	    if ( $append )
		$ulPrincipal->appendChild ( $li );
	    
	    if ( $selected )
		$a->setAttribute( 'class', 'selected_lk' );
	}
	
	$spanBd = $this->_dom->createElement( 'span' );
	$spanBd->setAttribute( 'class', 'sub_bg' );
	$divMainMenu->appendChild( $spanBd );
	
	return $this->_dom->saveHTML();
    }
    
    /**
     *
     * @return DOMElement
     */
    protected function _span( $class )
    {
	$spanLeft = $this->_dom->createElement( 'span' );
	$span = $this->_dom->createElement( 'span' );
	$spanLeft->appendChild( $span );
	$spanLeft->setAttribute( 'class', $class );
	
	return $spanLeft;
    }
}