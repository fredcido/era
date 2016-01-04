<?php

class ILO_View_Render
{
    protected $_vars;

    protected $_viewPath;

    protected $_rota;

    protected $_renderLayout;
    
    protected $_layoutFile;

    protected $_helper;

    protected $_layoutPath;

    /**
     * 
     */
    public function __construct( ILO_Helper_Proxy $helper = null )
    {
        $this->_initLayout();
        $this->_rota = ILO_Router_Dispatcher::getRoute();
        $this->_helper = $helper;
    }

    /**
     * 
     */
    protected function _initLayout()
    {
        $layout = ILO_Config::get( 'geral/layout' );
        if ( NULL !== $layout )
            $this->_renderLayout = (bool)$layout->render;
        else
            $this->_renderLayout = true;

        if ( $this->_renderLayout ) {

            $this->_layoutPath = APPDIR . '/' . ILO_Router_Dispatcher::getDefaultModules() . '/';
            if ( !empty( $layout->path ) ) {
                
                if ( !file_exists( $this->_layoutPath . $layout->path ) )
                    throw new Exception('Arquivo ' . $layout->path . ' de layout não encontrado.');

                $this->_layoutFile = $this->_layoutPath . $layout->path;
            } else
                $this->_layoutFile = $this->_layoutPath . $this->_rota['modulo'] . '/layout/main.php';
        }
    }

    /**
     *
     * @param <array> $rota
     */
    public function setRota( $rota )
    {
        $this->_rota = $rota;
    }

    /**
     *
     * @param <string> $layout
     */
    public function setLayout( $layout )
    {
        if ( !file_exists( $this->_layoutPath . $layout ) )
            throw new Exception( 'Arquivo ' . $layout . ' de layout não encontrado.');

        $this->_layoutFile = $this->_layoutPath . $layout;
    }
    
    /**
     *
     * @param string $layouPath 
     */
    public function setLayoutPath( $layouPath )
    {
	if ( !is_dir( $layouPath ) )
            throw new Exception( 'Diretório ' . $layouPath . ' de layout não encontrado.' );

        $this->_layoutPath = $this->_layoutPath . $this->_layoutFile;
    }

    /**
     *
     * @param <string> $view
     */
    public function renderNewView( $view, $controller = null, $module = null )
    {
        $this->_rota['action'] = $view;
	
	if ( $controller )
	    $this->_rota['controller'];
	
	if ( $module )
	    $this->_rota['modulo'] = $module;
    }

    /**
     *
     * @param <mixed> $var
     * @param <mixed> $value
     */
    public function assign( $var, $value )
    {
        $this->_vars[$var] = $value;
    }

    /**
     *
     * @param <mixed> $var
     * @param <mixed> $value
     */
    public function __set( $var, $value )
    {
        if ( !property_exists($this, $var) )
            $this->assign($var, $value);
    }

    /**
     *
     * @param <mixed> $var
     * @return <mixed>
     */
    public function __get( $var )
    {
        return array_key_exists($var, $this->_vars) ? $this->_vars[$var] : null;
    }

    /**
     *
     * @param <mixed> $var
     * @return <bool>
     */
    public function __isset( $var )
    {
        return !empty( $this->_vars[$var] );
    }

    /**
     * 
     */
    protected function _setViewPath()
    {
        $this->_viewPath = APPDIR .
                          '/' . ILO_Router_Dispatcher::getDefaultModules() . '/' .
                          $this->_rota['modulo'] . '/' .
                          'view/' .
                          $this->_rota['controller'] . '/' .
                          $this->_rota['action'] . '.php';

        if ( !file_exists( $this->_viewPath ) ) {
            throw new Exception('View: ' . $this->_viewPath . ' não encontrada');
        }
    }

    /**
     *
     * @param <bool> $render
     */
    public function renderLayout( $render = false )
    {
        $this->_renderLayout = $render;
    }

    /**
     * 
     */
    public function render( $return = false )
    {
        $this->_setViewPath();

        if ( $this->_renderLayout ) {

            // renderiza a view para colocar no layout
            ob_start();
            include $this->_viewPath;
            $this->content = ob_get_contents();
            ob_end_clean();

            // Renderiza o layout
            ob_start();
            require_once $this->_layoutFile;
            $content = ob_get_contents();
            ob_end_clean();

        } else {

            // Renderiza a view diretamente
            ob_start();
            include $this->_viewPath;
            $content = ob_get_contents();
            ob_end_clean();
        }

        if ( $return )
            return $content;
        else
            echo $content;
        
    }
    
    public function t( $termo, $id )
    {
	return ILO_Util_Translate::get( $termo, $id );
    }

}