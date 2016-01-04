<?php

class Model_BO_IadeService extends ILO_Model_BO

{

	public function save()

	{

		$iadeServiceDAO = new Model_DAO_IadeService();

		$iadeServiceVO = new Model_VO_IadeService();

		

$iadeServiceVO->setValues( $this->_data );

		

if ( null == $iadeServiceVO->getMUDAid() ) 

			return $iadeServiceDAO->insert( $iadeService);

		else

			return $iadeServiceDAO->update( $iadeService, array() );

	}

}