<?php

class Model_BO_IndustrySector extends ILO_Model_BO

{

	public function save()

	{

		$industrySectorDAO = new Model_DAO_IndustrySector();

		$industrySectorVO = new Model_VO_IndustrySector();

		

$industrySectorVO->setValues( $this->_data );

		

if ( null == $industrySectorVO->getMUDAid() ) 

			return $industrySectorDAO->insert( $industrySector);

		else

			return $industrySectorDAO->update( $industrySector, array() );

	}

}