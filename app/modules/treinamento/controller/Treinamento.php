<?php

class Treinamento_Controller_Treinamento extends ILO_Controller_Padrao
{ 
    /**
     *
     * @var array
     */
    protected $_accessMapping = array(
	'salvar'    =>	array(
	    'cadastro',
	    'turma',
	    'endereco',
	    'saveendereco',
	    'savegeral',
	    'saveturma',
	    'saveteste',
	    'saveparticipantes',
	    'subdistritos',
	    'sukus',
	    'participantes',
	    'unidadescompentencia',
	    'listparticipantes',
	    'removeparticipantes',
	    'buscaparticipantes',
	    'teste',
	    'searchtest',
	    'assessment',
	    'saveassessment',
	    'saveevolucao',
	    'searchassessment',
	    'finaliza',
	    'evolucao',
	    'savefinaliza',
	    'testclass',
	    'searchtestclass',
	    'savetestclass',
	    'practicaltraining',
	    'searchpracticaltraining',
	    'savepracticaltraining',
	    'attendence',
	    'searchattendence',
	    'saveattendence'
	),
	'consultar' =>	array(
	    'index'
	)
    );
    
    /**
     *
     * @var array
     */
    protected $_abas = array(
	array(
	    'label'	=>  'Informação Geral',
	    'id'	=>  51,
	    'url'	=>  '/treinamento/treinamento/cadastro/id/',
	    'liberado'	=>  true,
	    'action'	=>  'cadastro',
	    'selected'	=>  true,
	    'require'	=>  'id_student_class'
	),
	array(
	    'label'	=>  'Endereço',
	    'id'	=>  53,
	    'url'	=>  '/treinamento/treinamento/endereco/id/',
	    'liberado'	=>  false,
	    'action'	=>  'endereco',
	    'require'	=>  'id_student_class'
	),
	array(
	    'label'	=>  'Curso da turma',
	    'id'	=>  158,
	    'url'	=>  '/treinamento/treinamento/turma/id/',
	    'liberado'	=>  false,
	    'action'	=>  'turma',
	    'require'	=>  'id_student_class'
	),
	array(
	    'label'	=>  'Lista de participante',
	    'id'	=>  159,
	    'url'	=>  '/treinamento/treinamento/participantes/id/',
	    'liberado'	=>  false,
	    'action'	=>  'participantes',
	    'require'	=>  'fk_id_course'
	),
//	array(
//	    'label'	=>  'Assessment',
//	    'id'	=>  488,
//	    'url'	=>  '/treinamento/treinamento/assessment/id/',
//	    'liberado'	=>  false,
//	    'action'	=>  'assessment',
//	    'require'	=>  'fk_id_client'
//	),
//	array(
//	    'label'	=>  'Testes',
//	    'id'	=>  160,
//	    'url'	=>  '/treinamento/treinamento/teste/id/',
//	    'liberado'	=>  false,
//	    'action'	=>  'teste',
//	    'require'	=>  'fk_id_client'
//	),
	array(
	    'label'	=>  'Teste',
	    'id'	=>  160,
	    'url'	=>  '/treinamento/treinamento/testclass/id/',
	    'liberado'	=>  false,
	    'action'	=>  'testclass',
	    'require'	=>  'fk_id_client'
	),
	array(
	    'label'	=>  'Practical Training',
	    'id'	=>  528,
	    'url'	=>  '/treinamento/treinamento/practicaltraining/id/',
	    'liberado'	=>  false,
	    'action'	=>  'practicaltraining',
	    'require'	=>  'fk_id_client'
	),
	array(
	    'label'	=>  'Attendence',
	    'id'	=>  529,
	    'url'	=>  '/treinamento/treinamento/attendence/id/',
	    'liberado'	=>  false,
	    'action'	=>  'attendence',
	    'require'	=>  'fk_id_client'
	),
	array(
	    'label'	=>  'Evolução',
	    'id'	=>  489,
	    'url'	=>  '/treinamento/treinamento/evolucao/id/',
	    'liberado'	=>  false,
	    'action'	=>  'evolucao',
	    'require'	=>  'fk_id_client'
	),
	array(
	    'label'	=>  'Finalização',
	    'id'	=>  161,
	    'url'	=>  '/treinamento/treinamento/finaliza/id/',
	    'liberado'	=>  false,
	    'action'	=>  'finaliza',
	    'require'	=>  'fk_id_client'
	)
    );
    
