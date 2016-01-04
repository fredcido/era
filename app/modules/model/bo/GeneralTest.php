<?php

class Model_BO_GeneralTest extends ILO_Model_BO

{

	public function save()

	{

		$generalTestDAO = new Model_DAO_GeneralTest();

		$generalTestVO = new Model_VO_GeneralTest();

		

$generalTestVO->setValues( $this->_data );

		

if ( null == $generalTestVO->getMUDAid() ) 

			return $generalTestDAO->insert( $generalTest);

		else

			return $generalTestDAO->update( $generalTest, array() );

	}

}