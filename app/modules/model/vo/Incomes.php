<?php

class Model_VO_Incomes extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_client' => array( 'vo' => 'Model_VO_CliClient', 'dao' => 'Model_DAO_CliClient', 'localAttr' => 'fk_id_client', 'remoteAttr' => 'id_client' ), 'fk_id_enterprise' => array( 'vo' => 'Model_VO_Enterprise', 'dao' => 'Model_DAO_Enterprise', 'localAttr' => 'fk_id_enterprise', 'remoteAttr' => 'id_enterprise' ));

		protected $_id_incomes;

		protected $_fk_id_client;

		protected $_fk_id_enterprise;

		protected $_montly_value;

		protected $_annual_value;

		protected $_income_date;

}