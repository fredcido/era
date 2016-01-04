<?php

class Model_BO_QuestionnaireReport extends ILO_Model_BO
{
  
    /**
     * 
     * @return array
     */
    public function fetchReport()
    {
	$id = $this->_data['fk_id_questionnaire_config'];
	
	unset($this->_data['question']);
	
	// Get questionnaire header
	$questionnaireConfigDAO = new Model_DAO_QuestionnaireConfig();
	$questionnaireConfigVO = $questionnaireConfigDAO->fetchRow( array( 'id_questionnaire_config' => $id ) );
	
	// Get the questions configuration
	$questionnaireConfigBO = new Model_BO_QuestionnaireConfig();
	$dataQuestions = $questionnaireConfigBO->getListQuestions( $id );
	
	// Get the answered questionnaires
	$questionnaireDAO = new Model_DAO_Questionnaire();
	$questionnaires = $questionnaireDAO->listQuestionaires( $this->_data );
	
	$idQuestionnaires = array();
	foreach ( $questionnaires as $data )
	    $idQuestionnaires[] = (int)$data['id_questionnaire'];
	
	// Calc sum and average to text questions
	$sumTextAnswer = (array)$questionnaireDAO->calcTotalText( $idQuestionnaires );
	$groupSumTextAnswer = array();
	foreach ( $sumTextAnswer as $sum )
	    $groupSumTextAnswer[$sum['fk_id_text_question']] = $sum;
	
	$countOptionsAnswer = (array)$questionnaireDAO->calcCountOptions( $idQuestionnaires );
	
	$questions = array();
	foreach ( $dataQuestions as $question ) {
	    
	    // If it is a text question
	    if ( 'T' == $question['type'] ) {
		
		$idTextQuestion = $question['data']['id_text_question'];
		
		switch ( $question['data']['report'] ) {
		    case 'N':
			continue 2;
		    case 'A':
			if ( isset($groupSumTextAnswer[$idTextQuestion]) )
			    $question['avg'] = round($groupSumTextAnswer[$idTextQuestion]['avg'], 2);
			break;
		    case 'S':
			if ( isset($groupSumTextAnswer[$idTextQuestion]) )
			    $question['sum'] = round($groupSumTextAnswer[$idTextQuestion]['sum'], 2);
			break;
		    default:
			if ( isset($groupSumTextAnswer[$idTextQuestion]) )
			    $question['avg'] = round($groupSumTextAnswer[$idTextQuestion]['avg'], 2);
			if ( isset($groupSumTextAnswer[$idTextQuestion]) )
			    $question['sum'] = round($groupSumTextAnswer[$idTextQuestion]['sum'], 2);
		}
			
	    } else {

		$optionsCount = array();
		$total = 0;
		foreach ( $countOptionsAnswer as $optionAnswer ) {
		    if ( $optionAnswer['fk_id_option_question'] != $question['data']['id_option_question'] )
			continue;
		    
		    $total += $optionAnswer['cont'];
		    $optionsCount[$optionAnswer['fk_id_options_question']] = (float)$optionAnswer['cont'];
		}
		
		$options = array();
		foreach ( $question['options'] as $idOption => $optionTitle ) {
		    
		    $data = array( 'title' => $optionTitle );
		    
		    if ( isset( $optionsCount[$idOption] ) ) {
			$data['sum'] = $optionsCount[$idOption];
			$data['avg'] = round(($optionsCount[$idOption] / $total) * 100, 2);
		    }
		    
		    $options[] = $data;
		}
		
		$question['options'] = $options;
	    }
	    
	    $questions[] = $question;
	}
	
	$report = array(
	    'questionnaire' => $questionnaireConfigVO,
	    'questions'	    => $questions,
	    'answers'	    => $questionnaires,
	    'filters'	    => $this->_parseFilters( $this->_data )
	);
	
	return $report;
    }
    
    /**
     * 
     * @param array $filters
     * @return array
     */
    protected function _parseFilters( $filters = array() )
    {
	$filtersLabel = array();
	
	if ( !empty( $filters['identifier'] ) )
	    $filtersLabel['Identifier'] = $filters['identifier'];
	
	if ( !empty( $filters['road_location'] ) )
	    $filtersLabel['Road Location'] = $filters['road_location'];
	
	if ( !empty( $filters['code'] ) )
	    $filtersLabel['Code'] = $filters['code'];
	
	if ( !empty( $filters['fk_id_add_district'] ) ) {
	    
	    $districtDAO = new Model_DAO_AddDistrict();
	    $districtVO = $districtDAO->fetchRow(array('id_add_district' => $filters['fk_id_add_district']) );
	    $filtersLabel['District'] = $districtVO->getDistrict();
	}
	
	if ( !empty( $filters['fk_id_add_subdistrict'] ) ) {
	    
	    $subDistrictDAO = new Model_DAO_AddSubdistrict();
	    $subDistrictVO = $subDistrictDAO->fetchRow(array('id_add_subdistrict' => $filters['fk_id_add_subdistrict']) );
	    $filtersLabel['SubDistrict'] = $subDistrictVO->getSubdistrict();
	}
	
	if ( !empty( $filters['fk_id_suku'] ) ) {
	    
	    $subSukuDAO = new Model_DAO_AddSuku();
	    $subSukuVO = $subSukuDAO->fetchRow(array('id_suku' => $filters['fk_id_suku']) );
	    $filtersLabel['Suku'] = $subSukuVO->getSuku();
	}
	
	return $filtersLabel;
    }
}