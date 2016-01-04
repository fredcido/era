<?php

class Model_BO_TypeDocument extends ILO_Model_BO

{

	public function save()

	{

		$typeDocumentDAO = new Model_DAO_TypeDocument();

		$typeDocumentVO = new Model_VO_TypeDocument();

		

$typeDocumentVO->setValues( $this->_data );

		

if ( null == $typeDocumentVO->getMUDAid() ) 

			return $typeDocumentDAO->insert( $typeDocument);

		else

			return $typeDocumentDAO->update( $typeDocument, array() );

	}

}