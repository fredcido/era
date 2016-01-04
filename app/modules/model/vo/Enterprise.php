<?php

class Model_VO_Enterprise extends ILO_Model_VO
{

    protected $_referenceMap = array(
	'fk_id_add_district' => array(
	    'vo' => 'Model_VO_AddDistrict', 
	    'dao' => 'Model_DAO_AddDistrict', 
	    'localAttr' => 'fk_id_add_district', 
	    'remoteAttr' => 'id_add_district'
	    )
    );
    
    protected $_id_enterprise;
    protected $_fk_id_add_district;
    protected $_num_district;
    protected $_num_year;
    protected $_num_sequence;
    protected $_official_registration;
    protected $_enterprise_name;
    protected $_start_year;
    protected $_number_mtci;
    protected $_number_mj;
    protected $_date_mcti;
    protected $_date_mj;
    protected $_staff_man;
    protected $_staff_woman;
    protected $_staff_total;
    protected $_owner_name;
    protected $_owner_gender;
    protected $_other_contact;
    protected $_cell_phone1;
    protected $_cell_phone2;
    protected $_main_phone;
    protected $_fax_phone;
    protected $_email;
    protected $_website;
    protected $_desctiption;
    protected $_active;
    protected $_association;
    protected $_member_ccitl;
    protected $_size_business;
    protected $_business_structure;
    protected $_district_operation;
    protected $_iade_client;
    protected $_date_registration;
    protected $_last_update;
    protected $_num_ent;
    protected $_enterprise_score;

    public function getNumeroEmpresa()
    {
	$codProject = array(
	    $this->getNumEnt(),
	    $this->getNumDistrict(),
	    $this->getNumYear(),
	    $this->getNumSequence()
	);

	return implode( '-', $codProject );
    }

}