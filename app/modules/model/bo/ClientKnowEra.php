<?php

class Model_BO_ClientKnowEra extends ILO_Model_BO

{

	public function save()

	{

		$clientKnowEraDAO = new Model_DAO_ClientKnowEra();

		$clientKnowEraVO = new Model_VO_ClientKnowEra();

		

$clientKnowEraVO->setValues( $this->_data );

		

if ( null == $clientKnowEraVO->getMUDAid() ) 

			return $clientKnowEraDAO->insert( $clientKnowEra);

		else

			return $clientKnowEraDAO->update( $clientKnowEra, array() );

	}

}