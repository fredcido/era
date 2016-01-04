<?php

class Model_BO_FormalSchoolLevel extends ILO_Model_BO

{

	public function save()

	{

		$formalSchoolLevelDAO = new Model_DAO_FormalSchoolLevel();

		$formalSchoolLevelVO = new Model_VO_FormalSchoolLevel();

		

$formalSchoolLevelVO->setValues( $this->_data );

		

if ( null == $formalSchoolLevelVO->getMUDAid() ) 

			return $formalSchoolLevelDAO->insert( $formalSchoolLevel);

		else

			return $formalSchoolLevelDAO->update( $formalSchoolLevel, array() );

	}

}