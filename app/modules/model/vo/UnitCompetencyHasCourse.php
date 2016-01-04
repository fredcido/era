<?php

class Model_VO_UnitCompetencyHasCourse extends ILO_Model_VO
{
    protected $_referenceMap = array(
	'fk_id_unit_competency' => array(
	    'vo'	=> 'Model_VO_UnitCompetency',
	    'dao'	=> 'Model_DAO_UnitCompetency',
	    'localAttr' => 'fk_id_unit_competency',
	    'remoteAttr' => 'id_unit_competency'
	),
	'fk_id_course' => array(
	    'vo'	=> 'Model_VO_Course',
	    'dao'	=> 'Model_DAO_Course',
	    'localAttr' => 'fk_id_course',
	    'remoteAttr' => 'id_course'
	)
    );
    
    protected $_id_relationship;
    protected $_fk_id_unit_competency;
    protected $_fk_id_course;
}
