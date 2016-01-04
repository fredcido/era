<?php

class Model_VO_AddressGeneral extends ILO_Model_VO
{

    protected $_referenceMap = array(
	'fk_id_worker' => array(
	    'vo'		=> 'Model_VO_Worker',
	    'dao'		=> 'Model_DAO_Worker',
	    'localAttr'		=> 'fk_id_worker',
	    'remoteAttr'	=> 'id_worker'
	),
	'fk_id_student_class' => array(
	    'vo'		=> 'Model_VO_StudentClass',
	    'dao'		=> 'Model_DAO_StudentClass',
	    'localAttr'		=> 'fk_id_student_class',
	    'remoteAttr'	=> 'id_student_class'
	),
	'fk_id_add_country' => array(
	    'vo'		=> 'Model_VO_AddCountry',
	    'dao'		=> 'Model_DAO_AddCountry',
	    'localAttr'		=> 'fk_id_add_country',
	    'remoteAttr'	=> 'id_add_country'
	), 
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
	),
	'fk_id_client' => array(
	    'vo'		=> 'Model_VO_CliClient',
	    'dao'		=> 'Model_DAO_CliClient',
	    'localAttr'		=> 'fk_id_client',
	    'remoteAttr'	=> 'id_client'
	),
	'fk_id_enterprise' => array(
	    'vo'		=> 'Model_VO_Enterprise',
	    'dao'		=> 'Model_DAO_Enterprise',
	    'localAttr'		=> 'fk_id_enterprise',
	    'remoteAttr'	=> 'id_enterprise'
	)
    );
    
    protected $_id_address_general;
    protected $_fk_id_client;
    protected $_fk_id_enterprise;
    protected $_fk_id_worker;
    protected $_fk_id_student_class;
    protected $_fk_id_add_district;
    protected $_fk_id_add_subdistrict;
    protected $_fk_id_add_suku;
    protected $_fk_id_add_country;
    protected $_vilage;
    protected $_street;
    protected $_number;
    protected $_postal_code;
    protected $_description;
    protected $_type;

}