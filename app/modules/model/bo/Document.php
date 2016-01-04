<?php

class Model_BO_Document extends ILO_Model_BO

{

	public function save()

	{

		$documentDAO = new Model_DAO_Document();

		$documentVO = new Model_VO_Document();

		

$documentVO->setValues( $this->_data );

		

if ( null == $documentVO->getMUDAid() ) 

			return $documentDAO->insert( $document);

		else

			return $documentDAO->update( $document, array() );

	}

}