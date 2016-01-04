<?php

class Model_VO_ContractHasLocation extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_add_subdistrict' => array( 'vo' => 'Model_VO_AddSubdistrict', 'dao' => 'Model_DAO_AddSubdistrict', 'localAttr' => 'fk_id_add_subdistrict', 'remoteAttr' => 'id_add_subdistrict' ), 'fk_id_add_suku' => array( 'vo' => 'Model_VO_AddSuku', 'dao' => 'Model_DAO_AddSuku', 'localAttr' => 'fk_id_add_suku', 'remoteAttr' => 'id_suku' ), 'fk_id_contract' => array( 'vo' => 'Model_VO_Contract', 'dao' => 'Model_DAO_Contract', 'localAttr' => 'fk_id_contract', 'remoteAttr' => 'id_contract' ));

		protected $_id_relationship;

		protected $_fk_id_contract;

		protected $_fk_id_add_subdistrict;

		protected $_fk_id_add_suku;

}