<?php

class Model_BO_EnterpriseSector extends ILO_Model_BO

{

	public function save()

	{

		$enterpriseSectorDAO = new Model_DAO_EnterpriseSector();

		$enterpriseSectorVO = new Model_VO_EnterpriseSector();

		

$enterpriseSectorVO->setValues( $this->_data );

		

if ( null == $enterpriseSectorVO->getMUDAid() ) 

			return $enterpriseSectorDAO->insert( $enterpriseSector);

		else

			return $enterpriseSectorDAO->update( $enterpriseSector, array() );

	}

}