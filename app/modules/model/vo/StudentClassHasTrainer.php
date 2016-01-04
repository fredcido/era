<?php

class Model_VO_StudentClassHasTrainer extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_student_class' => array( 'vo' => 'Model_VO_StudentClass', 'dao' => 'Model_DAO_StudentClass', 'localAttr' => 'fk_id_student_class', 'remoteAttr' => 'id_student_class' ), 'fk_id_trainer' => array( 'vo' => 'Model_VO_Trainer', 'dao' => 'Model_DAO_Trainer', 'localAttr' => 'fk_id_trainer', 'remoteAttr' => 'id_trainer' ));

		protected $_id_relationship;

		protected $_fk_id_student_class;

		protected $_fk_id_trainer;

		protected $_trainer_type;

}