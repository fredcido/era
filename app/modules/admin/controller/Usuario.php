<?php

class Admin_Controller_Usuario extends ILO_Controller_Padrao
{
    /**
     *
     * @var array
     */
    protected $_accessMapping = array(
	'salvar'    =>	array(
	    'cadastro',
	    'save',
	    'editar',
	    'verificalogin'
	),
	'consultar' =>	array(
	    'index'
	)
    );
    
    public function init()
    {
    }
    
    /**
     * 
     */
    public function indexAction()
    {
	$sysUserDAO = new Model_DAO_SysUser();
	$usuarios = $sysUserDAO->fetchAll( array( 'name' ) );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $usuarios ) ) {

            foreach ( $usuarios as $key => $usuario ) {
                
		$status = $usuario->getActive() ? 'Ativo' : 'Inativo';
		
                $dataJson['rows'][] = array(
                   'id'     => $usuario->getIdSysuser(),
                    'data'  => array(
                        ++$key,
                        $usuario->getName(),
                        $usuario->getNickName(),
                        $status
                    )
                );
            }
        }
	
	$this->view->data = json_encode( $dataJson );
    }
    
    
    public function saveAction()
    {
	$sysUserBO = new Model_BO_SysUser();
	$sysUserBO->setData( $this->getParams() );

	$retorno = array();
	if ( $sysUserBO->save() )
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
	
	$sysUserDAO = new Model_DAO_SysUser();
	$sysUserVO = $sysUserDAO->fetchRow( array( 'id_sysuser' => $id ) );
	
	$sysUserVO->setPassword( null );
	
	$this->view->dadosForm = $sysUserVO->toArray();
	
	$this->view->renderNewView( 'cadastro' );
    }
    
    public function verificaloginAction()
    {
	$id = $this->getParam( 'id' );
	$login = $this->getParam( 'login' );
	
	$where = array( 'nick_name' => $login );
	if ( !empty( $id ) )
	    $where['id'] = array( '<>', $id );
	
	$sysUserDAO = new Model_DAO_SysUser();
	$sysUserVO = $sysUserDAO->fetchRow( $where );
	
	echo json_encode( array( 'existe' => !empty( $sysUserVO ) ) );
	exit;
    }
}