<?php

class Model_BO_AreaTraining extends ILO_Model_BO

{

	public function save()

	{

		$areaTrainingDAO = new Model_DAO_AreaTraining();

		$areaTrainingVO = new Model_VO_AreaTraining();

		

$areaTrainingVO->setValues( $this->_data );

		

if ( null == $areaTrainingVO->getMUDAid() ) 

			return $areaTrainingDAO->insert( $areaTraining);

		else

			return $areaTrainingDAO->update( $areaTraining, array() );

	}

}