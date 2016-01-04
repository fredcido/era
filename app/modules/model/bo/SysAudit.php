<?php

class Model_BO_SysAudit extends ILO_Model_BO

{

	public function save()

	{

		$sysAuditDAO = new Model_DAO_SysAudit();

		$sysAuditVO = new Model_VO_SysAudit();

		

$sysAuditVO->setValues( $this->_data );

		

if ( null == $sysAuditVO->getMUDAid() ) 

			return $sysAuditDAO->insert( $sysAudit);

		else

			return $sysAuditDAO->update( $sysAudit, array() );

	}

}