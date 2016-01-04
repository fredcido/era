<?php

class Model_BO_SysOperation extends ILO_Model_BO

{

	public function save()

	{

		$sysOperationDAO = new Model_DAO_SysOperation();

		$sysOperationVO = new Model_VO_SysOperation();

		

$sysOperationVO->setValues( $this->_data );

		

if ( null == $sysOperationVO->getMUDAid() ) 

			return $sysOperationDAO->insert( $sysOperation);

		else

			return $sysOperationDAO->update( $sysOperation, array() );

	}

}