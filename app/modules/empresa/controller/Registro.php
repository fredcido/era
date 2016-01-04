<?php

class Empresa_Controller_Registro extends ILO_Controller_Padrao
{

    /**
     *
     * @var array
     */
    protected $_accessMapping = array(
	'salvar' => array(
	    'geral',
	    'savegeral',
	    'contato',
	    'savecontato',
	    'volume',
	    'savevolume',
	    'clientes',
	    'saveclientes',
	    'buscaclientes',
	    'listclientes',
	    'tipo',
	    'savetipo',
	    'carregarsubsector',
	    'removeclientes',
	    'listvolumevendas',
	    'endereco',
	    'saveendereco',
	    'removerendereco',
	    'subsector',
	    'contratos',
	    'asset',
	    'listasset',
	    'saveasset',
	    'deleteasset',
	    'getasset',
	    'previouscontract',
	    'getpreviouscontract',
	    'listpreviouscontract',
	    'savepreviouscontract',
	    'deletepreviouscontract'
	),
	'consultar' => array(
	    'index'
	)
    );

    /**
     *
     * @var array
     */
    protected $_abas = array(
	array(
	    'label' => 'Informação Geral',
	    'id' => 51,
	    'url' => '/empresa/registro/geral/id/',
	    'liberado' => false,
	    'action' => 'geral',
	    'selected' => true,
	    'require' => 'id_enterprise'
	),
	array(
	    'label' => 'Contato',
	    'id' => 307,
	    'url' => '/empresa/registro/contato/id/',
	    'liberado' => false,
	    'action' => 'contato',
	    'require' => 'id_enterprise'
	),
	array(
	    'label' => 'Partisipante Treino',
	    'id' => 315,
	    'url' => '/empresa/registro/clientes/id/',
	    'liberado' => false,
	    'action' => 'clientes',
	    'require' => 'id_enterprise'
	),
	array(
	    'label' => 'Volume Negosiu',
	    'id' => 316,
	    'url' => '/empresa/registro/volume/id/',
	    'liberado' => false,
	    'action' => 'volume',
	    'require' => 'id_enterprise'
	),
	array(
	    'label' => 'Tipu Negosiu',
	    'id' => 336,
	    'url' => '/empresa/registro/tipo/id/',
	    'liberado' => false,
	    'action' => 'tipo',
	    'require' => 'id_enterprise'
	),
	array(
	    'label' => 'Enderesu Eskritoriu',
	    'id' => 348,
	    'url' => '/empresa/registro/endereco/id/',
	    'liberado' => false,
	    'action' => 'endereco',
	    'require' => 'id_enterprise'
	),
	array(
	    'label' => 'Asset',
	    'id' => 600,
	    'url' => '/empresa/registro/asset/id/',
	    'liberado' => false,
	    'action' => 'asset',
	    'require' => 'id_enterprise'
	),
	array(
	    'label' => 'Contrato anterior',
	    'id' => 602,
	    'url' => '/empresa/registro/previouscontract/id/',
	    'liberado' => false,
	    'action' => 'previouscontract',
	    'require' => 'id_enterprise'
	),
	array(
	    'label' => 'Contratos',
	    'id' => 157,
	    'url' => '/empresa/registro/contratos/id/',
	    'liberado' => false,
	    'action' => 'contratos',
	    'require' => 'id_enterprise'
	)
    );

    /**
     *
     * @var string
     */
    protected $_action;

    public function init()
    {
	$this->view->action = ILO_Router_Dispatcher::getAction();
    }

    /**
     *
     * @param Model_VO_Empresa $data 
     */
    protected function _liberaAbas( array $data = null )
    {
	foreach ( $this->_abas as $key => $aba ) {

	    $this->_abas[$key]['url'] .= @$data['id_enterprise'];

	    if ( !empty( $data[$aba['require']] ) )
		$this->_abas[$key]['liberado'] = true;

	    $this->_abas[$key]['selected'] = $aba['action'] == $this->view->action ? true : false;
	}

	$this->view->renderNewView( 'formulario' );
	$this->view->abas = $this->_abas;
    }

