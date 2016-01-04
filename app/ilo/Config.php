<?php

class ILO_Config
{
    public static $_config;

    private function __construct(){}

    public static function setConfig( $config_file )
    {
        if ( !file_exists( $config_file ) )
           throw new Exception ('Arquivo de configuração ' . $config_file . ' não encontrado.' );

        self::$_config = simplexml_load_file( $config_file );
    }

    public static function getConfig()
    {
        return empty( self::$_config ) ? null : self::$_config;
    }

    public static function get( $el )
    {
        if ( empty( self::$_config ) )
            return null;

        $config = self::$_config;

        $result = $config->xpath( $el );

        switch ( true ) {
            case null === $result:
                    return null;
                break;
            case 1 == count( $result ):
                    return $result[0];
                break;
            default:
                    return $result;
        }
    }

    public static function toArray( $nodeRoot = null, $itens = array() )
    {
	$nodeRoot = $nodeRoot ? $nodeRoot : self::$_config;

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