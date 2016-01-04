<?php

class Model_VO_AddSubdistrict extends ILO_Model_VO {

    protected $_referenceMap = array('fk_id_add_district' => array('vo' => 'Model_VO_AddDistrict', 'dao' => 'Model_DAO_AddDistrict', 'localAttr' => 'fk_id_add_district', 'remoteAttr' => 'id_add_district'));
    protected $_id_add_subdistrict;
    protected $_fk_id_add_district;
    protected $_subdistrict;
    protected $_acronym;

}