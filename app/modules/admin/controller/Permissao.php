<?php

class Admin_Controller_Permissao extends ILO_Controller_Padrao
{
    /**
     *
     * @var araray
     */
    protected $_accessMapping = array(
	'salvar'    =>	array(
	    'cadastro',
	    'save',
	    'editar'
	),
	'consultar' =>	array(
	    'index',
	    'busca'
	)
    );
    
    /**
     * 
     */
    public function init()
    {
    }
    
    /**
     * 
     */
    public function indexAction()
    {
	$sysUserDAO = new Model_DAO_SysUser();
	$sysModuleDAO = new Model_DAO_SysModule();
	$sysFormDAO = new Model_DAO_SysForm();
	$sysFormHasOperation = new Model_DAO_SysFormHasOperation();
	
	$this->view->usuarios = $sysUserDAO->fetchAll( array( 'name' ) );
	
	$modulos = $sysModuleDAO->fetchAll( array( 'module' ) );
	
	$telas = array();
	foreach ( $modulos as $modulo ) {
	    
	    // Busca formularios do modulo
	    $where = array( 'fk_id_sysmodule' => $modulo->getIdSysmodule() );
	    $formularios = $sysFormDAO->fetchAll( array( 'form_name' ), $where );
	    
	    if ( empty( $formularios ) )
		continue;
	    
	    $formulariosModulo = array();
	    foreach ( $formularios as $formulario ) {
		
		// Busca operacoes do form
		$where = array( 'fk_id_sysform' => $formulario->getIdSysform() );
		$operacoes = $sysFormHasOperation->fetchAll( array(), $where );
		
		if ( empty( $operacoes ) ) 
		    continue;
		
		$formulariosModulo[] = array(
		    'form'	=>  $formulario,
		    'operacoes'	=>  $operacoes
		);
	    }
	    
	    if ( empty( $formulariosModulo ) )
		continue;
	    
	    $telas[] = array(
		'modulo' => $modulo,
		'telas'  => $formulariosModulo
	    );
	}
	
	$this->view->permissoes = $telas;
    }
    
    
    public function saveAction()
    {
	$sysUserHasForm = new Model_BO_SysUserHasForm();
	$sysUserHasForm->setData( $this->getParams() );

	if ( $sysUserHasForm->save() )
	    $retorno['error'] = false;
	else
	    $retorno['error'] = true;

	echo json_encode( $retorno );
	exit;
    }
    
    public function buscaAction()
    {
	$id = $this->getParam( 'id' );
	
	$sysUserHasForm = new Model_DAO_SysUserHasForm();
	$sysUserHasFormVO = $sysUserHasForm->fetchAll( array(), array( 'fk_id_sysuser' => $id ) );
	
	$permissoes = array();
	foreach ( $sysUserHasFormVO as $permissao ) {
	    
	    $permissoes[] = array(
		'idForm'    => $permissao->getFkIdSysform()->getIdSysform(),
		'idOper'    => $permissao->getFkIdSysoperation()->getIdSysoperation(),
	    );
	}
	
	echo json_encode( $permissoes );
	exit;
    }
}