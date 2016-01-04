<?php

class Model_VO_ClientHasDocument extends ILO_Model_VO

{

	protected $_referenceMap = array(
                'fk_id_client' => array(
                                        'vo'         => 'Model_VO_CliClient',
                                        'dao'        => 'Model_DAO_CliClient',
                                        'localAttr'  => 'fk_id_client',
                                        'remoteAttr' => 'id_client'
                                ),
                'fk_id_document' => array(
                                        'vo'         => 'Model_VO_Document',
                                        'dao'        => 'Model_DAO_Document',
                                        'localAttr'  => 'fk_id_document',
                                        'remoteAttr' => 'id_document'
                                )
            );

		protected $_id_relationship;

		protected $_fk_id_client;

		protected $_fk_id_document;

}