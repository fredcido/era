<?php

class Model_VO_TrackStaff extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_enterprise' => array( 'vo' => 'Model_VO_Enterprise', 'dao' => 'Model_DAO_Enterprise', 'localAttr' => 'fk_id_enterprise', 'remoteAttr' => 'id_enterprise' ));

		protected $_id_track_staff;

		protected $_fk_id_enterprise;

		protected $_staff_man;

		protected $_staff_woman;

		protected $_total_staff;

		protected $_date_update;

}