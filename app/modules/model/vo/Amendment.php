<?php

class Model_VO_Amendment extends ILO_Model_VO
{
    protected $_referenceMap = array (
        'fk_id_contract' => array( 
	    'vo'	    => 'Model_VO_Amendment', 
	    'dao'	    => 'Model_DAO_Amendment', 
	    'localAttr'	    => 'fk_id_contract', 
	    'remoteAttr'    => 'id_contract' 
	 )
    );
    
    protected $_id_amendment;
    protected $_fk_id_contract;
    protected $_original_value;
    protected $_amendment_value;
    protected $_amendment_date;
    protected $_date_registration;
    protected $_justification;
}