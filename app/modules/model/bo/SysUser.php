<?php

class Model_BO_SysUser extends ILO_Model_BO
{
    /**
     *
     * @var string 
     */
    protected $_auditDescription = 'REJISTU/ATUALIZA USUARIO: %s';
    
    /**
     *
     * @return mixed
     */
    public function save()
    {
	$sysUserDAO = new Model_DAO_SysUser();
	$sysUserVO = new Model_VO_SysUser();

	$sysUserDAO->beginTransaction();
	try {
	    
	    if ( !empty( $this->_data['password'] ) )
		$this->_data['password'] = md5( $this->_data['password'] );
	    else
		unset( $this->_data['password'] );

	    $sysUserVO->setValues( $this->_data );

	    if ( null == $sysUserVO->getIdSysuser() ) {
		
		$sysUserId = $sysUserDAO->insert( $sysUserVO );

		// Auditoria
		$this->_auditUser( $sysUserId );
	    } else {
		
		$sysUserDAO->update( $sysUserVO, array( 'id_sysuser' => $sysUserVO->getIdSysuser() ) );

		// Auditoria
		$this->_auditUser( $sysUserVO->getIdSysuser() );

		$sysUserId = $sysUserVO->getIdSysuser();
	    }
	    
	    $sysUserDAO->commit();
	    return $sysUserId;
	    
	} catch ( Exception $e ) {
	    
	    $sysUserDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @param int $sysUserId 
     */
    protected function _auditUser( $sysUserId )
    {
	$description = sprintf( $this->_auditDescription, $sysUserId );
	$this->audit( $description, self::SALVAR );
    }
    
    /**
     *
     * @return bool 
     */
    public function autentica()
    {
	$sysUserDAO = new Model_DAO_SysUser();
	
	$where = array(
	    'nick_name'	=> $this->_data['login'],
	    'password'	=> md5( $this->_data['senha'] ),
	    'active'	=> 1
	);
	
	$sysUserVO = $sysUserDAO->fetchRow( $where );
		
	if ( empty( $sysUserVO ) ) {
	    
	    ILO_Util_Message::setMessage( 'Usuário ou senha inválidos.' );
	    return false;
	    
	} else {
	    
	    $sysUserHasForm = new Model_DAO_SysUserHasForm();
	    $sysUserHasFormVO = $sysUserHasForm->fetchAll( array(), array( 'fk_id_sysuser' => $sysUserVO->getIdSysuser() ) );
	    	    
	    $permissoes = array();
	    $paths = array();
	    foreach ( $sysUserHasFormVO as $sysUserForm ) {
		
		$modulo = $sysUserForm->getFkIdSysform()->getIdSysmodule()->getPath();
		$controller = $sysUserForm->getFkIdSysform()->getFileSystem();
		
		$role = '/' . $modulo . '/' . $controller . '/';
		
		if ( !array_key_exists( $role, $paths ) )
		    $paths[$role] = $sysUserForm;
		
		$permissoes[$role][] = ILO_Util_Geral::toAscii( $sysUserForm->getFkIdSysoperation()->getOperation() );
	    }
	     
	    // Define as permissões do usuário
	    ILO_Auth_Permissao::reset();
	    ILO_Auth_Permissao::addRoles( $permissoes );
	    
	    // Define o usuário logado
	    ILO_Auth_Acesso::setIdentity( $sysUserVO );
	    	    
	    // Salva caminhos na sessao
	    ILO_Util_Session::set( 'paths', $paths );
	    
	    return true;
	}
    }

}