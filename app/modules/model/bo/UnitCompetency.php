<?php

class Model_BO_UnitCompetency extends ILO_Model_BO
{

    /**
     * 
     * @return bool
     */
    public function save()
    {
	$unitCompetencyDAO = new Model_DAO_UnitCompetency();
	$unitCompetencyVO = new Model_VO_UnitCompetency();
	
	$this->_data['cod_unit'] = trim(strtoupper($this->_data['cod_unit']));
	
	$units = $unitCompetencyDAO->fetchAll(array(), array('cod_unit' => $this->_data['cod_unit']));
	foreach ( $units as $course ) {
	    if ( $course->getIdUnitCompetency() == $this->_data['id_unit_competency'] )
		continue;
	    
	    $this->setError( ILO_Util_Translate::get( 'Existe uma unidade de competência com esse acrônimo cadastrado', 710 ) );
	    return false;
	}

	$unitCompetencyVO->setValues( $this->_data );

	if ( null == $unitCompetencyVO->getIdUnitCompetency() )
	    return $unitCompetencyDAO->insert( $unitCompetencyVO );
	else {
	    $return = $unitCompetencyDAO->update( $unitCompetencyVO, array( 'id_unit_competency' => $this->_data['id_unit_competency'] ) );
	    if ( $return )
		return $this->_data['id_unit_competency'];
	    else
		return false;
	}
    }
}
