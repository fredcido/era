<?php

class Model_VO_ClientKnowEra extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_about_era' => array( 'vo' => 'Model_VO_AboutEra', 'dao' => 'Model_DAO_AboutEra', 'localAttr' => 'fk_id_about_era', 'remoteAttr' => 'id_about_era' ), 'fk_id_client' => array( 'vo' => 'Model_VO_CliClient', 'dao' => 'Model_DAO_CliClient', 'localAttr' => 'fk_id_client', 'remoteAttr' => 'id_client' ));

		protected $_id_relationship;

		protected $_fk_id_client;

		protected $_fk_id_about_era;

}