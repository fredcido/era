<?php

class Model_BO_Course extends ILO_Model_BO
{
    /**
     * 
     * @return bool
     */
    public function save()
    {
	$courseDAO = new Model_DAO_Course();
	$courseVO = new Model_VO_Course();
	
	$this->_data['acronym'] = trim(strtoupper($this->_data['acronym']));
	
	$courses = $courseDAO->fetchAll(array(), array('acronym' => $this->_data['acronym']));
	foreach ( $courses as $course ) {
	    if ( $course->getIdCourse() == $this->_data['id_course'] )
		continue;
	    
	    $this->setError( ILO_Util_Translate::get( 'Existe um curso com esse acrônimo cadastrado', 706 ) );
	    return false;
	}

	$courseVO->setValues( $this->_data );

	if ( null == $courseVO->getIdCourse() )
	    return $courseDAO->insert( $courseVO );
	else {
	    $return = $courseDAO->update( $courseVO, array( 'id_course' => $this->_data['id_course'] ) );
	    if ( $return )
		return $this->_data['id_course'];
	    else
		return false;
	}
    }
    
    
    /**
     *
     * @return bool
     */
    public function saveCompetency()
    {
	$unitCompetencyHasCourseDAO = new Model_DAO_UnitCompetencyHasCourse();
	$unitCompetencyHasCourseVO = new Model_VO_UnitCompetencyHasCourse();

	$unitCompetencyHasCourseDAO->beginTransaction();
	try {
	    
	    // Lista unidades de competencia ja inseridos no curso
	    $unitCompetencies = $unitCompetencyHasCourseDAO->fetchAll( array(), array( 'fk_id_course' => $this->_data['id'] ) );
	    
	    $existents = array();
	    foreach ( $unitCompetencies as $unitCompetency )
		$existents[] = $unitCompetency->getFkIdUnitCompetency()->getIdUnitCompetency();
	    
	    // Verifica os que ainda não existem no curso
	    $newCompetency = array_diff( $this->_data['competencies'], $existents );
	    
	    // Se nao tiver diferença
	    if ( empty( $newCompetency ) ) {

		$this->setError( ILO_Util_Translate::get( 'Todas as unidades selecionadas já estão no curso', 699 ) );
		return false;
	    }
	    
	    // Insere competencias no curso
	    foreach ( $newCompetency as $unitCompetency ) {
		
		$vo = clone $unitCompetencyHasCourseVO;
		
		$vo->setFkIdCourse( $this->_data['id'] );
		$vo->setFkIdUnitCompetency( $unitCompetency );
		
		$unitCompetencyHasCourseDAO->insert( $vo );
	    }
	    
	    $description = 'INSERE UNIDADE KOMPETENSIA: %s IHA KURSU: %s';
	    $this->audit( sprintf( $description, implode(',', $newCompetency), $this->_data['id'] ), self::SALVAR );
	    
	    $unitCompetencyHasCourseDAO->commit();
	    return $this->_data['id'];
	
	} catch ( Exception $e ) {
	    
	    $unitCompetencyHasCourseDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @return bool
     */
    public function removeUnit()
    {
	$unitCompetencyHasCourseDAO = new Model_DAO_UnitCompetencyHasCourse();
	$unitCompetencyHasCourseDAO->beginTransaction();
	try {
	    
	    // Remove participantes da turma
	    foreach ( $this->_data['units'] as $unit ) {
		
		$where = array(
		    'fk_id_unit_competency'	=> $unit,
		    'fk_id_course'		=> $this->_data['id']
		);
		
		$unitCompetencyHasCourseDAO->delete( $where );
	    }
	    
	    $description = 'REMOVE UNIDADE KOMPETENSIA: %s HUSI KURSO %s';
	    $this->audit( sprintf( $description, implode(',', $this->_data['units']), $this->_data['id'] ), self::SALVAR );
	    
	    $unitCompetencyHasCourseDAO->commit();
	    return $this->_data['id'];
	
	} catch ( Exception $e ) {
	    
	    $unitCompetencyHasCourseDAO->rollBack();
	    
	    return false;
	}
    }
}
