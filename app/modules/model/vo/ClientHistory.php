<?php

class Model_VO_ClientHistory extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_client' => array( 'vo' => 'Model_VO_CliClient', 'dao' => 'Model_DAO_CliClient', 'localAttr' => 'fk_id_client', 'remoteAttr' => 'id_client' ));

		protected $_id_client_history;

		protected $_fk_id_client;

		protected $_date_time;

		protected $_action;

}