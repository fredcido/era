<?php

class Model_VO_OptionsAnswer extends ILO_Model_VO
{
    protected $_referenceMap = array(
	'fk_id_questionnaire' => array(
	    'vo'	    => 'Model_VO_Questionnaire', 
	    'dao'	    => 'Model_DAO_Questionnaire', 
	    'localAttr'	    => 'fk_id_questionnaire', 
	    'remoteAttr'    => 'id_questionnaire'
	),
	'fk_id_option_question' => array(
	    'vo'	    => 'Model_VO_OptionQuestion', 
	    'dao'	    => 'Model_DAO_OptionQuestion', 
	    'localAttr'	    => 'fk_id_option_question', 
	    'remoteAttr'    => 'id_option_question'
	),
	'fk_id_options_question' => array(
	    'vo'	    => 'Model_VO_OptionsQuestion', 
	    'dao'	    => 'Model_DAO_OptionsQuestion', 
	    'localAttr'	    => 'fk_id_options_question', 
	    'remoteAttr'    => 'id_options_question'
	)
    );
    
    protected $_id_options_answer;
    protected $_fk_id_questionnaire;
    protected $_fk_id_option_question;
    protected $_fk_id_options_question;
}