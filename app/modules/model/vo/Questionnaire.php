<?php


class Model_VO_Questionnaire extends ILO_Model_VO
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
	'fk_id_suku' => array(
	    'vo'		=> 'Model_VO_AddSuku',
	    'dao'		=> 'Model_DAO_AddSuku',
	    'localAttr'		=> 'fk_id_suku',
	    'remoteAttr'	=> 'id_suku'
	),
	'fk_id_questionnaire_config' => array(
	    'vo'		=> 'Model_VO_QuestionnaireConfig',
	    'dao'		=> 'Model_DAO_QuestionnaireConfig',
	    'localAttr'		=> 'fk_id_questionnaire_config',
	    'remoteAttr'	=> 'id_questionnaire_config'
	)
    );
    
    protected $_id_questionnaire;
    protected $_fk_id_questionnaire_config;
    protected $_fk_id_add_district;
    protected $_fk_id_add_subdistrict;
    protected $_fk_id_suku;
    protected $_identifier;
    protected $_road_location;
    protected $_code;
    protected $_date_registration;
    
}