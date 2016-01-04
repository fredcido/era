<?php

class Default_Controller_Auth extends ILO_Controller_Padrao
{
    /**
     * 
     */
    public function init()
    {
	$this->view->renderLayout( false );
    }

    /**
     * 
     */
    public function loginAction()
    {
	$sysUserBO = new Model_BO_SysUser();
	$sysUserBO->setData( $this->getParams() );
	
	if ( !$sysUserBO->autentica() )
	    $this->redirect( '/auth/' );
	else
	    $this->redirect( '/index/' );
    }
    
    public function logoutAction()
    {
	ILO_Util_Session::clear();
	$this->redirect( '/auth/' );
    }
    
    public function translateAction()
    {
	$content = ILO_Util_Translate::getContents();
	
	header( 'Content-type: text/xml' );
	echo $content;
	exit;
    }
}