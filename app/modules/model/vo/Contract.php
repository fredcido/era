<?php

class Model_VO_Contract extends ILO_Model_VO
{

    protected $_referenceMap = array(
	'fk_id_add_district' => array(
	    'vo' => 'Model_VO_AddDistrict',
	    'dao' => 'Model_DAO_AddDistrict',
	    'localAttr' => 'fk_id_add_district',
	    'remoteAttr' => 'id_add_district'
	),
	'fk_id_enterprise' => array(
	    'vo'	    => 'Model_VO_Enterprise',
	    'dao'	    => 'Model_DAO_Enterprise',
	    'localAttr'	    => 'fk_id_enterprise',
	    'remoteAttr'    => 'id_enterprise'
	)
    );
    protected $_id_contract;
    protected $_fk_id_add_district;
    protected $_fk_id_enterprise;
    protected $_num_project;
    protected $_num_district;
    protected $_num_road;
    protected $_num_activity;
    protected $_num_year;
    protected $_num_sequence;
    protected $_total_contract;
    protected $_ilo_contract;
    protected $_contractor_name;
    protected $_activity;
    protected $_road_name;
    protected $_road_length;
    protected $_road_section;
    protected $_section_length;
    protected $_date_start_planned;
    protected $_date_start_real;
    protected $_date_finish_planned;
    protected $_date_finish_real;
    protected $_working_day_planned;
    protected $_working_day_real;
    protected $_labour_cost_planned;
    protected $_labour_cost_real;
    protected $_workers_planned;
    protected $_workers_real;
    protected $_total_cost_planned;
    protected $_total_cost_real;
    protected $_description;
    protected $_date_registration;
    protected $_bank_valid;
    protected $_nitl_valid;
    protected $_signature_date;
    protected $_batch;

    /**
     *
     * @return string
     */
    
    public function getProjectCode()
    {
	
        $codProject = array(
            $this->getNumProject(),
            $this->getNumDistrict(),
            $this->getNumActivity(),
            $this->getNumYear(),
            $this->getNumSequence()
        );
        
        return implode( '-', $codProject );
        
    }
}