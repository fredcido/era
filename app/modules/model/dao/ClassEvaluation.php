<?php

class Model_DAO_ClassEvaluation extends ILO_Model_DAO
{
    protected $_table = 'class_evaluation';
    protected $_class = 'Model_VO_ClassEvaluation';
    
    /**
     *
     * @param string $class
     * @return array
     */
    public function validaTotalEvaluation( $class ) 
    {
	$sql = 'SELECT
		    ce.order_evaluation, 
		    SUM( ce.score ) score_total,
		    sc.total_student
		FROM class_evaluation ce
		INNER JOIN student_class sc ON
		    sc.id_student_class = ce.fk_id_student_class
		WHERE
		    fk_id_student_class = :class
		GROUP BY ce.order_evaluation
		HAVING score_total <> sc.total_student';
	
	$bind = array( ':class' => $class );
	
	return $this->queryResult( $sql, $bind );
    }
}