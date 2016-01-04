<?php

class Model_BO_TrackStaff extends ILO_Model_BO

{

	public function save()

	{

		$trackStaffDAO = new Model_DAO_TrackStaff();

		$trackStaffVO = new Model_VO_TrackStaff();

		

$trackStaffVO->setValues( $this->_data );

		

if ( null == $trackStaffVO->getMUDAid() ) 

			return $trackStaffDAO->insert( $trackStaff);

		else

			return $trackStaffDAO->update( $trackStaff, array() );

	}

}