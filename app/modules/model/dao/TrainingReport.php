<?php

class Model_DAO_TrainingReport extends ILO_Model_DAO
{

    /**
     *
     * @param array $filters
     * @return array 
     */
    public function porDistrito( $filters = array() )
    {
	$bindColumns = array();
	$sql = 'SELECT
		  d.district,
		  COUNT(1) AS total
		FROM student_class sc
		INNER JOIN add_district d ON
		  d.id_add_district = sc.fk_id_add_district
		WHERE 1 = 1
		      %s
		GROUP BY d.id_add_district
		ORDER BY d.district';
	
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['dt_ini'] ) ) {
	    
	    $bindColumns[':dt_ini'] = ILO_Util_Geral::dateToBd( $filters['dt_ini'] );
	    $where .= ' AND sc.start_date >= :dt_ini';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['dt_fim'] ) ) {
	    
	    $bindColumns[':dt_fim'] = ILO_Util_Geral::dateToBd( $filters['dt_fim'] );
	    $where .= ' AND sc.finish_date <= :dt_fim';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array
     */
    public function evolucao( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT
		  ce.level_evaluation,
		  SUM( ce.score ) total
		FROM class_evaluation ce
		INNER JOIN student_class sc ON
		  sc.id_student_class = ce.fk_id_student_class
		WHERE 1 = 1
		      %s
		GROUP BY ce.level_evaluation';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['dt_ini'] ) ) {
	    
	    $bindColumns[':dt_ini'] = ILO_Util_Geral::dateToBd( $filters['dt_ini'] );
	    $where .= ' AND sc.start_date >= :dt_ini';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['dt_fim'] ) ) {
	    
	    $bindColumns[':dt_fim'] = ILO_Util_Geral::dateToBd( $filters['dt_fim'] );
	    $where .= ' AND sc.finish_date <= :dt_fim';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['fk_id_add_district'] ) ) {
	    
	    $bindColumns[':district'] = $filters['fk_id_add_district'];
	    $where .= ' AND sc.fk_id_add_district = :district';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function atividadesTreinador( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT
		  t.id_trainer,
		  t.name_trainer,
		  sct.trainer_type,
		  COUNT(1) total
		FROM student_class sc
		INNER JOIN student_class_has_trainer sct ON
		  sct.fk_id_student_class = sc.id_student_class
		INNER JOIN trainer t ON
		  t.id_trainer = sct.fk_id_trainer
		WHERE 1 = 1
		      %s
		GROUP BY t.id_trainer, sct.trainer_type
		ORDER BY t.name_trainer';
	
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['dt_ini'] ) ) {
	    
	    $bindColumns[':dt_ini'] = ILO_Util_Geral::dateToBd( $filters['dt_ini'] );
	    $where .= ' AND sc.start_date >= :dt_ini';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['dt_fim'] ) ) {
	    
	    $bindColumns[':dt_fim'] = ILO_Util_Geral::dateToBd( $filters['dt_fim'] );
	    $where .= ' AND sc.finish_date <= :dt_fim';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function participantesSexo( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT
		  sc.id_student_class,
		  cc.gender,
		  COUNT(1) AS total
		FROM student_class sc
		INNER JOIN student_class_has_client scc ON
		   scc.fk_id_student_class = sc.id_student_class
		INNER JOIN cli_client cc ON
		  cc.id_client = scc.fk_id_client
		WHERE 1 = 1
		      %s
		GROUP BY cc.gender';
	
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND sc.start_date >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND sc.finish_date <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {
	    
	    //$bindColumns[':turma_id'] = '%' . $filters['turma_id'] . '%';
	    //$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function participantesDistritoSexo( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT
		  d.id_add_district,
		  d.district,
		  cc.gender,
		  COUNT(1) AS total
		FROM student_class sc
		INNER JOIN student_class_has_client scc ON
		   scc.fk_id_student_class = sc.id_student_class
		INNER JOIN cli_client cc ON
		  cc.id_client = scc.fk_id_client
		INNER JOIN add_district d ON
		   d.id_add_district = cc.fk_id_add_district
		WHERE 1 = 1
		      %s
		GROUP BY d.id_add_district, cc.gender';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND sc.start_date >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND sc.finish_date <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {
	    
	    //$bindColumns[':turma_id'] = '%' . $filters['turma_id'] . '%';
	    //$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function participantesTurmaSexo( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT
		  sc.*,
		  cc.gender,
		  COUNT(1) AS total
		FROM student_class sc
		INNER JOIN student_class_has_client scc ON
		   scc.fk_id_student_class = sc.id_student_class
		INNER JOIN cli_client cc ON
		  cc.id_client = scc.fk_id_client
		WHERE 1 = 1
		      %s
		GROUP BY sc.id_student_class, cc.gender';
	
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND sc.start_date >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND sc.finish_date <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {

	    $turmas = (array)$filters['turma_id'];
	    foreach ( $turmas as $turma ) {
		
		$bindColumns[':turma_id'] = '%' . $turma . '%';
		$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	    }
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function curso( $filters = array() )
    {
	$bindColumns = array();
	$sql = 'SELECT
		    c.id_course,
		    c.course,
		    cc.gender,
		    COUNT(1) AS total
		FROM student_class sc
		INNER JOIN student_class_has_course schc ON
		    schc.fk_id_student_class = sc.id_student_class
		INNER JOIN course c ON
		    c.id_course = schc.fk_id_course
		INNER JOIN student_class_has_client scc ON
		    scc.fk_id_student_class = sc.id_student_class
		INNER JOIN cli_client cc ON
		    cc.id_client = scc.fk_id_client
		WHERE 1 = 1
		      %s
		GROUP BY c.id_course, cc.gender';
	
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['dt_ini'] ) ) {
	    
	    $bindColumns[':dt_ini'] = ILO_Util_Geral::dateToBd( $filters['dt_ini'] );
	    $where .= ' AND sc.start_date >= :dt_ini';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['dt_fim'] ) ) {
	    
	    $bindColumns[':dt_fim'] = ILO_Util_Geral::dateToBd( $filters['dt_fim'] );
	    $where .= ' AND sc.finish_date <= :dt_fim';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['fk_id_add_district'] ) ) {
	    
	    $bindColumns[':district'] = $filters['fk_id_add_district'];
	    $where .= ' AND sc.fk_id_add_district = :district';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function participanteGrupoIdade( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	$sql = 'SELECT
		    TIMESTAMPDIFF(YEAR, cc.date_birth, NOW()) idade,
		    cc.gender
		FROM student_class sc
		INNER JOIN student_class_has_client scc ON
		    scc.fk_id_student_class = sc.id_student_class
		INNER JOIN cli_client cc ON
		    cc.id_client = scc.fk_id_client
		WHERE 1 = 1
		      %s';
	
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND sc.start_date >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND sc.finish_date <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {
	    
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	    //$bindColumns[':turma_id'] = '%' . $filters['turma_id'] . '%';
	    //$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['fk_id_add_district'] ) ) {
	    
	    $bindColumns[':district'] = $filters['fk_id_add_district'];
	    $where .= ' AND sc.fk_id_add_district = :district';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function participantesEducacao( $filters = array() )
    {
	$bindColumns = array();
	$sql = 'SELECT
		    fsc.id_school_level,
		    fsc.school_level,
		    cc.gender,
		    COUNT(1) AS total
		FROM student_class sc
		INNER JOIN student_class_has_client scc ON
		    scc.fk_id_student_class = sc.id_student_class
		INNER JOIN cli_client cc ON
		    cc.id_client = scc.fk_id_client
		INNER JOIN formal_school_level fsc ON
		    fsc.id_school_level = cc.fk_max_school_level
		WHERE 1 = 1
		      %s
		GROUP BY fsc.id_school_level, cc.gender';
	
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['dt_ini'] ) ) {
	    
	    $bindColumns[':dt_ini'] = ILO_Util_Geral::dateToBd( $filters['dt_ini'] );
	    $where .= ' AND sc.start_date >= :dt_ini';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['dt_fim'] ) ) {
	    
	    $bindColumns[':dt_fim'] = ILO_Util_Geral::dateToBd( $filters['dt_fim'] );
	    $where .= ' AND sc.finish_date <= :dt_fim';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['fk_id_add_district'] ) ) {
	    
	    $bindColumns[':district'] = $filters['fk_id_add_district'];
	    $where .= ' AND sc.fk_id_add_district = :district';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function desempenho( $filters = array() )
    {
	$bindColumns = array();
	$sql = "SELECT
		    sc.id_student_class,
		    ct.fk_id_unit_competency,
		    ct.fk_id_client,
		    ct.type,
		    ct.score
		FROM student_class sc
		INNER JOIN add_district d ON
		    d.id_add_district = sc.fk_id_add_district
		INNER JOIN class_test ct ON
		    ct.fk_id_student_class = sc.id_student_class
		WHERE ct.type IN ( 'PRE', 'POS' )
		      AND sc.active = 'I'
		      %s
		ORDER BY sc.id_student_class, ct.fk_id_unit_competency, ct.fk_id_client";
	
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['dt_ini'] ) ) {
	    
	    $bindColumns[':dt_ini'] = ILO_Util_Geral::dateToBd( $filters['dt_ini'] );
	    $where .= ' AND sc.start_date >= :dt_ini';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['dt_fim'] ) ) {
	    
	    $bindColumns[':dt_fim'] = ILO_Util_Geral::dateToBd( $filters['dt_fim'] );
	    $where .= ' AND sc.finish_date <= :dt_fim';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['fk_id_add_district'] ) ) {
	    
	    $bindColumns[':district'] = $filters['fk_id_add_district'];
	    $where .= ' AND sc.fk_id_add_district = :district';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }

    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function andamentoMes( $filters = array() )
    {
	$bindColumns = array();
	$sql = "SELECT
		    DATE_FORMAT( sc.start_date, '%%M/%%Y' ) data,
		    DATE_FORMAT( sc.start_date, '%%Y/%%m' ) ordem,
		    cc.gender,
		    COUNT(1) AS total
		FROM student_class sc
		INNER JOIN student_class_has_client scc ON
		    scc.fk_id_student_class = sc.id_student_class
		INNER JOIN cli_client cc ON
		    cc.id_client = scc.fk_id_client
		WHERE 1 = 1
		      %s
		GROUP BY data, cc.gender
		ORDER BY ordem";
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['dt_ini'] ) ) {
	    
	    $bindColumns[':dt_ini'] = ILO_Util_Geral::dateToBd( $filters['dt_ini'] );
	    $where .= ' AND sc.start_date >= :dt_ini';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['dt_fim'] ) ) {
	    
	    $bindColumns[':dt_fim'] = ILO_Util_Geral::dateToBd( $filters['dt_fim'] );
	    $where .= ' AND sc.finish_date <= :dt_fim';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['fk_id_add_district'] ) ) {
	    
	    $bindColumns[':district'] = $filters['fk_id_add_district'];
	    $where .= ' AND sc.fk_id_add_district = :district';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function listaTreinamento( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = "SELECT
		    sc.*,
		    c.course,
		    uc.name_unit,
		    t.name_trainer
		FROM student_class sc
		LEFT JOIN student_class_has_course scc ON
		    scc.fk_id_student_class = sc.id_student_class
		LEFT JOIN unit_competency uc ON
		    uc.id_unit_competency = scc.fk_id_unit_competency
		INNER JOIN course c ON
		    c.id_course = sc.fk_id_course
		INNER JOIN student_class_has_trainer sct ON
		    sct.fk_id_student_class = sc.id_student_class
		    AND sct.trainer_type = 'MAIN'
		INNER JOIN trainer t ON
		    t.id_trainer = sct.fk_id_trainer
		WHERE 1 = 1
		      %s
		ORDER BY sc.start_date";
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['dt_ini'] ) ) {
	    
	    $bindColumns[':dt_ini'] = ILO_Util_Geral::dateToBd( $filters['dt_ini'] );
	    $where .= ' AND sc.start_date >= :dt_ini';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['dt_fim'] ) ) {
	    
	    $bindColumns[':dt_fim'] = ILO_Util_Geral::dateToBd( $filters['dt_fim'] );
	    $where .= ' AND sc.finish_date <= :dt_fim';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['fk_id_add_district'] ) ) {
	    
	    $bindColumns[':district'] = $filters['fk_id_add_district'];
	    $where .= ' AND sc.fk_id_add_district = :district';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {
	    
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	    //$bindColumns[':turma_id'] = '%' . $filters['turma_id'] . '%';
	    //$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array
     */
    public function listTurmas( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = "SELECT
		    sc.*
		FROM student_class sc
		WHERE 1 = 1
		      %s
		ORDER BY sc.start_date";
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND sc.start_date >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND sc.finish_date <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {
	    
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	    //$bindColumns[':turma_id'] = '%' . $filters['turma_id'] . '%';
	    //$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array
     */
    public function listParticipantesAttendence( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = "SELECT
		    sc.*,
		    at.present_percent
		FROM student_class sc
		INNER JOIN student_class_has_client schc ON
		  schc.fk_id_student_class = sc.id_student_class
		LEFT JOIN attendence at ON
		  at.fk_id_student_class = sc.id_student_class
		  AND at.fk_id_client = schc.fk_id_client
		WHERE 1 = 1
		      %s
		ORDER BY sc.start_date";
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND sc.start_date >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND sc.finish_date <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {
	    
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	    //$bindColumns[':turma_id'] = '%' . $filters['turma_id'] . '%';
	    //$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array
     */
    public function listDistritosEmpresa( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT DISTINCT
		    ad.id_add_district,
		    ad.district,
		    e.id_enterprise,
		    e.enterprise_name,
		    sc.num_title,
		    ' . $this->_getTurmaIdExpression() . ' as turma_id
		FROM student_class sc 
		INNER JOIN student_class_has_client schc ON
		    schc.fk_id_student_class = sc.id_student_class
		INNER JOIN cli_client cc ON
		    cc.id_client = schc.fk_id_client
		INNER JOIN client_has_enterprise che ON
		    che.fk_id_client = cc.id_client
		INNER JOIN enterprise e ON
		    e.id_enterprise = che.fk_id_enterprise
		INNER JOIN add_district ad ON
		    ad.id_add_district = e.fk_id_add_district
		WHERE 1 = 1
		      %s
		ORDER BY ad.district, sc.num_course, sc.num_year, sc.num_title DESC, sc.num_sequence';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND sc.start_date >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND sc.finish_date <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {
	    
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	    //$bindColumns[':turma_id'] = '%' . $filters['turma_id'] . '%';
	    //$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    
     /**
     *
     * @param array $filters
     * @return array
     */
    public function listTreinadores( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT 
		    t.id_trainer,
		    t.name_trainer,
		    scht.trainer_type
		FROM student_class sc 
		INNER JOIN student_class_has_trainer scht ON
		    scht.fk_id_student_class = sc.id_student_class
		INNER JOIN trainer t ON
		    t.id_trainer = scht.fk_id_trainer
		WHERE 1 = 1
		      %s
		ORDER BY t.name_trainer, scht.trainer_type';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND sc.start_date >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND sc.finish_date <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {
	    
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	    //$bindColumns[':turma_id'] = '%' . $filters['turma_id'] . '%';
	    //$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    public function listTurmasParticipantes( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT 
		   sc.*,
		   COUNT(1) participantes
		FROM student_class sc 
		INNER JOIN student_class_has_client scc ON
		    sc.id_student_class = scc.fk_id_student_class
		WHERE 1 = 1
		      %s
		GROUP BY sc.id_student_class';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND sc.start_date >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND sc.finish_date <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {
	    
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	    //$bindColumns[':turma_id'] = '%' . $filters['turma_id'] . '%';
	    //$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function listScoreClassRoom( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT 
		    sc.*,
		    tc.*,
		    cc.first_name,
		    cc.last_name,
		    cc.gender,
		    e.enterprise_name
		FROM student_class sc
		INNER JOIN student_class_has_client scc ON
		    scc.fk_id_student_class = sc.id_student_class
		INNER JOIN cli_client cc ON
		    cc.id_client = scc.fk_id_client
		LEFT JOIN test_class tc ON
		    tc.fk_id_client = scc.fk_id_client
		    AND tc.fk_id_student_class = sc.id_student_class
		LEFT JOIN client_has_enterprise che ON
		    che.fk_id_client = cc.id_client
		LEFT JOIN enterprise e ON
		    e.id_enterprise = che.fk_id_enterprise
		WHERE 1 = 1
		      %s
		GROUP BY sc.id_student_class, cc.id_client
		ORDER BY sc.id_student_class, cc.id_client';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND sc.start_date >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND sc.finish_date <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {
	    
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	    //$bindColumns[':turma_id'] = '%' . $filters['turma_id'] . '%';
	    //$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function listAttendance( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT 
		    sc.*,
		    a.sick,
		    a.permission,
		    a.absence,
		    a.present,
		    a.present_percent,
		    a.sick sick_field,
		    a1.permission permission_field,
		    a1.absence absence_field,
		    a1.present present_field,
		    a1.present_percent present_percent_field,
		    cc.first_name,
		    cc.last_name,
		    cc.gender,
		    e.enterprise_name
		FROM student_class sc
		INNER JOIN student_class_has_client scc ON
		    scc.fk_id_student_class = sc.id_student_class
		INNER JOIN cli_client cc ON
		    cc.id_client = scc.fk_id_client
		LEFT JOIN attendence a ON
		    a.fk_id_client = scc.fk_id_client
		    AND a.fk_id_student_class = sc.id_student_class
		    AND a.type = "C"
		LEFT JOIN attendence a1 ON
		    a1.fk_id_client = scc.fk_id_client
		    AND a1.fk_id_student_class = sc.id_student_class
		    AND a1.type = "F"
		LEFT JOIN client_has_enterprise che ON
		    che.fk_id_client = cc.id_client
		LEFT JOIN enterprise e ON
		    e.id_enterprise = che.fk_id_enterprise
		WHERE 1 = 1
		      %s
		GROUP BY sc.id_student_class, cc.id_client
		ORDER BY sc.id_student_class, cc.id_client';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND sc.start_date >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND sc.finish_date <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {
	    
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	    //$bindColumns[':turma_id'] = '%' . $filters['turma_id'] . '%';
	    //$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	}
	
	$sql = sprintf( $sql, $where );
	return $this->queryResult( $sql, $bindColumns );
    }
    
     /**
     *
     * @param array $filters
     * @return array 
     */
    public function listScorePratica( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT 
		    sc.*,
		    pt.*,
		    cc.first_name,
		    cc.last_name,
		    cc.gender,
		    e.enterprise_name
		FROM student_class sc
		INNER JOIN student_class_has_client scc ON
		    scc.fk_id_student_class = sc.id_student_class
		INNER JOIN cli_client cc ON
		    cc.id_client = scc.fk_id_client
		LEFT JOIN practical_training pt ON
		    pt.fk_id_client = scc.fk_id_client
		    AND pt.fk_id_student_class = sc.id_student_class
		LEFT JOIN client_has_enterprise che ON
		    che.fk_id_client = cc.id_client
		LEFT JOIN enterprise e ON
		    e.id_enterprise = che.fk_id_enterprise
		WHERE 1 = 1
		      %s
		GROUP BY sc.id_student_class, cc.id_client
		ORDER BY sc.id_student_class, cc.id_client';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND sc.start_date >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND sc.finish_date <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {
	    
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	    //$bindColumns[':turma_id'] = '%' . $filters['turma_id'] . '%';
	    //$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	}
	
	$sql = sprintf( $sql, $where );
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function listFinalAssessment( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT 
		    sc.*,
		    tc.pre_test,
		    tc.final_test,
		    tc.understanding,
		    tc.final_score test_class,
		    a.sick,
		    a.permission,
		    a.absence,
		    a.present,
		    a.present_percent,
		    a.sick sick_field,
		    a1.permission permission_field,
		    a1.absence absence_field,
		    a1.present present_field,
		    a1.present_percent present_percent_field,
		    pt.road_construction,
		    pt.discipline,
		    pt.final_score practical,
		    cc.first_name,
		    cc.last_name,
		    cc.gender,
		    e.enterprise_name
		FROM student_class sc
		INNER JOIN student_class_has_client scc ON
		    scc.fk_id_student_class = sc.id_student_class
		INNER JOIN cli_client cc ON
		    cc.id_client = scc.fk_id_client
		LEFT JOIN test_class tc ON
		    tc.fk_id_client = scc.fk_id_client
		    AND tc.fk_id_student_class = sc.id_student_class
		LEFT JOIN attendence a ON
		    a.fk_id_client = scc.fk_id_client
		    AND a.fk_id_student_class = sc.id_student_class
		    AND a.type = "C"
		LEFT JOIN attendence a1 ON
		    a1.fk_id_client = scc.fk_id_client
		    AND a1.fk_id_student_class = sc.id_student_class
		    AND a1.type = "F"
		LEFT JOIN practical_training pt ON
		    pt.fk_id_client = scc.fk_id_client
		    AND pt.fk_id_student_class = sc.id_student_class
		LEFT JOIN client_has_enterprise che ON
		    che.fk_id_client = cc.id_client
		LEFT JOIN enterprise e ON
		    e.id_enterprise = che.fk_id_enterprise
		WHERE 1 = 1
		      %s
		GROUP BY sc.id_student_class, cc.id_client
		ORDER BY sc.id_student_class, cc.id_client';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND sc.start_date >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND sc.finish_date <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) ) {
	    
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	    
	    //$bindColumns[':turma_id'] = '%' . $filters['turma_id'] . '%';
	    //$where .= ' AND ' . $this->_getTurmaIdExpression() . ' LIKE :turma_id';
	}
	
	$sql = sprintf( $sql, $where );
	return $this->queryResult( $sql, $bindColumns );
    }
    
    public function listFullCourse( $filters = array() )
    {
	$sql = "SELECT 
		    sc.*,
		    CONCAT( cc.first_name, ' ', cc.last_name ) complete_name,
		    e.id_enterprise,
		    e.enterprise_name
		FROM student_class sc
		INNER JOIN student_class_has_client scc ON
		    scc.fk_id_student_class = sc.id_student_class
		INNER JOIN cli_client cc ON
		    cc.id_client = scc.fk_id_client
		INNER JOIN client_has_enterprise ce ON
		    ce.fk_id_client = scc.fk_id_client
		INNER JOIN enterprise e ON
		    e.id_enterprise = ce.fk_id_enterprise
		WHERE 1 = 1
		      %s
		GROUP BY e.id_enterprise, cc.id_client
		ORDER BY e.enterprise_name, sc.num_course, sc.num_year, sc.num_title, sc.num_sequence";
	
	$where = '';
	$bindColumns = array();
		
	// se tiver filtro por turma ID
	if ( !empty( $filters['turma_id'] ) )
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	
	$sql = sprintf( $sql, $where );
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @return string 
     */
    protected function _getTurmaIdExpression()
    {
	return 'CONCAT( sc.num_course, "-", sc.num_year, "-", sc.num_title, "-", sc.num_sequence )';
    }
    
    /**
     *
     * @param array $filters
     * @param string $bind
     * @return string 
     */
    protected function prepareIdFilter( $filters, &$bind )
    {
	if ( empty( $filters['turma_id'] ) )
	    return '';
	
	$turmas = (array)$filters['turma_id'];
	$where = array();
	foreach ( $turmas as $key => $value ) {
	    
	    $bind[':turma_' . $key] = '%' . $value .  '%';
	    $where[] = $this->_getTurmaIdExpression() . ' LIKE :turma_' . $key;
	}
	
	$where = implode( ' OR ', $where );
	
	return ' AND (' . $where . ')';
    }
}