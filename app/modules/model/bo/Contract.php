<?php

class Model_BO_Contract extends ILO_Model_BO
{
    /*
     * 
     */

    public function saveGeral()
    {
        
	$contractDAO = new Model_DAO_Contract();
	$contractVO = new Model_VO_Contract();

	$districtDAO = new Model_DAO_AddDistrict();
        
	$contractDAO->beginTransaction();
        
	try {

	    $districtVO = $districtDAO->fetchRow( array('id_add_district' => $this->_data['fk_id_add_district']) );
	    $this->_data['num_district'] = $districtVO->getAcronym();
            
            $this->_data['date_finish_planned'] = ILO_Util_Geral::dateToBd($this->_data['date_finish_planned']);
            $this->_data['date_start_planned'] = ILO_Util_Geral::dateToBd($this->_data['date_start_planned']);    
	    $this->_data['signature_date'] = ILO_Util_Geral::dateToBd( $this->_data['signature_date'] );
	    $this->_data['nitl_valid'] = ILO_Util_Geral::dateToBd( $this->_data['nitl_valid'] );
	    $this->_data['bank_valid'] = ILO_Util_Geral::dateToBd( $this->_data['bank_valid'] );

	    $contractVO->setValues( $this->_data );
            //var_dump($contractVO);die();
	    $contractHasLocationDAO = new Model_DAO_ContractHasLocation();

	    $contractVO->setTotalContract( ILO_Util_Geral::toFloat( $contractVO->getTotalContract() ) );
            
	    if ( null == $contractVO->getIdContract() ) {

		$contractVO->setDateRegistration( date( 'Y-m-d H:i:s' ) );
		$contractVO->setFkIdAddDistrict( $this->_data['fk_id_add_district'] );
		$contractVO->setNumSequence( $this->_getNumSequence( $contractVO ) );
		$contractId = $contractDAO->insert( $contractVO );

		//insere os sub e suku
		$this->_insertContractHasLocation( $contractId );
	    } else {

		$contractId = $contractVO->getIdContract();

		$contractUpd = $contractDAO->fetchRow( array('id_contract' => $contractId) );
		if ( is_null( $contractUpd->getNumSequence() ) )
		    $contractUpd->setNumSequence( $this->_getNumSequence( $contractVO ) );

		$contractDAO->update( $contractVO, array('id_contract' => $contractId) );

		//deleta os subdistritu e suku               
		$contractHasLocationDAO->delete( array('fk_id_contract' => $contractId) );

		//insere os sub e suku
		$this->_insertContractHasLocation( $contractId );
	    }

	    // Salva auditoria
	    $description = 'REJISTU/ATUALIZA KONTRAKTU PROFILE : ' . $this->buscaProjectCode( $contractId ) . ' BA HAKAT 1 – INFORMASAUN GERAL';
	    $this->audit( $description, self::SALVAR );

	    $contractDAO->commit();
	    return $contractId;
	} catch ( Exception $e ) {

	    $contractDAO->rollBack();
	    return false;
	}
    }

    protected function _insertContractHasLocation( $contractId )
    {

	try {

	    // Insere vinculo de contrato com local
	    $contractHasLocationVO = new Model_VO_ContractHasLocation();
	    $contractHasLocationDAO = new Model_DAO_ContractHasLocation();

	    $sukuDAO = new Model_DAO_AddSuku();

	    if ( !empty( $this->_data['fatin_suku'] ) ) {

		foreach ( $this->_data['fatin_suku'] as $suku ) {

		    //busca o subdistrict
		    $sukuVO = $sukuDAO->fetchRow( array('id_suku' => $suku), array('fk_id_add_subdistrict') );

		    $contractHasLocationVO->setFkIdAddSubdistrict( $sukuVO->getFkIdAddSubdistrict()->getIdAddSubdistrict() );
		    $contractHasLocationVO->setFkIdAddSuku( $suku );
		    $contractHasLocationVO->setFkIdContract( $contractId );

		    $contractHasLocationDAO->insert( $contractHasLocationVO );
		}
	    }

	    return true;
	} catch ( Exception $e ) {

	    return false;
	}
    }

