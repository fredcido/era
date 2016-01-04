<?php

class Model_BO_BusinessInputs extends ILO_Model_BO

{

	public function save()

	{

		$businessInputsDAO = new Model_DAO_BusinessInputs();

		$businessInputsVO = new Model_VO_BusinessInputs();

		

$businessInputsVO->setValues( $this->_data );

		

if ( null == $businessInputsVO->getMUDAid() ) 

			return $businessInputsDAO->insert( $businessInputs);

		else

			return $businessInputsDAO->update( $businessInputs, array() );

	}

}