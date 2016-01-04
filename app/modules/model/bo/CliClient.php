<?php

class Model_BO_CliClient extends ILO_Model_BO {

    public function saveGeral() {

        $cliClienteDAO = new Model_DAO_CliClient();
        $cliClienteVO = new Model_VO_CliClient();        
        $districtDAO = new Model_DAO_AddDistrict();

        $cliClienteDAO->beginTransaction();
        
        try{
            
            $districtVO = $districtDAO->fetchRow( array( 'id_add_district' => $this->_data['fk_id_add_district'] ) );
            $this->_data['num_district'] = $districtVO->getAcronym();
            
            $this->_data['date_birth'] = ILO_Util_Geral::dateToBd( $this->_data['date_birth'] );
            
            $cliClienteVO->setValues($this->_data);
            
            if ( null == $cliClienteVO->getIdClient() ) {
                
                $cliClienteVO->setDateRegistration( ILO_Util_Geral::dateToBd( $this->_data['date_registration'] ) );
                $cliClienteVO->setFkIdAddDistrict( $this->_data['fk_id_add_district'] );
                $cliClienteVO->setNumSequence( $this->_getNumSequence( $cliClienteVO ) );  
                $cliClienteVO->setActive( 'S' );  
		$clientId = $cliClienteDAO->insert( $cliClienteVO );
                
                $this->saveIncome( $clientId );
                
                $this->_data['id_client'] = $clientId;               
		
	    } else {    
                
                $clientId = $cliClienteVO->getIdClient();
                
                $this->saveIncome( $clientId );
	
                $cliClienteVO->setDateRegistration( date( 'Y-m-d' ) );
		$cliClienteDAO->update( $cliClienteVO, array( 'id_client' => $clientId ) );
                
	    }
            
            // Salva auditoria
            $description = 'REJISTU/ATUALIZA PARTISIPANTE: '.$this->getNumCliente($clientId).' BA HAKAT 1 – INFORMASAUN GERAL';
            $this->audit( $description, self::SALVAR );
            
            //salva na tabela de client history
            if( !$this->_saveClientHistory( 'REJISTU/ATUALIZA PARTISIPANTE HAKAT 1 – INFORMASAUN GERAL' ) )
                return false;
            
            $cliClienteDAO->commit();
	    return $clientId;
            
        } catch ( Exception $e ) {
            
            ILO_Util_Debug::dump($e->getMessage());
	    $cliClienteDAO->rollBack();
	   
	    return false;
	}
        
    }
    
    public function saveIncome( $clientId )
    {
        
        $incomesDAO = new Model_DAO_Incomes();
        $incomesVO = new Model_VO_Incomes();
        
        try{
            
            //insere na tabela Incomes
            $incomesVO->setFkIdClient( $clientId );
            $incomesVO->setIncomeDate( date( 'Y-m-d' ) );
            $incomesVO->setMontlyValue( ILO_Util_Geral::toFloat( $this->_data['montly_value'] ) );
            $incomesVO->setAnnualValue( ILO_Util_Geral::toFloat( $this->_data['annual_value'] ) );
            $incomesDAO->insert( $incomesVO );

            return true;
            
        }catch( Exception $e ){
            
            return false;
            
        }
    
    }
    
    public function saveDocumento()
    {
	$documentDAO = new Model_DAO_Document();
	$documentVO = new Model_VO_Document();
        
	$documentDAO->beginTransaction();
        
	try {            
	                
	    $this->_data['issue_date'] = ILO_Util_Geral::dateToBd( $this->_data['issue_date'] );
                
            $documentVO->setValues( $this->_data );
            
            if( !$this->_verificaDocumentoCadastrado( $this->_data ) )
                return false;
            
            // Insere registro na tabela de documento
            $documentId = $documentDAO->insert( $documentVO );
            
            $clientHasDocumentDAO = new Model_DAO_ClientHasDocument();
            $clientHasDocumentVO = new Model_VO_ClientHasDocument();
            
            $clientHasDocumentVO->setFkIdClient( $this->_data['id_client'] );
            $clientHasDocumentVO->setFkIdDocument( $documentId );
            
            //insere registro na tabela client_has_document
            $clientHasDocumentId = $clientHasDocumentDAO->insert( $clientHasDocumentVO );
            
            // Salva auditoria
            $description = 'REJISTU/ATUALIZA PARTISIPANTE: '.$this->getNumCliente( $this->_data['id_client'] ).' BA HAKAT 2 – DOKUMENTUS';
            $this->audit( $description, self::SALVAR );
            
            //salva na tabela de client history
            if( !$this->_saveClientHistory( 'REJISTU/ATUALIZA PARTISIPANTE HAKAT 2 – DOKUMENTUS' ) )
                    return false;
	
	    $documentDAO->commit();
	    return $this->_data['id_client'];
	
	} catch ( Exception $e ) {
	    ILO_Util_Debug::dump($e->getMessage());
	    $documentDAO->rollBack();
	    return false;
	}
    }
    
    
    
