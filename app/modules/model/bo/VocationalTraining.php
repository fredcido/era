<?php

class Model_BO_VocationalTraining extends ILO_Model_BO

{

	public function save()

	{

		$vocationalTrainingDAO = new Model_DAO_VocationalTraining();

		$vocationalTrainingVO = new Model_VO_VocationalTraining();

		

$vocationalTrainingVO->setValues( $this->_data );

		

if ( null == $vocationalTrainingVO->getMUDAid() ) 

			return $vocationalTrainingDAO->insert( $vocationalTraining);

		else

			return $vocationalTrainingDAO->update( $vocationalTraining, array() );

	}

}