    /**
     *
     * @var string
     */
    protected $_action;
    
    /**
     * 
     */
    public function init()
    {
	$this->view->action = ILO_Router_Dispatcher::getAction();
    }
    
    /**
     *
     * @param array $data 
     */
    protected function _liberaAbas( array $data = null )
    {
	if ( !empty( $data ) ) {
	    	    
	    foreach ( $this->_abas as $key => $aba ) {

		$this->_abas[$key]['url'] .= $data['id_student_class'];
		
		if ( !empty( $data[$aba['require']] ) )
		    $this->_abas[$key]['liberado'] = true;
		
		$this->_abas[$key]['selected'] = $aba['action'] == $this->view->action ? true : false;
	    }
	    
	}
	
	// Pega codigo da turma para ser mostrado
	if ( !empty( $data['id_student_class'] ) ) {
	   
	    $studentClassDAO = new Model_DAO_StudentClass();
	    $studentClassVO = $studentClassDAO->fetchRow( array( 'id_student_class' => $data['id_student_class'] ) );
	    
	    $this->view->numero_turma = $studentClassVO->getNumeroTurma();
	    $this->view->finalizada = $studentClassVO->getActive() == 'I';
	}
	
	$this->view->renderNewView( 'formulario' );
	$this->view->abas =  $this->_abas;
    }
    
