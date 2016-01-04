<?php

abstract class ILO_Util_Xml
{
    /**
     *
     * @var DOMDocument 
     */
    private static $_dom;
    
    /**
     *
     * @param array $data
     * @return string 
     */
    public static function toXml( $data )
    {
	self::$_dom = new DOMDocument( '1.0', 'utf-8' );
        $rootNode = self::$_dom->createElement( 'data' );
        
        self::$_dom->appendChild( $rootNode );
        
        self::fromMixed( $data, $rootNode );
	
	return self::$_dom->saveXML();
    }
    
    /**
     *
     * @param arra $data
     * @return string 
     */
    protected static function fromMixed( $mixed, DOMElement $domElement = null, $nameSpace = '' )
    {
	if ( is_array( $mixed ) ) {

	    foreach ( $mixed as $index => $mixedElement ) {
		if ( is_int( $index ) ) {
		    if ( $index == 0 ) {
			$node = $domElement;
		    } else {
			$node = self::$_dom->createElement( $domElement->tagName );
			$domElement->parentNode->appendChild( $node );
		    }
		} else {
		    $name = empty( $nameSpace ) ? $index : $nameSpace . ':' . $index;
		    $node = self::$_dom->createElement( $name );
		    $domElement->appendChild( $node );
		}

		self::fromMixed( $mixedElement, $node, $nameSpace );
	    }
	} else {
	    $domElement->appendChild( self::$_dom->createTextNode( utf8_encode( $mixed ) ) );
	} 
    }

}