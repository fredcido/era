<?php
/**
 *
 */
abstract class ILO_Controller_Padrao
{
    /**
     *
     * @var <Lirary_View_Render>
     */
    protected $view;

    /**
     *
     * @var <bool>
     */
    protected $_renderView = true;

    /**
     *
     * @var <ILO_Helper_Proxy>
     */
    protected $_helper;
    
    /**
     *
     * @var array
     */
    protected $_accessMapping = array(
	'salvar'    =>	array(
	    'cadastro',
	    'save',
	    'editar'
	),
	'consultar' =>	array(
	    'index'
	)
    );

    /**
     * 
     */
    public function createView()
    {
        $this->_helper = new ILO_Helper_Proxy();
        $this->view = new ILO_View_Render( $this->_helper );
    }
    
    /**
     *
     * @return array
     */
    public function getAccessMapping()
    {
	return $this->_accessMapping;
    }
    
    /**
     *
     * @param array $accessMapping 
     */
    public function setAccessMapping( array $accessMapping )
    {
	$this->_accessMapping = $accessMapping;
    }

    /**
     *
     * @param <bool> $flag
     */
    public function setViewNoRender( $flag = false )
    {
        $this->_renderView = $flag;
    }

    /**
     * 
     */
    public function render()
    {
        if ( $this->_renderView )
            $this->view->render();
    }

    /**
     *
     * @param <string> $id
     * @param <mixed> $noFind
     * @return <mixed>
     */
    public function getParam( $id, $noFind = null )
    {
        $params = ILO_Router_Dispatcher::getParams();
        return array_key_exists( $id, $params) ? $params[$id] : $noFind;
    }

    /**
     *
     * @return <mixed>
     */
    public function getParams()
    {
        return ILO_Router_Dispatcher::getParams();
    }

    /**
     *
     * @param <string> $url
     */
    public function redirect( $url )
    {
        header('Location: ' . BASE . $url);
        exit;
    }

    public function indexAction(){}

    public function cadastroAction(){}
}