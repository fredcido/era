<?php

class Model_BO_ClassTest extends ILO_Model_BO

{

	public function save()

	{

		$classTestDAO = new Model_DAO_ClassTest();

		$classTestVO = new Model_VO_ClassTest();

		

$classTestVO->setValues( $this->_data );

		

if ( null == $classTestVO->getMUDAid() ) 

			return $classTestDAO->insert( $classTest);

		else

			return $classTestDAO->update( $classTest, array() );

	}

}