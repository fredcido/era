<?php

class Model_VO_PreviousContract extends ILO_Model_VO
{
    protected $_referenceMap = array(
	'fk_id_enterprise' => array(
	    'vo'	    => 'Model_VO_Enterprise', 
	    'dao'	    => 'Model_DAO_Enterprise', 
	    'localAttr'	    => 'fk_id_enterprise', 
	    'remoteAttr'    => 'id_enterprise'
	)
    );
    
    protected $_id_previous_contract;
    protected $_fk_id_enterprise;
    protected $_contract_type;
    protected $_total_contract;
    protected $_contract_client;
    protected $_start_date;
    protected $_finish_date;
}