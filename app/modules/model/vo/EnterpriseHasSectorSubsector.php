<?php

class Model_VO_EnterpriseHasSectorSubsector extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_enterprise' => array( 'vo' => 'Model_VO_Enterprise', 'dao' => 'Model_DAO_Enterprise', 'localAttr' => 'fk_id_enterprise', 'remoteAttr' => 'id_enterprise' ), 'fk_id_sector' => array( 'vo' => 'Model_VO_EnterpriseSector', 'dao' => 'Model_DAO_EnterpriseSector', 'localAttr' => 'fk_id_sector', 'remoteAttr' => 'id_sector' ));

		protected $_id_relationship;

		protected $_fk_id_enterprise;

		protected $_fk_id_sector;

		protected $_fk_id_subsector;

}