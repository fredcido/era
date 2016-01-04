<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Village
 *
 * @author calos
 */
class Model_VO_Village extends ILO_Model_VO
{
    protected $_referenceMap = array(
	'id_suku' => array(
	    'vo'	    => 'Model_VO_AddSuku',
	    'dao'	    => 'Model_DAO_AddSuku',
	    'localAttr'	    => 'fk_id_suku',
	    'remoteAttr'    => 'id_suku'
	)
    );
    
    protected $_id_village;
    
    protected $_fk_id_suku;
    
    protected $_village_name;
    
    protected $_village_code;
}

?>
