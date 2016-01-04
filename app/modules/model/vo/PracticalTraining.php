<?php

class Model_VO_PracticalTraining extends ILO_Model_VO
{
    protected $_referenceMap = array(
	'fk_id_client' => array(
	    'vo'	    => 'Model_VO_CliClient', 
	    'dao'	    => 'Model_DAO_CliClient', 
	    'localAttr'	    => 'fk_id_client', 
	    'remoteAttr'    => 'id_client'
	   ), 
	'fk_id_student_class' => array(
	    'vo'	    => 'Model_VO_StudentClass', 
	    'dao'	    => 'Model_DAO_StudentClass', 
	    'localAttr'	    => 'fk_id_student_class', 
	    'remoteAttr'    => 'id_student_class'
	)
    );
     
    protected $_id_test_class;
    protected $_fk_id_student_class;
    protected $_fk_id_client;
    protected $_road_construction;
    protected $_discipline;
    protected $_final_score;

}