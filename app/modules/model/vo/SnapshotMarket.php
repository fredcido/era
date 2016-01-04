<?php

class Model_VO_SnapshotMarket extends ILO_Model_VO
{

    protected $_referenceMap = array(
	'fk_id_snapshot' => array(
	    'vo'		=> 'Model_VO_Snapshot',
	    'dao'		=> 'Model_DAO_Snapshot',
	    'localAttr'		=> 'fk_id_snapshot',
	    'remoteAttr'	=> 'id_snapshot'
	)
    );
    
    protected $_id_snapshot_market;
    protected $_fk_id_snapshot;
    protected $_place;
    protected $_days_week;
    protected $_wet_season_motor;
    protected $_dry_season_motor;
    protected $_wet_season_walk;
    protected $_dry_season_walk;
    protected $_travel_cost_motor;
    protected $_travel_cost_walk;
}