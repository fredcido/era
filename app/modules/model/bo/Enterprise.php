<?php

class Model_BO_Enterprise extends ILO_Model_BO
{

    public function saveGeral()
    {

	try {

	    $enterprise = (array)ILO_Util_Session::get( 'enterprise' );
	    $enterprise['geral'] = $this->_data;

	    ILO_Util_Session::set( 'enterprise', $enterprise );

	    if ( !empty( $this->_data['id_enterprise'] ) ) {

		$empresaDAO = new Model_DAO_Enterprise();
		$empresaVO = new Model_VO_Enterprise();

		if ( !empty( $this->_data['date_mcti'] ) )
		    $this->_data['date_mcti'] = ILO_Util_Geral::dateToBd( $this->_data['date_mcti'] );

		if ( !empty( $this->_data['date_mj'] ) )
		    $this->_data['date_mj'] = ILO_Util_Geral::dateToBd( $this->_data['date_mj'] );

		$empresaVO->setValues( $this->_data );

		$empresaId = $empresaVO->getIdEnterprise();
		$empresaDAO->update( $empresaVO, array('id_enterprise' => $empresaId) );
		
		$vo = $empresaDAO->fetchRow( array('id_enterprise' => $empresaId ) );

		// Salva auditoria
		$description = sprintf( 'ATUALIZA EMPREZA: %s  BA HAKAT 1 – INFORMASAUN GERAL', $vo->getNumeroEmpresa() );
		$this->audit( $description, self::SALVAR );
	    }
	   
	    return true;
	} catch ( Exception $e ) {

	    return false;
	}


	/*
	  $empresaDAO = new Model_DAO_Enterprise();
	  $empresaVO = new Model_VO_Enterprise();

	  $empresaDAO->beginTransaction();

	  try{

	  $this->_data['date_mtci'] = ILO_Util_Geral::dateToBd( $this->_data['date_mtci'] );
	  $this->_data['date_mj'] = ILO_Util_Geral::dateToBd( $this->_data['date_mj'] );

	  $empresaVO->setValues($this->_data);

	  if ( null == $empresaVO->getIdEnterprise() ) {

	  $empresaVO->setDateRegistration( date( 'Y-m-d' ) );
	  $empresaId = $empresaDAO->insert( $empresaVO );

	  } else {

	  $empresaId = $empresaVO->getIdClient();

	  $empresaVO->setDateRegistration( date( 'Y-m-d' ) );
	  $empresaDAO->update( $empresaVO, array( 'id_enterprise' => $empresaId ) );

	  }

	  // Salva auditoria
	  $description = 'REJISTU/ATUALIZA EMPREZA: NNNNNNNN BA HAKAT 1 – INFORMASAUN GERAL';
	  $this->audit( $description, self::SALVAR );

	  $empresaDAO->commit();
	  return $empresaId;

	  } catch ( Exception $e ) {

	  ILO_Util_Debug::dump($e->getMessage());
	  $empresaDAO->rollBack();

	  return false;
	  }
	 */
    }

