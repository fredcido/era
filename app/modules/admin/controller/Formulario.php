<?php

class Admin_Controller_Formulario extends ILO_Controller_Padrao
{
    public function init()
    {
    }
    
    /**
     * 
     */
    public function indexAction()
    {
	$sysFormDAO = new Model_DAO_SysForm();
	$formularios = $sysFormDAO->fetchAll( array( 'form_name' ) );
        
	$dataJson['rows'] = array();
        
        if ( !empty( $formularios ) ) {

            foreach ( $formularios as $key => $formulario ) {
                
                $dataJson['rows'][] = array(
                   'id'     => $formulario->getIdSysform(),
                    'data'  => array(
                        ++$key,
                        $formulario->getFormName(),
                        $formulario->getIdSysmodule()->getModule(),
                        $formulario->getFileSystem(),
                    )
                );
            }
        }
	
	$this->view->data = json_encode( $dataJson );
    }
    
    
    public function saveAction()
    {
	$sysFormBO = new Model_BO_SysForm();
	$sysFormBO->setData( $this->getParams() );

	if ( $sysFormBO->save() )
	    $retorno['error'] = false;
	else
	    $retorno['error'] = true;
	
	if ( empty( $retorn['error'] ) )
	    ILO_Util_Message::setMessage( ILO_Util_Translate::get( 'Operação realizada com sucesso', 46 ), 'confirm');

	echo json_encode( $retorno );
	exit;
    }
    
    public function cadastroAction()
    {
	$sysModuleDAO = new Model_DAO_SysModule();
	$this->view->modules = $sysModuleDAO->fetchAll( array( 'module' ) );
	
        $this->_getOperations();
    }
    
    /**
     * 
     */
    public function editarAction()
    {
	$id = $this->getParam( 'id' );
	
	$sysModuleDAO = new Model_DAO_SysModule();
	$this->view->modules = $sysModuleDAO->fetchAll( array( 'module' ) );
	
	$sysFormDAO = new Model_DAO_SysForm();
	$sysFormVO = $sysFormDAO->fetchRow( array( 'id_sysform' => $id ) );
        
        $formHasOperationDAO = new Model_DAO_SysFormHasOperation();
        $formHasOperation = $formHasOperationDAO->fetchAll( null , array( 'fk_id_sysform' => $id ) );
        
        $operations = array();
        if( !empty( $formHasOperation ) ){
            foreach( $formHasOperation as $operation ){

                $operations[] = $operation->getFkIdSysoperation()->getIdSysoperation();

            }
        }
	
        $data = $sysFormVO->toArray();
        $data['fk_id_sysoperation'] = $operations;
        
	$this->view->dadosForm = $data;
	
        $this->_getOperations();
        
	$this->view->renderNewView( 'cadastro' );
    }
    
    /**
     * 
     */
    protected function _getOperations()
    {
        
        $sysOperationDAO = new Model_DAO_SysOperation();
        $operations = $sysOperationDAO->fetchAll();
	
        return $this->view->operations = $operations;
        
    }
}