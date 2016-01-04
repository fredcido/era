<?php

class Model_VO_SnapshotHasVillage extends ILO_Model_VO
{

    protected $_referenceMap = array(
	'fk_id_snapshot' => array(
	    'vo'		=> 'Model_VO_Snapshot',
	    'dao'		=> 'Model_DAO_Snapshot',
	    'localAttr'		=> 'fk_id_snapshot',
	    'remoteAttr'	=> 'id_snapshot'
	),
	'fk_id_village' => array(
	    'vo'		=> 'Model_VO_AddVillage',
	    'dao'		=> 'Model_DAO_AddVillage',
	    'localAttr'		=> 'fk_id_village',
	    'remoteAttr'	=> 'id_village'
	)
    );
    
    protected $_id_relationship;
    protected $_fk_id_snapshot;
    protected $_fk_id_village;
    protected $_total;
    protected $_total_men;
    protected $_total_women;
    protected $_total_hh;
}