    /**
     *
     * @return type 
     */
    public function saveContato()
    {
	try {
 	
	    $enterprise = (array)ILO_Util_Session::get( 'enterprise' );
	    $enterprise['contato'] = $this->_data;

	    ILO_Util_Session::set( 'enterprise', $enterprise );
		
	    if ( !empty( $this->_data['id_enterprise'] ) ) {
		
		$empresaDAO = new Model_DAO_Enterprise();
		$empresaVO = new Model_VO_Enterprise();
		
		$empresaVO->setValues( $this->_data );
		
		$empresaId = $empresaVO->getIdEnterprise();
		$empresaDAO->update( $empresaVO, array('id_enterprise' => $empresaId) );
		
		$vo = $empresaDAO->fetchRow( array('id_enterprise' => $empresaId ) );
		
		 // Salva auditoria
		$description = sprintf( 'ATUALIZA EMPREZA: %s  BA HAKAT 2 – KONTAKTU', $vo->getNumeroEmpresa() );
		$this->audit( $description, self::SALVAR );
	    }
	   
	    return true;
	    
	} catch ( Exception $e ) {
	    return false;
	}

	/*

	  $empresaDAO = new Model_DAO_Enterprise();
	  $empresaVO = new Model_VO_Enterprise();

	  $empresaDAO->beginTransaction();

	  try{

	  $empresaVO->setValues($this->_data);

	  if ( null != $empresaVO->getIdEnterprise() ) {

	  $empresaDAO->update( $empresaVO, array( 'id_enterprise' => $empresaVO->getIdEnterprise() ) );

	  } else {

	  $this->setError( ILO_Util_Translate::get( 'Erro ao efetuar operação', 25 ) );

	  }

	  // Salva auditoria
	  $description = 'REJISTU/ATUALIZA EMPREZA: NNNNNNNN BA HAKAT 2 – KLIENTE IADE/CDE MEMBRO EMPREZA';
	  $this->audit( $description, self::SALVAR );

	  $empresaDAO->commit();
	  return $empresaVO->getIdEnterprise();

	  } catch ( Exception $e ) {

	  ILO_Util_Debug::dump($e->getMessage());
	  $empresaDAO->rollBack();

	  return false;
	  }
	 */
    }

    /**
     *
     * @return bool
     */
    public function saveClientes()
    {
	$clientHasEnterpriseDAO = new Model_DAO_ClientHasEnterprise();

	try {
	    
	    $novos = !empty( $this->_data['clientes'] ) ? $this->_data['clientes'] : array();

	    if ( !empty( $this->_data['id_enterprise'] ) && !empty( $novos ) ) {

		// Lista clientes ja inseridos na empresa
		$clientes = $clientHasEnterpriseDAO->fetchAll( array(), array('fk_id_enterprise' => $this->_data['id_enterprise']) );

		$existentes = array();
		foreach ( $clientes as $cliente )
		    $existentes[] = $cliente->getFkIdClient()->getIdClient();

		// Verifica os que ainda não existem na turma
		$novos = array_diff( $this->_data['clientes'], $existentes );

		// Se nao tiver diferença
		if ( empty( $novos ) ) {

		    $this->setError( ILO_Util_Translate::get( 'Todos participantes selecionados já estão na turma', 327 ) );
		    return false;
		}
	    }
	    
	    if ( !empty( $this->_data['id_enterprise'] ) ) {
		
		$this->_data['clientes'] = $novos;
		$this->insertClientes( $this->_data );
	    
		$enterpriseDAO = new Model_DAO_Enterprise();
		$enterpriseVO = $enterpriseDAO->fetchRow( array( 'id_enterprise' => $this->_data['id_enterprise'] ) );
		$enterpriseVO->setIadeClient( $this->_data['iade_client'] );
		$enterpriseDAO->update( $enterpriseVO, array( 'id_enterprise' => $this->_data['id_enterprise'] ) );
		
		 // Salva auditoria
		$description = sprintf( 'ATUALIZA EMPREZA: %s  BA HAKAT 3 – PARTISIPANTE', $enterpriseVO->getNumeroEmpresa() );
		$this->audit( $description, self::SALVAR );
		
		$enterpriseS['clientes']['clientes'] = array_merge( $novos, $existentes );
	    }
	    
	    $enterpriseS = (array)ILO_Util_Session::get( 'enterprise' );
	    
	    if ( !empty( $enterpriseS['clientes']['clientes'] ) )
		$novos = array_merge( $novos, $enterpriseS['clientes']['clientes'] );
	    
	    $data['id_enterprise'] = $this->_data['id_enterprise'];
	    $data['iade_client'] = $this->_data['iade_client'];
	    $data['clientes'] = array_unique( $novos );
	    $enterpriseS['clientes'] = $data;
	    
	    ILO_Util_Session::set( 'enterprise', $enterpriseS );
	    
	    return true;
	    
	} catch ( Exception $e ) {

	    return false;
	}

	/*

	  $clientHasEnterpriseDAO = new Model_DAO_ClientHasEnterprise();
	  $clientHasEnterpriseVO = new Model_VO_ClientHasEnterprise();

	  $clientHasEnterpriseDAO->beginTransaction();
	  try {

	  // Lista estudantes ja inseridos na turma
	  $clientes = $clientHasEnterpriseDAO->fetchAll( array(), array( 'fk_id_student_class' => $this->_data['id'] ) );

	  $existentes = array();
	  foreach ( $clientes as $cliente )
	  $existentes[] = $cliente->getFkIdClient()->getIdClient();

	  // Verifica os que ainda não existem na turma
	  $novos = array_diff( $this->_data['clientes'], $existentes );

	  // Se nao tiver diferença
	  if ( empty( $novos ) ) {

	  $this->setError( ILO_Util_Translate::get( 'Todos participantes selecionados já estão na turma', 327 ) );
	  return false;
	  }

	  // Insere clientes na empresa
	  foreach ( $novos as $cliente ) {

	  $vo = clone $clientHasEnterpriseVO;

	  $vo->setFkIdEnterprise( $this->_data['id'] );
	  $vo->setFkIdClient( $cliente );

	  $clientHasEnterpriseDAO->insert( $vo );
	  }

	  $description = 'ATUALIZA EMPREZA: %s HAKAT 3 – KLIENTE IADE/CDE MEMBRO EMPREZA';
	  $this->audit( sprintf( $description, $this->_data['id'] ), self::SALVAR );

	  $clientHasEnterpriseDAO->commit();
	  return $this->_data['id'];

	  } catch ( Exception $e ) {

	  $clientHasEnterpriseDAO->rollBack();

	  ILO_Util_Debug::dump( $e );
	  exit;

	  return false;
	  }
	 */
    }

