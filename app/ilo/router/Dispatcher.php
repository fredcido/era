<?php

class ILO_Router_Dispatcher
{
    /**
     *
     * @var <array> array com dados da url
     */
    protected $_url;

    /**
     *
     * @var <ILO_Auth_Interface>
     */
    protected $_accessControl;

    /**
     *
     * @var <array> com rota atual
     */
    protected static $_rota;

    /**
     *
     * @var <string> modulo atual
     */
    protected static $_module;

    /**
     *
     * @var <string> controller atual
     */
    protected static $_controller;

    /**
     *
     * @var <string> action atual
     */
    protected static $_action;

    /**
     *
     * @var <array> parametros atuais ( GET | POST )
     */
    public static $_params;

    /**
     *
     * @var <object> objeto com configuracao atual
     */
    protected $_defaultRoute;

    /**
     *
     * @var <string> pasta de modulo padrao
     */
    protected static $_defaultModules;

    /**
     *
     * @var <string> nome do modulo padrao
     */
    protected static $_defaultModule;

    /**
     *
     * @var <string> nome do controller padrao
     */
    protected static $_defaultController;

    /**
     *
     * @var <string> nome do action padrao
     */
    protected static $_defaultAction;

    /**
     *
     */
    public function __construct()
    {
        // Pega configuracao de rota
        $this->_defaultRoute = ILO_Config::get('route');

        // Verifica se tem configuracao com pasta de modulos padrao
        self::$_defaultModules = empty( $this->_defaultRoute->modules ) ? 'modules' : $this->_defaultRoute->modules;

        // Configuracao do modulo padrao
        self::$_defaultModule = empty( $this->_defaultRoute->default->module ) ? 'default' : $this->_defaultRoute->default->module;

        // Configuracao do controller padrao
        self::$_defaultController = empty( $this->_defaultRoute->default->controller ) ? 'index' :$this->_defaultRoute->default->controller;
        
        // Configuracao do action padrao
        self::$_defaultAction = empty( $this->_defaultRoute->default->action ) ? 'index' : $this->_defaultRoute->default->action;
    }

    /**
     *
     * @return <string> self::$_module
     */
    public static function getModule()
    {
        return self::$_module;
    }

    /**
     *
     * @return <string> self::$_defaultModules
     */
    public static function getDefaultModules()
    {
        return self::$_defaultModules;
    }

    /**
     *
     * @return <string> self::$_defaultModule
     */
    public static function getDefaultModule()
    {
        return self::$_defaultModule;
    }

    /**
     *
     * @return <string> self::$_controller
     */
    public static function getController()
    {
        return self::$_controller;
    }
    
    /**
     *
     * @return string
     */
    public static function getPathAtual()
    {
	// Pega modulo e controller atual e o nome do modulo padrão
	$modulo = self::getModule();
	$controller = self::getController();
	$defaultModule = self::getDefaultModule();

	// Pega caminho atual para marcar no menu
	return ( $modulo == $defaultModule ? '' : '/' . $modulo  ) . '/' . $controller . '/';
    }

    /**
     *
     * @return <string> self::$_defaultController
     */
    public static function getDefaultController()
    {
        return self::$_defaultController;
    }

    /**
     *
     * @return <string> self::$_action
     */
    public static function getAction()
    {
        return self::$_action;
    }

    /**
     *
     * @return <string> self::$_defaultAction
     */
    public static function getDefaultAction()
    {
        return self::$_defaultAction;
    }

    /**
     *
     * @return <array>
     */
    public static function getParams()
    {
        return self::$_params;
    }

    /**
     *
     * @return <array>
     */
    public static function getRoute()
    {
        return self::$_rota;
    }

    /**
     *
     * @param ILO_Auth_IAcesso $objControle
     */
    public function setAccessObject( ILO_Auth_Interface $objControle = NULL )
    {
        $this->_accessControl = $objControle;
    }

    /**
     *
     */
    protected function parseUrl()
    {
        if ( $this->isCli() ) {
            $this->_url = empty( $_SERVER['argv'][1] ) ? '' : $_SERVER['argv'][1];
        } else {
            $this->_url = str_replace( BASE, '', $_SERVER['REQUEST_URI'] );
        }

        $this->_url = preg_replace('/(^\/|\/$)/','', $this->_url );
        $this->_url = empty( $this->_url ) ? array() : explode('/', $this->_url );
        $this->initRoute();
    }

    /**
     *
     */
    protected function setParams()
    {
        $urlParams = array();
        foreach ( $this->_url as $key => $param ) {
            if ( isset( $this->_url[$key + 1 ] ) )
                $urlParams[$param] = $this->_url[$key + 1];
        }

        self::$_params = $urlParams;

        if ( !$this->isCli() && 'POST' == $_SERVER['REQUEST_METHOD'] ) {

            self::$_params = array_merge( self::$_params, $_POST );
        } else if ( !$this->isCli() ) {
	    self::$_params = array_merge( self::$_params, $_GET );
	}
    }
    
    /**
     *
     * @param string $param
     * @param mixed $value 
     */
    public static function setParam( $param, $value )
    {
	self::$_params[$param] = $value;
    }

    /**
     *
     * @return <bool>
     */
    public function isCli()
    {
        return PHP_SAPI == 'cli';
    }

