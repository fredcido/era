<?php

class Model_VO_OptionQuestion extends ILO_Model_VO
{
    protected $_referenceMap = array(
	'fk_id_questionnaire_config' => array(
	    'vo'	    => 'Model_VO_QuestionnaireConfig', 
	    'dao'	    => 'Model_DAO_QuestionnaireConfig', 
	    'localAttr'	    => 'fk_id_questionnaire_config', 
	    'remoteAttr'    => 'id_questionnaire_config'
	)
    );
    
    protected $_id_option_question;
    protected $_fk_id_questionnaire_config;
    protected $_title;
    protected $_order_question;
    protected $_required;
    protected $_multiple;
    protected $_choices;
}