    /**
     *
     * @return type 
     */
    public function saveVolume()
    {
	try {

	    if ( empty( $this->_data['id_enterprise'] ) ) {
	    
		$enterprise = (array)ILO_Util_Session::get( 'enterprise' );
		$enterprise['volume'] = $this->_data;

		ILO_Util_Session::set( 'enterprise', $enterprise );
	    
	    } else {
		
		$incomesDAO = new Model_DAO_Incomes();
		$incomesVO = new Model_VO_Incomes();

		$incomesVO->setIncomeDate( date( 'Y-m-d' ) );
		$incomesVO->setFkIdEnterprise( $this->_data['id_enterprise'] );
		$incomesVO->setMontlyValue( ILO_Util_Geral::toFloat( $this->_data['sales_monthly'] ) );
		$incomesVO->setAnnualValue( ILO_Util_Geral::toFloat( $this->_data['sales_annual'] ) );
		$incomesDAO->insert( $incomesVO );
		
		 // Salva auditoria
		$description = sprintf( 'ATUALIZA EMPREZA: %s  BA HAKAT 4 – VOLUME NEGOSIU', $incomesVO->getFkIdEnterprise()->getNumeroEmpresa() );
		$this->audit( $description, self::SALVAR );
	    }
	    
	    return true;
	} catch ( Exception $e ) {

	    return false;
	}
    }

