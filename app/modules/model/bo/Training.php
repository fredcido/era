<?php

class Model_BO_Training extends ILO_Model_BO

{

	public function save()

	{

		$trainingDAO = new Model_DAO_Training();

		$trainingVO = new Model_VO_Training();

		

$trainingVO->setValues( $this->_data );

		

if ( null == $trainingVO->getMUDAid() ) 

			return $trainingDAO->insert( $training);

		else

			return $trainingDAO->update( $training, array() );

	}

}