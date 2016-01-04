<?php

class Model_VO_AddSuku extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_add_district' => array( 'vo' => 'Model_VO_AddDistrict', 'dao' => 'Model_DAO_AddDistrict', 'localAttr' => 'fk_id_add_district', 'remoteAttr' => 'id_add_district' ), 'fk_id_add_subdistrict' => array( 'vo' => 'Model_VO_AddSubdistrict', 'dao' => 'Model_DAO_AddSubdistrict', 'localAttr' => 'fk_id_add_subdistrict', 'remoteAttr' => 'id_add_subdistrict' ));

		protected $_id_suku;

		protected $_fk_id_add_subdistrict;

		protected $_fk_id_add_district;

		protected $_suku;

		protected $_acronym;

}