    /**
     *
     * @return type 
     */
    public function saveTipo()
    {

	$empresaDAO = new Model_DAO_Enterprise();
	$empresaVO = new Model_VO_Enterprise();

	$empresaDAO->beginTransaction();
	$data = array();

	try {

	    $dadoSession = ILO_Util_Session::get( 'enterprise' );
	    
	    $data = array();
	    
	    //dados da ABA TIPU NEGOSIU
	    $data += $this->_data;
	    
	    //objeto EnterpriseHasSectorSubsector
	    $enterpriseHasSectorVO = new Model_VO_EnterpriseHasSectorSubsector();
	    $enterpriseHasSectorDAO = new Model_DAO_EnterpriseHasSectorSubsector();
	    
	    //faz o tratamento para salvar district operation
	    if ( !empty( $data['district_operation'] ) ) {

		if ( in_array( "Hotu-Hotu", $data['district_operation'] ) )
		    $data['district_operation'] = "Hotu-Hotu";
		else
		    $data['district_operation'] = implode( '|', $data['district_operation'] );
	    }
	    
	    //verifica se é um novo registro ou alteracao de dados
	    if ( empty( $this->_data['id_enterprise'] ) ) {
		
		//dados da ABA GERAL
		$dataGeral = $dadoSession['geral'];

		if ( !empty( $dataGeral['date_mcti'] ) )
		    $dataGeral['date_mcti'] = ILO_Util_Geral::dateToBd( $dataGeral['date_mcti'] );

		if ( !empty( $dataGeral['date_mj'] ) )
		    $dataGeral['date_mj'] = ILO_Util_Geral::dateToBd( $dataGeral['date_mj'] );

		$data += $dataGeral;

		//dados da ABA CONTATO
		$dataContato = $dadoSession['contato'];
		$data += $dataContato;

		//dados da ABA VOLUME
		$dataVolume = $dadoSession['volume'];
		$data += $dataVolume;

		//dados da ABA CLIENTES
		if ( isset( $dadoSession['clientes'] ) )
		    $data += $dadoSession['clientes'];
		
		$empresaVO->setDateRegistration( date( 'Y-m-d' ) );
		$empresaVO->setNumYear( date( 'y' ) );
		$empresaVO->setNumSequence( $this->_getNumSequence( $empresaVO ) );
		$empresaVO->setActive( 'S' );
		
		 if ( !empty( $data['fk_id_add_district'] ) ) {
		
		    $districtDAO = new Model_DAO_AddDistrict();
		    $districtVO = $districtDAO->fetchRow( array('id_add_district' => $data['fk_id_add_district']) );
		    $data['num_district'] = $districtVO->getAcronym();
		}
		
		 //salva o resgistro na tabela enterprise
		$empresaVO->setValues( $data );
		
		$empresaId = $empresaDAO->insert( $empresaVO );

		//USUARIU NEE HALO REJISTU BA EMPREZA:
		$description = 'USUARIU NEE HALO REJISTU BA EMPREZA: %s';
		$this->audit( sprintf( $description, $this->getNumEmpresa( $empresaId ) ), self::SALVAR );

		$data['id_enterprise'] = $empresaId;

		//salva os clientes
		$this->insertClientes( $data );
		
		//salva na tabela INCOMES
		if ( !empty( $data['sales_monthly'] ) ) {

		    $incomesDAO = new Model_DAO_Incomes();
		    $incomesVO = new Model_VO_Incomes();

		    $incomesVO->setIncomeDate( date( 'Y-m-d' ) );
		    $incomesVO->setFkIdEnterprise( $empresaId );
		    $incomesVO->setMontlyValue( ILO_Util_Geral::toFloat( $data['sales_monthly'] ) );
		    $incomesVO->setAnnualValue( ILO_Util_Geral::toFloat( $data['sales_annual'] ) );
		    $incomesDAO->insert( $incomesVO );
		}
		
	    } else {
		
		 //salva o resgistro na tabela enterprise
		$empresaVO->setValues( $data );

		$empresaId = $empresaVO->getIdEnterprise();
		$empresaDAO->update( $empresaVO, array('id_enterprise' => $empresaId) );

		$data['id_enterprise'] = $empresaId;
		
		$description = 'ATUALIZA EMPREZA: %s  BA HAKAT 5 – TIPU NEGOSIU';
		$this->audit( sprintf( $description, $this->getNumEmpresa( $empresaId ) ), self::SALVAR );

		//salva os clientes
		$this->insertClientes( $data );

		//exclui da tabela enterprise has sector subsector
		$enterpriseHasSectorDAO->delete( array('fk_id_enterprise' => $empresaId) );
	    }

	    //salva na tabela enterprise has sector subsector            
	    $data['fk_id_enterprise'] = $empresaId;
	    foreach ( $data['sub-sector'] as $subSector ) {
		$data['fk_id_subsector'] = $subSector;
		$enterpriseHasSectorVO->setValues( $data );
		$enterpriseHasSectorDAO->insert( $enterpriseHasSectorVO );
	    }
	    
	    ILO_Util_Session::remove( 'enterprise' );

	    $empresaDAO->commit();

	    return $empresaId;
	} catch ( Exception $e ) {

	    $empresaDAO->rollBack();
	    return false;
	}
    }

