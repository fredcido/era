<?php

class Model_VO_StudentClassHasCourse extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_course' => array( 'vo' => 'Model_VO_Course', 'dao' => 'Model_DAO_Course', 'localAttr' => 'fk_id_course', 'remoteAttr' => 'id_course' ), 'fk_id_student_class' => array( 'vo' => 'Model_VO_StudentClass', 'dao' => 'Model_DAO_StudentClass', 'localAttr' => 'fk_id_student_class', 'remoteAttr' => 'id_student_class' ), 'fk_id_unit_competency' => array( 'vo' => 'Model_VO_UnitCompetency', 'dao' => 'Model_DAO_UnitCompetency', 'localAttr' => 'fk_id_unit_competency', 'remoteAttr' => 'id_unit_competency' ));

		protected $_id_relationship;

		protected $_fk_id_student_class;

		protected $_fk_id_unit_competency;

		protected $_fk_id_course;

}