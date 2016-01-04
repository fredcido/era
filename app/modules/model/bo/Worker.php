<?php

class Model_BO_Worker extends ILO_Model_BO
{
    /**
     *
     * @return bool
     */
    public function saveGeral()
    {
	$workerDAO = new Model_DAO_Worker();
	$workerVO = new Model_VO_Worker();

	$workerDAO->beginTransaction();
	try {

	    $workerVO->setValues( $this->_data );
	    
	    if ( !$this->_validaSaveGeral( $workerVO ) )
		return false;

	    if ( null == $workerVO->getIdWorker() ) {
		
		// Monta birt_place
		$subdistrictAc = $workerVO->getFkIdAddSubdistrict()->getAcronym();
		$districtAc = $workerVO->getFkIdAddSubdistrict()->getFkIdAddDistrict()->getAcronym();
		$workerVO->setNumBirthplace( $districtAc . '-' . $subdistrictAc );
		
		// Set numYear
		$workerVO->setNumYear( substr( $workerVO->getDateRegistration(), -2 ) );
		// Formata data de nascimento
		$workerVO->setDateBirth( ILO_Util_Geral::dateToBd( $workerVO->getDateBirth() ) );
		// Formata data de registro
		$workerVO->setDateRegistration( ILO_Util_Geral::dateToBd( $workerVO->getDateRegistration() ) );
		
		// Define status por padrão
		$workerVO->setStatusWorker( 'A' );
		
		$workerId = $workerDAO->insert( $workerVO );
		
		$workerVO->setIdWorker( $workerId );
		
		// Salva auditoria
		$description = 'REJISTU BENEFISIARIU: %s HAKAT 1 – INFORMASAUN GERAL – BENEFISIARIUS KONTRAKTU';
		$this->audit( sprintf( $description, $workerVO->getCodBeneficiario() ), self::SALVAR );
		
		// Insere vinculo do trabalhador com contrato
		$contractHasWorkerDAO = new Model_DAO_ContractHasWorker();
		$contractHasWorkerVO = new Model_VO_ContractHasWorker();
		
		$contractHasWorkerVO->setFkIdContract( $this->_data['fk_id_contract'] );
		$contractHasWorkerVO->setFkIdWorker( $workerId );
		
		$contractHasWorkerDAO->insert( $contractHasWorkerVO );
		
	    } else {
		
		$workerId = $workerVO->getIdWorker();
		
		// Se tiver contrato para ser vinculado
		if ( !empty( $this->_data['fk_id_contract'] ) ) {
		    
		    // Insere vinculo do trabalhador com contrato
		    $contractHasWorkerDAO = new Model_DAO_ContractHasWorker();

		    // Verifica se beneficiario já está vinculado ao projeto
		    $existeVinculo = $contractHasWorkerDAO->fetchRow( 
								array( 
								    'fk_id_worker' => $workerId, 
								    'fk_id_contract' => $this->_data['fk_id_contract'] 
								) 
							    );

		    // se nao existir vinculo, insere o vinculo do beneficiario com o projeto
		    if ( empty( $existeVinculo ) ) {

			$contractHasWorkerVO = new Model_VO_ContractHasWorker();

			$contractHasWorkerVO->setFkIdContract( $this->_data['fk_id_contract'] );
			$contractHasWorkerVO->setFkIdWorker( $workerId );

			$contractHasWorkerDAO->insert( $contractHasWorkerVO );
		    }
		}
		
		// Formata data de nascimento
		$workerVO->setDateBirth( ILO_Util_Geral::dateToBd( $workerVO->getDateBirth() ) );
		// Formata data de registro
		$workerVO->setDateRegistration( ILO_Util_Geral::dateToBd( $workerVO->getDateRegistration() ) );
		
		$workerDAO->update( $workerVO, array( 'id_worker' => $workerId ) );
		
		$description = 'ATUALIZA BENEFISIARIU: %s HAKAT 1 – INFORMASAUN GERAL – BENEFISIARIUS KONTRAKTU';
		$this->audit( sprintf( $description, $workerVO->getCodBeneficiario() ), self::SALVAR );
	    }
	    
	    $workerDAO->commit();
	    return $workerId;
	
	} catch ( Exception $e ) {
	    
	    $workerDAO->rollBack();
	   
	    return false;
	}
    }
    
