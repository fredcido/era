<?php

class Model_VO_ClassTest extends ILO_Model_VO
{

    protected $_referenceMap = array('fk_id_client' => array('vo' => 'Model_VO_CliClient', 'dao' => 'Model_DAO_CliClient', 'localAttr' => 'fk_id_client', 'remoteAttr' => 'id_client'), 'fk_id_course' => array('vo' => 'Model_VO_Course', 'dao' => 'Model_DAO_Course', 'localAttr' => 'fk_id_course', 'remoteAttr' => 'id_course'), 'fk_id_student_class' => array('vo' => 'Model_VO_StudentClass', 'dao' => 'Model_DAO_StudentClass', 'localAttr' => 'fk_id_student_class', 'remoteAttr' => 'id_student_class'), 'fk_id_unit_competency' => array('vo' => 'Model_VO_UnitCompetency', 'dao' => 'Model_DAO_UnitCompetency', 'localAttr' => 'fk_id_unit_competency', 'remoteAttr' => 'id_unit_competency'));
    protected $_id_class_test;
    protected $_fk_id_student_class;
    protected $_fk_id_client;
    protected $_fk_id_course;
    protected $_fk_id_unit_competency;
    protected $_score;
    protected $_type;

}