    /**
     * 
     */
    public function indexAction()
    {
	ILO_Util_Session::remove( 'enterprise' );

	$orderEmpresa = array(
	    'enterprise_name',
	    'id_enterprise'
	);

	$empresaDAO = new Model_DAO_Enterprise();
	$empresas = $empresaDAO->fetchAll( $orderEmpresa );

	$dataJson['rows'] = array();

	if ( !empty( $empresas ) ) {

	    foreach ( $empresas as $key => $empresa ) {

		$dataJson['rows'][] = array(
		    'id' => $empresa->getIdEnterprise(),
		    'data' => array(
			++$key,
			$empresa->getNumeroEmpresa(),
			$empresa->getEnterpriseName(),
			$empresa->getOwnerName(),
		    )
		);
	    }
	}

	$this->view->dataEmpresas = json_encode( $dataJson );
    }

    /**
     * 
     */
    public function geralAction()
    {
	$data = array();
	
	$empresa = ILO_Util_Session::get( 'enterprise' );
	
	if ( !empty( $empresa['geral'] ) )
	    $data = $empresa['geral'];
	else {
	    
	    $id = $this->getParam( 'id' );
	    
	    if ( !empty( $id ) ) {

		$empresaDAO = new Model_DAO_Enterprise();
		$vo = $empresaDAO->fetchRow( array('id_enterprise' => $id ) );

		$data = $vo->toArray();

		$data['date_mcti'] = ILO_Util_Geral::dateToBr( $data['date_mcti'] );
		$data['date_mj'] = ILO_Util_Geral::dateToBr( $data['date_mj'] );

		$this->view->numEmpresa = $vo->getNumeroEmpresa();
	    }
	}
	
	$this->view->data = json_encode( $data );
	$this->_liberaAbas( $data );
    }

    /**[
     * 
     */
    public function savegeralAction()
    {
	$empresaBO = new Model_BO_Enterprise();
	$retorno['error'] = !$empresaBO->setData( $this->getParams() )->saveGeral();

	echo json_encode( $retorno );
	exit;
    }

    /**
     * 
     */
    public function contatoAction()
    {
	$empresa = ILO_Util_Session::get( 'enterprise' );
	
	$data = array();
	if ( !empty( $empresa['contato'] ) ) 
	    $data = $empresa['contato'];
	else {
	    
	    $id = $this->getParam( 'id' );
	    
	    if ( !empty( $id ) ) {

		$empresaDAO = new Model_DAO_Enterprise();
		$empresaVO = $empresaDAO->fetchRow( array('id_enterprise' => $id) );

		$data = $empresaVO->toArray();
		$data['id_enterprise'] = $id;

		$this->view->numEmpresa = $empresaVO->getNumeroEmpresa();
	    }
	}

	$this->_liberaAbas( $data );
	$this->view->data = json_encode( $data );
    }

