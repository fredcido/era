<?php

class Model_BO_Questionnaire extends ILO_Model_BO
{
  
    /**
     *
     * @return mixed
     */
    public function save()
    {
	$questionnaireDAO = new Model_DAO_Questionnaire();
	$questionnaireVO = new Model_VO_Questionnaire();

	$questionnaireDAO->beginTransaction();
	try {
	    
	    $questionnaireVO->setValues( $this->_data );
	    $questionnaireVO->setDateRegistration( ILO_Util_Geral::dateToBd( $questionnaireVO->getDateRegistration() ) );
	    
	    if ( empty( $this->_data['id_questionnaire'] ) ) {
		
		$id = $questionnaireDAO->insert( $questionnaireVO );
		$questionnaireVO->setIdQuestionnaire( $id );
	    } else {
		
		$where = array( 'id_questionnaire' => $this->_data['id_questionnaire'] );
		$questionnaireDAO->update( $questionnaireVO, $where );
		$id = $this->_data['id_questionnaire'];
	    }
	    
	    $this->_saveQuestionsText( $id );
	    $this->_saveQuestionsOptions( $id );
	    
	     // Salva auditoria
	    $description = 'REJISTU/ATUALIZA QUESTIONNAIRE: ' . $id;
	    $this->audit( $description, self::SALVAR );
	    
	    $questionnaireDAO->commit();
	    return $id;
	    
	} catch ( Exception $e ) {
	    
	    $questionnaireDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @param int $id
     * @return boolean 
     */
    protected function _saveQuestionsText( $id )
    {
	if ( empty( $this->_data['question']['text'] ) )
	    return true;
	
	$textAnswerDAO = new Model_DAO_TextAnswer();
	$textAnswerVO = new Model_VO_TextAnswer();
	
	foreach ( $this->_data['question']['text'] as $question => $answer ) {
	    
	    $where = array(
		'fk_id_text_question' => $question,
		'fk_id_questionnaire' => $id
	    );
	    
	    $vo = $textAnswerDAO->fetchRow( $where );
	    if ( empty( $vo ) ) {
		
		$vo = clone $textAnswerVO;
		$vo->setValues( $where );
		$vo->setAnswer( $answer );
		$textAnswerDAO->insert( $vo );
		
	    } else {
		
		$vo->setAnswer( $answer );
		$textAnswerDAO->update( $vo, $where );
	    }
	}
    }
    
    /**
     *
     * @param int $id
     * @return boolean 
     */
    protected function _saveQuestionsOptions( $id )
    {
	if ( empty( $this->_data['question']['option'] ) )
	    return true;
	
	$optionsAnswerDAO = new Model_DAO_OptionsAnswer();
	$optionsAnswerVO = new Model_VO_OptionsAnswer();
	
	$ids = array();
	foreach ( $this->_data['question']['option'] as $question => $options ) {
	    
	    $where = array(
		'fk_id_option_question' => $question,
		'fk_id_questionnaire'   => $id
	    );
	    
	    $options = (array)$options;
	    
	    $rows = $optionsAnswerDAO->fetchAll( array(), $where );
	   
	    $old = array();
	    foreach ( $rows as $row )
		$old[] = $row->getFkIdOptionsQuestion()->getIdOptionsQuestion();
	    
	    $del = array_diff( $old, $options );
	    $new = array_diff( $options, $old );
	    
	    // Delete Remove Answer
	    foreach ( $del as $oldOption ) {
		
		$whereDelete = array(
		    'fk_id_option_question'	=> $question,
		    'fk_id_questionnaire'	=> $id,
		    'fk_id_options_question'	=> $oldOption
		);
		
		$optionsAnswerDAO->delete( $whereDelete );
	    }
	    
	    // Insert new Options
	    foreach ( $new as $newOption ) {
		
		if ( empty( $newOption ) )
		    continue;
		
		$vo = clone $optionsAnswerVO;
		$vo->setValues( $where );
		$vo->setFkIdOptionsQuestion( $newOption );
		$optionsAnswerDAO->insert( $vo );
	    }
	    
	    $ids[] = $question;
	}
	
	if ( empty( $ids ) )
	    $ids[] = 0;
	
	$sql = 'DELETE FROM options_answer WHERE fk_id_option_question NOT IN(' . implode( ',', $ids ) . ')
		AND fk_id_questionnaire = ' . $id;
	
	$optionsAnswerDAO->query( $sql );
    }
    
    /**
     *
     * @param int $id
     * @return array
     */
    public function getAnswer( $id )
    {
	$optionsAnswerDAO = new Model_DAO_OptionsAnswer();
	$textAnswerDAO = new Model_DAO_TextAnswer();
	
	$answers = array(
	    'text'	=> array(),
	    'option'	=> array()
	);
	
	$where = array( 'fk_id_questionnaire' => $id );
	
	$rows = $textAnswerDAO->fetchAll( array(), $where );
	foreach ( $rows as $row ) {
	    
	    $data = $row->toArray();
	    $answers['text'][$data['fk_id_text_question']] = $row->getAnswer();
	}
	
	$rows = $optionsAnswerDAO->fetchAll( array(), $where );
	foreach ( $rows as $row ) {
	    
	    $data = $row->toArray();
	    $answers['option'][$data['fk_id_option_question']][] = $data['fk_id_options_question'];
	}
	
	return $answers;
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