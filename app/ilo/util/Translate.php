<?php

/**
 * 
 */
abstract class ILO_Util_Translate
{
    /**
     *
     * @var SimpleXMLElement 
     */
    protected static $_data;
    
    /**
     *
     * @var string
     */
    protected static $_termoPath = '/language/termo[id=%s]';
    
    /**
     *
     * @param string $language 
     */
    public static function setLanguage( $language )
    {
	$file = 'app/conf/' . strtolower( $language ) . '.xml';
	if ( !file_exists( $file ) )
	    die( 'Arquivo de tradução ' . $file . ' não encontrado.' );
	
	self::$_data = simplexml_load_file( $file );
    }
    
    /**
     *
     * @param string $termo
     * @return string 
     */
    public static function get( $termo, $id )
    {
	if ( empty( self::$_data ) )
	    return $termo;
	
	$config = self::$_data;
	
	$path = sprintf( self::$_termoPath, $id );
	
	$result = $config->xpath( $path );
	
        if ( empty( $result ) )
	    return $termo;
	else
	    return (string)$result[0]->traducao;
    }
    
    /**
     *
     * @return SimpleXMLElement 
     */
    public static function getData()
    {
	return self::$_data;
    }
    
    public static function getContents()
    {
	return self::$_data->saveXML();
    }
    
    /**
     *
     * @param string $termo
     * @return string 
     */
    protected static function _toTagXml( $termo )
    {
	return preg_replace( '/[^0-9a-z]/i', '', strtolower( $termo ) );
    }
    
    public static function toArray( $nodeRoot = null, $itens = array() )
    {
	$nodeRoot = $nodeRoot ? $nodeRoot : self::$_data;

	if ( is_string( $nodeRoot ) )
	    $nodeRoot = self::get ( $nodeRoot );

	foreach( $nodeRoot->children() as $node ) {

	    $nameNode = $node->getName();

	    if( !$node->children() ) {
		if ( array_key_exists( $nameNode, $itens ) ) {

		    if ( !is_array( $itens[$nameNode] ) ) {

			$initValue = $itens[$nameNode];
			$itens[$nameNode] = array();
			$itens[$nameNode][] = $initValue;
		    }

		    $itens[$nameNode][] = trim( $node[0] );
		} else {
		    $itens[$nameNode] = trim( $node[0] );
		}
	    } else {
		$itens[$nameNode] = array();
		$itens[$nameNode] = self::toArray( $node, $itens[$nameNode] );
	    }
        }

        return $itens;
    }
}
