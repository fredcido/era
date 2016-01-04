<?php

class Model_VO_Asset extends ILO_Model_VO
{
    protected $_referenceMap = array(
	'fk_id_enterprise' => array(
	    'vo'	    => 'Model_VO_Enterprise', 
	    'dao'	    => 'Model_DAO_Enterprise', 
	    'localAttr'	    => 'fk_id_enterprise', 
	    'remoteAttr'    => 'id_enterprise'
	)
    );
    
    protected $_id_asset;
    protected $_fk_id_enterprise;
    protected $_asset_name;
    protected $_asset_total;
    protected $_asset_description;
}