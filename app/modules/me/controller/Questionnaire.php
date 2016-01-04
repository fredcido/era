<?php

class Me_Controller_Questionnaire extends ILO_Controller_Padrao
{

    /**
     *
     * @var array
     */
    protected $_accessMapping = array(
	'salvar' => array(
	    'form',
	    'save',
	    'subdistritos',
	    'sukus',
	    'getquestionnaire'
	),
	'consultar' => array(
	    'index'
	)
    );

    /**
     * 
     */
    public function indexAction()
    {
	$questionnaireDAO = new Model_DAO_Questionnaire();
	$rows = $questionnaireDAO->fetchAll( array( 'identifier' ) );

	$dataJson['rows'] = array();

	if ( !empty( $rows ) ) {

	    foreach ( $rows as $key => $row ) {

		$dataJson['rows'][] = array(
		    'id' => $row->getIdQuestionnaire(),
		    'data' => array(
			$row->getIdQuestionnaire(),
			$row->getIdentifier(),
			$row->getFkIdQuestionnaireConfig()->getTitle(),
			$row->getFkIdAddDistrict()->getDistrict(),
			$row->getFkIdAddSubdistrict()->getSubdistrict(),
			$row->getFkIdSuku()->getSuku(),
			$row->getRoadLocation()
		    )
		);
	    }
	}

	$this->view->rows = json_encode( $dataJson );
    }

    /**
     * 
     */
    public function formAction()
    {
	$data = array();
	
	$questionnaireConfigDAO = new Model_DAO_QuestionnaireConfig();
	$this->view->questions = $questionnaireConfigDAO->fetchAll( array( 'title' ) );
	
	 $districtDAO = new Model_DAO_AddDistrict();
        $this->view->distritos = $districtDAO->fetchAll( array( 'district' ) );
	
	$questionnaireDAO = new Model_DAO_Questionnaire();
	
	$id = $this->getParam( 'id' );
	
	if ( !empty( $id ) ) {
	    
	    $vo = $questionnaireDAO->fetchRow( array( 'id_questionnaire' => $id ) );
	    $data = $vo->toArray();
	    $data['date_registration'] = ILO_Util_Geral::dateToBr( $data['date_registration'] );
	}
		
	$this->view->data = json_encode( $data );
    }
    
    /**
     * 
     */
    public function saveAction()
    {
	$questionnaireBO = new Model_BO_Questionnaire();
	$questionnaireBO->setData( $this->getParams() );

	$idSnapshot = $questionnaireBO->save();
	if ( $idSnapshot ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idSnapshot;
	    
	} else {
	 
	    $retorno['msg'] = $questionnaireBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
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
 
    public function getquestionnaireAction()
    {
	$this->view->renderLayout( false );
	
	$questionnaireConfigDAO = new Model_BO_QuestionnaireConfig();
	$this->view->questions = $questionnaireConfigDAO->getListQuestions( $this->getParam( 'quest' ) );
	
	$answer = array();
	$id = $this->getParam( 'id' );
	if ( !empty( $id ) ) {
	    
	    $questionnaireBO = new Model_BO_Questionnaire();
	    $answer = $questionnaireBO->getAnswer( $id );
	}
	
	$this->view->answer = $answer;
    }
}