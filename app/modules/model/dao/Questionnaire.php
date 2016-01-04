<?php

class Model_DAO_Questionnaire extends ILO_Model_DAO
{
    protected $_table = 'questionnaire';
    protected $_class = 'Model_VO_Questionnaire';
    
    public function listQuestionaires( $filters = array() )
    {
	$sql = 'SELECT
		    q.*,
		    qc.title config,
		    d.district,
		    sd.subdistrict,
		    s.suku
		FROM questionnaire q
		INNER JOIN questionnaire_config qc ON
		    qc.id_questionnaire_config = q.fk_id_questionnaire_config
		INNER JOIN add_district d ON
		    d.id_add_district = q.fk_id_add_district
		INNER JOIN add_subdistrict sd ON
		    sd.id_add_subdistrict = q.fk_id_add_subdistrict
		INNER JOIN add_suku s ON
		    s.id_suku = q.fk_id_suku
		LEFT JOIN options_answer oa ON
		    oa.fk_id_questionnaire = q.id_questionnaire
		LEFT JOIN text_answer ta ON
		    ta.fk_id_questionnaire = q.id_questionnaire
		WHERE 1 = 1
			%s
		GROUP BY q.id_questionnaire
		ORDER BY qc.title, q.identifier';
	
	$bindColumns = array();
	$where = '';
	
	if ( !empty( $filters['fk_id_questionnaire_config'] ) ) {
	    
	    $where .= ' AND q.fk_id_questionnaire_config = :config';
	    $bindColumns[':config'] = $filters['fk_id_questionnaire_config'];
	}
	
	if ( !empty( $filters['fk_id_add_district'] ) ) {
	    
	    $where .= ' AND q.fk_id_add_district = :district';
	    $bindColumns[':district'] = $filters['fk_id_add_district'];
	}
	
	if ( !empty( $filters['fk_id_add_subdistrict'] ) ) {
	    
	    $where .= ' AND q.fk_id_add_subdistrict = :subdistrict';
	    $bindColumns[':subdistrict'] = $filters['fk_id_add_subdistrict'];
	}
	
	if ( !empty( $filters['fk_id_suku'] ) ) {
	    
	    $where .= ' AND q.fk_id_suku = :suku';
	    $bindColumns[':suku'] = $filters['fk_id_suku'];
	}
	
	if ( !empty( $filters['identifier'] ) ) {
	    
	    $where .= ' AND q.identifier LIKE :identifier';
	    $bindColumns[':identifier'] = '%' . $filters['identifier'] . '%';
	}
	
	if ( !empty( $filters['road_location'] ) ) {
	    
	    $where .= ' AND q.road_location LIKE :road_location';
	    $bindColumns[':road_location'] = '%' . $filters['road_location'] . '%';
	}
	
	if ( !empty( $filters['code'] ) ) {
	    
	    $where .= ' AND q.code = :code';
	    $bindColumns[':code'] = $filters['code'];
	}
	
	if ( !empty( $filters['question']['text'] ) )
	    $where .= $this->whereQuestionText( $filters['question']['text'], $bindColumns );
	
	if ( !empty( $filters['question']['option'] ) )
	    $where .= $this->whereQuestionOption( $filters['question']['option'], $bindColumns );
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $questions
     * @param string $bind
     * @return string 
     */
    public function whereQuestionText( $questions, &$bind )
    {
	$where = array();
	foreach ( $questions as $id => $question ) {
	    
	    $question = trim( $question );
	    if ( empty( $question ) ) continue;
	    
	    $identifierLike = ':text_l_' . $id;
	    $identifier = ':text_q_' . $id;
	    
	    $whereAux = ' ( ta.answer LIKE ' . $identifierLike;
	    $whereAux .= ' AND ta.fk_id_text_question = ' . $identifier . ' )';
	    $bind[$identifierLike] = '%' . $question . '%';
	    $bind[$identifier] = $id;
	    
	    $where[] = $whereAux;
	}
	
	if ( empty( $where ) ) return '';
	
	$where = implode( ' OR ', $where );
	return ' AND (' . $where . ')';
    }
    
    /**
     *
     * @param array $questions
     * @param string $bind
     * @return string 
     */
    public function whereQuestionOption( $questions, &$bind )
    {
	$where = array();
	foreach ( $questions as $id => $question ) {
	    
	    if ( empty( $question ) ) continue;
	    
	    $identifier = ':option_' . $id;
	    
	    $whereAux = ' ( oa.fk_id_options_question IN (' . implode( ',', (array)$question ) . ')';
	    $whereAux .= ' AND oa.fk_id_option_question = ' . $identifier . ' )';
	    $bind[$identifier] = $id;
	    
	    $where[] = $whereAux;
	}
	
	$where = implode( ' OR ', $where );
	
	return ' AND (' . $where . ')';
    }
    
    /**
     * 
     * @param array $ids
     * @return array
     */
    public function calcTotalText( $ids )
    {
	$ids = (array)$ids;
	
	$sql = "SELECT 
		    tq.title,
		    ta.fk_id_text_question, 
		    COUNT(ta.id_text_answer) count,
		    SUM(REPLACE(ta.answer, ',', '')) sum,
		    AVG(REPLACE(ta.answer, ',', '')) avg
		FROM text_answer ta
		INNER JOIN text_question tq ON
		    tq.id_text_question = ta.fk_id_text_question
		WHERE tq.report != 'N'
		    AND tq.class IN ('numeric', 'money')
		    AND ta.fk_id_questionnaire IN (" . implode(',', $ids) . ")
		GROUP BY ta.fk_id_text_question";
	
	return $this->queryResult($sql);
    }
    
    /**
     * 
     * @param array $ids
     * @return array
     */
    public function calcCountOptions( $ids )
    {
	$ids = (array)$ids;
	
	$sql = "SELECT 
		    COUNT(oa.fk_id_options_question) cont,
		    oa.fk_id_option_question, 
		    oa.fk_id_options_question
		FROM options_answer oa
		WHERE oa.fk_id_questionnaire IN (" . implode(',', $ids) . ")
		GROUP BY oa.fk_id_options_question";
	
	return $this->queryResult($sql);
    }
}