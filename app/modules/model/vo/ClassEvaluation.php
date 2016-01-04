<?php

class Model_VO_ClassEvaluation extends ILO_Model_VO
{

    protected $_referenceMap = array(
	'fk_id_student_class' => array(
	    'vo'	    => 'Model_VO_StudentClass', 
	    'dao'	    => 'Model_DAO_StudentClass', 
	    'localAttr'	    => 'fk_id_student_class', 
	    'remoteAttr'    => 'id_student_class'
	)
    );
    
    protected $_id_class_evaluation;
    protected $_fk_id_student_class;
    protected $_level_evaluation;
    protected $_order_evaluation;
    protected $_score;
}