    public function insertClientes( array $data )
    {
	try {
	    
	    //salva os clientes
	    if ( !empty( $data['clientes'] ) ) {

		$clienteHasEnterpriseDAO = new Model_DAO_ClientHasEnterprise();
		$clienteHasEnterpriseVO = new Model_VO_ClientHasEnterprise();

		foreach ( $data['clientes'] as $cliente ) {
		    $clienteHasEnterpriseVO->setFkIdClient( $cliente );
		    $clienteHasEnterpriseVO->setFkIdEnterprise( $data['id_enterprise'] );
		    $clienteHasEnterpriseDAO->insert( $clienteHasEnterpriseVO );
		}
	    }

	    return true;
	} catch ( Exception $e ) {

	    return false;
	}
    }

    /*
     * 
     */

    public function removeClientes( array $dados )
    {

	$clientHasEnterpriseDAO = new Model_DAO_ClientHasEnterprise();

	$clientHasEnterpriseDAO->beginTransaction();
	try {
	    
	    $empresa = ILO_Util_Session::get( 'enterprise' );
	    
	    if ( empty( $empresa['clientes'] ) && empty( $dados['id_enterprise'] ) )
		return true;
	    
	    $clientesSession = empty( $empresa['clientes']['clientes'] ) ? array() : (array)$empresa['clientes']['clientes'];
	    
	    // Remove participantes da turma
	    foreach ( $dados['clientes'] as $cliente ) {
		
		if ( !empty( $dados['id_enterprise'] ) ) {
		
		    $where = array(
			'fk_id_client' => $cliente,
			'fk_id_enterprise' => $dados['id_enterprise']
		    );
		    
		    // Remove clientes da empresa
		    $clientHasEnterpriseDAO->delete( $where );
		
		}
		
		if ( false !== ( $pos = array_search( $cliente, $clientesSession ) ) )
		    unset( $clientesSession[$pos] );
	    }
	    
	    $empresa['clientes']['clientes'] = array_unique( $clientesSession );
	    ILO_Util_Session::set( 'enterprise', $empresa );

	    $clientHasEnterpriseDAO->commit();
	    return true;
	    
	} catch ( Exception $e ) {

	    $clientHasEnterpriseDAO->rollBack();

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

	    $this->_data['fk_id_add_country'] = 1;

	    $this->_data['fk_id_enterprise'] = $this->_data['fk_id_enterprise'];

	    $addressGeneralVO = new Model_VO_AddressGeneral();

	    $addressGeneralVO->setValues( $this->_data );

	    // Insere endereço do escritoriu
	    $addressGeneralDAO->insert( $addressGeneralVO );
	    
	    $enterpriseDAO = new Model_DAO_Enterprise();
	    $empresaVO = $enterpriseDAO->fetchRow( array( 'id_enterprise' => $this->_data['fk_id_enterprise'] ) );
	    
	    // Salva auditoria
	    $description = sprintf( 'ATUALIZA EMPREZA: %s  BA HAKAT 6 – ENDERESU', $empresaVO->getNumeroEmpresa() );
	    $this->audit( $description, self::SALVAR );

	    $addressGeneralDAO->commit();
	    return $this->_data['fk_id_enterprise'];
	} catch ( Exception $e ) {

	    $addressGeneralDAO->rollBack();
	    return false;
	}
    }

    /*
     * 
     */

    protected function _getNumSequence( $vo )
    {
	try {

	    $contractDAO = new Model_DAO_Contract();
	    
	    $query = "SELECT IFNULL(MAX(num_sequence),0) + 1  AS num_sequence
                                                    FROM enterprise c WHERE
                                                    c.num_district = '" . $vo->getNumDistrict() . "' AND
                                                    c.num_year = '" . $vo->getNumYear() . "'";
	    
	    $result = $contractDAO->queryResult( $query );
	} catch ( Exeception $e ) {

	}

	return $result[0]['num_sequence'];
    }

