<?php

class Model_VO_BusinessInputs extends ILO_Model_VO

{

	protected $_referenceMap = array('fk_id_client' => array( 'vo' => 'Model_VO_CliClient', 'dao' => 'Model_DAO_CliClient', 'localAttr' => 'fk_id_client', 'remoteAttr' => 'id_client' ), 'fk_id_student_class' => array( 'vo' => 'Model_VO_StudentClass', 'dao' => 'Model_DAO_StudentClass', 'localAttr' => 'fk_id_student_class', 'remoteAttr' => 'id_student_class' ));

		protected $_id_business_inputs;

		protected $_fk_id_client;

		protected $_fk_id_student_class;

		protected $_q1;

		protected $_q2;

		protected $_q3;

		protected $_q4;

		protected $_q5;

		protected $_q6;

		protected $_q7;

		protected $_q8;

		protected $_q9;

		protected $_q10;

		protected $_q11;

		protected $_q12;

		protected $_score;

		protected $_date;

}