    /**
     *
     * @return bool
     */
    public function saveEducacao()
    {
        
	$clientDAO = new Model_DAO_CliClient();
	$clientVO = new Model_VO_CliClient();
	$clientDAO->beginTransaction();
	try {

	    $clientVO->setValues( $this->_data );
	    
	    $clientId = $clientVO->getIdClient();
	    $clientDAO->update( $clientVO, array( 'id_client' => $clientId ) );
	    
	    // Salva auditoria
	    $vo = $clientDAO->fetchRow( array( 'id_client' => $clientId ) );
	    $description = 'REJISTU/ATUALIZA PARTISIPANTE: %s BA HAKAT 3 – NIVEL EDUKASAUN';
	    $this->audit( sprintf( $description, $this->getNumCliente( $clientId ) ), self::SALVAR );
	    
	    $clientVocatTrainingDAO = new Model_DAO_ClientHasVacatTraining();
	    
	    // remove treinamentos já cadastrados
	    $clientVocatTrainingDAO->delete( array( 'fk_id_client' => $clientId ) );
            
	    // Se tiverem treinamentos a serem inseridos
	    if ( !empty( $this->_data['vocat_training'] ) ) {
		
		$clientVocatTrainingVO = new Model_VO_ClientHasVacatTraining();
		foreach ( $this->_data['vocat_training'] as $key => $vocat ) {
		    
		    $clientVocatTrainingVO->setFkIdClient( $clientId );
		    $clientVocatTrainingVO->setFkIdVocationalTraining( $vocat );
		    $clientVocatTrainingVO->setYearCompleted( $this->_data['year_completed'][$key] );
		    
		    $clientVocatTrainingDAO->insert( $clientVocatTrainingVO );
		}
	    }
	    
	    $clientDAO->commit();
	    return $clientId;
	
	} catch ( Exception $e ) {
	    ILO_Util_Debug::dump($e->getMessage());
	    $clientDAO->rollBack();
	   
	    return false;
	}
    }
    
    private function _verificaDocumentoCadastrado( array $dados )
    {
        
        $clientHasDocumentDAO = new Model_DAO_ClientHasDocument();
        
        $result = $clientHasDocumentDAO->queryResult( "
                    SELECT d.* FROM document d
                    INNER JOIN client_has_document cd
                        ON cd.fk_id_document = d.id_document
                    WHERE cd.fk_id_client = ".$dados['id_client']." AND d.fk_id_type_document = ".$dados['fk_id_type_document'].""
        );
        
        if ( !empty( $result ) ){
            
            $this->setError( ILO_Util_Translate::get( 'Documento já cadastrado para este participante', 275 ) );
	    return false;
            
        }else
            return true;
        
    }
    
    private function _saveClientHistory( $action )
    {
        
        $clientHistoryVO = new Model_VO_ClientHistory();
        $clientHistoryDAO = new Model_DAO_ClientHistory();
        
        try{
            
            $clientHistoryVO->setFkIdClient( $this->_data['id_client'] );
            $clientHistoryVO->setAction( $action );
            $clientHistoryVO->setDateTime( date( 'Y-m-d H:i:s' ) );
            $clientHistoryDAO->insert( $clientHistoryVO );
            
	    return true;
        
        }catch( Exception $e ){
            ILO_Util_Debug::dump($e->getMessage());
	    return false;
            
        }
    }


