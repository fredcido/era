<?php

class Model_VO_ProfessionalExperience extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_client' => array( 'vo' => 'Model_VO_CliClient', 'dao' => 'Model_DAO_CliClient', 'localAttr' => 'fk_id_client', 'remoteAttr' => 'id_client' ));

		protected $_id_professional_experience;

		protected $_fk_id_client;

		protected $_start_date;

		protected $_finish_date;

		protected $_position;

		protected $_enterprise_name;

		protected $_job_description;

}