<?php

class Relatorio_Controller_Empresa extends ILO_Controller_Padrao
{
    /**
     *
     * @var Model_BO_TrainingReport
     */
    protected $_bo;
    
    /**
     * 
     */
    public function init()
    {
	$this->view->relatorio_mode = true;
	$this->_bo = new Model_BO_EnterpriseReport();
    }
    
    /**
     * 
     */
    public function pordistritoAction()
    {
    }
    
    /**
     * 
     */
    public function relatoriopordistritoAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->porDistrito();
    }
    
    /**
     * 
     */
    public function volumenegocioAction()
    {
	// Lista distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->districts = $districtDAO->fetchAll( 'district' );
    }
    
    /**
     * 
     */
    public function relatoriovolumenegocioAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->volumeNegocio();
    }
    
    /**
     * 
     */
    public function generodiretorAction()
    {
	// Lista distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->districts = $districtDAO->fetchAll( 'district' );
    }
    
    /**
     * 
     */
    public function relatoriogenerodiretorAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->generoDiretor();
    }
    
    /**
     * 
     */
    public function setorAction()
    {
	// Lista distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->districts = $districtDAO->fetchAll( 'district' );
    }
    
    /**
     * 
     */
    public function relatoriosetorAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->setor();
    }
    
    /**
     * 
     */
    public function listaempresaAction()
    {
	// Lista distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->districts = $districtDAO->fetchAll( 'district' );
    }
    
    /**
     * 
     */
    public function relatoriolistaempresaAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->listaEmpresa();
    }
}