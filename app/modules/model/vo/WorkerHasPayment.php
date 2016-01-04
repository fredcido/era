<?php

class Model_VO_WorkerHasPayment extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_worker' => array( 'vo' => 'Model_VO_Worker', 'dao' => 'Model_DAO_Worker', 'localAttr' => 'fk_id_worker', 'remoteAttr' => 'id_worker' ), 'fk_id_worker_payment' => array( 'vo' => 'Model_VO_WorkerPayment', 'dao' => 'Model_DAO_WorkerPayment', 'localAttr' => 'fk_id_worker_payment', 'remoteAttr' => 'id_worker_payment' ));

		protected $_id_relationship;

		protected $_fk_id_worker;

		protected $_fk_id_worker_payment;

}