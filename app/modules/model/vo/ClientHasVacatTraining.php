<?php

class Model_VO_ClientHasVacatTraining extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_client' => array( 'vo' => 'Model_VO_CliClient', 'dao' => 'Model_DAO_CliClient', 'localAttr' => 'fk_id_client', 'remoteAttr' => 'id_client' ), 'fk_id_vocational_training' => array( 'vo' => 'Model_VO_VocationalTraining', 'dao' => 'Model_DAO_VocationalTraining', 'localAttr' => 'fk_id_vocational_training', 'remoteAttr' => 'id_vocational_training' ));

		protected $_id_relationship;

		protected $_fk_id_client;

		protected $_fk_id_vocational_training;

		protected $_year_completed;

}