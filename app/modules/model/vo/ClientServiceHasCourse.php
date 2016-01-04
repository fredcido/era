<?php

class Model_VO_ClientServiceHasCourse extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_course' => array( 'vo' => 'Model_VO_Course', 'dao' => 'Model_DAO_Course', 'localAttr' => 'fk_id_course', 'remoteAttr' => 'id_course' ));

		protected $_id_relationship;

		protected $_fk_id_client_has_service;

		protected $_fk_id_course;

}