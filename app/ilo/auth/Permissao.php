<?php

abstract class ILO_Auth_Permissao
{
    /**
     *
     * @var array
     */
    protected static $_defaultRoles = array(
					'/auth/',
					'/index/',
					'/error/',
				      );
    
    protected static $_defaultModules = array( 'relatorio' );
    
    /**
     *
     * @var string
     */
    protected static $_roleId = 'permissoes';
    
    /**
     *
     * @param string $role 
     */
    public static function addRole( $role, $operations )
    {
	$roles = ILO_Util_Session::get( self::$_roleId );
	$roles[$role] = $operations;
	ILO_Util_Session::set( self::$_roleId, $roles );
    }
    
    /**
     *
     * @return array
     */
    public static function getDefaultModules()
    {
	return self::$_defaultModules;
    }
    
    /**
     *
     * @return array
     */
    public static function getDefaultRoles()
    {
	return self::$_defaultRoles;
    }
    
    /**
     *
     * @return bool
     */
    public static function hasFreeAccess( $path = '' )
    {
	// Verifica se o módulo atual é liberado sem necessidade de autenticação
	$module = ILO_Router_Dispatcher::getModule();
	if ( in_array( $module, self::getDefaultModules() ) )
	    return true;
	
	return false;
    }
    
    /**
     *
     * @param array $roles 
     */
    public static function addRoles( array $roles )
    {
	foreach ( $roles as $role => $operations )
	    self::addRole ( $role, $operations );
    }
    
    /**
     *
     * @param string $role 
     */
    public static function removeRole( $role )
    {
	$roles = (array)ILO_Util_Session::get( self::$_roleId );
	
	unset( $roles[$pos] );
	
	ILO_Util_Session::set( self::$_roleId, $roles );
    }
    
    /**
     *
     * @param string $role
     * @return boolean
     */
    public static function has( $role, $operation = null )
    {
	if ( in_array( $role, self::$_defaultRoles ) )
	    return true;
	
	$roles = (array)ILO_Util_Session::get( self::$_roleId );
	
	if ( !empty( $operation ) )
	    $operation = ILO_Util_Geral::toAscii( $operation );
		
	return !$operation ? 
	     array_key_exists( $role, $roles ) : 
	     array_key_exists( $role, $roles ) && in_array( $operation, $roles[$role] );
    }
    
    /**
     * 
     */
    public static function reset()
    {
	ILO_Util_Session::remove( self::$_roleId );
    }
}