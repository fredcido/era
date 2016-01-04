<?php

class Model_BO_ClientHistory extends ILO_Model_BO

{

	public function save()

	{

		$clientHistoryDAO = new Model_DAO_ClientHistory();

		$clientHistoryVO = new Model_VO_ClientHistory();

		

$clientHistoryVO->setValues( $this->_data );

		

if ( null == $clientHistoryVO->getMUDAid() ) 

			return $clientHistoryDAO->insert( $clientHistory);

		else

			return $clientHistoryDAO->update( $clientHistory, array() );

	}

}