    /**
     *
     * @return boolean 
     */
    public function removerDocumento()
    {
        
	$clientHasDocumentDAO = new Model_DAO_ClientHasDocument();

	$clientHasDocumentDAO->beginTransaction();
	try {
	    
	    $clientHasDocumentDAO->delete( $this->_data );
	    
	    $documentDAO = new Model_DAO_Document();
	    $documentDAO->delete( array( 'id_document' => $this->_data['fk_id_document'] ) );
	  
	    $clientHasDocumentDAO->commit();
	    return true;
	
	} catch ( Exception $e ) {
	    
	    $clientHasDocumentDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @return bool
     */
    public function saveEndereco()
    {
	$addressGeneralDAO = new Model_DAO_AddressGeneral();
	$addressGeneralDAO->beginTransaction();
        
	try {

	    $where = array( 'fk_id_client' => $this->_data['id_client'] );
	    
            $this->_data['fk_id_add_country'] = 1;
            
	    $addressGeneralVO = $addressGeneralDAO->fetchRow( $where );
	    
	    if ( empty( $addressGeneralVO ) ) {
		
		$this->_data['fk_id_client'] = $this->_data['id_client'];

		$addressGeneralVO = new Model_VO_AddressGeneral();
		
		$addressGeneralVO->setValues( $this->_data );
		$addressGeneralVO->setType( 'PRINCIPAL' );

		// Insere endereço do beneficiario
		$addressGeneralDAO->insert( $addressGeneralVO );
		
	    } else {
		
		// Atualiza beneficiario
		$addressGeneralVO->setValues( $this->_data );
		$addressGeneralDAO->update( $addressGeneralVO, $where );
	    }

	    // Salva auditoria
	    $clientDAO = new Model_DAO_CliClient();
	    $vo = $clientDAO->fetchRow( array( 'id_client' => $this->_data['id_client'] ) );
	    
	    $description = 'REJISTU/ATUALIZA PARTISIPANTE: %s BA HAKAT 4 – HELA FATIN';
	    $this->audit( sprintf( $description, $this->getNumCliente( $this->_data['id_client'] ) ), self::SALVAR );
	
	    $addressGeneralDAO->commit();
	    return $this->_data['id_client'];
	
	} catch ( Exception $e ) {
	    
            ILO_Util_Debug::dump($e->getMessage());
	    $addressGeneralDAO->rollBack();
	   
	    return false;
	}
    }
    
    /**
     *
     * @return bool
     */
    public function saveExperiencia()
    {
	$profExperienceDAO = new Model_DAO_ProfessionalExperience();
        
	$profExperienceDAO->beginTransaction();
        
        $profExperienceVO = new Model_VO_ProfessionalExperience();
        
	try {            
	    
	    if ( empty( $this->_data['id_professional_experience'] ) ) {
		
		$this->_data['fk_id_client'] = $this->_data['id_client'];
		
                $this->_data['start_date'] = ILO_Util_Geral::dateToBd( $this->_data['start_date'] );
                $this->_data['finish_date'] = ILO_Util_Geral::dateToBd( $this->_data['finish_date'] );
                
		$profExperienceVO->setValues( $this->_data );

		// Insere experiencia
		$profExperienceDAO->insert( $profExperienceVO );
		
	    } else {
                
                $where = array( 'id_professional_experience' => $this->_data['id_professional_experience'] );
		
		// Atualiza beneficiario
                $this->_data['start_date'] = ILO_Util_Geral::dateToBd( $this->_data['start_date'] );
                $this->_data['finish_date'] = ILO_Util_Geral::dateToBd( $this->_data['finish_date'] );                
                
		$profExperienceVO->setValues( $this->_data );
		$profExperienceDAO->update( $profExperienceVO, $where );
	    }

	    // Salva auditoria	    
	    $description = 'REJISTU/ATUALIZA PARTISIPANTE: %s BA HAKAT 5 – ESPERIENSIA SERVISU';
	    $this->audit( sprintf( $description, $this->getNumCliente( $this->_data['id_client'] ) ), self::SALVAR );
	
	    $profExperienceDAO->commit();
	    return $this->_data['id_client'];
	
	} catch ( Exception $e ) {
	    ILO_Util_Debug::dump($e->getMessage());
	    $profExperienceDAO->rollBack();
	   
	    return false;
	}
    }
    
    /**
     *
     * @return array
     */
    public function searchClients()
    {
	$cliClientDAO = new Model_DAO_CliClient();
	
	$filters = array();
	
	// Filtra por nome
	if ( !empty( $this->_data['name'] ) )
	    $filters[] = 'CONCAT(first_name, " ", last_name) LIKE "%' . $this->_data['name'] . '%"';
	
	if ( !empty( $this->_data['num'] ) )
	    $filters[] = 'CONCAT(num_district, "-", num_year, "-", num_sequence) LIKE "%' . $this->_data['num'] . '%"';
	
	return $cliClientDAO->fetchAll( array( 'first_name', 'last_name' ), $filters );
    }
    
    protected function _getNumSequence(  $vo )
    {
        
        try{
            
            $contractDAO = new Model_DAO_Contract();
            $result = $contractDAO->queryResult( "SELECT IFNULL(MAX(num_sequence),0) + 1  AS num_sequence
                                                    FROM cli_client c WHERE
                                                    c.num_district = '".$vo->getNumDistrict()."' AND
                                                    c.num_year = '".$vo->getNumYear()."'" );
            
        }catch( Exeception $e ){
            
            ILO_Util_Debug::dump( $e->getMessage() );
            
        }
        
        return $result[0]['num_sequence'];
        
    }
    
    public function getNumCliente( $id )
    {
        
        $clientDAO = new Model_DAO_CliClient();
        $vo = $clientDAO->fetchRow( array( 'id_client' => $id ) );        
        
        return $vo->getNumDistrict().'-'.$vo->getNumYear().'-'.$vo->getNumSequence();
        
    }
    

}