<?php

class Model_VO_IadeService extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_type_service' => array( 'vo' => 'Model_VO_TypeService', 'dao' => 'Model_DAO_TypeService', 'localAttr' => 'fk_id_type_service', 'remoteAttr' => 'id_type_service' ));

		protected $_id_iade_service;

		protected $_fk_id_type_service;

		protected $_iade_sevice;

		protected $_description;

}