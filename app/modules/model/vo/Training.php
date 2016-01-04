<?php

class Model_VO_Training extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_area_training' => array( 'vo' => 'Model_VO_AreaTraining', 'dao' => 'Model_DAO_AreaTraining', 'localAttr' => 'fk_id_area_training', 'remoteAttr' => 'id_area_training' ));

		protected $_id_training;

		protected $_training_provider;

		protected $_fk_id_area_training;

}