<?php

class Model_DAO_PracticalTraining extends ILO_Model_DAO
{

    protected $_table = 'practical_training';
    protected $_class = 'Model_VO_PracticalTraining';

    /**
     *
     * @param string $class
     * @return array
     */
    public function verificaPracticalTrainingClient( $class )
    {
	$sql = 'SELECT sc.*
		FROM student_class_has_client sc
		WHERE 
		    sc.fk_id_student_class = :class
		    AND NOT EXISTS (
			SELECT NULL
			FROM practical_training ct
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