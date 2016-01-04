<?php

class Model_VO_ClientHasService extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_business_inputs' => array( 'vo' => 'Model_VO_BusinessInputs', 'dao' => 'Model_DAO_BusinessInputs', 'localAttr' => 'fk_id_business_inputs', 'remoteAttr' => 'id_business_inputs' ), 'fk_id_client' => array( 'vo' => 'Model_VO_CliClient', 'dao' => 'Model_DAO_CliClient', 'localAttr' => 'fk_id_client', 'remoteAttr' => 'id_client' ), 'fk_id_type_service' => array( 'vo' => 'Model_VO_TypeService', 'dao' => 'Model_DAO_TypeService', 'localAttr' => 'fk_id_type_service', 'remoteAttr' => 'id_type_service' ));

		protected $_id_relationship;

		protected $_fk_id_client;

		protected $_fk_id_type_service;

		protected $_all_iade_service;

		protected $_fk_id_general_test;

		protected $_fk_id_business_inputs;

		protected $_visit_date;

		protected $_description;

		protected $_flag;

}