<?php

abstract class ILO_Util_Message
{
    /**
     *
     * @var string 
     */
    protected static $_idMessage;
    
    /**
     *
     * @param string $message 
     */
    public static function setMessage( $message, $level = 'error' )
    {
	$message = array(
	    'msg'   =>	$message,
	    'level' =>	$level
	);
	
	ILO_Util_Session::set( self::$_idMessage, $message );
    }
    
    /**
     *
     * @return type 
     */
    public static function getMessage()
    {
	return ILO_Util_Session::get( self::$_idMessage ); 
    }
    
    /**
     * 
     */
    public static function clear()
    {
	ILO_Util_Session::remove( self::$_idMessage );
    }
    
    /**
     *
     * @return type 
     */
    public static function hasMessage()
    {
	$message = ILO_Util_Session::get( self::$_idMessage );
	return !empty( $message );
    }
}