<?php

class Model_VO_SnapshotIndicator extends ILO_Model_VO
{

    protected $_referenceMap = array(
	'fk_id_snapshot' => array(
	    'vo'		=> 'Model_VO_Snapshot',
	    'dao'		=> 'Model_DAO_Snapshot',
	    'localAttr'		=> 'fk_id_snapshot',
	    'remoteAttr'	=> 'id_snapshot'
	)
    );
    
    protected $_id_snapshot_indicator;
    protected $_fk_id_snapshot;
    protected $_indicator;
    protected $_value;
    protected $_type;
    protected $_score;
    protected $_total;
}