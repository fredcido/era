<?php

class Model_VO_ContractHasWorker extends ILO_Model_VO {

    protected $_referenceMap = array(
        'fk_id_contract' => 
        array(
            'vo' => 'Model_VO_Contract',
            'dao' => 'Model_DAO_Contract',
            'localAttr' => 'fk_id_contract',
            'remoteAttr' => 'id_contract'
            ), 
        'fk_id_worker' => 
        array(
                'vo' => 'Model_VO_Worker',
                'dao' => 'Model_DAO_Worker',
                'localAttr' => 'fk_id_worker',
                'remoteAttr' => 'id_worker'
                )
        );
    protected $_id_relationship;
    protected $_fk_id_contract;
    protected $_fk_id_worker;

}