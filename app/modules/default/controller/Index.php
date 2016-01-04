<?php

class Default_Controller_Index extends ILO_Controller_Padrao
{
    public function init()
    {
    }
    
    /**
     * 
     */
    public function dadosAction()
    {
	$sysUserVO = ILO_Auth_Acesso::getIdentity();
	$sysUserVO->setPassword( null );
	
	$this->view->dadosForm = $sysUserVO->toArray();
    }
    
    public function saveAction()
    {
	$sysUserBO = new Model_BO_SysUser();
	$sysUserBO->setData( $this->getParams() );

	$retorno = array();
	if ( $sysUserBO->save() ) {
	    
	    $sysUserVO = new Model_VO_SysUser();
	    $sysUserVO->setValues( $this->getParams() );
	    ILO_Auth_Acesso::setIdentity( $sysUserVO );
	    
	    $retorno['error'] = false;
	} else
	    $retorno['error'] = true;

	echo json_encode( $retorno );
	exit;
    }
}