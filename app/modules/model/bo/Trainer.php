<?php

class Model_BO_Trainer extends ILO_Model_BO

{

	public function save()

	{

		$trainerDAO = new Model_DAO_Trainer();

		$trainerVO = new Model_VO_Trainer();

		

$trainerVO->setValues( $this->_data );

		

if ( null == $trainerVO->getMUDAid() ) 

			return $trainerDAO->insert( $trainer);

		else

			return $trainerDAO->update( $trainer, array() );

	}

}