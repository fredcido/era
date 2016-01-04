<?php

class Model_VO_Snapshot extends ILO_Model_VO
{

    protected $_referenceMap = array(
	'fk_id_add_district' => array(
	    'vo'		=> 'Model_VO_AddDistrict',
	    'dao'		=> 'Model_DAO_AddDistrict',
	    'localAttr'		=> 'fk_id_add_district',
	    'remoteAttr'	=> 'id_add_district'
	),
	'fk_id_add_subdistrict' => array(
	    'vo'		=> 'Model_VO_AddSubdistrict',
	    'dao'		=> 'Model_DAO_AddSubdistrict',
	    'localAttr'		=> 'fk_id_add_subdistrict',
	    'remoteAttr'	=> 'id_add_subdistrict'
	),
	'fk_id_add_suku' => array(
	    'vo'		=> 'Model_VO_AddSuku',
	    'dao'		=> 'Model_DAO_AddSuku',
	    'localAttr'		=> 'fk_id_add_suku',
	    'remoteAttr'	=> 'id_suku'
	)
    );
    
    protected $_id_snapshot;
    protected $_fk_id_add_district;
    protected $_fk_id_add_subdistrict;
    protected $_fk_id_add_suku;
    protected $_road_location;
    protected $_code;
    protected $_date_registration;
    protected $_reference;
    protected $_health_comment;
    protected $_education_comment;
    protected $_market_comment;
    protected $_date_snapshot;
}