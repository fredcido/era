<?php

class Model_VO_SysAudit extends ILO_Model_VO
{

    protected $_referenceMap = array(
	'fk_id_sysform' => array(
	    'vo'	    => 'Model_VO_SysForm',
	    'dao'	    => 'Model_DAO_SysForm',
	    'localAttr'	    => 'fk_id_sysform',
	    'remoteAttr'    => 'id_sysform'
	),
	'fk_id_sysmodule' => array(
	    'vo'	    => 'Model_VO_SysModule',
	    'dao'	    => 'Model_DAO_SysModule',
	    'localAttr'	    => 'fk_id_sysmodule',
	    'remoteAttr'    => 'id_sysmodule'
	),
	'fk_id_sysoperation' => array(
	    'vo'	    => 'Model_VO_SysOperation',
	    'dao'	    => 'Model_DAO_SysOperation',
	    'localAttr'	    => 'fk_id_sysoperation',
	    'remoteAttr'    => 'id_sysoperation'
	),
	'fk_id_sysuser' => array(
	    'vo'	    => 'Model_VO_SysUser',
	    'dao'	    => 'Model_DAO_SysUser',
	    'localAttr'	    => 'fk_id_sysuser',
	    'remoteAttr'    => 'id_sysuser'
	)
    );
    protected $_id_sysaudit;
    protected $_fk_id_sysmodule;
    protected $_fk_id_sysform;
    protected $_fk_id_sysoperation;
    protected $_fk_id_sysuser;
    protected $_date_time;
    protected $_description;
    protected $_ip;

}