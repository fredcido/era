<?php

class Model_BO_Incomes extends ILO_Model_BO

{

	public function save()

	{

		$incomesDAO = new Model_DAO_Incomes();

		$incomesVO = new Model_VO_Incomes();

		

$incomesVO->setValues( $this->_data );

		

if ( null == $incomesVO->getMUDAid() ) 

			return $incomesDAO->insert( $incomes);

		else

			return $incomesDAO->update( $incomes, array() );

	}

}