     /**
     * 
     */
    public function indexAction()
    {
	$studentClassDAO = new Model_DAO_StudentClass();
	$classes = $studentClassDAO->fetchAll( array( 'num_course','num_year','num_title','num_sequence') );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $classes ) ) {

            foreach ( $classes as $key => $class ) {
                
		$status =   $class->getActive() == 'A' ?
			    ILO_Util_Translate::get( 'Ativo', 88 ) :
			    ILO_Util_Translate::get( 'Inativo', 89 );
			 
		
                $dataJson['rows'][] = array(
                   'id'     => $class->getIdStudentClass(),
                    'data'  => array(
                        ++$key,
                        $class->getNumeroTurma(),
                        $class->getClassName(),
                        $class->getTotalStudent(),
			$status
                    )
                );
            }
        }
	
	$this->view->data = json_encode( $dataJson );
    }
    
    /**
     * 
     */
    public function cadastroAction()
    {
	$class = $this->getParam( 'id' );
	
	// Lista distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->districts = $districtDAO->fetchAll( 'district' );
	
	$courseDAO = new Model_DAO_Course();
	$coursesVO = $courseDAO->fetchAll();
	
	$courses = array();
	foreach ( $coursesVO as $course ) {
	    
	    $label = sprintf('%s - %s', $course->getAcronym(), $course->getCourse());
	    $courses[$course->getIdCourse()] = $label;
	}
	
	$this->view->courses = $courses;
        
        $data = array();
       
	if ( !empty( $class ) ) {
	    
	    $studentClassDAO = new Model_DAO_StudentClass();
	    $vo = $studentClassDAO->fetchRow( array( 'id_student_class' => $class ) );
	    
	    if ( empty( $vo ) )
		$this->redirect ( '/treinamento/treinamento/cadastro' );
	
	    $data = $this->_studentClassVoToData( $vo );
	    
	    $this->view->altera = true;
	}
	
	$this->view->data = json_encode( $data );
        $this->_liberaAbas( $data );
    }
    
    /**
     *
     * @param Model_VO_StudentClass $vo
     * @return array
     */
    protected function _studentClassVoToData( Model_VO_StudentClass $vo )
    {
	$data = $vo->toArray();
			
	// Valores para popular formulario

	// data de inicio
	$data['start_date'] = ILO_Util_Geral::dateToBr( $data['start_date'] );
	// data de termino
	$data['finish_date'] = ILO_Util_Geral::dateToBr( $data['finish_date'] );
	
	// Busca se a turma ja tem cursos cadastrados
	//$studentClassHasCourseDAO = new Model_DAO_StudentClassHasCourse();
	//$course = $studentClassHasCourseDAO->fetchAll( array(), array( 'fk_id_student_class' => $vo->getIdStudentClass() ) );
	//$data['fk_id_course'] = !empty( $course );
	
	// Busca se a turma ja tem participantes
	$studentClassHasClientDAO = new Model_DAO_StudentClassHasClient();
	$client = $studentClassHasClientDAO->fetchAll( array(), array( 'fk_id_student_class' => $vo->getIdStudentClass() ) );
	$data['fk_id_client'] = !empty( $client );
	
	// Evolucao da turma
	$classEvaluationDAO = new Model_DAO_ClassEvaluation();
	$evaluation = $classEvaluationDAO->fetchAll( array(), array( 'fk_id_student_class' => $vo->getIdStudentClass() ) );
	$data['id_class_evaluation'] = !empty( $evaluation );
	
	return $data;
    }
    
    /**
     * 
     */
    public function savegeralAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$studentClassBO->setData( $this->getParams() );

	$idStudentClass = $studentClassBO->saveGeral();
	if ( $idStudentClass ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idStudentClass;
	    
	} else {
	 
	    $retorno['msg'] = $studentClassBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function enderecoAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/treinamento/treinamento/cadastro' );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	$studentClassVO = $studentClassDAO->fetchRow( array( 'id_student_class' => $id ) );
	
	if ( empty( $studentClassVO ) )
	    $this->redirect ( '/treinamento/treinamento/cadastro' );
	
	$data['id_student_class'] = $studentClassVO->getIdStudentClass();
	
	// Busca endereco cadastrado para o treinamento
	$addressGeneralDAO = new Model_DAO_AddressGeneral();
	$addressGeneralVO = $addressGeneralDAO->fetchRow( array( 'fk_id_student_class' => $id ) );
	
	if ( !empty( $addressGeneralVO ))
	    $data = $data + $addressGeneralVO->toArray();
	
	$this->view->data = json_encode( $data );
	
	// Busca distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->distritos = $districtDAO->fetchAll( array( 'district' ), array( 'fk_id_add_country' => 1 ) );
	
	$this->_liberaAbas( $this->_studentClassVoToData( $studentClassVO ) );
    }
    
    /**
     * 
     */
    public function saveenderecoAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$studentClassBO->setData( $this->getParams() );

	$idStudentClass = $studentClassBO->saveEndereco();
	if ( $idStudentClass ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idStudentClass;
	    
	} else {
	 
	    $retorno['msg'] = $studentClassBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function turmaAction()
    {
	$id = $this->getParam( 'id' );
	
	if ( empty( $id ) )
	    $this->redirect ( '/treinamento/treinamento/cadastro' );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	$studentClassVO = $studentClassDAO->fetchRow( array( 'id_student_class' => $id ) );
	
	$courseVO = $studentClassVO->getFkIdCourse();
	$this->view->course = $courseVO;
	
	// Lista treinadores
	$trainerDAO = new Model_DAO_Trainer();
	$this->view->trainers = $trainerDAO->fetchAll( array( 'name_trainer' ) );
	
	if ( empty( $studentClassVO ) )
	    $this->redirect ( '/treinamento/treinamento/cadastro' );
	
	$data = $this->_studentClassVoToData( $studentClassVO );
	$data['fk_id_course'] = $this->view->course->getIdCourse();
	
	// Busca unidades de competencia ja cadastrados
	$studentClassHasCourse = new Model_DAO_StudentClassHasCourse();
	$units = $studentClassHasCourse->fetchAll( array(), array( 'fk_id_student_class' => $id ) );
	
	$dataUnits = array();
	foreach ( $units as $unit )
	    $dataUnits[] = $unit->getFkIdUnitCompetency()->getIdUnitCompetency();
	
	$studentClassHasTrainerDAO = new Model_DAO_StudentClassHasTrainer();
	
	// Busca se a turma ja tem treinador principal
	$studentClassHasTrainerMain = $studentClassHasTrainerDAO->fetchRow( array( 'fk_id_student_class' => $id, 'trainer_type' => 'MAIN' ) );
	if ( !empty( $studentClassHasTrainerMain ) )
	    $data['fk_id_trainer_prin'] = $studentClassHasTrainerMain->getFkIdTrainer()->getIdTrainer();
	
	$studentClassHasTrainerAss = $studentClassHasTrainerDAO->fetchAll( array(), array( 'fk_id_student_class' => $id, 'trainer_type' => 'ASSIS' ) );
	$assistentes = array();
	foreach ( $studentClassHasTrainerAss as $trainer )
	    $assistentes[] = $trainer->getFkIdTrainer()->getIdTrainer();
	
	$this->view->assistentes = $assistentes;
	$this->view->units = json_encode( $dataUnits );
	$this->view->data = json_encode( $data );
	
	$this->_liberaAbas( $this->_studentClassVoToData( $studentClassVO ) );
    }
    
    /**
     * 
     */
    public function participantesAction()
    {
	$id = $this->getParam( 'id' );
	
	if ( empty( $id ) )
	    $this->redirect ( '/treinamento/treinamento/cadastro' );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	$studentClassVO = $studentClassDAO->fetchRow( array( 'id_student_class' => $id ) );
	
	if ( empty( $studentClassVO ) )
	    $this->redirect ( '/treinamento/treinamento/cadastro' );
	
	$dataForm = $studentClassVO->toArray();
	
	$this->view->data = json_encode( $dataForm );
	$this->view->id = $id;
	
	$this->_liberaAbas( $this->_studentClassVoToData( $studentClassVO ) );
    }
    
    public function listparticipantesAction()
    {
	$id = $this->getParam( 'id' );
	
	// Lista participantes ja vinculados a turma
	$studentHasClientDAO = new Model_DAO_StudentClassHasClient();
	$clients = $studentHasClientDAO->fetchAll( array(), array( 'fk_id_student_class' => $id ) );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $clients ) ) {

            foreach ( $clients as $key => $client ) {
		
		$participante = $client->getFkIdClient();
		
		$sexo = $participante->getGender() == 'Mane' ?
			$this->view->t( 'Masculino', 83 ) :
			$this->view->t( 'Feminino', 84 );
		
		$numero = str_replace( '-', '', $client->getFkIdStudentClass()->getNumeroTurma() )
			  . '-' 
			  . str_replace( '-', '', $participante->getNumeroCliente() );
		
                $dataJson['rows'][] = array(
                   'id'     => $participante->getIdClient(),
                    'data'  => array(
                        ++$key,
			0,
                        $participante->getFirstName() . ' ' . $participante->getLastName(),
			$numero,
			$sexo,
                    )
                );
            }
        }
	
	echo json_encode( $dataJson );
	exit;
    }
    
    /**
     * 
     */
    public function subdistritosAction()
    {
	$distrito = $this->getParam( 'id' );
	
	$subdistritoDAO = new Model_DAO_AddSubdistrict();
	$subdistritoVO = $subdistritoDAO->fetchAll( array( 'subdistrict' ), array( 'fk_id_add_district' => $distrito ) );
	
	$data = array();
	foreach ( $subdistritoVO as $subdistrito ) {
	    
	    $data[] = array(
		'id'	=> $subdistrito->getIdAddSubdistrict(),
		'name'	=> $subdistrito->getSubdistrict(),
	    );
	}
	
	echo json_encode( $data );
	exit;
    }
    
    /**
     * 
     */
    public function sukusAction()
    {
	$subdistrito = $this->getParam( 'id' );
	
	$sukuDAO = new Model_DAO_AddSuku();
	$sukuVO = $sukuDAO->fetchAll( array( 'suku' ), array( 'fk_id_add_subdistrict' => $subdistrito ) );
	
	$data = array();
	foreach ( $sukuVO as $suku ) {
	    
	    $data[] = array(
		'id'	=> $suku->getIdSuku(),
		'name'	=> $suku->getSuku(),
	    );
	}
	
	echo json_encode( $data );
	exit;
    }
    
    /**
     * 
     */
    public function unidadescompentenciaAction()
    {
	$course = $this->getParam( 'id' );
	
	$unitCompetencyHasCourseDAO = new Model_DAO_UnitCompetencyHasCourse();
	$unitCompetencyHasCourseVO = $unitCompetencyHasCourseDAO->fetchAll( array(), array( 'fk_id_course' => $course ) );

    var_dump($unitCompetencyHasCourseVO);
	
	$data = array();
	foreach ( $unitCompetencyHasCourseVO as $unitCompetency ) {
	    
	    $unit = $unitCompetency->getFkIdUnitCompetency();
	    
	    $cod = $unit->getCodUnit();
	    $label = sprintf('(%s) - %s', $cod, $unit->getNameUnit() );
	    if ( empty($cod) )
		$label = $unit->getNameUnit();
	    
	    $data[] = array(
		'id'	=> $unit->getIdUnitCompetency(),
		'name'	=> $label,
	    );
	}
	
	echo json_encode( $data );
	exit;
    }
    
    /**
     * 
     */
    public function saveturmaAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$studentClassBO->setData( $this->getParams() );

	$idStudentClass = $studentClassBO->saveTurma();
	if ( $idStudentClass ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idStudentClass;
	    
	} else {
	 
	    $retorno['msg'] = $studentClassBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function savetesteAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$studentClassBO->setData( $this->getParams() );

	if ( $studentClassBO->saveTeste() ) {
	  
	    $retorno['error'] = false;
	    
	} else {
	 
	    $retorno['msg'] = $studentClassBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function saveparticipantesAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$studentClassBO->setData( $this->getParams() );

	$idStudentClass = $studentClassBO->saveParticipantes();
	if ( $idStudentClass ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idStudentClass;
	    
	} else {
	 
	    $retorno['msg'] = $studentClassBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function removeparticipantesAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$studentClassBO->setData( $this->getParams() );

	if ( $studentClassBO->removeParticipantes() )
	    $retorno['error'] = false;
	else {
	 
	    $retorno['msg'] = $studentClassBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function testeAction()
    {
	$id = $this->getParam( 'id' );
	
	if ( empty( $id ) )
	    $this->redirect( '/treinamento/treinamento/cadastro' );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	$studentClassVO = $studentClassDAO->fetchRow( array( 'id_student_class' => $id ) );
	
	if ( empty( $studentClassVO ) )
	    $this->redirect( '/treinamento/treinamento/cadastro' );
	
	$dataForm = $studentClassVO->toArray();
	
	// Lista participantes
	$studentClassHasClient = new Model_DAO_StudentClassHasClient();
	$clients = $studentClassHasClient->fetchAll( array(), array( 'fk_id_student_class' => $id ) );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $clients ) ) {
	    
            foreach ( $clients as $key => $client ) {
		
		$client = $client->getFkIdClient();
		
		$sexo = $client->getGender() == 'Mane' ?
			$this->view->t( 'Masculino', 83 ) :
			$this->view->t( 'Feminino', 84 );
			
		
                $dataJson['rows'][] = array(
                   'id'     => $client->getIdClient(),
                    'data'  => array(
                        ++$key,
                        $client->getFirstName(),
                        $client->getLastName(),
			$client->getNumeroCliente(),
			$sexo,
                    )
                );
            }
        }
	
	// Busca nome do curso
	$studentClassHasCourseDAO = new Model_DAO_StudentClassHasCourse();
	$studentClassHasCourseVO = $studentClassHasCourseDAO->fetchAll( array(), array( 'fk_id_student_class' => $id ) );
	
	$dataForm['fk_id_course'] = $studentClassHasCourseVO[0]->getFkIdCourse()->getIdCourse();
	$dataForm['course'] = $studentClassHasCourseVO[0]->getFkIdCourse()->getCourse();
	
	$this->view->data = json_encode( $dataForm );
	$this->view->participantes = json_encode( $dataJson );
	$this->_liberaAbas( $this->_studentClassVoToData( $studentClassVO ) );
    }
    
    /**
     * 
     */
    public function assessmentAction()
    {
	$id = $this->getParam( 'id' );
	
	if ( empty( $id ) )
	    $this->redirect( '/treinamento/treinamento/cadastro' );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	$studentClassVO = $studentClassDAO->fetchRow( array( 'id_student_class' => $id ) );
	
	if ( empty( $studentClassVO ) )
	    $this->redirect( '/treinamento/treinamento/cadastro' );
	
	$dataForm = $studentClassVO->toArray();
	
	// Lista participantes
	$studentClassHasClient = new Model_DAO_StudentClassHasClient();
	$clients = $studentClassHasClient->fetchAll( array(), array( 'fk_id_student_class' => $id ) );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $clients ) ) {
	    
            foreach ( $clients as $key => $client ) {
		
		$client = $client->getFkIdClient();
		
		$sexo = $client->getGender() == 'Mane' ?
			$this->view->t( 'Masculino', 83 ) :
			$this->view->t( 'Feminino', 84 );
		
                $dataJson['rows'][] = array(
                   'id'     => $client->getIdClient(),
                    'data'  => array(
                        ++$key,
                        $client->getFirstName(),
                        $client->getLastName(),
			$client->getNumeroCliente(),
			$sexo,
                    )
                );
            }
        }
	
	// Busca nome do curso
	$studentClassHasCourseDAO = new Model_DAO_StudentClassHasCourse();
	$studentClassHasCourseVO = $studentClassHasCourseDAO->fetchAll( array(), array( 'fk_id_student_class' => $id ) );
	
	$dataForm['fk_id_course'] = $studentClassHasCourseVO[0]->getFkIdCourse()->getIdCourse();
	$dataForm['course'] = $studentClassHasCourseVO[0]->getFkIdCourse()->getCourse();
	$dataForm['unit_competency'] = $studentClassHasCourseVO[0]->getFkIdUnitCompetency()->getIdUnitCompetency();
	
	$this->view->data = json_encode( $dataForm );
	$this->view->participantes = json_encode( $dataJson );
	$this->_liberaAbas( $this->_studentClassVoToData( $studentClassVO ) );
    }
    
    /**
     * 
     */
    public function saveassessmentAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$studentClassBO->setData( $this->getParams() );

	if ( $studentClassBO->saveAssessment() ) {
	  
	    $retorno['error'] = false;
	    
	} else {
	 
	    $retorno['msg'] = $studentClassBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function savetestclassAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$studentClassBO->setData( $this->getParams() );

	if ( $studentClassBO->saveTestclass() ) {
	  
	    $retorno['error'] = false;
	    
	} else {
	 
	    $retorno['msg'] = $studentClassBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function savepracticaltrainingAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$studentClassBO->setData( $this->getParams() );

	if ( $studentClassBO->savePracticalTraining() ) {
	  
	    $retorno['error'] = false;
	    
	} else {
	 
	    $retorno['msg'] = $studentClassBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function saveattendenceAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$studentClassBO->setData( $this->getParams() );

	if ( $studentClassBO->saveAttendence() ) {
	  
	    $retorno['error'] = false;
	    
	} else {
	 
	    $retorno['msg'] = $studentClassBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function searchtestAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$retorno = $studentClassBO->setData( $this->getParams() )->searchTests();

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function searchpracticaltrainingAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$retorno = $studentClassBO->setData( $this->getParams() )->searchPracticalTraninig();

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function searchattendenceAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$retorno = $studentClassBO->setData( $this->getParams() )->searchAttendence();
        
	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function searchassessmentAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$retorno = $studentClassBO->setData( $this->getParams() )->searchAssessment();
	
	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function searchtestclassAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$retorno = $studentClassBO->setData( $this->getParams() )->searchTestClass();
	
	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function buscaparticipantesAction()
    {
	// Lista participantes
	$clientDAO = new Model_BO_CliClient();
	$clients = $clientDAO->setData( $this->getParams() )->searchClients();
	
	$dataJson['rows'] = array();
        
        if ( !empty( $clients ) ) {
	    
            foreach ( $clients as $key => $client ) {
		
		$sexo = $client->getGender() == 'Mane' ?
			$this->view->t( 'Masculino', 83 ) :
			$this->view->t( 'Feminino', 84 );
			
		
                $dataJson['rows'][] = array(
                   'id'     => $client->getIdClient(),
                    'data'  => array(
                        ++$key,
			0,
                        $client->getFirstName(),
                        $client->getLastName(),
			$client->getNumeroCliente(),
			$sexo,
                    )
                );
            }
        }
	
	echo json_encode( $dataJson );
	exit;
    }
    
    /**
     * 
     */
    public function evolucaoAction()
    {
	$id = $this->getParam( 'id' );
	
	if ( empty( $id ) )
	    $this->redirect( '/treinamento/treinamento/cadastro' );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	$studentClassVO = $studentClassDAO->fetchRow( array( 'id_student_class' => $id ) );
	
	if ( empty( $studentClassVO ) )
	    $this->redirect( '/treinamento/treinamento/cadastro' );
	
	$dataForm = $studentClassVO->toArray();
	
	// Busca nome do curso
	//$studentClassHasCourseDAO = new Model_DAO_StudentClassHasCourse();
	//$studentClassHasCourseVO = $studentClassHasCourseDAO->fetchAll( array(), array( 'fk_id_student_class' => $id ) );
	
	$dataForm['course'] = $studentClassVO->getFkIdCourse()->getCourse();
	
	$this->view->data = json_encode( $dataForm );
	$this->_liberaAbas( $this->_studentClassVoToData( $studentClassVO ) );
	
	$this->view->levels = array(
		'DIAL',
		'DIAK',
		'SUFIS',
		'LADIA'
	);
	
	$studentClassBO = new Model_BO_StudentClass();
	$this->view->tests = $studentClassBO->listEvolucao( $id );
    }
    
    /**
     * 
     */
    public function saveevolucaoAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$studentClassBO->setData( $this->getParams() );

	if ( $studentClassBO->saveEvolucao() )
	    $retorno['error'] = false;
	else {
	 
	    $retorno['msg'] = $studentClassBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function finalizaAction()
    {
    	$id = $this->getParam( 'id' );
    	
    	if ( empty( $id ) )
    	    $this->redirect( '/treinamento/treinamento/cadastro' );
    	
    	$studentClassDAO = new Model_DAO_StudentClass();
    	$studentClassVO = $studentClassDAO->fetchRow( array( 'id_student_class' => $id ) );
    	
    	if ( empty( $studentClassVO ) )
    	    $this->redirect( '/treinamento/treinamento/cadastro' );
    	
    	$dataForm = $studentClassVO->toArray();
    	
    	$studentClassBO = new Model_BO_StudentClass();
    	
    	$this->view->data = json_encode( $dataForm );
    	$this->view->criterios = $studentClassBO->setData( $dataForm )->verificaFinalizacao();

    	$this->_liberaAbas( $this->_studentClassVoToData( $studentClassVO ) );
    }
    
    /**
     * 
     */
    public function savefinalizaAction()
    {
	$studentClassBO = new Model_BO_StudentClass();
	$studentClassBO->setData( $this->getParams() );

	if ( $studentClassBO->saveFinaliza() )
	    $retorno['error'] = false;
	else {
	 
	    $retorno['msg'] = $studentClassBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function testclassAction()
    {
	$id = $this->getParam( 'id' );
	
	if ( empty( $id ) )
	    $this->redirect( '/treinamento/treinamento/cadastro' );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	$studentClassVO = $studentClassDAO->fetchRow( array( 'id_student_class' => $id ) );
	
	if ( empty( $studentClassVO ) )
	    $this->redirect( '/treinamento/treinamento/cadastro' );
	
	$dataForm = $studentClassVO->toArray();
	
	// Lista participantes
	$studentClassHasClient = new Model_DAO_StudentClassHasClient();
	$clients = $studentClassHasClient->fetchAll( array(), array( 'fk_id_student_class' => $id ) );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $clients ) ) {
	    
            foreach ( $clients as $key => $client ) {
		
		$participante = $client->getFkIdClient();
		
		$sexo = $participante->getGender() == 'Mane' ?
			$this->view->t( 'Masculino', 83 ) :
			$this->view->t( 'Feminino', 84 );
		
		$numero = str_replace( '-', '', $client->getFkIdStudentClass()->getNumeroTurma() )
			  . '-' 
			  . str_replace( '-', '', $participante->getNumeroCliente() );
		
                $dataJson['rows'][] = array(
                   'id'     => $participante->getIdClient(),
                    'data'  => array(
                        ++$key,
                        $participante->getFirstName() . ' ' . $participante->getLastName(),
			$numero,
			$sexo,
                    )
                );
            }
        }
	
	// Busca nome do curso
	$dataForm['course'] = $studentClassVO->getFkIdCourse()->getCourse();
	
	$this->view->data = json_encode( $dataForm );
	$this->view->participantes = json_encode( $dataJson );
	$this->_liberaAbas( $this->_studentClassVoToData( $studentClassVO ) );
    }
    
    /**
     * 
     */
    public function practicaltrainingAction()
    {
	$id = $this->getParam( 'id' );
	
	if ( empty( $id ) )
	    $this->redirect( '/treinamento/treinamento/cadastro' );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	$studentClassVO = $studentClassDAO->fetchRow( array( 'id_student_class' => $id ) );
	
	if ( empty( $studentClassVO ) )
	    $this->redirect( '/treinamento/treinamento/cadastro' );
	
	$dataForm = $studentClassVO->toArray();
	
	// Lista participantes
	$studentClassHasClient = new Model_DAO_StudentClassHasClient();
	$clients = $studentClassHasClient->fetchAll( array(), array( 'fk_id_student_class' => $id ) );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $clients ) ) {
	    
            foreach ( $clients as $key => $client ) {
		
		$participante = $client->getFkIdClient();
		
		$sexo = $participante->getGender() == 'Mane' ?
			$this->view->t( 'Masculino', 83 ) :
			$this->view->t( 'Feminino', 84 );
		
		$numero = str_replace( '-', '', $client->getFkIdStudentClass()->getNumeroTurma() )
			  . '-' 
			  . str_replace( '-', '', $participante->getNumeroCliente() );
		
                $dataJson['rows'][] = array(
                   'id'     => $participante->getIdClient(),
                    'data'  => array(
                        ++$key,
                        $participante->getFirstName() . ' ' . $participante->getLastName(),
			$numero,
			$sexo,
                    )
                );
            }
        }
	
	// Busca nome do curso
	$dataForm['fk_id_course'] = $studentClassVO->getFkIdCourse()->getIdCourse();
	$dataForm['course'] = $studentClassVO->getFkIdCourse()->getCourse();
	
	$this->view->data = json_encode( $dataForm );
	$this->view->participantes = json_encode( $dataJson );
	$this->_liberaAbas( $this->_studentClassVoToData( $studentClassVO ) );
    }
    
    /**
     * 
     */
    public function attendenceAction()
    {
	$id = $this->getParam( 'id' );
	
	if ( empty( $id ) )
	    $this->redirect( '/treinamento/treinamento/cadastro' );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	$studentClassVO = $studentClassDAO->fetchRow( array( 'id_student_class' => $id ) );
	
	if ( empty( $studentClassVO ) )
	    $this->redirect( '/treinamento/treinamento/cadastro' );
	
	$dataForm = $studentClassVO->toArray();
	
	// Lista participantes
	$studentClassHasClient = new Model_DAO_StudentClassHasClient();
	$clients = $studentClassHasClient->fetchAll( array(), array( 'fk_id_student_class' => $id ) );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $clients ) ) {
	    
            foreach ( $clients as $key => $client ) {
		
		$participante = $client->getFkIdClient();
		
		$sexo = $participante->getGender() == 'Mane' ?
			$this->view->t( 'Masculino', 83 ) :
			$this->view->t( 'Feminino', 84 );
		
		$numero = str_replace( '-', '', $client->getFkIdStudentClass()->getNumeroTurma() )
			  . '-' 
			  . str_replace( '-', '', $participante->getNumeroCliente() );
		
                $dataJson['rows'][] = array(
                   'id'     => $participante->getIdClient(),
                    'data'  => array(
                        ++$key,
                        $participante->getFirstName() . ' ' . $participante->getLastName(),
			$numero,
			$sexo,
                    )
                );
            }
        }
	
	// Busca nome do curso
	$dataForm['fk_id_course'] = $studentClassVO->getFkIdCourse()->getIdCourse();
	$dataForm['course'] = $studentClassVO->getFkIdCourse()->getCourse();
	
	$this->view->data = json_encode( $dataForm );
	$this->view->participantes = json_encode( $dataJson );
	$this->_liberaAbas( $this->_studentClassVoToData( $studentClassVO ) );
    }
}