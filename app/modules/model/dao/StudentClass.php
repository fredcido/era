<?php

class Model_DAO_StudentClass extends ILO_Model_DAO
{

    protected $_table = 'student_class';
    protected $_class = 'Model_VO_StudentClass';

    /**
     *
     * @param string $num_district
     * @param string $num_year
     * @return string 
     */
    public function getNumSequence( $num_course, $num_title, $num_year )
    {
	$sql = 'SELECT IFNULL( MAX( num_sequence ), 0 ) + 1 num_sequence
		FROM student_class
		WHERE 
		    num_year = :year
		    AND num_course = :course
		    AND num_title = :title';
	
	$bind = array(
	    ':year'	=> $num_year,
	    ':course'	=> $num_course,
	    ':title'	=> $num_title
	);
	
	$result = $this->queryResult( $sql, $bind );
	
	return str_pad( $result[0]['num_sequence'], 2, '0', STR_PAD_LEFT );
    }
}