    public function getNumEmpresa( $id )
    {

	$empresaDAO = new Model_DAO_Enterprise();
	$vo = $empresaDAO->fetchRow( array('id_enterprise' => $id) );

	return $vo->getNumEnt() . '-' . $vo->getNumDistrict() . '-' . $vo->getNumYear() . '-' . $vo->getNumSequence();
    }

    /**
     *
     * @return type 
     */
    public function searchEnterprises()
    {
	$enterpriseDAO = new Model_DAO_Enterprise();

	$filters = array();

	// Filtra por nome
	if ( !empty( $this->_data['name'] ) )
	    $filters[] = 'enterprise_name LIKE "%' . $this->_data['name'] . '%"';

	if ( !empty( $this->_data['num'] ) )
	    $filters[] = 'CONCAT(num_ent, "-", num_district, "-", num_year, "-", num_sequence ) LIKE "%' . $this->_data['num'] . '%"';

	return $enterpriseDAO->fetchAll( array('enterprise_name'), $filters );
    }

    /**
     *
     * @return type 
     */
    public function saveAsset()
    {
	try {
	    
	    $this->_data['fk_id_enterprise'] = $this->_data['id_enterprise'];
	    
	    $assetDAO = new Model_DAO_Asset();
	    $assetVO = new Model_VO_Asset();

	    $assetVO->setValues( $this->_data );
	    
	    if ( empty( $this->_data['id_asset'] ) )
		$assetDAO->insert( $assetVO );
	    else {
		$assetDAO->update( $assetVO, array( 'id_asset' => $this->_data['id_asset'] ) );
	    }
	    
	     // Salva auditoria
	    $description = sprintf( 'ATUALIZA EMPREZA: %s  BA HAKAT 7 – ASSET', $this->getNumEmpresa( $this->_data['id_enterprise'] ) );
	    $this->audit( $description, self::SALVAR );
	    
	    return true;
	} catch ( Exception $e ) {
	    var_dump( $e );
	    exit;
	    return false;
	}
    }
    
    /**
     *
     * @return type 
     */
    public function savePreviousContract()
    {
	try {
	    
	    $this->_data['fk_id_enterprise'] = $this->_data['id_enterprise'];
	    $this->_data['start_date'] = ILO_Util_Geral::dateToBd( $this->_data['start_date'] );
	    $this->_data['finish_date'] = ILO_Util_Geral::dateToBd( $this->_data['finish_date'] );
	    $this->_data['total_contract'] = ILO_Util_Geral::toFloat( $this->_data['total_contract'] );
	    
	    $previousContractDAO = new Model_DAO_PreviousContract();
	    $previousContractVO = new Model_VO_PreviousContract();

	    $previousContractVO->setValues( $this->_data );
	    
	    if ( empty( $this->_data['id_previous_contract'] ) )
		$previousContractDAO->insert( $previousContractVO );
	    else {
		$previousContractDAO->update( $previousContractVO, array( 'id_previous_contract' => $this->_data['id_previous_contract'] ) );
	    }
	    
	     // Salva auditoria
	    $description = sprintf( 'ATUALIZA EMPREZA: %s  BA HAKAT 8 – KONTRAKTU ULUK', $this->getNumEmpresa( $this->_data['id_enterprise'] ) );
	    $this->audit( $description, self::SALVAR );
	    
	    return true;
	} catch ( Exception $e ) {
	    
	    ILO_Util_Debug::dump($e);
	    exit;
	    return false;
	}
    }
    
    public function deleteAsset( $id )
    {
	try {
	    
	    $assetDAO = new Model_DAO_Asset();
	    $assetDAO->delete( array( 'id_asset' => $id ) );
	    
	    return true;
	} catch ( Exception $e ) {

	    return false;
	}
    }
    
    public function deletePreviousContract( $id )
    {
	try {
	    
	    $previousContractDAO = new Model_DAO_PreviousContract();
	    $previousContractDAO->delete( array( 'id_previous_contract' => $id ) );
	    
	    return true;
	} catch ( Exception $e ) {

	    return false;
	}
    }
}