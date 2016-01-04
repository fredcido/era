<?php

class Model_VO_OptionsQuestion extends ILO_Model_VO
{
    protected $_referenceMap = array(
	'fk_id_options_question' => array(
	    'vo'	    => 'Model_VO_OptionsQuestion', 
	    'dao'	    => 'Model_DAO_OptionsQuestion', 
	    'localAttr'	    => 'fk_id_options_question', 
	    'remoteAttr'    => 'id_options_question'
	)
    );
    
    protected $_id_options_question;
    protected $_fk_id_option_question;
    protected $_title;
    protected $_value;
}