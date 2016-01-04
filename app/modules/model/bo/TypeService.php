<?php

class Model_BO_TypeService extends ILO_Model_BO

{

	public function save()

	{

		$typeServiceDAO = new Model_DAO_TypeService();

		$typeServiceVO = new Model_VO_TypeService();

		

$typeServiceVO->setValues( $this->_data );

		

if ( null == $typeServiceVO->getMUDAid() ) 

			return $typeServiceDAO->insert( $typeService);

		else

			return $typeServiceDAO->update( $typeService, array() );

	}

}