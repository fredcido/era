<?php

class Model_VO_StudentClass extends ILO_Model_VO
{

    protected $_referenceMap = array(
	'fk_id_add_district' => array(
	    'vo' => 'Model_VO_AddDistrict',
	    'dao' => 'Model_DAO_AddDistrict',
	    'localAttr' => 'fk_id_add_district',
	    'remoteAttr' => 'id_add_district'
	),
	'fk_id_add_suku' => array(
	    'vo' => 'Model_VO_AddSuku',
	    'dao' => 'Model_DAO_AddSuku',
	    'localAttr' => 'fk_id_add_suku',
	    'remoteAttr' => 'id_suku'
	),
	'fk_id_course' => array(
	    'vo' => 'Model_VO_Course',
	    'dao' => 'Model_DAO_Course',
	    'localAttr' => 'fk_id_course',
	    'remoteAttr' => 'id_course'
	)
    );
    protected $_id_student_class;
    protected $_fk_id_add_district;
    protected $_fk_id_course;
    protected $_num_course;
    protected $_num_year;
    protected $_num_title;
    protected $_num_sequence;
    protected $_class_name;
    protected $_class_days;
    protected $_field_days;
    protected $_duration_time;
    protected $_man_student;
    protected $_woman_student;
    protected $_total_student;
    protected $_start_date;
    protected $_finish_date;
    protected $_start_time;
    protected $_finish_time;
    protected $_payment_value;
    protected $_payment_description;
    protected $_class_description;
    protected $_fk_id_add_suku;
    protected $_place_complement;
    protected $_active;
    protected $_training_cost;

    /**
     *
     * @return string 
     */
    public function getNumeroTurma()
    {
	$numeroTurma = array(
	    $this->getNumCourse(),
	    $this->getNumYear(),
	    $this->getNumTitle(),
	    $this->getNumSequence()
	);
	
	return implode( '-', $numeroTurma );
    }
}