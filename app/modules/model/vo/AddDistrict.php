<?php

class Model_VO_AddDistrict extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_add_country' => array( 'vo' => 'Model_VO_AddCountry', 'dao' => 'Model_DAO_AddCountry', 'localAttr' => 'fk_id_add_country', 'remoteAttr' => 'id_add_country' ));

		protected $_id_add_district;

		protected $_fk_id_add_country;

		protected $_district;

		protected $_acronym;

}