<?php

class Model_DAO_TestClass extends ILO_Model_DAO
{

    protected $_table = 'test_class';
    protected $_class = 'Model_VO_TestClass';

    /**
     *
     * @param string $class
     * @return array
     */
    public function verificaTestClient( $class )
    {
	$sql = 'SELECT sc.*
		FROM student_class_has_client sc
		WHERE 
		    sc.fk_id_student_class = :class
		    AND NOT EXISTS (
			SELECT NULL
			FROM test_class ct
			WHERE 
			    ct.fk_id_student_class = sc.fk_id_student_class
			    AND ct.fk_id_client = sc.fk_id_client
		    )';
	
	$bind = array(
	    ':class' => $class
	);
	
	return $this->queryResult( $sql, $bind );
    }
}