    /**
     * 
     */
    public function savecontatoAction()
    {
	$empresaBO = new Model_BO_Enterprise();
	$retorno['error'] = !$empresaBO->setData( $this->getParams() )->saveContato();

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function clientesAction()
    {
	$empresa = ILO_Util_Session::get( 'enterprise' );
	
	$data = array();
	if ( !empty( $empresa['clientes'] ) ) 
	    $data = $empresa['clientes'];
	else {
	    
	    $id = $this->getParam( 'id' );

	    if ( !empty( $id ) ) {

		$empresaDAO = new Model_DAO_Enterprise();
		$empresaVO = $empresaDAO->fetchRow( array( 'id_enterprise' => $id ) );

		$data = $empresaVO->toArray();
		$data['id_enterprise'] = $id;

		$this->view->numEmpresa = $empresaVO->getNumeroEmpresa();
		
		$clientes = array();
		
		$clientHasEnterpriseDAO =  new Model_DAO_ClientHasEnterprise();
		$rows = $clientHasEnterpriseDAO->fetchAll(array(), array( 'fk_id_enterprise' => $id ) );
		
		foreach ( $rows as $row )
		    $clientes[] = $row->getFkIdClient()->getIdClient();
		
		$empresa['clientes'] = array(
		    'id_enterprise' => $id,
		    'iade_client'   => $empresaVO->getIadeClient(),
		    'clientes'	=> $clientes
		);
		
		ILO_Util_Session::set( 'enterprise', $empresa );
	    }
	}
	
	unset( $data['clientes'] );

	$this->view->data = json_encode( $data );
	$this->_liberaAbas( $data );
    }

    /**
     * 
     */
    public function saveclientesAction()
    {
	$empresaBO = new Model_BO_Enterprise();
	$empresaBO->setData( $this->getParams() );

	$retorno['error'] = !$empresaBO->setData( $this->getParams() )->saveClientes();
	
	if ( $retorno['error'] )
	    $retorno['msg'] = $empresaBO->getError();

	echo json_encode( $retorno );
	exit;
    }

    /**
     * 
     */
    public function buscaclientesAction()
    {
	// Lista participantes
	$clientDAO = new Model_BO_CliClient();
	$clients = $clientDAO->setData( $this->getParams() )->searchClients();

	$dataJson['rows'] = array();

	if ( !empty( $clients ) ) {

	    foreach ( $clients as $key => $client ) {

		$sexo = $client->getGender() == 'M' ?
			$this->view->t( 'Masculino', 83 ) :
			$this->view->t( 'Feminino', 84 );


		$dataJson['rows'][] = array(
		    'id' => $client->getIdClient(),
		    'data' => array(
			++$key,
			0,
			$client->getFirstName(),
			$client->getLastName(),
			$client->getNumeroCliente(),
			$sexo,
		    )
		);
	    }
	}

	echo json_encode( $dataJson );
	exit;
    }

    /*
     * 
     */

    public function listclientesAction()
    {
	$empresa = ILO_Util_Session::get( 'enterprise' );
	$dataJson['rows'] = array();
	
	if ( !empty( $empresa['clientes'] ) ) {
	  
	    $clientes = $empresa['clientes'];
	    
	    if ( !empty( $clientes['clientes'] ) ) {
		
		$sql =  'SELECT * FROM cli_client WHERE id_client IN(' . implode( ',', $clientes['clientes'] ) . ')';
		
		$clientDAO = new Model_DAO_CliClient();
		$clientes = $clientDAO->queryResult( $sql );
		
		if ( !empty( $clientes ) ) {

		    foreach ( $clientes as $key => $client ) {

			$sexo = $client['gender'] == 'M' ?
				$this->view->t( 'Masculino', 83 ) :
				$this->view->t( 'Feminino', 84 );

			$numClient = array(
			    $client['num_district'],
			    $client['num_year'],
			    $client['num_sequence']
			);

			$dataJson['rows'][] = array(
			    'id' => $client['id_client'],
			    'data' => array(
				++$key,
				0,
				$client['first_name'] . ' ' . $client['last_name'],
				implode( '-', $numClient ),
				$sexo,
			    )
			);
		    }
		}
	    }
	    
	} else {

	    $id = $this->getParam( 'id' );

	    if ( !empty( $id ) ) {

		// Lista clientes ja vinculados a empresa
		$clientHasEnterpriseDAO = new Model_DAO_ClientHasEnterprise();
		$clients = $clientHasEnterpriseDAO->fetchAll( array(), array('fk_id_enterprise' => $id) );

		//busca empresa
		$empresaDAO = new Model_DAO_Enterprise();
		$empresaVO = $empresaDAO->fetchRow( array('id_enterprise' => $id) );

		if ( !empty( $clients ) ) {

		    foreach ( $clients as $key => $client ) {

			$client = $client->getFkIdClient();

			$sexo = $client->getGender() == 'M' ?
				$this->view->t( 'Masculino', 83 ) :
				$this->view->t( 'Feminino', 84 );


			$dataJson['rows'][] = array(
			    'id' => $client->getIdClient(),
			    'data' => array(
				++$key,
				0,
				$client->getFirstName() . ' ' . $client->getLastName(),
				$empresaVO->getNumeroEmpresa() . ' - ' . $client->getNumeroCliente(),
				$sexo,
			    )
			);
		    }
		}
	    }
	}

	echo json_encode( $dataJson );
	exit;
    }
    
    /**
     * 
     */
    public function volumeAction()
    {
	$empresa = ILO_Util_Session::get( 'enterprise' );
	$data = array();
	
	if ( !empty( $empresa['volume'] ) ) 
	    $data = $empresa['volume'];
	else {
	    
	    $id = $this->getParam( 'id' );
	    
	    if ( !empty( $id ) ) {

		$empresaDAO = new Model_DAO_Enterprise();
		$empresaVO = $empresaDAO->fetchRow( array( 'id_enterprise' => $id ) );

		$data = $empresaVO->toArray();
		$data['id_enterprise'] = $id;

		$this->view->numEmpresa = $empresaVO->getNumeroEmpresa( $id );
	    }
	}
	
	$this->view->data = json_encode( $data );
	$this->_liberaAbas( $data );
    }

    /**
     * 
     */
    public function savevolumeAction()
    {
	$empresaBO = new Model_BO_Enterprise();
	$retorno['error'] = !$empresaBO->setData( $this->getParams() )->saveVolume();

	echo json_encode( $retorno );
	exit;
    }

    /**
     * 
     */
    public function listvolumevendasAction()
    {
	$id = $this->getParam( 'id' );
	$dataJson['rows'] = array();

	if ( !empty( $id ) ) {

	    //lista os dados da tabela incomes
	    $incomesDAO = new Model_DAO_Incomes();
	    $incomes = $incomesDAO->fetchAll( array( 'income_date desc' ), array( 'fk_id_enterprise' => $id ) );

	    if ( !empty( $incomes ) ) {

		foreach ( $incomes as $key => $income ) {

		    $dataJson['rows'][] = array(
			'id' => $income->getIdIncomes(),
			'data' => array(
			    ++$key,
			    number_format( $income->getMontlyValue(), 2, ',', '.' ),
			    number_format( $income->getAnnualValue(), 2, ',', '.' ),
			    ILO_Util_Geral::dateToBr( $income->getIncomeDate() ),
			)
		    );
		}
	    }
	}

	echo json_encode( $dataJson );
	exit;
    }

    /**
     * 
     */
    public function removeclientesAction()
    {
	$clienteEnterpriseBO = new Model_BO_Enterprise();

	if ( $clienteEnterpriseBO->removeClientes( $this->getParams() ) )
	    $retorno['error'] = false;
	else {

	    $retorno['msg'] = $clienteEnterpriseBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }

    /*
     * 
     */

    public function tipoAction()
    {
	$id = $this->getParam( 'id' );
	$data = array();

	//lista structure
	$structureDAO = new Model_DAO_BusinessStructure();
	$structure = $structureDAO->fetchAll( 'structure' );

	//lista sector enterprise
	$enterpriseSectorDAO = new Model_DAO_EnterpriseSector();
	$sector = $enterpriseSectorDAO->fetchAll( "name_sector" );

	//lista add district
	$districtDAO = new Model_DAO_AddDistrict();
	$district = $districtDAO->fetchAll( "district" );

	if ( !empty( $id ) ) {

	    $empresaDAO = new Model_DAO_Enterprise();
	    $empresaVO = $empresaDAO->fetchRow( array( 'id_enterprise' => $id ) );

	    $data = $empresaVO->toArray();

	    //busca o sector cadastrado
	    $enterpriseHasSectorDAO = new Model_DAO_EnterpriseHasSectorSubsector();
	    $enterpriseHasSectorVO = $enterpriseHasSectorDAO->fetchRow( array('fk_id_enterprise' => $id) );

	    $data['fk_id_sector'] = $enterpriseHasSectorVO->getFkIdSector()->getIdSector();
	    $data['fk_id_subsector'] = $enterpriseHasSectorVO->getFkIdSubsector();

	    // busca os distritu operasi
	    $operasi = explode( "|", $data['district_operation'] );

	    $flag = 0;
	    if ( in_array( "Hotu-Hotu", $operasi ) ) {
		$operasi = array("Hotu-Hotu");
		$flag = true;
	    }

	    $subsectors = array();
	    //busca os subsector cadastrados
	    $subsectorDAO = new Model_DAO_EnterpriseHasSectorSubsector();
	    $subsectorVO = $subsectorDAO->fetchAll( array(), array('fk_id_enterprise' => $id) );

	    foreach ( $subsectorVO as $subsector )
		$subsectors[] = $subsector->getFkIdSubsector();
	    
	    $this->view->operasi = $operasi;
	    $this->view->flag = $flag;
	    $this->view->subsector = json_encode( $subsectors );

	    $data['id_enterprise'] = $id;
	    
	    $this->view->numEmpresa = $empresaVO->getNumeroEmpresa();
	}
	
	$this->view->structure = $structure;
	$this->view->sector = $sector;
	$this->view->districts = $district;
	$this->view->data = json_encode( $data );
	$this->_liberaAbas( $data );
    }

    /*
     * 
     */

    public function savetipoAction()
    {

	$empresaBO = new Model_BO_Enterprise();
	$empresaBO->setData( $this->getParams() );
	$idEmpresa = $empresaBO->saveTipo();

	if ( $idEmpresa ) {

	    $retorno['error'] = false;
	    $retorno['id'] = $idEmpresa;
	} else {

	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }

    /*
     * 
     */

    public function enderecoAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect( '/empresa/registro/geral' );

	$empresaDAO = new Model_DAO_Enterprise();
	$empresaBO = new Model_BO_Enterprise();
	$empresaVO = $empresaDAO->fetchRow( array('id_enterprise' => $id) );

	if ( empty( $empresaVO ) )
	    $this->redirect( '/empresa/registro/geral' );

	$data['fk_id_enterprise'] = $id;
	$data['id_enterprise'] = $id;

	$addressGeneralVO = array();

	// Busca endereco cadastrado para o beneficiario
	$addressGeneralDAO = new Model_DAO_AddressGeneral();
	$addressGeneralVO = $addressGeneralDAO->fetchAll( array('id_address_general'), array('fk_id_enterprise' => $id) );

	$this->view->enderecos = $addressGeneralVO;
	$this->view->data = json_encode( $data );

	// Busca distritos
	$countryDAO = new Model_DAO_AddCountry();
	$this->view->countrys = $countryDAO->fetchAll( array('country') );

	$this->view->numEmpresa = $empresaBO->getNumEmpresa( $id );

	$this->_liberaAbas( $data );
    }

    /*
     * 
     */

    public function saveenderecoAction()
    {
	$empresaBO = new Model_BO_Enterprise();
	$empresaBO->setData( $this->getParams() );

	$idEmpresa = $empresaBO->saveEndereco();
	if ( $idEmpresa ) {

	    $retorno['error'] = false;
	    $retorno['id'] = $idEmpresa;
	} else {

	    $retorno['msg'] = $empresaBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }

    /*
     * 
     */

    public function removerenderecoAction()
    {

	$enderecoBO = new Model_BO_AddressGeneral();
	$enderecoBO->setData( $this->getParams() );

	$retorno['status'] = $enderecoBO->removerEndereco();

	echo json_encode( $retorno );
	exit;
    }

    /**
     * 
     */
    public function subsectorAction()
    {
	$sector = $this->getParam( 'id' );

	// Busca subsector
	$subsectorDAO = new Model_DAO_EnterpriseSubsector();
	$subsectorVO = $subsectorDAO->fetchAll( array('name_subsector'), array('fk_id_sector' => $sector) );

	$data = array();

	foreach ( $subsectorVO as $subsector ) {
	    $data[] = array('id_subsector' => $subsector->getIdSubsector(), 'name_subsector' => $subsector->getNameSubsector());
	}

	echo json_encode( $data );
	exit;
    }

    /*
     * 
     */

    public function contratosAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect( '/empresa/registro/geral' );

	$empresaDAO = new Model_DAO_Enterprise();
	$empresaVO = $empresaDAO->fetchRow( array('id_enterprise' => $id) );

	if ( empty( $empresaVO ) )
	    $this->redirect( '/empresa/registro/geral' );

	$contractDAO = new Model_DAO_Contract();
	$contractsVO = $contractDAO->fetchAll( array('contractor_name'), array('fk_id_enterprise' => $id) );

	$dataJson['rows'] = array();

	if ( !empty( $contractsVO ) ) {

	    $link = '<a href="' . BASE . '/beneficiario/contrato/geral/id/%s">%s</a>';

	    foreach ( $contractsVO as $key => $contract ) {

		$dataJson['rows'][] = array(
		    'id' => $contract->getIdContract(),
		    'data' => array(
			++$key,
			sprintf( $link, $contract->getIdContract(), $contract->getProjectCode() ),
			$contract->getContractorName(),
			$contract->getIloContract(),
		    )
		);
	    }
	}

	$this->view->dataContratos = json_encode( $dataJson );
	$empresaBO = new Model_BO_Enterprise();
	$this->view->numEmpresa = $empresaBO->getNumEmpresa( $id );

	$this->_liberaAbas( $empresaVO->toArray() );
    }

    public function assetAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect( '/empresa/registro/geral' );

	$empresaDAO = new Model_DAO_Enterprise();
	$empresaVO = $empresaDAO->fetchRow( array('id_enterprise' => $id) );

	if ( empty( $empresaVO ) )
	    $this->redirect( '/empresa/registro/geral' );

	$empresaBO = new Model_BO_Enterprise();
	$this->view->numEmpresa = $empresaBO->getNumEmpresa( $id );
	
	$data = $empresaVO->toArray();
	$this->view->data = json_encode( $data );

	$this->_liberaAbas( $data);
    }
    
    /**
     * 
     */
    public function listassetAction()
    {
	$id = $this->getParam( 'id' );
	$dataJson['rows'] = array();

	if ( !empty( $id ) ) {

	    $assetDAO = new Model_DAO_Asset();
	    $assets = $assetDAO->fetchAll( array( 'id_asset desc' ), array( 'fk_id_enterprise' => $id ) );

	    if ( !empty( $assets ) ) {

		foreach ( $assets as $key => $asset ) {

		    $dataJson['rows'][] = array(
			'id' => $asset->getIdAsset(),
			'data' => array(
			    ++$key,
			    $asset->getAssetName(),
			    $asset->getAssetTotal(),
			    $asset->getAssetDescription(),
			    $asset->getIdAsset()
			)
		    );
		}
	    }
	}

	echo json_encode( $dataJson );
	exit;
    }
    
    /**
     * 
     */
    public function saveassetAction()
    {
	$empresaBO = new Model_BO_Enterprise();
	$retorno['error'] = !$empresaBO->setData( $this->getParams() )->saveAsset();

	echo json_encode( $retorno );
	exit;
    }
    
    public function deleteassetAction()
    {
	$id = $this->getParam( 'id' );
	
	$empresaBO = new Model_BO_Enterprise();
	$retorno['status'] = $empresaBO->deleteAsset( $id );

	echo json_encode( $retorno );
	exit;
    }
    
    public function getassetAction()
    {
	$id = $this->getParam( 'id' );
	
	$assetDAO = new Model_DAO_Asset();
	$asset = $assetDAO->fetchRow( array( 'id_asset' => $id ) );
	
	echo json_encode( $asset->toArray() );
	exit;
    }
    
    public function previouscontractAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect( '/empresa/registro/geral' );

	$empresaDAO = new Model_DAO_Enterprise();
	$empresaVO = $empresaDAO->fetchRow( array('id_enterprise' => $id) );

	if ( empty( $empresaVO ) )
	    $this->redirect( '/empresa/registro/geral' );

	$empresaBO = new Model_BO_Enterprise();
	$this->view->numEmpresa = $empresaBO->getNumEmpresa( $id );
	
	$data = $empresaVO->toArray();
	$this->view->data = json_encode( $data );

	$this->_liberaAbas( $data);
    }
    
