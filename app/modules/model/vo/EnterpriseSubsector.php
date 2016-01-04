<?php

class Model_VO_EnterpriseSubsector extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_sector' => array( 'vo' => 'Model_VO_EnterpriseSector', 'dao' => 'Model_DAO_EnterpriseSector', 'localAttr' => 'fk_id_sector', 'remoteAttr' => 'id_sector' ));

		protected $_id_subsector;

		protected $_fk_id_sector;

		protected $_code;

		protected $_name_subsector;

		protected $_description;

}