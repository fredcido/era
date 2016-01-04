<?php

class Me_Controller_QuestionnaireConfig extends ILO_Controller_Padrao
{

    /**
     *
     * @var array
     */
    protected $_accessMapping = array(
	'salvar' => array(
	    'form',
	    'questiontext',
	    'questionoption',
	    'listquestion',
	    'loadoptions',
	    'option',
	    'save'
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
	$quesitonnaireConfigDAO = new Model_DAO_QuestionnaireConfig();
	$rows = $quesitonnaireConfigDAO->fetchAll( array( 'title' ) );

	$dataJson['rows'] = array();

	if ( !empty( $rows ) ) {

	    foreach ( $rows as $key => $row ) {

		$dataJson['rows'][] = array(
		    'id' => $row->getIdQuestionnaireConfig(),
		    'data' => array(
			$row->getIdQuestionnaireConfig(),
			$row->getTitle()
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
	$id = $this->getParam( 'id' );
	
	if ( !empty( $id ) ) {
	    
	    $vo = $questionnaireConfigDAO->fetchRow( array( 'id_questionnaire_config' => $id ) );
	    $data = $vo->toArray();
	}
		
	$this->view->data = json_encode( $data );
    }
    
    /**
     * 
     */
    public function saveAction()
    {
	$questionnaireConfigBO = new Model_BO_QuestionnaireConfig();
	$questionnaireConfigBO->setData( $this->getParams() );

	$idSnapshot = $questionnaireConfigBO->save();
	if ( $idSnapshot ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idSnapshot;
	    
	} else {
	 
	    $retorno['msg'] = $questionnaireConfigBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function questiontextAction()
    {
	$this->view->renderLayout( false );
	$data =  array();
	
	$id = $this->getParam( 'id' );
	if ( !empty( $id ) ) {
	    
	    $textQuestionDAO = new Model_DAO_TextQuestion();
	    $vo = $textQuestionDAO->fetchRow( array( 'id_text_question' => $id ) );
	    $data = $vo->toArray();
	}
	
	$this->view->data = $data;
    }
    
    /**
     * 
     */
    public function questionoptionAction()
    {
	$this->view->renderLayout( false );
	
	$data =  array();
	
	$id = $this->getParam( 'id' );
	if ( !empty( $id ) ) {
	    
	    $optionQuestionDAO = new Model_DAO_OptionQuestion();
	    $vo = $optionQuestionDAO->fetchRow( array( 'id_option_question' => $id ) );
	    $data = $vo->toArray();
	}
	
	$this->view->data = $data;
    }
    
    /**
     * 
     */
    public function optionAction()
    {
	$this->view->renderLayout( false );
	$this->view->order = $this->getParam( 'order' );
	
	$data =  array();
	
	$this->view->data = $data;
    }
    
    public function loadoptionsAction()
    {
	$this->view->renderLayout( false );
	
	$id = $this->getParam( 'id' );
	
	$optionQuestionDAO = new Model_DAO_OptionQuestion();
	$vo = $optionQuestionDAO->fetchRow( array( 'id_option_question' => $id ) );
	$row = $vo->toArray();
	
	$optionsQuestionDAO = new Model_DAO_OptionsQuestion();
	$this->view->options = $optionsQuestionDAO->fetchAll(array(), array( 'fk_id_option_question' => $id ) );
	$this->view->row = $row;
    }
    
    public function listquestionAction()
    {
	$id = $this->getParam( 'id' );
	
	$textQuestionDAO = new Model_DAO_TextQuestion();
	$optionQuestionDAO = new Model_DAO_OptionQuestion();
	
	$where = array( 'fk_id_questionnaire_config' => $id );
	
	$questions = array();
	
	$textQuestions = $textQuestionDAO->fetchAll( array( 'order_question' ), $where );
	$optionQuestions = $optionQuestionDAO->fetchAll( array( 'order_question' ), $where );
	
	foreach ( $textQuestions as $question ) {
	    
	    $questions[$question->getOrderQuestion()] = array(
		'id'	=> $question->getIdTextQuestion(),
		'type'	=> 'T'
	    );
	}
	
	foreach ( $optionQuestions as $question ) {
	    
	    $questions[$question->getOrderQuestion()] = array(
		'id'	=> $question->getIdOptionQuestion(),
		'type'	=> 'O'
	    );
	}
	
	ksort( $questions );
	
	echo json_encode( $questions );
	exit;
    }
}