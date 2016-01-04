<?php

class Model_BO_QuestionnaireConfig extends ILO_Model_BO
{
    /**
     *
     * @return mixed
     */
    public function save()
    {
	$questionnaireConfigDAO = new Model_DAO_QuestionnaireConfig();
	$questionnaireConfigVO = new Model_VO_QuestionnaireConfig();

	$questionnaireConfigDAO->beginTransaction();
	try {
	    
	    $questionnaireConfigVO->setValues( $this->_data );
	    
	    if ( empty( $this->_data['id_questionnaire_config'] ) ) {
		
		$id = $questionnaireConfigDAO->insert( $questionnaireConfigVO );
		$questionnaireConfigVO->setIdQuestionnaireConfig( $id );
	    } else {
		
		$where = array( 'id_questionnaire_config' => $this->_data['id_questionnaire_config'] );
		$questionnaireConfigDAO->update( $questionnaireConfigVO, $where );
		$id = $this->_data['id_questionnaire_config'];
	    }
	    
	    $questions = $this->getQuestions();
	    
	    $this->_saveQuestionsText( $questions, $id );
	    $this->_saveQuestionsOptions( $questions, $id );
	    
	     // Salva auditoria
	    $description = 'REJISTU/ATUALIZA QUESTIONNAIRE CONFIG: ' . $id;
	    $this->audit( $description, self::SALVAR );
	    
	    $questionnaireConfigDAO->commit();
	    return $id;
	    
	} catch ( Exception $e ) {
	    
	    $questionnaireConfigDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @param array $questions
     * @param int $id 
     */
    protected function _saveQuestionsText( $questions, $id )
    {
	$textQuestionDAO = new Model_DAO_TextQuestion();
	$textQuestionVO = new Model_VO_TextQuestion();
	
	$ids = array();
	foreach ( $questions as $question ) {
	    
	    if ( $question['type'] != 'T' ) continue;
	    
	    $vo = clone $textQuestionVO;
	    $vo->setValues( $question );
	    $vo->setFkIdQuestionnaireConfig( $id );
	    
	    if ( empty( $question['id'] ) )
		$ids[] = $textQuestionDAO->insert( $vo );
	    else {
		
		$where = array( 'id_text_question' => $question['id'] );
		$textQuestionDAO->update( $vo, $where );
		$ids[] = $question['id'];
	    }
	}
	
	$textAnswerDAO = new Model_DAO_TextAnswer();
	$questionsBase = $textQuestionDAO->fetchAll(array(), array( 'fk_id_questionnaire_config' => $id ) );
	foreach ( $questionsBase as $question ) {
	    
	    if ( in_array( $question->getIdTextQuestion(), $ids ) )
		continue;
	    
	    $where = array( 'fk_id_text_question' => $question->getIdTextQuestion() );
	    $textAnswerDAO->delete( $where );
	    
	    $where = array( 'id_text_question' => $question->getIdTextQuestion() );
	    $textQuestionDAO->delete( $where );
	}
    }
    
     /**
     *
     * @param array $questions
     * @param int $id 
     */
    protected function _saveQuestionsOptions( $questions, $id )
    {
	$optionQuestionDAO = new Model_DAO_OptionQuestion();
	$optionsQuestionDAO = new Model_DAO_OptionsQuestion();
	$optionQuestionVO = new Model_VO_OptionQuestion();
	$optionsQuestionVO = new Model_VO_OptionsQuestion();
	$optionsAnswerDAO = new Model_DAO_OptionsAnswer();
	
	$ids = array();
	foreach ( $questions as $question ) {
	    
	    if ( $question['type'] != 'O' ) continue;
	    
	    $vo = clone $optionQuestionVO;
	    $vo->setValues( $question );
	    $vo->setFkIdQuestionnaireConfig( $id );
	    
	    if ( empty( $question['id'] ) )
		$question['id'] = $optionQuestionDAO->insert( $vo );
	    else {
		
		$where = array( 'id_option_question' => $question['id'] );
		$optionQuestionDAO->update( $vo, $where );
	    }
	    
	    $ids[] = $question['id'];
	    
	    $options = $this->_data['options'][$question['order_question']];
	    
	    $o = array();
	    foreach ( $options as $label => $values )
		foreach ( $values as $p => $v )
		    $o[$p][$label] = $v;
	    
	    $options = $o;
	    
	    $optionsIds = array();
	    foreach ( $options as $option ) {
		
		$voOption = clone $optionsQuestionVO;
		
		$idOptions = @$option['id_options_question'];
		unset( $option['id_options_question'] );
		
		$voOption->setValues( $option );
		$voOption->setFkIdOptionQuestion( $question['id'] );
		
		if ( empty( $idOptions ) ) {
		    $optionsIds[] = $optionsQuestionDAO->insert( $voOption );
		} else {
		    
		    $where = array( 'id_options_question' => $idOptions );
		    $optionsQuestionDAO->update( $voOption, $where );
		    $optionsIds[] = $idOptions;
		}
	    }
	    
	    $where = array( 'fk_id_option_question' => $question['id'] );
	    $optionsBase = $optionsQuestionDAO->fetchAll( array(), $where );
	    foreach ( $optionsBase as $option ) {
		
		if ( in_array( $option->getIdOptionsQuestion(), $optionsIds ) )
		    continue;
		
		$where = array( 'fk_id_options_question' => $option->getIdOptionsQuestion() );
		$optionsAnswerDAO->delete( $where );
		
		$where = array( 'id_options_question' => $option->getIdOptionsQuestion() );
		$optionsQuestionDAO->delete( $where );
	    }
	}
	
	$optionsAnswerDAO = new Model_DAO_OptionsAnswer();
	$questionsBase = $optionQuestionDAO->fetchAll(array(), array( 'fk_id_questionnaire_config' => $id ) );
	foreach ( $questionsBase as $question ) {
	    
	    if ( in_array( $question->getIdOptionQuestion(), $ids ) )
		continue;
	    
	    $where = array( 'fk_id_option_question' => $question->getIdOptionQuestion() );
	    $optionsAnswerDAO->delete( $where );
	    $optionsQuestionDAO->delete( $where );
	    
	    $where = array( 'id_option_question' => $question->getIdOptionQuestion() );
	    $optionQuestionDAO->delete( $where );
	}
    }
    
    /**
     *
     * @return array
     */
    public function getQuestions()
    {
	$questions = array();
	if ( !empty( $this->_data['question_option'] ) ) {
	    
	    $options = array();
	    foreach ( $this->_data['question_option'] as $label => $itens ) {
		foreach ( $itens as $pos => $value )
		    $options[$pos][$label] = $value;
	    }
	    
	    foreach ( $options as $option ) {
		
		$option['type'] = 'O';
		$questions[$option['order_question']] = $option;
	    }
	}
	
	if ( !empty( $this->_data['question_text'] ) ) {
	    
	    $options = array();
	    foreach ( $this->_data['question_text'] as $label => $itens ) {
		foreach ( $itens as $pos => $value )
		    $options[$pos][$label] = $value;
	    }
	    
	    foreach ( $options as $option ) {
		
		$option['type'] = 'T';
		$questions[$option['order_question']] = $option;
	    }
	}
	
	ksort( $questions );
	
	return $questions;
    }
    
    public function getListQuestions( $id )
    {
	$textQuestionDAO = new Model_DAO_TextQuestion();
	$optionQuestionDAO = new Model_DAO_OptionQuestion();
	$optionsQuestionDAO = new Model_DAO_OptionsQuestion();
	
	$where = array( 'fk_id_questionnaire_config' => $id );
	
	$questions = array();
	
	$textQuestions = $textQuestionDAO->fetchAll( array( 'order_question' ), $where );
	$optionQuestions = $optionQuestionDAO->fetchAll( array( 'order_question' ), $where );
	
	foreach ( $textQuestions as $question ) {
	    
	    $questions[$question->getOrderQuestion()] = array(
		'data'	=> $question->toArray(),
		'type'	=> 'T'
	    );
	}
	
	foreach ( $optionQuestions as $question ) {
	    
	    $whereOption = array( 'fk_id_option_question' => $question->getIdOptionQuestion() );
	    $rows = $optionsQuestionDAO->fetchAll( array( 'title'), $whereOption );
	    
	    $options = array();
	    foreach ( $rows as $row )
		$options[$row->getIdOptionsQuestion()] = $row->getTitle();
	    
	    $questions[$question->getOrderQuestion()] = array(
		'data'	    => $question->toArray(),
		'options'   => $options,
		'type'	    => 'O'
	    );
	}
	
	ksort( $questions );
	
	return $questions;
    }
    
    /**
     *
     * @param int $sysUserId 
     */
    protected function _auditUser( $sysUserId )
    {
	$description = sprintf( $this->_auditDescription, $sysUserId );
	$this->audit( $description, self::SALVAR );
    }
}