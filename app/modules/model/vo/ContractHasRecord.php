<?php

class Model_VO_ContractHasRecord extends ILO_Model_VO
{
    protected $_referenceMap = array( 
	'fk_id_contract' => array( 
	    'vo'	    => 'Model_VO_Contract', 
	    'dao'	    => 'Model_DAO_Contract', 
	    'localAttr'	    => 'fk_id_contract', 
	    'remoteAttr'    => 'id_contract' 
	 )
    );

    protected $_id_relationship;
    protected $_fk_id_contract;
    protected $_date_record;
    protected $_category;
    protected $_payment_origin;
    protected $_invoice_amount;
    protected $_amount;
    protected $_retention;
    protected $_advances;
    protected $_net_payment;
    protected $_contract_balance;
    protected $_cert_num;
    protected $_other_justification;
    protected $_other_value;

}