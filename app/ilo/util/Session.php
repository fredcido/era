<?php

abstract class ILO_Util_Session
{
    
    public static function start()
    {
	session_start();
    }
    
    public static function set( $name, $value )
    {
	$_SESSION[$name] = $value;
    }
    
    public static function get( $name )
    {
	return empty( $_SESSION[$name] ) ? null : $_SESSION[$name];
    }
    
    public static function remove( $name )
    {
	unset( $_SESSION[$name] );
    }
    
    public static function clear()
    {
	session_destroy();
    }
}