    /**
     * 
     */
    protected function initRoute()
    {
        if ( is_dir( APPDIR . '/' . self::$_defaultModules . '/' . self::$_defaultModule . '/' ) ) {

            if ( empty( $this->_url ) ) {

                self::$_module = self::$_defaultModule;
                self::$_controller = self::$_defaultController;
                self::$_action = self::$_defaultAction;
            } else {

                if ( file_exists( APPDIR . '/'. self::$_defaultModules . '/' . self::$_defaultModule . '/controller/' . ucfirst( $this->_url[0] ) . '.php' ) ) {

                    self::$_module = self::$_defaultModule;
                    self::$_controller = $this->_url[0];
                    self::$_action = empty( $this->_url[1] ) ? self::$_defaultAction : $this->_url[1];

                    $this->_url = array_slice( $this->_url, 2);

                } elseif ( is_dir ( APPDIR . '/' . self::$_defaultModules . '/' . $this->_url[0] ) ) {
		    
		    if ( empty( $this->_url[1] ) )
			$this->_url[1] = self::$_defaultController;

                    if ( file_exists( APPDIR . '/' . self::$_defaultModules . '/' . $this->_url[0] . '/controller/' . ucfirst( $this->_url[1] ) . '.php' ) ) {

                        self::$_module = $this->_url[0];
                        self::$_controller = $this->_url[1];
                        self::$_action = empty( $this->_url[2] ) ? self::$_defaultAction : $this->_url[2];

                        $this->_url = array_slice( $this->_url, 3);
                    } else {

                        throw new Exception( 'Controller ' . $this->_url[1] . ' não encontrado.', 002 );
                    }
                } else {

                    throw new Exception( 'Módulo ' . $this->_url[0] . ' não encontrado.', 003 );
                }
            }
        } else {

            throw new Exception( 'Módulo default não encontrado.', 001);
        }

        self::setRoute( self::$_action, self::$_controller, self::$_module );
    }

    /**
     *
     * @param <string> $action
     * @param <string> $controller
     * @param <string> $modulo
     */
    public static function setRoute( $action, $controller = null, $modulo = null )
    {
        if ( !empty( $modulo ) )
            self::$_module = $modulo;
        if ( !empty( $controller ) )
            self::$_controller = $controller;

        self::$_action = $action;

        self::$_rota = array(
                        'modulo'     => self::$_module,
                        'controller' => self::$_controller,
                        'action'     => self::$_action
                    );
    }

    /**
     * 
     */
    public function run()
    {
        try {

            $this->parseUrl();
            $this->setParams();
            $this->dispatch();

        } catch ( Exception $e ) {

            $this->routeError( $e );
        }
    }

    /**
     * 
     */
    protected function checkAccess( ILO_Controller_Padrao $controller )
    {
        if ( null != $this->_accessControl ) {
	    
            if ( !$this->_accessControl->verificaAcesso( $controller ) ) {

                if ( $this->isCli() ) {

                    die( 'Sem acesso a rota: ' . implode('/', array_values( self::$_rota ) ) );
                } else {

                    $novaRota = $this->_accessControl->getNewRoute();

                    self::setRoute( $novaRota['action'], $novaRota['controller'], $novaRota['modulo'] );
		    
		    return false;
                }
            }
        }
	
	return true;
    }

    /**
     * 
     */
    protected function dispatch( $error = false )
    {
	if ( !$error ) {
	    
	    // Verifica se o sistema esta em manutencao
	    $this->_verificaManutencao();
	}
	
        $classe = ucfirst( self::$_module ) . '_Controller_' . ucfirst( self::$_controller );

        if ( class_exists( $classe ) ) {

            $objControle = new $classe();
	    
	    if ( !$this->checkAccess( $objControle ) ) {
		
		$classe = ucfirst( self::$_module ) . '_Controller_' . ucfirst( self::$_controller );
		$objControle = new $classe();
	    }
	    
            $actionName = self::$_action . 'Action';
	    
            if ( method_exists( $objControle, $actionName ) ) {

                $objControle->createView();

                if ( method_exists( $objControle, 'init') )
                    $objControle->init();

                call_user_func_array( array( $objControle, $actionName ), $this->_url );
                $objControle->render();
                
            } else {

                throw new Exception('Método ' . $actionName . ' da classe: ' . $classe . ' não encontrado', 005 );
            }
        } else {

            throw new Exception('Classe ' . $classe . ' não encontrada.', 005 );
        }
    }
    
    protected function _verificaManutencao()
    {
	$manutencao = ILO_Config::get('geral/manutencao');
	
	if ( $manutencao != 0 )
	    throw new Exception('Sistema em manuten&ccedil;&atilde;o.');
    }


    /**
     *
     * @param Exception $e 
     */
    protected function routeError( Exception $e )
    {
        if ( $e->getCode() == 001 ) {

            throw new Exception('Módulo default não encontrado.', 001 );
        } else {
	    
            if ( $this->isCli() ) {

                die( $e->getMessage() );
                
            } else {
                
               self::$_params['error'] = $e;

                if ( file_exists( APPDIR . '/' . self::$_defaultModules . '/'. self::$_defaultModule . '/controller/Error.php') ) {

                    self::setRoute( 'error', 'error', self::$_defaultModule );
                    $this->dispatch( true );
                } else {

                    throw new Exception('Arquivo Error.php não encontrado no módulo default.', 006 );
                }
            }
        }
    }
}