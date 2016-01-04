<?php

class ILO_Auth_Acesso implements ILO_Auth_Interface
{
    /**
     *
     * @var string
     */
    protected static $_nameSession = 'auth';
    
    /**
     *
     * @var array
     */
    protected $_newRoute = array(
				'modulo'	=>  'default',
				'controller'    =>  'auth',
				'action'	=>  'index'
			  );
    
    /**
     *
     * @var ILO_Controller_Padrao 
     */
    protected $_controller = null;
    
    /**
     *
     * @var string
     */
    protected $_pathAtual = null;
    
    /**
     * 
     */
    public function verificaAcesso( ILO_Controller_Padrao $controller )
    {
	$auth = ILO_Util_Session::get( self::$_nameSession );
	
	$this->_pathAtual = ILO_Router_Dispatcher::getPathAtual();
	$this->_controller = $controller;
	
	switch ( true ) {
	    
	    // Caso seja um caminho liberado sem necessidade de autenticação
	    case ILO_Auth_Permissao::hasFreeAccess():
		return true;
	    
	    // Se usuario não estiver autenticado e o controller não for o auth
	    case ( empty( $auth ) && $this->_pathAtual != '/auth/' ):
		return false;
		
	    // Se o usuario estiver tentando acessar uma role liberada
	    case in_array( $this->_pathAtual, ILO_Auth_Permissao::getDefaultRoles() ):
		return true;
		
	    // Se usuario não tiver permissão no caminho ou o action não esteja mapeado
	    case ( !ILO_Auth_Permissao::has( $this->_pathAtual ) ):
	    case ( !$this->_checkAccessMapping() ):
		
		$this->_newRoute = array(
		    'modulo'	    =>  'default',
		    'controller'    =>  'error',
		    'action'	    =>  'permissao'
		);

		$route = ILO_Router_Dispatcher::getRoute();
		ILO_Router_Dispatcher::setParam( 'routeDenied', $route );

		return false;
	}
	    
	return true;
    }

    
    /**
     *
     */
    protected function _checkAccessMapping()
    {
	$accessMapping = $this->_controller->getAccessMapping();
	$actionAtual = ILO_Router_Dispatcher::getAction();
		
	foreach ( $accessMapping as $operation => $actions ) {
	    if ( 
		 in_array( $actionAtual, $actions ) && 
		 ILO_Auth_Permissao::has( $this->_pathAtual, $operation ) )
		return true;
	}
	    
	return false;
    }
    
    /**
     *
     * @return array
     */
    public function getNewRoute()
    {
	return $this->_newRoute;
    }
    
    /**
     *
     * @return mixed
     */
    public static function getIdentity()
    {
	$auth = ILO_Util_Session::get( self::$_nameSession );
	return empty( $auth ) ? null : $auth;
    }
    
    /**
     *
     * @param mixed $identity 
     */
    public static function setIdentity( $identity )
    {
	ILO_Util_Session::set( self::$_nameSession, $identity );
    }
    
    /**
     * 
     */
    public static function reset()
    {
	ILO_Util_Session::remove( self::$_nameSession );
    }
}