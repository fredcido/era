<?php

abstract class ILO_Model_BO
{
    const SALVAR = 1;
    
    const CONSULTAR = 1;
    
    protected $_valid = true;

    protected $_error = null;

    protected $_data;

    public function setData( $data )
    {
        $data = $this->cleanData( $data );
        $this->_data = $data;
	
	return $this;
    }

    public function getData()
    {
        $this->_data;
    }

    public function cleanData( $data )
    {
        foreach ( $data as $key => $value ) {
            if ( $value === '' )
                $data[$key] = null;
            else
                $data[$key] = $value;
        }


        return $data;
    }

    public function isValid()
    {
        return $this->_valid;
    }

    public function setError( $error )
    {
        $this->_error = $error;
    }

    public function getError()
    {
        return $this->_error;
    }
    
    /**
     *
     * @param string $description
     * @param int $operation 
     */
    public function audit( $description, $operation )
    {
	$sysAuditDAO = new Model_DAO_SysAudit();
	$sysAuditVO = new Model_VO_SysAudit();
	
	
	// Recupera modulo e form id de acordo com o path atual ( Salvos na sessao no login )
	$sysUserHasForm = $this->_getModuleFormAudit();
	
	// se nao foi possivel recuperar o form e o modulo
	if ( empty( $sysUserHasForm ) )
	    return true;
	
	// Define id do form e do modulo
	$sysAuditVO->setFkIdSysmodule( $sysUserHasForm->getFkIdSysform()->getIdSysmodule()->getIdSysmodule() );
	$sysAuditVO->setFkIdSysform( $sysUserHasForm->getFkIdSysform()->getIdSysform() );
	
	// pega usuario logado
	$sysUserVO = ILO_Auth_Acesso::getIdentity();
	
	// Define dados padroes da auditoria
	$sysAuditVO->setDescription( $description );
	$sysAuditVO->setIp( $_SERVER['REMOTE_ADDR'] );
	$sysAuditVO->setDateTime( date( 'Y-m-d H:i:s' ) );
	$sysAuditVO->setFkIdSysuser( $sysUserVO->getIdSysuser() );
	$sysAuditVO->setFkIdSysoperation( $operation );
	
	// Insere auditoria
	$sysAuditDAO->insert( $sysAuditVO );
    }
    
    /**
     *
     * @return mixed
     */
    protected function _getModuleFormAudit()
    {
	$module = ILO_Router_Dispatcher::getModule();
	$controller = ILO_Router_Dispatcher::getController();
	$path = '/' . $module . '/' . $controller . '/';
	
	// Pega caminhos da sessao
	$paths = ILO_Util_Session::get( 'paths' );
	if ( empty( $paths ) )
	    return null;
	
	return empty( $paths[$path] ) ? null : $paths[$path];
    }
    
    public function toCamelCase( $string )
    {
	$string = preg_replace('/^_/', '', $string );
        $pieces = explode('_', $string);
        
        $string = '';
        foreach ( $pieces as $piece ) {
            $string .= ucfirst( $piece );
        }

        return $string;
    }
}