<?php

class Model_BO_WorkerPayment extends ILO_Model_BO

{

	public function save()

	{

		$workerPaymentDAO = new Model_DAO_WorkerPayment();

		$workerPaymentVO = new Model_VO_WorkerPayment();

		

$workerPaymentVO->setValues( $this->_data );

		

if ( null == $workerPaymentVO->getMUDAid() ) 

			return $workerPaymentDAO->insert( $workerPayment);

		else

			return $workerPaymentDAO->update( $workerPayment, array() );

	}

}