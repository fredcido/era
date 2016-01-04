<?php

class Model_VO_WorkerHasVocatTraining extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_vocational_training' => array( 'vo' => 'Model_VO_VocationalTraining', 'dao' => 'Model_DAO_VocationalTraining', 'localAttr' => 'fk_id_vocational_training', 'remoteAttr' => 'id_vocational_training' ), 'fk_id_worker' => array( 'vo' => 'Model_VO_Worker', 'dao' => 'Model_DAO_Worker', 'localAttr' => 'fk_id_worker', 'remoteAttr' => 'id_worker' ));

		protected $_id_relationship;

		protected $_fk_id_worker;

		protected $_fk_id_vocational_training;

		protected $_year_completed;

}