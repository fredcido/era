<?php

class Model_VO_CliClient extends ILO_Model_VO
{
    protected $_referenceMap = array(
	'fk_birth_place' => array(
	    'vo'	    => 'Model_VO_AddSubdistrict',
	    'dao'	    => 'Model_DAO_AddSubdistrict',
	    'localAttr'	    => 'fk_birth_place',
	    'remoteAttr'    => 'id_add_subdistrict'
	),
	'fk_id_add_district' => array(
	    'vo'	    => 'Model_VO_AddDistrict',
	    'dao'	    => 'Model_DAO_AddDistrict',
	    'localAttr'	    => 'fk_id_add_district',
	    'remoteAttr'    => 'id_add_district'
	),
	'fk_max_school_level' => array(
	    'vo'	    => 'Model_VO_FormalSchoolLevel',
	    'dao'	    => 'Model_DAO_FormalSchoolLevel',
	    'localAttr'	    => 'fk_max_school_level',
	    'remoteAttr'    => 'id_school_level'
	)
    );
    
    protected $_id_client;
    protected $_fk_id_add_district;
    protected $_date_registration;
    protected $_date_birth;
    protected $_num_district;
    protected $_num_year;
    protected $_num_sequence;
    protected $_first_name;
    protected $_last_name;
    protected $_fk_birth_place;
    protected $_gender;
    protected $_civil_status;
    protected $_cell_phone;
    protected $_phone;
    protected $_email;
    protected $_have_job;
    protected $_fk_max_school_level;
    protected $_occupation;
    protected $_active;
    
    public function getNumeroCliente()
    {
	$codProject = array(
	    $this->getNumDistrict(),
	    $this->getNumYear(),
	    $this->getNumSequence()
	);

	return implode( '-', $codProject );
    }

}