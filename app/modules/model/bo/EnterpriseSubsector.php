<?php

class Model_BO_EnterpriseSubsector extends ILO_Model_BO

{

	public function save()

	{

		$enterpriseSubsectorDAO = new Model_DAO_EnterpriseSubsector();

		$enterpriseSubsectorVO = new Model_VO_EnterpriseSubsector();

		

$enterpriseSubsectorVO->setValues( $this->_data );

		

if ( null == $enterpriseSubsectorVO->getMUDAid() ) 

			return $enterpriseSubsectorDAO->insert( $enterpriseSubsector);

		else

			return $enterpriseSubsectorDAO->update( $enterpriseSubsector, array() );

	}

}