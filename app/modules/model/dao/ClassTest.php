<?php

class Model_DAO_ClassTest extends ILO_Model_DAO
{

    protected $_table = 'class_test';
    protected $_class = 'Model_VO_ClassTest';
    
    /**
     *
     * @param int $class
     * @param string $type
     * @param int $cli
     * @return array 
     */
    public function searchUnitiesWithTests( $class, $type, $cli )
    {
	$bind = array(
	    ':class'	=>  $class,
	    ':type'	=>  $type,
	    ':cli'	=>  $cli
	);
	
	$sql = 'SELECT
		    uc.id_unit_competency,
		    uc.name_unit,
		    IFNULL( ct.score, 0 ) score
		FROM unit_competency uc
		INNER JOIN student_class_has_course sc ON
		    sc.fk_id_unit_competency = uc.id_unit_competency
		    AND sc.fk_id_course = uc.fk_id_course
		LEFT JOIN class_test ct ON
		    ct.fk_id_unit_competency = uc.id_unit_competency
		    AND ct.fk_id_course = uc.fk_id_course
		    AND ct.fk_id_student_class = sc.fk_id_student_class
		    AND ct.fk_id_client = :cli
		    AND ct.type = :type
		WHERE 
		    sc.fk_id_student_class = :class
		ORDER BY uc.name_unit';
	
	return $this->queryResult( $sql, $bind );
    }

    /**
     *
     * @param string $class
     * @param string $test
     * @return array
     */
    public function verificaTestClient( $class, $test )
    {
	$sql = 'SELECT sc.*
		FROM student_class_has_client sc
		WHERE 
		    sc.fk_id_student_class = :class
		    AND NOT EXISTS (
			SELECT NULL
			FROM class_test ct
			WHERE 
			    ct.fk_id_student_class = sc.fk_id_student_class
			    AND ct.fk_id_client = sc.fk_id_client
			    AND ct.type = :test
		    )';
	
	$bind = array(
	    ':class' => $class,
	    ':test'  =>	$test
	);
	
	return $this->queryResult( $sql, $bind );
    }
}