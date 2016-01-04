<?php

class Treinamento_Controller_Curso extends ILO_Controller_Padrao
{
    /**
     *
     * @var array
     */
    protected $_accessMapping = array(
	'salvar'    =>	array(
	    'save',
	    'cadastro',
            'editar',
            'savecompetency',
            'listunitcompetency',
            'removeunit',
	),
	'consultar' =>	array(
	    'index'
	)
    );
    
    /**
     * 
     */
    public function init()
    {
    }
    
    /**
     * 
     */
    public function indexAction()
    {
	$courseDAO = new Model_DAO_Course();
	$courses = $courseDAO->fetchAll( array( 'course' ) );
        
	$dataJson['rows'] = array();
        
        if ( !empty( $courses ) ) {

            foreach ( $courses as $key => $course ) {
                
                $dataJson['rows'][] = array(
                   'id'     => $course->getIdCourse(),
                    'data'  => array(
                        ++$key,
                        $course->getCourse(),
                        $course->getAcronym(),
                        $course->getCertificate() ? ILO_Util_Translate::get('Sim', 86) : ILO_Util_Translate::get('Não', 87),
                    )
                );
            }
        }
	
	$this->view->data = json_encode( $dataJson );
    }
    
    
    public function saveAction()
    {
	$courseBO = new Model_BO_Course();
	$courseBO->setData( $this->getParams() );

	$id = $courseBO->save();
	if ( $id ) {
	    $retorno['error'] = false;
	    $retorno['id'] = $id;
	} else {
	    $retorno['error'] = true;
	    $retorno['msg'] = $courseBO->getError();
	}

	echo json_encode( $retorno );
	exit;
    }
    
    public function cadastroAction()
    {
    }
    
    /**
     * 
     */
    public function editarAction()
    {
	$id = $this->getParam( 'id' );
	
	$courseDAO = new Model_DAO_Course();
	$courseVO = $courseDAO->fetchRow( array( 'id_course' => $id ) );
	
        $data = $courseVO->toArray();
        
	$this->view->dadosForm = $data;
	$this->view->renderNewView( 'cadastro' );
	
	$this->_getUnitCompetency();
	$this->_getUnitCourse( $id );
    }
    
    /**
     * 
     */
    protected function _getUnitCompetency()
    {
	$dataJson['rows'] = array();
        
	$unitDAO = new Model_DAO_UnitCompetency();
	$unitsVO = $unitDAO->fetchAll(array( 'name_unit' ));
	
        if ( !empty( $unitsVO ) ) {

            foreach ( $unitsVO as $key => $unit ) {
                
                $dataJson['rows'][] = array(
                   'id'     => $unit->getIdUnitCompetency(),
                    'data'  => array(
                        ++$key,
			0,
                        sprintf('%s', $unit->getCodUnit()),
                        $unit->getNameUnit(),
                    )
                );
            }
        }
	
	$this->view->unit_competency = json_encode( $dataJson );
    }
    
    /**
     * 
     */
    protected function _getUnitCourse($id)
    {
	$dataJson['rows'] = array();
        
	$unitCourseDAO = new Model_DAO_UnitCompetencyHasCourse();
	$unitsCourseVO = $unitCourseDAO->fetchAll(array(), array('fk_id_course' => $id));
	
        if ( !empty( $unitsCourseVO ) ) {

            foreach ( $unitsCourseVO as $key => $unitCourse ) {
		
		$unit = $unitCourse->getFkIdUnitCompetency();
                
                $dataJson['rows'][] = array(
                   'id'     => $unit->getIdUnitCompetency(),
                    'data'  => array(
                        ++$key,
			0,
                        sprintf('%s', $unit->getCodUnit()),
                        $unit->getNameUnit(),
                    )
                );
            }
        }
	
	$this->view->unit_course = json_encode( $dataJson );
    }
    
    /**
     * 
     */
    public function savecompetencyAction()
    {
	$courseBO = new Model_BO_Course();
	$courseBO->setData( $this->getParams() );

	$idCourse = $courseBO->saveCompetency();
	if ( $idCourse ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idCourse;
	    
	} else {
	 
	    $retorno['msg'] = $courseBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    public function listunitcompetencyAction()
    {
	$id = $this->getParam( 'id' );
	
	$dataJson['rows'] = array();
        
	$unitCourseDAO = new Model_DAO_UnitCompetencyHasCourse();
	$unitsCourseVO = $unitCourseDAO->fetchAll(array(), array('fk_id_course' => $id));
	
        if ( !empty( $unitsCourseVO ) ) {

            foreach ( $unitsCourseVO as $key => $unitCourse ) {
		
		$unit = $unitCourse->getFkIdUnitCompetency();
                
                $dataJson['rows'][] = array(
                   'id'     => $unit->getIdUnitCompetency(),
                    'data'  => array(
                        ++$key,
			0,
                        sprintf('%s', $unit->getCodUnit()),
                        $unit->getNameUnit(),
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
    public function removeunitAction()
    {
	$courseBO = new Model_BO_Course();
	$courseBO->setData( $this->getParams() );

	if ( $courseBO->removeUnit() )
	    $retorno['error'] = false;
	else {
	 
	    $retorno['msg'] = $courseBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
}