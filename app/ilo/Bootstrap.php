<?php

class ILO_Bootstrap
{
    public static function start()
    {
        $methods = get_class_methods(__CLASS__);
        foreach ( $methods as $method ) {
            if ( preg_match( '/^init/i', $method ) )
                self::$method();
        }
    }

    public static function initConfig()
    {
        ILO_Config::setConfig( APPDIR . '/conf/config.xml');
        $config = ILO_Config::getConfig();

        foreach ( $config->php->children() as $config => $value )
            ini_set( $config, $value );
    }
    
    public static function initLanguage()
    {
	ILO_Util_Translate::setLanguage( 'tetum' );
    }

    public static function initSession()
    {
        ILO_Util_Session::start();
    }

    public static function initRoute()
    {
        $objRouter = new ILO_Router_Dispatcher();
	$objRouter->setAccessObject( new ILO_Auth_Acesso() );
        $objRouter->run();
    }
}