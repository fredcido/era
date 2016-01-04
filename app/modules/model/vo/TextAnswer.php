<?php

class Model_VO_TextAnswer extends ILO_Model_VO
{
    protected $_referenceMap = array(
	'fk_id_text_question' => array(
	    'vo'	    => 'Model_VO_TextQuestion', 
	    'dao'	    => 'Model_DAO_TextQuestion', 
	    'localAttr'	    => 'fk_id_text_question', 
	    'remoteAttr'    => 'id_text_question'
	),
	'fk_id_questionnaire' => array(
	    'vo'	    => 'Model_VO_Questionnaire', 
	    'dao'	    => 'Model_DAO_Questionnaire', 
	    'localAttr'	    => 'fk_id_questionnaire', 
	    'remoteAttr'    => 'id_questionnaire'
	)
    );
     
    protected $_id_text_answer;
    protected $_fk_id_text_question;
    protected $_fk_id_questionnaire;
    protected $_answer;

}