    /**
     *
     * @param Model_VO_Worker $worker
     * @return bool 
     */
    protected function _validaSaveGeral( Model_VO_Worker $worker )
    {
	// Valida data de nascimento
	if ( !ILO_Util_Geral::checkDate( $worker->getDateBirth() ) ) {
	    
	    $this->setError( ILO_Util_Translate::get( 'Data de nascimento inválida', 78 ) );
	    return false;
	}
	
	// Valida data de registro
	if ( !ILO_Util_Geral::checkDate( $worker->getDateRegistration() ) ) {
	    
	    $this->setError( ILO_Util_Translate::get( 'Data de registro inválida', 79 ) );
	    return false;
	}

	return true;
    }
    
    /**
     *
     * @return bool
     */
    public function saveEducacao()
    {
	$workerDAO = new Model_DAO_Worker();
	$workerVO = new Model_VO_Worker();

	$workerDAO->beginTransaction();
	try {

	    $workerVO->setValues( $this->_data );
	    
	    $workerId = $workerVO->getIdWorker();
	    $workerDAO->update( $workerVO, array( 'id_worker' => $workerId ) );
	    
	    // Salva auditoria
	    $vo = $workerDAO->fetchRow( array( 'id_worker' => $workerId ) );
	    $description = 'ATUALIZA BENEFISIARIU: %s HAKAT 2 – EDUKASAUM – BENEFISIARIUS KONTRAKTU';
	    $this->audit( sprintf( $description, $vo->getCodBeneficiario() ), self::SALVAR );
	    
	    $workerVocatTrainingDAO = new Model_DAO_WorkerHasVocatTraining();
	    
	    // remove treinamentos já cadastrados
	    $workerVocatTrainingDAO->delete( array( 'fk_id_worker' => $workerId ) );
	    
	    // Se tiverem treinamentos a serem inseridos
	    if ( 'S' == $this->_data['vocational_training'] && !empty( $this->_data['vocat_training'] ) ) {
		
		$workerVocatTrainingVO = new Model_VO_WorkerHasVocatTraining();
		foreach ( $this->_data['vocat_training'] as $key => $vocat ) {
		    
		    $workerVocatTrainingVO->setFkIdWorker( $workerId );
		    $workerVocatTrainingVO->setFkIdVocationalTraining( $vocat );
		    $workerVocatTrainingVO->setYearCompleted( $this->_data['year_completed'][$key] );
		    
		    $workerVocatTrainingDAO->insert( $workerVocatTrainingVO );
		}
	    }
	    
	    $workerDAO->commit();
	    return $workerId;
	
	} catch ( Exception $e ) {
	    
	    $workerDAO->rollBack();
	   
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

	    $where = array( 'fk_id_worker' => $this->_data['id_worker'] );
	    
	    $addressGeneralVO = $addressGeneralDAO->fetchRow( $where );
	    
	    if ( empty( $addressGeneralVO ) ) {
		
		$this->_data['fk_id_worker'] = $this->_data['id_worker'];

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
	    $workerDAO = new Model_DAO_Worker();
	    $vo = $workerDAO->fetchRow( array( 'id_worker' => $this->_data['id_worker'] ) );
	    
	    $description = 'ATUALIZA BENEFISIARIU: %s HAKAT 3 – HELA FATIN – BENEFISIARIUS KONTRAKTU';
	    $this->audit( sprintf( $description, $vo->getCodBeneficiario() ), self::SALVAR );
	
	    $addressGeneralDAO->commit();
	    return $this->_data['id_worker'];
	
	} catch ( Exception $e ) {
	    
	    $addressGeneralDAO->rollBack();
	   
	    return false;
	}
    }
    
    /**
     *
     * @return bool
     */
    public function savePagamento()
    {
	$workerPaymentDAO = new Model_DAO_WorkerPayment();
	$workerPaymentVO = new Model_VO_WorkerPayment();

	$workerPaymentDAO->beginTransaction();
	try {
	    
	    $this->_data['salary_day'] = ILO_Util_Geral::toFloat( $this->_data['salary_day'] );
	    $this->_data['total_salary'] = ILO_Util_Geral::toFloat( $this->_data['total_salary'] );
	    $this->_data['date_payment'] = ILO_Util_Geral::dateToBd( $this->_data['date_payment'] );
	    
	    $workerPaymentVO->setValues( $this->_data );
	    
	    // valida se ja existe pagamento na mesma data para o beneficiario
	    if ( !$this->_validaPagamento( $this->_data ) )
		return false;
	    
	    // Insere registro de pagamento
	    $workerPaymentId = $workerPaymentDAO->insert( $workerPaymentVO );
	    
	    // Vincula pagamento ao beneficiario
	    $workerHasPaymentDAO = new Model_DAO_WorkerHasPayment();
	    $workerHasPaymentVO = new Model_VO_WorkerHasPayment();
	    
	    $workerHasPaymentVO->setFkIdWorker( $this->_data['id_worker'] );
	    $workerHasPaymentVO->setFkIdWorkerPayment( $workerPaymentId );
	    $workerHasPaymentDAO->insert( $workerHasPaymentVO );
	    
	    // Salva auditoria
	    $workerDAO = new Model_DAO_Worker();
	    $vo = $workerDAO->fetchRow( array( 'id_worker' => $this->_data['id_worker'] ) );

	    $description = 'ATUALIZA BENEFISIARIU: %s HAKAT 4 – PAGAMENTU – BENEFISIARIUS KONTRAKTU';
	    $this->audit( sprintf( $description, $vo->getCodBeneficiario() ), self::SALVAR );
	
	    $workerPaymentDAO->commit();
	    return $this->_data['id_worker'];
	
	} catch ( Exception $e ) {
	    
	    $workerPaymentDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @param array $data
     * @return boolean 
     */
    protected function _validaPagamento( array $data )
    {
	$workerHasPaymentDAO = new Model_DAO_WorkerHasPayment();
	
	// Valida pagamento
	if ( !$workerHasPaymentDAO->validaPagamentoBeneficiario( $data ) ) {
	    
	    $this->setError( ILO_Util_Translate::get( 'Pagamento já cadastrado para beneficiário', 107 ) );
	    return false;
	}

	return true;
    }
    
    /**
     *
     * @return boolean 
     */
    public function removerPagamento()
    {
	$workerHasPaymentDAO = new Model_DAO_WorkerHasPayment();

	$workerHasPaymentDAO->beginTransaction();
	try {
	    
	    $workerHasPaymentDAO->delete( $this->_data );
	    
	    $workerPaymentDAO = new Model_DAO_WorkerPayment();
	    $workerPaymentDAO->delete( array( 'id_worker_payment' => $this->_data['fk_id_worker_payment'] ) );
	  
	    $workerHasPaymentDAO->commit();
	    return true;
	
	} catch ( Exception $e ) {
	    
	    $workerHasPaymentDAO->rollBack();
	    return false;
	}
    }

    /**
     *
     * @param array $subdistrict
     * @return string
     */
    public function montaNumBeneficiario( $data )
    {
	// Busca subdistrito
	$subdistrictDAO = new Model_DAO_AddSubdistrict();
	$subdistrictVO = $subdistrictDAO->fetchRow( array( 'id_add_subdistrict' => $data['sub'] ) );
	
	$workerDAO = new Model_DAO_Worker();
	
	$codBeneficiario = array(
	    $subdistrictVO->getFkIdAddDistrict()->getAcronym(),
	    $subdistrictVO->getAcronym(),
	    ( empty( $data['registration'] ) ? date( 'y' ) : substr( $data['registration'], -2 ) ),
	    $workerDAO->lastIdWorker() + 1
	);
	
	return implode( '-', $codBeneficiario );
    }
}