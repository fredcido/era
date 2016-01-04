<?php

class Model_VO_SysForm extends ILO_Model_VO
{

    protected $_referenceMap = array(
	'id_sysmodule' => array(
	    'vo'	    => 'Model_VO_SysModule',
	    'dao'	    => 'Model_DAO_SysModule',
	    'localAttr'	    => 'fk_id_sysmodule',
	    'remoteAttr'    => 'id_sysmodule'
	)
    );
    
    protected $_id_sysform;
    
    protected $_id_sysmodule;
    
    protected $_form_name;
    
    protected $_file_system;
    
    protected $_description;
}