    public function savePlanejamento()
    {

	$contractDAO = new Model_DAO_Contract();
	$contractVO = new Model_VO_Contract();

	$contractDAO->beginTransaction();

	try {

	    $this->_data['total_cost_planned'] = ILO_Util_Geral::toFloat( $this->_data['total_cost_planned'] );
	    $this->_data['labour_cost_planned'] = ILO_Util_Geral::toFloat( $this->_data['labour_cost_planned'] );
	    $this->_data['date_start_planned'] = ILO_Util_Geral::dateToBd( $this->_data['date_start_planned'] );
	    $this->_data['date_finish_planned'] = ILO_Util_Geral::dateToBd( $this->_data['date_finish_planned'] );

	    $contractVO->setValues( $this->_data );
	    $contractId = $contractVO->getIdContract();

	    $contractDAO->update( $contractVO, array('id_contract' => $contractId) );

	    $description = 'ATUALIZA KONTRAKTU PROFILE : ' . $this->buscaProjectCode( $contractId ) . ' BA HAKAT 2 – PLANEAMENTU';
	    $this->audit( $description, self::SALVAR );

	    $contractDAO->commit();
	    return $contractId;
	} catch ( Exception $e ) {

	    $contractDAO->rollBack();

	    return false;
	}
    }

    public function saveExecucao()
    {

	$contractDAO = new Model_DAO_Contract();
	$contractVO = new Model_VO_Contract();

	$contractDAO->beginTransaction();

	try {

	    $this->_data['total_cost_real'] = ILO_Util_Geral::toFloat( $this->_data['total_cost_real'] );
	    $this->_data['labour_cost_real'] = ILO_Util_Geral::toFloat( $this->_data['labour_cost_real'] );
	    $this->_data['date_start_real'] = ILO_Util_Geral::dateToBd( $this->_data['date_start_real'] );
	    $this->_data['date_finish_real'] = ILO_Util_Geral::dateToBd( $this->_data['date_finish_real'] );

	    $contractVO->setValues( $this->_data );
	    $contractId = $contractVO->getIdContract();

	    $contractDAO->update( $contractVO, array('id_contract' => $contractId) );

	    $description = 'ATUALIZA KONTRAKTU PROFILE : ' . $this->buscaProjectCode( $contractId ) . ' BA HAKAT 3 – EZEKUSAUN';
	    $this->audit( $description, self::SALVAR );

	    $contractDAO->commit();
	    return $contractId;
	} catch ( Exception $e ) {

	    ILO_Util_Debug::dump( $e->getMessage() );
	    $contractDAO->rollBack();

	    return false;
	}
    }

