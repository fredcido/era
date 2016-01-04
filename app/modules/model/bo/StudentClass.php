<?php

class Model_BO_StudentClass extends ILO_Model_BO
{
    /**
     *
     * @var array
     */
    protected $_tests = array(
	'PRE'	=>  'ASS_K',
	'POS'	=>  'PRE'
    );
    
    /**
     *
     * @return boolean 
     */
    public function saveGeral()
    {
	$studentClassDAO = new Model_DAO_StudentClass();
	$studentClassVO = new Model_VO_StudentClass();

	$studentClassDAO->beginTransaction();
	try {
	    
	    $studentClassVO->setValues( $this->_data );
	    
	    // Valida dados da turam
	    if ( !$this->_validaSaveGeral( $studentClassVO ) )
		return false;
	    
	    // Formata data inicial
	    $studentClassVO->setStartDate( ILO_Util_Geral::dateToBd( $studentClassVO->getStartDate() ) );
	    // Formata data final
	    $studentClassVO->setFinishDate( ILO_Util_Geral::dateToBd( $studentClassVO->getFinishDate() ) );

	    // Formata valor de pagamento
	    $studentClassVO->setPaymentValue( ILO_Util_Geral::toFloat( $studentClassVO->getPaymentValue() ) );
	    // Formata custo do treinamento
	    $studentClassVO->setTrainingCost( ILO_Util_Geral::toFloat( $studentClassVO->getTrainingCost() ) );

	    if ( null == $studentClassVO->getIdStudentClass() ) {
		
		// Monta num_district
		//$districtAc = $studentClassVO->getFkIdAddDistrict()->getAcronym();
		//$studentClassVO->setNumDistrict( $districtAc );
		
		// Padrão ativo
		$studentClassVO->setActive( 'A' );
		
		// Get the course
		$courseDAO = new Model_DAO_Course();
		$courseVO = $courseDAO->fetchRow(array('id_course' => $this->_data['fk_id_course']));
		
		$this->_data['num_course'] = $courseVO->getAcronym();
		$studentClassVO->setNumCourse($this->_data['num_course']);
		
		// Gera num_sequence
		$studentClassVO->setNumSequence( $studentClassDAO->getNumSequence( $this->_data['num_course'], $this->_data['num_title'], $this->_data['num_year'] ) );
		
		// Insere turma
		$studentClassId = $studentClassDAO->insert( $studentClassVO );
		
		// Salva auditoria
		$description = 'REJISTU TURMA TREINAMENTU: %s BA HAKAT 1 – INFORMASAUN GERAL';
		$this->audit( sprintf( $description, $studentClassVO->getNumeroTurma() ), self::SALVAR );
		
	    } else {
		
		$studentClassId = $studentClassVO->getIdStudentClass();
			
		// Atualiza turma
		$studentClassDAO->update( $studentClassVO, array( 'id_student_class' => $studentClassId ) );
		
		$vo = $studentClassDAO->fetchRow( array( 'id_student_class' => $studentClassId ) );
		
		// Salva auditoria
		$description = 'ATUALIZA TURMA TREINAMENTU: %s BA HAKAT 1 – INFORMASAUN GERAL';
		$this->audit( sprintf( $description, $vo->getNumeroTurma() ), self::SALVAR );
	    }
	    
	    $studentClassDAO->commit();
	    return $studentClassId;
	
	} catch ( Exception $e ) {
	    
	    $studentClassDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @param Model_VO_StudentClass $student
     * @return bool 
     */
    protected function _validaSaveGeral( Model_VO_StudentClass $student )
    {
	// Valida data de nascimento
	if ( !ILO_Util_Geral::checkDate( $student->getStartDate() ) ) {
	    
	    $this->setError( ILO_Util_Translate::get( 'Data inicial inválida', 215 ) );
	    return false;
	}
	
	// Valida data de registro
	if ( !ILO_Util_Geral::checkDate( $student->getFinishDate() ) ) {
	    
	    $this->setError( ILO_Util_Translate::get( 'Data final inválida', 216 ) );
	    return false;
	}

	return true;
    }
    
    /**
     *
     * @return bool
     */
    public function saveEndereco()
    {
	$addressGeneralDAO = new Model_DAO_AddressGeneral();

	$addressGeneralDAO->beginTransaction();
	try {

	    $where = array( 'fk_id_student_class' => $this->_data['id_student_class'] );
	    
	    $addressGeneralVO = $addressGeneralDAO->fetchRow( $where );
	    
	    if ( empty( $addressGeneralVO ) ) {
		
		$this->_data['fk_id_student_class'] = $this->_data['id_student_class'];

		$addressGeneralVO = new Model_VO_AddressGeneral();
		
		$addressGeneralVO->setValues( $this->_data );
		$addressGeneralVO->setType( 'PRINCIPAL' );

		// Insere endereço da turma de treinamento
		$addressGeneralDAO->insert( $addressGeneralVO );
		
	    } else {
		
		// Atualiza endereco do treinamento
		$addressGeneralVO->setValues( $this->_data );
		$addressGeneralDAO->update( $addressGeneralVO, $where );
	    }

	    // Salva auditoria
	    $studentClassDAO = new Model_DAO_StudentClass();
	    $vo = $studentClassDAO->fetchRow( array( 'id_student_class' => $this->_data['id_student_class'] ) );
	    
	    $description = 'ATUALIZA TURMA TREINAMENTU: %s HAKAT 2 – HELA FATIN';
	    $this->audit( sprintf( $description, $vo->getNumeroTurma() ), self::SALVAR );
	
	    $addressGeneralDAO->commit();
	    return $this->_data['id_student_class'];
	
	} catch ( Exception $e ) {
	    
	    $addressGeneralDAO->rollBack();
	   
	    return false;
	}
    }
    
    /**
     *
     * @return bool
     */
    public function saveTurma()
    {
	$studentClassHasCourseDAO = new Model_DAO_StudentClassHasCourse();
	$studentClassHasCourseVO = new Model_VO_StudentClassHasCourse();

	$studentClassHasCourseDAO->beginTransaction();
	try {
	    
	    $studentClassHasTrainerDAO = new Model_DAO_StudentClassHasTrainer();
	    
	    // Remove todos os treinadores vinculados a turma
	    $where = array( 'fk_id_student_class' => $this->_data['id_student_class'] );
	    $studentClassHasTrainerDAO->delete( $where );
	    
	    $studentClassHasTrainerVO = new Model_VO_StudentClassHasTrainer();
	    
	    // Insere treinador principal
	    $studentClassHasTrainerVO->setFkIdStudentClass( $this->_data['id_student_class'] );
	    $studentClassHasTrainerVO->setFkIdTrainer( $this->_data['fk_id_trainer_prin'] );
	    $studentClassHasTrainerVO->setTrainerType( 'MAIN' );
	    $studentClassHasTrainerDAO->insert( $studentClassHasTrainerVO );

	    // Se tiverem treinadores secundarios para serem inseridos
	    if ( !empty( $this->_data['fk_id_trainer_sec'] ) ) {
		
		foreach ( $this->_data['fk_id_trainer_sec'] as $trainer ) {

		    // Insere treinador assistente
		    $studentClassHasTrainerVO->setFkIdStudentClass( $this->_data['id_student_class'] );
		    $studentClassHasTrainerVO->setFkIdTrainer( $trainer );
		    $studentClassHasTrainerVO->setTrainerType( 'ASSIS' );
		    $studentClassHasTrainerDAO->insert( $studentClassHasTrainerVO );
		}
	    }
	    
	    if ( empty( $this->_data['units_competency'] ) )
		$this->_data['units_competency'] = array();
	    
	    // Busca unidades de competencia ja vinculadas com a turma
	    $unidadesTurma = $studentClassHasCourseDAO->fetchAll( array(), $where );
	    $dataCompetency = array();
	    foreach ( $unidadesTurma as $unidade )
		$dataCompetency[] = $unidade->getFkIdUnitCompetency()->getIdUnitCompetency();
	    
	    $deleteCompetency = array_diff( $dataCompetency, $this->_data['units_competency'] );
	    $insertCompetency = array_diff( $this->_data['units_competency'], $dataCompetency );
	    
	    $classTestDAO = new Model_DAO_ClassTest();
	    
	    // Remove pre/pos teste das unidades de competencia que nao estao mais na turma
	    foreach ( $deleteCompetency as $unitCompetency ) {
		
		// Remove testes desta unidade de competencia
		$whereDelTest = array(
		    'fk_id_student_class'   =>	$this->_data['id_student_class'],
		    'fk_id_unit_competency' =>	$unitCompetency
		);
		
		$classTestDAO->delete( $whereDelTest );
		
		$whereDelCompetency = array( 
		    'fk_id_unit_competency' => $unitCompetency,
		    'fk_id_student_class'   => $this->_data['id_student_class']
		);
		
		// Remove todas unidades de competencia
		$studentClassHasCourseDAO->delete( $whereDelCompetency );
	    }

	    // Insere novas unidades de competencia da turma
	    foreach ( $insertCompetency as $unitCompetency ) {
		
		$vo = clone $studentClassHasCourseVO;
		
		$vo->setFkIdStudentClass( $this->_data['id_student_class'] );
		$vo->setFkIdCourse( $this->_data['fk_id_course'] );
		$vo->setFkIdUnitCompetency( $unitCompetency );
		
		$studentClassHasCourseDAO->insert( $vo );
	    }
	    
	    // Salva auditoria
	    $studentClassDAO = new Model_DAO_StudentClass();
	    $vo = $studentClassDAO->fetchRow( array( 'id_student_class' => $this->_data['id_student_class'] ) );
	    
	    $description = 'ATUALIZA TURMA TREINAMENTU: %s  HAKAT 3 – KURSO BA TURMA';
	    $this->audit( sprintf( $description, $vo->getNumeroTurma() ), self::SALVAR );
	    
	    $studentClassHasCourseDAO->commit();
	    return $this->_data['id_student_class'];
	
	} catch ( Exception $e ) {
	    
	    $studentClassHasCourseDAO->rollBack();
	    
	    return false;
	}
    }
    
    
    /**
     *
     * @return type 
     */
    public function saveAssessment()
    {
	$classTestDAO = new Model_DAO_ClassTest();

	$classTestDAO->beginTransaction();
	try {
	    
	    $whereDel = array(
		'fk_id_student_class'	=>  $this->_data['id_student_class'],
		'fk_id_client'		=>  $this->_data['fk_id_client'],
	    );
	    
	    $classTestVO = new Model_VO_ClassTest();
	    
	    foreach ( $this->_data['assessment'] as $key => $assessment ) {
		
		// Remove teste do participante
		$whereDel['type'] = strtoupper( $key );
		$classTestDAO->delete( $whereDel );
		
		$vo = clone $classTestVO;
		$vo->setValues(
		    array(
			'fk_id_student_class'	    =>  $this->_data['id_student_class'],
			'fk_id_client'		    =>  $this->_data['fk_id_client'],
			'fk_id_course'		    =>  $this->_data['fk_id_course'],
			'fk_id_unit_competency'	    =>  $this->_data['unit_competency'],
			'score'			    =>  $assessment,
			'type'			    =>  strtoupper( $key )
		    )
		);
		
		$classTestDAO->insert( $vo );
	    }
	    
	    // Salva auditoria
	    $studentClassDAO = new Model_DAO_StudentClass();
	    $vo = $studentClassDAO->fetchRow( array( 'id_student_class' => $this->_data['id_student_class'] ) );
	    
	    $description = 'ATUALIZA TURMA TREINAMENTU: %s  HAKAT 5 – ASSESSMENT';
	    $this->audit( sprintf( $description, $vo->getNumeroTurma() ), self::SALVAR );
	    
	    $classTestDAO->commit();
	    return $this->_data['id_student_class'];
	
	} catch ( Exception $e ) {
	    
	    $classTestDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @return type 
     */
    public function saveTestclass()
    {
	$testClassDAO = new Model_DAO_TestClass();

	$testClassDAO->beginTransaction();
	try {
	    
	    $this->_data['fk_id_student_class'] = $this->_data['id_student_class'];
	    
	    $where = array(
		'fk_id_student_class' => $this->_data['id_student_class'],
		'fk_id_client'	      => $this->_data['fk_id_client']
	    );
	    
	    $testClassVO = $testClassDAO->fetchRow( $where );
	    
	    if ( !empty( $this->_data['optional'] ) ) {
		foreach ( $this->_data['optional'] as $field => $value )
		    $this->_data[$field] = null;
	    }
	    
	    // Verifica se participante ja fez teste
	    if ( empty( $testClassVO ) ) {
	    
		// Insere o teste do participante
		$testClassVO = new Model_VO_TestClass();
		$testClassVO->setValues( $this->_data );

		$testClassDAO->insert( $testClassVO );
	    
	    } else {
		
		$testClassVO->setValues( $this->_data );
		$testClassDAO->update( $testClassVO, $where );
	    }
	    
	    // Salva auditoria
	    $studentClassDAO = new Model_DAO_StudentClass();
	    $vo = $studentClassDAO->fetchRow( array( 'id_student_class' => $this->_data['id_student_class'] ) );
	    
	    
	    $description = 'ATUALIZA TURMA TREINAMENTU: %s  HAKAT 5 – TESTE CLASSROOM';
	    $this->audit( sprintf( $description, $vo->getNumeroTurma() ), self::SALVAR );
	    
	    $testClassDAO->commit();
	    return $this->_data['id_student_class'];
	
	} catch ( Exception $e ) {
	    
	    $testClassDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @return type 
     */
    public function savePracticalTraining()
    {
	$practicalTrainingDAO = new Model_DAO_PracticalTraining();

	$practicalTrainingDAO->beginTransaction();
	try {
	    
	    $this->_data['fk_id_student_class'] = $this->_data['id_student_class'];
	    
	     $where = array(
		'fk_id_student_class' => $this->_data['id_student_class'],
		'fk_id_client'	      => $this->_data['fk_id_client']
	    );
	    
	    $practicalTrainingVO = $practicalTrainingDAO->fetchRow( $where );
	    
	    if ( !empty( $this->_data['optional'] ) ) {
		foreach ( $this->_data['optional'] as $field => $value )
		    $this->_data[$field] = null;
	    }
	    
	    if ( is_null($this->_data['road_construction'] ) && is_null($this->_data['discipline'] ) )
		$this->_data['final_score'] = null;
			
	    // Verifica se participante ja fez teste
	    if ( empty( $practicalTrainingVO ) ) {
	    
		// Insere o teste do participante
		$practicalTrainingVO = new Model_VO_PracticalTraining();
		$practicalTrainingVO->setValues( $this->_data );

		$practicalTrainingDAO->insert( $practicalTrainingVO );
	    
	    } else {
		
		$practicalTrainingVO->setValues( $this->_data );
		$practicalTrainingDAO->update( $practicalTrainingVO, $where );
	    }
	    
	    // Salva auditoria
	    $studentClassDAO = new Model_DAO_StudentClass();
	    $vo = $studentClassDAO->fetchRow( array( 'id_student_class' => $this->_data['id_student_class'] ) );
	    
	    $description = 'ATUALIZA TURMA TREINAMENTU: %s  HAKAT 6 – PRACTICAL TRAINING';
	    $this->audit( sprintf( $description, $vo->getNumeroTurma() ), self::SALVAR );
	    
	    $practicalTrainingDAO->commit();
	    return $this->_data['id_student_class'];
	
	} catch ( Exception $e ) {
	    
	    $practicalTrainingDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @return type 
     */
    public function saveAttendence()
    {
	$attendenceDAO = new Model_DAO_Attendence();

	$attendenceDAO->beginTransaction();
	try {
	    
	    $this->_data['fk_id_student_class'] = $this->_data['id_student_class'];
	    
	     $where = array(
		'fk_id_student_class' => $this->_data['id_student_class'],
		'fk_id_client'	      => $this->_data['fk_id_client'],
		'type'		      => $this->_data['type']
	    );
	     
	     foreach ( $this->_data as $key => $value ) {
		 $key = str_replace('_class', '', $key);
		 $this->_data[$key] = $value;
	     }
	     
	    $attendenceVO = $attendenceDAO->fetchRow( $where );
	    
	    // Verifica se participante ja fez teste
	    if ( empty( $attendenceVO ) ) {
	    
		// Insere o teste do participante
		$attendenceVO = new Model_VO_Attendence();
		$attendenceVO->setValues( $this->_data );

		$attendenceDAO->insert( $attendenceVO );
	    
	    } else {
		
		$attendenceVO->setValues( $this->_data );
		$attendenceDAO->update( $attendenceVO, $where );
	    }
	    
	    // Salva auditoria
	    $studentClassDAO = new Model_DAO_StudentClass();
	    $vo = $studentClassDAO->fetchRow( array( 'id_student_class' => $this->_data['id_student_class'] ) );
	    
	    $description = 'ATUALIZA TURMA TREINAMENTU: %s  HAKAT 7 – ATTENDENCE';
	    $this->audit( sprintf( $description, $vo->getNumeroTurma() ), self::SALVAR );
	    
	    $attendenceDAO->commit();
	    return $this->_data['id_student_class'];
	
	} catch ( Exception $e ) {
	    
	    $attendenceDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @return type 
     */
    public function saveTeste()
    {
	$classTestDAO = new Model_DAO_ClassTest();

	$classTestDAO->beginTransaction();
	try {
	    
	    $whereDel = array(
		'type'			=>  $this->_data['type'],
		'fk_id_student_class'	=>  $this->_data['id_student_class'],
		'fk_id_client'		=>  $this->_data['fk_id_client'],
	    );
	    
	    // remove os testes já efetuados para esse cliente
	    $classTestDAO->delete( $whereDel );
	    
	    $classTestVO = new Model_VO_ClassTest();
	    
	    foreach ( $this->_data['competency'] as $key => $competency ) {
		
		$vo = clone $classTestVO;
		$vo->setValues(
		    array(
			'fk_id_student_class'	    =>  $this->_data['id_student_class'],
			'fk_id_client'		    =>  $this->_data['fk_id_client'],
			'fk_id_course'		    =>  $this->_data['fk_id_course'],
			'fk_id_unit_competency'	    =>  $competency,
			'score'			    =>  $this->_data['score_competency'][$key],
			'type'			    =>  $this->_data['type']
		    )
		);
		
		$classTestDAO->insert( $vo );
	    }
	    
	    // Salva auditoria
	    $studentClassDAO = new Model_DAO_StudentClass();
	    $vo = $studentClassDAO->fetchRow( array( 'id_student_class' => $this->_data['id_student_class'] ) );
	    
	    $description = 'ATUALIZA TURMA TREINAMENTU: %s  HAKAT 6 – TESTS';
	    $this->audit( sprintf( $description, $vo->getNumeroTurma() ), self::SALVAR );
	    
	    $classTestDAO->commit();
	    return $this->_data['id_student_class'];
	
	} catch ( Exception $e ) {
	    
	    $classTestDAO->rollBack();
	    
	    return false;
	}
    }
    
    /**
     *
     * @return bool
     */
    public function saveParticipantes()
    {
	$studentClassHasClientDAO = new Model_DAO_StudentClassHasClient();
	$studentClassHasClientVO = new Model_VO_StudentClassHasClient();

	$studentClassHasClientDAO->beginTransaction();
	try {
	    
	    // Lista estudantes ja inseridos na turma
	    $students = $studentClassHasClientDAO->fetchAll( array(), array( 'fk_id_student_class' => $this->_data['id'] ) );
	    
	    $existentes = array();
	    foreach ( $students as $student )
		$existentes[] = $student->getFkIdClient()->getIdClient();
	    
	    // Verifica os que ainda não existem na turma
	    $novos = array_diff( $this->_data['students'], $existentes );
	    
	    // Se nao tiver diferença
	    if ( empty( $novos ) ) {

		$this->setError( ILO_Util_Translate::get( 'Todos participantes selecionados já estão na turma', 217 ) );
		return false;
	    }
	    
	    $studentClassDAO = new Model_DAO_StudentClass();
	    
	    // Busca total de alunos configurados a turma
	    $totalAlunos = $studentClassDAO->fetchRow( array( 'id_student_class' => $this->_data['id'] ) )->getTotalStudent();
	    $total = count( $novos ) + count( $existentes );
	    
	    // Verifica se total ultrapassa quantidade definida
	    if ( $total > $totalAlunos ) {
		
		$this->setError( ILO_Util_Translate::get( 'Quantidade de participantes ultrapassa a definida. Verifique.', 218 ) );
		return false;
	    }

	    // Insere participantes na turma
	    foreach ( $novos as $student ) {
		
		$vo = clone $studentClassHasClientVO;
		
		$vo->setFkIdStudentClass( $this->_data['id'] );
		$vo->setFkIdClient( $student );
		
		$studentClassHasClientDAO->insert( $vo );
	    }
	    
	     // Salva auditoria
	    $studentClassDAO = new Model_DAO_StudentClass();
	    $vo = $studentClassDAO->fetchRow( array( 'id_student_class' => $this->_data['id'] ) );
	    
	    $description = 'ATUALIZA TREINAMENTU: %s HAKAT 4 – LISTA PARTISIPANTE';
	    $this->audit( sprintf( $description, $vo->getNumeroTurma() ), self::SALVAR );
	    
	    $studentClassHasClientDAO->commit();
	    return $this->_data['id'];
	
	} catch ( Exception $e ) {
	    
	    $studentClassHasClientDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @return bool
     */
    public function removeParticipantes()
    {
	$studentClassHasClientDAO = new Model_DAO_StudentClassHasClient();

	$studentClassHasClientDAO->beginTransaction();
	try {
	    
	    $classTestDAO = new Model_DAO_ClassTest();

	    // Remove participantes da turma
	    foreach ( $this->_data['students'] as $student ) {
		
		$where = array(
		    'fk_id_client'	    => $student,
		    'fk_id_student_class'   => $this->_data['id']
		);
		
		// Remove todos os testes do participante nesta turma
		$classTestDAO->delete( $where );
		// Remove participante da turma
		$studentClassHasClientDAO->delete( $where );
	    }
	    
	    // Busca turma para auditoria
	    $studentClassDAO = new Model_DAO_StudentClass();
	    $studentClassVO = $studentClassDAO->fetchRow( array( 'id_student_class' => $this->_data['id'] ) );
	    
	    $description = 'ATUALIZA TREINAMENTU: %s HAKAT 4 – LISTA PARTISIPANTE';
	    $this->audit( sprintf( $description, $studentClassVO->getNumeroTurma() ), self::SALVAR );
	    
	    $studentClassHasClientDAO->commit();
	    return $this->_data['id'];
	
	} catch ( Exception $e ) {
	    
	    $studentClassHasClientDAO->rollBack();
	    
	    return false;
	}
    }
    
    /**
     *
     * @return array
     */
    public function searchAssessment()
    {
	$classTestDAO = new Model_DAO_ClassTest();
	
	$where = array(
	    'fk_id_student_class'   => $this->_data['student_class'],
	    'fk_id_client'	    => $this->_data['client'],
	    'type IN( "ASS_K", "ASS_P", "ASS_R" )'
	);
	
	$rows = $classTestDAO->fetchAll( array(), $where );
	
	$data = array();
	foreach ( $rows as $row ) {
	    
	    $data[] = array(
		'type'	=>  strtoupper( $row->getType() ),
		'score'	=>  $row->getScore()
	    );
	}
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function searchTestClass()
    {
	$cliClientDAO = new Model_DAO_CliClient();
	$cliClientVO = $cliClientDAO->fetchRow( array( 'id_client' => $this->_data['client'] ) ) ;
	
	$testClassDAO = new Model_DAO_TestClass();
	
	$where = array(
	    'fk_id_student_class'   => $this->_data['student_class'],
	    'fk_id_client'	    => $this->_data['client']
	);
	
	$row = $testClassDAO->fetchRow( $where );
	
	$nomeClient = $cliClientVO->getNumeroCliente() . '-' . $cliClientVO->getFirstName() . ' ' . $cliClientVO->getLastName();
	
	$retorno = array(
	    'test'	    => empty( $row ) ? array() : $row->toArray(),
	    'participant'   => $nomeClient
	);
	
	return $retorno;
    }
    
    /**
     *
     * @return array
     */
    public function searchPracticalTraninig()
    {
	$cliClientDAO = new Model_DAO_CliClient();
	$cliClientVO = $cliClientDAO->fetchRow( array( 'id_client' => $this->_data['client'] ) ) ;
	
	$practicalTrainingDAO = new Model_DAO_PracticalTraining();
	
	$where = array(
	    'fk_id_student_class'   => $this->_data['student_class'],
	    'fk_id_client'	    => $this->_data['client']
	);
	
	$row = $practicalTrainingDAO->fetchRow( $where );
	
	$nomeClient = $cliClientVO->getNumeroCliente() . '-' . $cliClientVO->getFirstName() . ' ' . $cliClientVO->getLastName();
	
	$retorno = array(
	    'test'	    => empty( $row ) ? array() : $row->toArray(),
	    'participant'   => $nomeClient
	);
	
	return $retorno;
    }
    
    /**
     *
     * @return array
     */
    public function searchAttendence()
    {
	$cliClientDAO = new Model_DAO_CliClient();
	$cliClientVO = $cliClientDAO->fetchRow( array( 'id_client' => $this->_data['client'] ) ) ;
	
	$attendenceDAO = new Model_DAO_Attendence();
	
	$where = array(
	    'fk_id_student_class'   => $this->_data['student_class'],
	    'fk_id_client'	    => $this->_data['client']
	);
	
	$rows = $attendenceDAO->fetchAll( array(), $where );
	
	$nomeClient = $cliClientVO->getNumeroCliente() . '-' . $cliClientVO->getFirstName() . ' ' . $cliClientVO->getLastName();
	
	$tests = array();
	foreach ( $rows as $row )
	    $tests[] = $row->toArray();
	
	$retorno = array(
	    'test'	    => $tests,
	    'participant'   => $nomeClient
	);
	
	return $retorno;
    }
    
    /**
     *
     * @return array
     */
    public function searchTests()
    {
	$retorno =  array(
	    'error'	=> false,
	    'msg'	=> '',
	    'media'	=> 0,
	    'unidades'	=> array()
	);
	
	$classTestDAO = new Model_DAO_ClassTest();
	
	// Se o teste tiver pre requisito
	if ( !empty( $this->_tests[$this->_data['type']] ) ) {
	    
	    $pre = $this->_tests[$this->_data['type']];
	    
	    $filter = array(
		'fk_id_student_class'	=>  $this->_data['id'],
		'fk_id_client'		=>  $this->_data['cli'],
		'type'			=>  $pre
	    );
	    
	    $tests = $classTestDAO->fetchAll( array(), $filter );
	    
	    // Se nao tiver testes de pre requisito
	    if ( empty( $tests ) ) {
		
		$retorno['error'] = true;
		$retorno['msg'] = ILO_Util_Translate::get( 'Execute o teste anterior primeiro', 258 );
		return $retorno;
	    }
	}
	
	$tests = $classTestDAO->searchUnitiesWithTests( $this->_data['id'], $this->_data['type'], $this->_data['cli'] );
	
	foreach ( $tests as $test ) {
	    
	    $retorno['unidades'][] = array(
		'id'		=>  $test['id_unit_competency'],
		'competency'	=>  $test['name_unit'],
		'score'		=>  $test['score']
	    );
	    
	    $retorno['media'] += $test['score'];
	}
	
	$retorno['media'] = round( $retorno['media'] / count( $tests ), 1 );
	
	return $retorno;
    }
    
    /**
     *
     * @return bool
     */
    public function saveEvolucao()
    {
	$classEvaluationDAO = new Model_DAO_ClassEvaluation();
	$classEvaluationDAO->beginTransaction();
	try {
	    
	    // Remove o teste de evolucao ja feito para a turma
	    $where = array( 'fk_id_student_class' => $this->_data['id_student_class'] );
	    $classEvaluationDAO->delete( $where );
	    
	    // Insere testes de evolucao
	    $classEvaluationVO = new Model_VO_ClassEvaluation();
	    foreach ( $this->_data['score'] as $order => $scores ) {
		foreach ( $scores as $level => $score ) {
		    
		    $vo = clone $classEvaluationVO;
		    $vo->setValues(
			array(
			    'fk_id_student_class'   => $this->_data['id_student_class'],
			    'level_evaluation'	    => $level,
			    'order_evaluation'	    => $order,
			    'score'		    => empty( $score ) ? 0 : $score,
			)
		    );
		    
		    $classEvaluationDAO->insert( $vo );
		}
	    }
	    
	    // Busca turma para auditoria
	    $studentClassDAO = new Model_DAO_StudentClass();
	    $studentClassVO = $studentClassDAO->fetchRow( array( 'id_student_class' => $this->_data['id_student_class'] ) );
	    
	    $description = 'ATUALIZA TREINAMENTU: %s HAKAT 7 – EVALUASAUN';
	    $this->audit( sprintf( $description, $studentClassVO->getNumeroTurma() ), self::SALVAR );
	    
	    $classEvaluationDAO->commit();
	    return $this->_data['id_student_class'];
	
	} catch ( Exception $e ) {
	    
	    $classEvaluationDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @return boolean 
     */
    public function saveFinaliza()
    {
	$studentClassDAO = new Model_DAO_StudentClass();
	$studentClassDAO->beginTransaction();
	try {
	    
	    $where = array( 'id_student_class' => $this->_data['id_student_class'] );
	    $studentClassVO = $studentClassDAO->fetchRow( $where );
	    $studentClassVO->setActive( 'I' );
	    
	    $studentClassDAO->update( $studentClassVO, $where );
	    
	    $description = 'ATUALIZA TREINAMENTU: %s HAKAT 9 – REMATA TURMA';
	    $this->audit( sprintf( $description, $studentClassVO->getNumeroTurma() ), self::SALVAR );
	    
	    $studentClassDAO->commit();
	    return $this->_data['id_student_class'];
	
	} catch ( Exception $e ) {
	    
	    $studentClassDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @param int $id
     * @return array
     */
    public function listEvolucao( $id )
    {
	$classEvaluationDAO = new Model_DAO_ClassEvaluation();
	$evaluations = $classEvaluationDAO->fetchAll( array( 'order_evaluation' ), array( 'fk_id_student_class' => $id ) );
	
	$data = array();
	foreach ( $evaluations as $row )
	    $data[$row->getOrderEvaluation()][$row->getLevelEvaluation()] = $row->getScore();
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function verificaFinalizacao()
    {
	try {
	    
	    $retorno = array(
		'valid'	    => true,
		'criterios' => array()
	    );
	    
	    $validators = array(
			'_validaDataFinal',
			'_validaCompetenciaCurso',
			'_validaQtdeParticipantes',
			//'_validaAssessment',
			//'_validaPreTest',
			//'_validaPosTest',
	    );
	    
	    $courseDAO = new Model_DAO_Course();
	    $courseVO = $courseDAO->fetchRow(array('id_course' => $this->_data['fk_id_course']));
	    
	    if ( $courseVO->getCertificate() ) {
		
			$validators[] = '_validaTestClass';
			$validators[] = '_validaPracticalTraining';
			$validators[] = '_validaAttendence';
			$validators[] = '_validaEvolucao';
	    }
	    
	    // Valida o fechamento da turma
	    foreach ( $validators as $validator ) {
		
			$valid = call_user_func( array( $this, $validator ) );
			$retorno['criterios'][] = $valid;
			
			if ( empty( $valid['valid'] ) )
			    $retorno['valid'] = false;
	    } 
	    
	    return $retorno;
	
	} catch ( Exception $e ) {
	    
	    return false;
	}
    }
    
    /**
     *
     * @return array
     */
    protected function _validaDataFinal()
    {
	$retorno = array(
	   'msg'    => ILO_Util_Translate::get( 'Loron (Data) Planu Ramata Turma', 490 ),
	   'valid'  => true
	);
	    
	// Valida data final do curso
	if ( strtotime( $this->_data['finish_date'] ) > time() )
	    $retorno['valid'] = false;
	
	return $retorno;
    }
    
    /**
     *
     * @return array
     */
    protected function _validaCompetenciaCurso()
    {
		$unitCompetencyHasCourse = new Model_DAO_UnitCompetencyHasCourse();
		$hasCompetency = $unitCompetencyHasCourse->fetchAll(array(), array('fk_id_course' => $this->_data['fk_id_course']));
		
		$retorno = array(
		   'msg'    => ILO_Util_Translate::get( 'Iha Rejistu Kursu nia Kompetensia (?)', 491 ),
		   'valid'  => true
		);

		if ( empty( $hasCompetency ) )
			return $retorno;

		// Busca cursos e competencia
		$studentClassHasCourseDAO = new Model_DAO_StudentClassHasCourse();
		$courses = $studentClassHasCourseDAO->fetchAll( array(), array( 'fk_id_student_class' => $this->_data['id_student_class'] ) );

		// Se nao tiver cursos e competencias
		if ( empty( $courses ) )
		    $retorno['valid'] = false;
		
		return $retorno;
    }
    
    /**
     *
     * @return array
     */
    protected function _validaQtdeParticipantes()
    {
	$retorno = array(
	   'msg'    => ILO_Util_Translate::get( 'Iha Rejistu Partisipante Sira Kompleto (?)', 492 ),
	   'valid'  => true
	);
	
	$totalParticipantes = $this->_data['total_student'];
	
	$studentClassHasClientDAO = new Model_DAO_StudentClassHasClient();
	$clients = $studentClassHasClientDAO->fetchAll( array(), array( 'fk_id_student_class' => $this->_data['id_student_class'] ) );

	// Se o total de participantes definidos forem diferentes dos inseridos
	if ( $totalParticipantes != count( $clients ) )
	    $retorno['valid'] = false;
	
	return $retorno;
    }
    
    /**
     *
     * @return array
     */
    protected function _validaAssessment()
    {
	$retorno = array(
	   'msg'    => ILO_Util_Translate::get( 'Verifique o performance assessment para todos os participantes', 493 ),
	   'valid'  => true
	);
	
	$classTestDAO = new Model_DAO_ClassTest();
	$tests = array(
	    'ASS_K',
	    'ASS_P',
	    'ASS_R',
	);
	
	// Valida tests de assessment
	foreach ( $tests as $test ) {
	    
	    // Verifica se todos os participantes tem o teste em especifico
	    $validTests = $classTestDAO->verificaTestClient( $this->_data['id_student_class'], $test );
	    if ( !empty( $validTests ) ) {
		
		$retorno['valid'] = false;
		break;
	    }
	}
	
	return $retorno;
    }
    
    /**
     *
     * @return array
     */
    protected function _validaTestClass()
    {
	$retorno = array(
	   'msg'    => ILO_Util_Translate::get( 'Verifique o Test Class para todos os participantes', 519 ),
	   'valid'  => true
	);
	
	$testClassDAO = new Model_DAO_TestClass();
	
	// Verifica se todos os participantes tem o testClass
	$validTests = $testClassDAO->verificaTestClient( $this->_data['id_student_class'] );
	if ( !empty( $validTests ) )
	    $retorno['valid'] = false;
	
	return $retorno;
    }
    
    /**
     *
     * @return array
     */
    protected function _validaPracticalTraining()
    {
	$retorno = array(
	   'msg'    => ILO_Util_Translate::get( 'Verifique o Practical Training para todos os participantes', 520 ),
	   'valid'  => true
	);
	
	$practicalTrainingDAO = new Model_DAO_PracticalTraining();
	
	// Verifica se todos os participantes tem o Practical training
	$validTests = $practicalTrainingDAO->verificaPracticalTrainingClient( $this->_data['id_student_class'] );
	if ( !empty( $validTests ) )
	    $retorno['valid'] = false;
	
	return $retorno;
    }
    
    /**
     *
     * @return array
     */
    protected function _validaAttendence()
    {
	$retorno = array(
	   'msg'    => ILO_Util_Translate::get( 'Verifique o Attendence para todos os participantes', 521 ),
	   'valid'  => true
	);
	
	$attendenceDAO = new Model_DAO_Attendence();
	
	// Verifica se todos os participantes tem o Attedence
	$validTests = $attendenceDAO->verificaAttendenceClient( $this->_data['id_student_class'] );
	if ( !empty( $validTests ) )
	    $retorno['valid'] = false;
	
	return $retorno;
    }
    
    /**
     *
     * @return array
     */
    protected function _validaPreTest()
    {
	$retorno = array(
	   'msg'    => ILO_Util_Translate::get( 'Iha Rejistu Pre - Test (?)', 494 ),
	   'valid'  => true
	);
	
	$classTestDAO = new Model_DAO_ClassTest();
	
	// Verifica se todos os participantes tem o preteste
	$validTests = $classTestDAO->verificaTestClient( $this->_data['id_student_class'], 'PRE' );
	if ( !empty( $validTests ) )
	    $retorno['valid'] = false;
	
	return $retorno;
    }
    
    /**
     *
     * @return array
     */
    protected function _validaPosTest()
    {
	$retorno = array(
	   'msg'    => ILO_Util_Translate::get( 'Iha Rejistu Pos - Test (?)', 495 ),
	   'valid'  => true
	);
	
	$classTestDAO = new Model_DAO_ClassTest();
	
	// Verifica se todos os participantes tem o preteste
	$validTests = $classTestDAO->verificaTestClient( $this->_data['id_student_class'], 'POS' );
	if ( !empty( $validTests ) )
	    $retorno['valid'] = false;
	
	return $retorno;
    }
    
    /**
     *
     * @return array
     */
    protected function _validaEvolucao()
    {
	$retorno = array(
	   'msg'    => ILO_Util_Translate::get( 'Iha Rejistu Evaluasaum Treinamentu (?)', 496 ),
	   'valid'  => true
	);
	
	$classEvaluationDAO = new Model_DAO_ClassEvaluation();
	
	// Valida se foi feito teste de evolucao pra turma
	$evaluation = $classEvaluationDAO->fetchAll( array(), array( 'fk_id_student_class' => $this->_data['id_student_class'] ) );
	if ( empty( $evaluation ) )
	    $retorno['valid'] = false;
	
	// Valida se o teste de evolucao bate com o total de participantes
	$totalEvaluation = $classEvaluationDAO->validaTotalEvaluation( $this->_data['id_student_class'] );
	if ( !empty( $totalEvaluation ) )
	    $retorno['valid'] = false;
	
	return $retorno;
    }
}