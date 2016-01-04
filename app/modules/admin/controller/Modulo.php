<?php

class Admin_Controller_Modulo extends ILO_Controller_Padrao
{
    public function init()
    {
    }
    
    /**
     * 
     */
    public function indexAction()
    {
	$sysModuleDAO = new Model_DAO_SysModule();
	$modulos = $sysModuleDAO->fetchAll( array( 'module' ) );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $modulos ) ) {

            foreach ( $modulos as $key => $modulo ) {
                
                $dataJson['rows'][] = array(
                   'id'     => $modulo->getIdSysmodule(),
                    'data'  => array(
                        ++$key,
                        $modulo->getModule()
                    )
                );
            }
        }
	
	$this->view->data = json_encode( $dataJson );
    }
    
    
    public function saveAction()
    {
	$sysModuleBO = new Model_BO_SysModule();
	$sysModuleBO->setData( $this->getParams() );

	if ( $sysModuleBO->save() )
	    $retorno['error'] = false;
	else
	    $retorno['error'] = true;
	
	if ( empty( $retorn['error'] ) )
	    ILO_Util_Message::setMessage( ILO_Util_Translate::get( 'Operação realizada com sucesso', 46 ), 'confirm');

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function editarAction()
    {
	$id = $this->getParam( 'id' );
	
	$sysModuleDAO = new Model_DAO_SysModule();
	$sysModuleVO = $sysModuleDAO->fetchRow( array( 'id_sysmodule' => $id ) );
	
	$this->view->dadosForm = $sysModuleVO->toArray();
	
	$this->view->renderNewView( 'cadastro' );
    }
}