    public function savePagamento()
    {
	$workerPaymentDAO = new Model_DAO_WorkerPayment();
	$workerPaymentVO = new Model_VO_WorkerPayment();

	$workerPaymentDAO->beginTransaction();
	try {

	    if ( empty( $this->_data['worker'] ) ) {
		$this->setError( ILO_Util_Translate::get( 'Escolha pelo menos 1(um) Beneficiário', 156 ) );
		return false;
	    }

	    $this->_data['salary_day'] = ILO_Util_Geral::toFloat( $this->_data['salary_day'] );
	    $this->_data['total_salary'] = ILO_Util_Geral::toFloat( $this->_data['total_salary'] );
	    $this->_data['date_payment'] = ILO_Util_Geral::dateToBd( $this->_data['date_payment'] );

	    $workerPaymentVO->setValues( $this->_data );

	    foreach ( $this->_data['worker'] as $worker ) {

		$this->_data['id_worker'] = $worker;

		// valida se ja existe pagamento na mesma data para o beneficiario
		if ( !$this->_validaPagamento( $this->_data ) ) {
		    return false;
		}

		// Insere registro de pagamento
		$workerPaymentId = $workerPaymentDAO->insert( $workerPaymentVO );

		// Vincula pagamento ao beneficiario
		$workerHasPaymentDAO = new Model_DAO_WorkerHasPayment();
		$workerHasPaymentVO = new Model_VO_WorkerHasPayment();

		$workerHasPaymentVO->setFkIdWorker( $worker );
		$workerHasPaymentVO->setFkIdWorkerPayment( $workerPaymentId );
		$workerHasPaymentDAO->insert( $workerHasPaymentVO );

		$description = 'ATUALIZA KONTRAKTU PROFILE: ' . $this->buscaProjectCode( $this->_data['id_contract'] ) . ' BA HAKAT 4 – PAGAMENTU';
		$this->audit( $description, self::SALVAR );
	    }

	    $workerPaymentDAO->commit();
	    return $this->_data['id_contract'];
	} catch ( Exception $e ) {
	    ILO_Util_Debug::dump( $e->getMessage() );
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

    protected function _getNumSequence( $vo )
    {

	try {

	    $contractDAO = new Model_DAO_Contract();
	    $result = $contractDAO->queryResult( "SELECT IFNULL(MAX(num_sequence),0) + 1  AS num_sequence
                                                    FROM contract c WHERE
                                                    c.num_project = '" . $vo->getNumProject() . "' AND
                                                    c.num_district = '" . $vo->getNumDistrict() . "' AND
                                                    c.num_activity = '" . $vo->getNumActivity() . "' AND
                                                    c.num_year = '" . $vo->getNumYear() . "'" );
	} catch ( Exeception $e ) {

	    ILO_Util_Debug::dump( $e->getMessage() );
	}

	return $result[0]['num_sequence'];
    }

    public function buscaProjectCode( $contractId )
    {

	$contractDAO = new Model_DAO_Contract();
	$contractVO = $contractDAO->fetchRow( array('id_contract' => $contractId) );

	$codProject = array();

	if ( !empty( $contractVO ) ) {

	    $codProject = array(
		$contractVO->getNumProject(),
		$contractVO->getNumDistrict(),
		$contractVO->getNumActivity(),
		$contractVO->getNumYear(),
		$contractVO->getNumSequence()
	    );
	}

	return implode( '-', $codProject );
    }

    public function buscarTotalContrato( $id_contrato )
    {

	try {

	    $contractDAO = new Model_DAO_Contract();
	    $result = $contractDAO->queryResult( "
                    SELECT COUNT(DISTINCT whp.fk_id_worker) AS qtd,
                           IFNULL(SUM(wp.total_salary),0) AS total_salary
                    FROM worker_has_payment whp
                    INNER JOIN worker_payment wp ON wp.id_worker_payment = whp.fk_id_worker_payment
                    WHERE whp.fk_id_worker IN(
                            SELECT DISTINCT c.fk_id_worker FROM contract_has_worker c WHERE c.fk_id_contract = $id_contrato
                    )" );
	} catch ( Exeception $e ) {

	    ILO_Util_Debug::dump( $e->getMessage() );
	}
	return $result;
    }

    public function saveEmpresa()
    {
	$contractDAO = new Model_DAO_Contract();
	$contractDAO->beginTransaction();
	try {

	    // Busca contrato
	    $contractVO = $contractDAO->fetchRow( array('id_contract' => $this->_data['id_contract']) );

	    $contractVO->setFkIdEnterprise( $this->_data['empresa'] );
	    $contractDAO->update( $contractVO, array('id_contract' => $this->_data['id_contract']) );

	    $description = 'ATUALIZA KONTRAKTU PROFILE: ' . $contractVO->getProjectCode() . ' BA HAKAT 5 – EMPREZA/KOMPANIA';
	    $this->audit( $description, self::SALVAR );

	    $contractDAO->commit();

	    return $this->_data['id_contract'];
	} catch ( Exception $e ) {

	    $contractDAO->rollBack();
	    return false;
	}
    }

    /**
     *
     * @param int $contract_id
     * @return string
     */
    public function nomeEmpresaContrato( $contract_id )
    {
	$contractDAO = new Model_DAO_Contract();
	$contractVO = $contractDAO->fetchRow( array('id_contract' => $contract_id) );

	$enterpriseVO = $contractVO->getFkIdEnterprise();

	if ( empty( $enterpriseVO ) )
	    return null;

	return implode( ' - ', array(
				$enterpriseVO->getNumeroEmpresa(),
				$enterpriseVO->getEnterpriseName(),
				$enterpriseVO->getOwnerName()
			)
	);
    }

    /**
     *
     * @return mixed
     */
    public function saveRegistro()
    {
	$contractHasRecordDAO = new Model_DAO_ContractHasRecord();
	$contractHasRecordVO = new Model_VO_ContractHasRecord();
        $contractsHasRecordVO = $contractHasRecordDAO->fetchRow( array( 'fk_id_contract' => $this->_data['id_contract'] ,'cert_num' =>  $this->_data['cert_num']) );
        
        if (!empty($contractsHasRecordVO)){
            $this->setError (ILO_Util_Translate::get("Labele save. Iha rejistu Cert. no tiha ona", 535));
            return false;
        }
	$contractHasRecordDAO->beginTransaction();

	try {
            
            //Final payment    
            if ($this->_data['category'] == 'FP'){           
              
                $this->_data['invoice_amount'] = 0;
                $this->_data['amount'] = ILO_Util_Geral::toFloat( $this->_data['amount'] );
                $this->_data['retention'] = 0;
                $this->_data['advances'] = 0;
                $this->_data['net_payment'] = ILO_Util_Geral::toFloat( $this->_data['net_payment'] );
                $this->_data['contract_balance'] = ILO_Util_Geral::toFloat( $this->_data['contract_balance'] );
                $this->_data['other_value'] = $this->_data['indicator'] . ILO_Util_Geral::toFloat( $this->_data['other_value'] );
                $this->_data['date_record'] = ILO_Util_Geral::dateToBd( $this->_data['date_record'] );
                $this->_data['fk_id_contract'] = $this->_data['id_contract'];
                $this->_data['other_justification'] = "Other Value: " . $this->_data['other_value']." | ". $this->_data['other_justification'];
                
                $contractHasRecordVO->setValues( $this->_data );

                $contractHasRecordDAO->insert( $contractHasRecordVO );

            } else {              
                //Todos os outros pagamentos
                $this->_data['invoice_amount'] = ILO_Util_Geral::toFloat( $this->_data['invoice_amount'] );
                $this->_data['amount'] = ILO_Util_Geral::toFloat( $this->_data['amount'] );
                $this->_data['retention'] = ILO_Util_Geral::toFloat( $this->_data['retention'] );
                $this->_data['advances'] = ILO_Util_Geral::toFloat( $this->_data['advances'] );
                $this->_data['net_payment'] = ILO_Util_Geral::toFloat( $this->_data['net_payment'] );
                $this->_data['contract_balance'] = ILO_Util_Geral::toFloat( $this->_data['contract_balance'] );
                $this->_data['other_value'] = $this->_data['indicator'] . ILO_Util_Geral::toFloat( $this->_data['other_value'] );
                $this->_data['date_record'] = ILO_Util_Geral::dateToBd( $this->_data['date_record'] );
                $this->_data['fk_id_contract'] = $this->_data['id_contract'];
                $this->_data['other_justification'] = "Other Value: " . $this->_data['other_value']." | ". $this->_data['other_justification'];

                $contractHasRecordVO->setValues( $this->_data );

                $contractHasRecordDAO->insert( $contractHasRecordVO );

                //addd registro de works caso seja pagamento de Wages
                if ($this->_data['category'] == "WA"){

                    $this->_data['category'] = "works";
                    $this->_data['invoice_amount'] = 0;
                    $this->_data['amount'] = ILO_Util_Geral::toFloat( $this->_data['works'] );
                    $this->_data['retention'] = 0;
                    $this->_data['advances'] = 0;
                    $this->_data['net_payment'] = 0;
                    $this->_data['contract_balance'] = 0;
                    $this->_data['date_record'] = ILO_Util_Geral::dateToBd( $this->_data['date_record'] );
                    $this->_data['fk_id_contract'] = $this->_data['id_contract'];

                    $contractHasRecordVO->setValues( $this->_data );

                    $contractHasRecordDAO->insert( $contractHasRecordVO );
                }
            }            

	    $description = 'ATUALIZA KONTRAKTU PROFILE : ' . $this->buscaProjectCode( $this->_data['id_contract'] ) . ' BA HAKAT 2 – KONTRAKTU RECORD';
	    $this->audit( $description, self::SALVAR );

	    $contractHasRecordDAO->commit();
	    return $this->_data['id_contract'];
	    
	} catch ( Exception $e ) {

	    $contractHasRecordDAO->rollBack();
	    
	    return false;
	}
    }
    
    /**
     *
     * @param int $id
     * @return array
     */
    public function listContratos( $id )
    {
	$contratHasRecordDAO = new Model_DAO_ContractHasRecord();
	$contractsHasRecordVO = $contratHasRecordDAO->fetchAll( array( 'date_record' ), array( 'fk_id_contract' => $id ) );
	
	// Busca contrato
	$contractDAO = new Model_DAO_Contract();
	$contractVO = $contractDAO->fetchRow( array( 'id_contract' => $id ) );
	
	// Pega total do contrato
	$totalContract = (float)$contractVO->getTotalContract();
	
	$data = array(
	    'rows'	    => array(),
	    'invoices'	    => 0,
	    'net_pays'	    => 0,
	    'progress_pay'  => 0,
	    'advances'	    => 0,
	    'retentions'    => 0,
	    'balances'	    => 0,
	    'compl'	    => 0
	);
	
	foreach ( $contractsHasRecordVO as $contractVO ) {
	    
	    $contract = $contractVO->toArray();
	    
	    $data['invoices'] += (float)$contract['invoice_amount'];
	    $data['net_pays'] += (float)$contract['net_payment'];
	    $data['progress_pay'] += (float)$contract['amount'];
	    $data['advances'] += (float)$contract['advances'];
	    $data['retentions'] += (float)$contract['retention'];
	    //$data['balances'] += (float) $contract['contract_balance'];
	    $data['balances'] = $totalContract - $data['net_pays'] ;
            
	    $contract['finan_compl'] = round( ( (float)$contract['invoice_amount'] / $totalContract ) * 100, 2 );
	    $contract['date_record'] = ILO_Util_Geral::dateToBr( $contract['date_record'] );
	    $contract['payment_origin'] = $contract['payment_origin'] == 'ILO' ? 'ILO' : 'Dom Bosco';
	    
	    switch ( $contract['category'] ) {
		case 'FA':
			$contract['category'] = 'First Advance';
		    break;
		case 'WA':
			$contract['category'] = 'Wages';
		    break;
                case 'W0':
			$contract['category'] = 'Works';
		    break;
                case 'FP':
			$contract['category'] = 'Final Payment';
		    break;
		default:
		    $contract['category'] = 'Works';
	    }
	    
	    $data['rows'][] = $contract;
	}
	
	$data['compl'] = round( ( (float)$data['invoices'] / $totalContract ) * 100,2);
	
	foreach ( $data as $key => $value ) {
	    
	    if ( $key == 'rows' )
		continue;
	    
	    $data[$key] = number_format( (float)$value, 2, '.', ',' );
	}
	
	/*
	$data['invoices'] += round( $data['invoices'], 2);
	$data['net_pays'] += round( $data['net_pays'], 2);
	$data['progress_pay'] += round( $data['progress_pay'], 2);
	$data['advances'] += round( $data['advances'], 2);
	$data['retentions'] += round( $data['retentions'], 2);
	$data['balances'] += round( $data['balances'], 2);
	*/
	return $data;
    }
    public function saveAmendment()
    {
        $amendmentDao = new Model_DAO_Amendment();
        $amendmentVO = new Model_VO_Amendment();
        $amendmentResultVO = new Model_VO_Amendment();
        $contractDao = new Model_DAO_Contract();
        $contractVO = new Model_VO_Contract();
        
        if($this->_data['type_amendment'] == 'amendment_value'){
            $this->_data['amendment_value'] = ILO_Util_Geral::toFloat($this->_data['amendment_value']);
                        
            $amendmentResultVO = $amendmentDao->fetchRow(array('fk_id_contract' => $this->_data['id_contract'],
                                                         'amendment_value' => $this->_data['amendment_value'],
                                                         'date_registration' => $this->_data['date_registration']));
            if (!empty($amendmentResultVO)){
                $this->setError (ILO_Util_Translate::get("Labele save. Iha Amendment hanesa ne'e tiha ona", 547));
                return false;
            }
            $contractVO->setTotalContract($this->_data['amendment_value']);
            
        } else {
            $this->_data['amendment_date']  = ILO_Util_Geral::dateToBd($this->_data['amendment_date']) ;
            
            $amendmentResultVO = $amendmentDao->fetchRow(array('fk_id_contract' => $this->_data['id_constract'],
                                                         'amendment_date' => $this->_data['amendment_date'],
                                                         'date_registration' => $this->_data['date_registration']));
            if (!empty($amendmentResultVO)){
                $this->setError (ILO_Util_Translate::get("Labele save. Iha Amendment hanesa ne'e tiha ona", 547));
                return false;
            }
            $contractVO->setDateFinishPlanned($this->_data['amendment_date']);
        }
        
        $amendmentDao->beginTransaction();
        
        try{
            
            //$this->_data['date_registry']   = date('Y-m-d h:i:s');
            $this->_data['date_registration']   = ILO_Util_Geral::dateToBd($this->_data['date_registration']) ;
            
            $amendmentResultVO = $amendmentDao->fetchRow(array('fk_id_contract' => $this->_data['id_contract']));
            
            if(empty($amendmentResultVO)){
                //insert the original value for this contract
                $amendmentUnincVO = new Model_VO_Amendment();
                $amendmentUnincVO->setFkIdContract($this->_data['id_contract']);
                $amendmentUnincVO->setOriginalValue($this->_data['contract_value']);
                $amendmentDao->insert($amendmentUnincVO);
            }
            
            $this->_data['contract_value'] = null;
            $this->_data['fk_id_contract'] = $this->_data['id_contract'];                 
            
            $amendmentVO->setValues($this->_data);
            
            $amendmentDao->insert($amendmentVO);
                        
            $contractDao->update($contractVO, array('id_contract' => $this->_data['id_contract']));
            
            $description = 'ATUALIZA KONTRAKTU PROFILE : ' . $this->buscaProjectCode( $this->_data['id_contract'] ) . ' BA HAKAT – KONTRAKTU AMENDMENT';
	    $this->audit( $description, self::SALVAR );

	    $amendmentDao->commit();
	    return $this->_data['id_contract'];
            
        } catch ( Exception $e ) {

	    $amendmentDao->rollBack();
	    var_dump($e);
	    return false;
	}
    }
    
    public function deleteRecord($id_relationship)
    {
        try{
            //echo "ta no BO, id:".$id_relationship;die;
            $contratHasRecordDAO = new Model_DAO_ContractHasRecord();
        
            $contratHasRecordDAO->delete( array('id_relationship' => $id_relationship) );
            
            return true;
            
        } catch (Exception $e) {
            
            $contratHasRecordDAO->rollBack();
            
            return false;
        }
    }

}