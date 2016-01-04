<?php

class Model_VO_Worker extends ILO_Model_VO
{
    protected $_referenceMap = array(
	'fk_id_add_subdistrict' => array(
	    'vo'	    => 'Model_VO_AddSubdistrict',
	    'dao'	    => 'Model_DAO_AddSubdistrict',
	    'localAttr'	    => 'fk_id_add_subdistrict',
	    'remoteAttr'    => 'id_add_subdistrict'
	),
	'fk_id_industry_sector' => array(
	    'vo'	    => 'Model_VO_IndustrySector',
	    'dao'	    => 'Model_DAO_IndustrySector',
	    'localAttr'	    => 'fk_id_industry_sector',
	    'remoteAttr'    => 'id_industry_sector'
	),
	'fk_max_school_level' => array(
	    'vo'	    => 'Model_VO_FormalSchoolLevel',
	    'dao'	    => 'Model_DAO_FormalSchoolLevel',
	    'localAttr'	    => 'fk_max_school_level',
	    'remoteAttr'    => 'id_school_level'
	)
    );
    protected $_id_worker;
    protected $_num_birthplace;
    protected $_num_year;
    protected $_first_name;
    protected $_last_name;
    protected $_gender;
    protected $_civil_status;
    protected $_date_birth;
    protected $_fk_id_add_subdistrict;
    protected $_occupation;
    protected $_fk_max_school_level;
    protected $_field_supervisor;
    protected $_date_registration;
    protected $_status_worker;
    protected $_document_id;
    protected $_fk_id_industry_sector;
    protected $_vocational_training;
    
    /**
     *
     * @return string
     */
    public function getCodBeneficiario()
    {
	$codBeneficiario = array(
	    $this->getNumBirthplace(),
	    $this->getNumYear(),
	    $this->getIdWorker()
	);
	
	return implode( '-', $codBeneficiario );
    }

}