    /**
     * 
     */
    public function listpreviouscontractAction()
    {
	$id = $this->getParam( 'id' );
	$dataJson['rows'] = array();

	if ( !empty( $id ) ) {

	    $previousContractDAO = new Model_DAO_PreviousContract();
	    $previousContracts = $previousContractDAO->fetchAll( array( 'id_previous_contract desc' ), array( 'fk_id_enterprise' => $id ) );

	    if ( !empty( $previousContracts ) ) {

		foreach ( $previousContracts as $key => $previousContract ) {

		    $dataJson['rows'][] = array(
			'id' => $previousContract->getIdPreviousContract(),
			'data' => array(
			    ++$key,
			    $previousContract->getContractType(),
			    $previousContract->getContractClient(),
			    ILO_Util_Geral::dateToBr( $previousContract->getStartDate() ),
			    ILO_Util_Geral::dateToBr( $previousContract->getFinishDate() ),
			    number_format( $previousContract->getTotalContract() , 2, ',', '.' ),
			    $previousContract->getIdPreviousContract()
			)
		    );
		}
	    }
	}

	echo json_encode( $dataJson );
	exit;
    }
    
    /**
     * 
     */
    public function savepreviouscontractAction()
    {
	$empresaBO = new Model_BO_Enterprise();
	$retorno['error'] = !$empresaBO->setData( $this->getParams() )->savePreviousContract();

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function getpreviouscontractAction()
    {
	$id = $this->getParam( 'id' );
	
	$previousContractDAO = new Model_DAO_PreviousContract();
	$previousContractVO = $previousContractDAO->fetchRow( array( 'id_previous_contract' => $id ) );
	
	$data = $previousContractVO->toArray();
	
	$data['start_date'] = ILO_Util_Geral::dateToBr( $data['start_date'] );
	$data['finish_date'] = ILO_Util_Geral::dateToBr( $data['finish_date'] );
	$data['total_contract'] = number_format( $data['total_contract'] , 2, ',', '.' );
	
	echo json_encode( $data );
	exit;
    }
    
    public function deletepreviouscontractAction()
    {
	$id = $this->getParam( 'id' );
	
	$empresaBO = new Model_BO_Enterprise();
	$retorno['status'] = $empresaBO->deletePreviousContract( $id );

	echo json_encode( $retorno );
	exit;
    }
}