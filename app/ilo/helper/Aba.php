<?php

class ILO_Helper_Aba extends ILO_Helper_Abstract
{
   
    /**
     *
     * @var DOMDocument
     */
    protected $_dom;
    
    /**
     *
     * @var array
     */
    protected $_buttons = array();
    
    /**
     * 
     */
    public function __invoke()
    {
	return $this;
    }
    
    /**
     *
     * @param array $button 
     */
    public function addButton( array $button )
    {
	$this->_buttons[] = $button;
	return $this;
    }
    
    /**
     *
     * @param array $buttons 
     */
    public function addButtons( array $buttons )
    {
	$this->_buttons += $buttons;
	return $this;
    }
    
    /**
     *
     * @param array $buttons 
     */
    public function setButtons( array $buttons )
    {
	$this->_buttons = $buttons;
	return $this;
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
	$this->_dom = new DOMDocument();
	
	$ul = $this->_dom->createElement( 'ul' );
	$ul->setAttribute( 'class', 'section_menu section_nav right' );
	
	$this->_dom->appendChild( $ul );
	
	foreach ( $this->_buttons as $button ) {
	    
	    if ( 
		 !empty( $button['role'] ) &&
		 !empty( $button['operation'] ) &&
		 !ILO_Auth_Permissao::has( $button['role'], $button['operation'] ) 
		)
		continue;
	    
	    $ul->appendChild( $this->_createButtom( $button ) );
	}
	
	return $this->_dom->saveHTML();
    }
    
    /**
     *
     * @param array $button
     * @return DOMElement 
     */
    protected function _createButtom( $button )
    {
	$li = $this->_dom->createElement( 'li' );
	$a = $this->_dom->createElement( 'a' );
	
	$a->setAttribute( 'class', $button['class'] );
	
	if ( !empty( $button['class'] ) )
	    $a->setAttribute( 'class', $button['class'] );
	
	if ( !empty( $button['id'] ) )
	    $a->setAttribute( 'id', $button['id'] );
	
	$a->setAttribute( 'href', ( !empty( $button['url'] ) ? $button['url'] : 'javascript:;' ) );
	
	$spanMiddle = $this->_dom->createElement( 'span' );
	$span = $this->_dom->createElement( 'span' );
	$emMiddle = $this->_dom->createElement( 'em' );
	
	$emMiddle->appendChild( $this->_dom->createTextNode( ILO_Util_Translate::get(  $button['label'], $button['trans_id'] ) ) );
	$spanMiddle->appendChild( $emMiddle );
	$spanMiddle->appendChild( $span );
	$spanMiddle->setAttribute( 'class', 'm' );
	
	$li->appendChild( $a );
	$a->appendChild( $this->_span( 'l' ) );
	$a->appendChild( $spanMiddle );
	$a->appendChild( $this->_span( 'r' ) );
	
	return $li;
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