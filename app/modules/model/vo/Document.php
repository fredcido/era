<?php

class Model_VO_Document extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_add_district' => array( 'vo' => 'Model_VO_AddDistrict', 'dao' => 'Model_DAO_AddDistrict', 'localAttr' => 'fk_id_add_district', 'remoteAttr' => 'id_add_district' ), 'fk_id_type_document' => array( 'vo' => 'Model_VO_TypeDocument', 'dao' => 'Model_DAO_TypeDocument', 'localAttr' => 'fk_id_type_document', 'remoteAttr' => 'id_type_document' ));

		protected $_id_document;

		protected $_fk_id_type_document;

		protected $_number_doc;

		protected $_fk_id_add_district;

		protected $_issue_date;

}