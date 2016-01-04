<?php

class Beneficiario_Controller_Beneficiario extends ILO_Controller_Padrao
{
    
    /**
     *
     * @var array
     */
    protected $_accessMapping = array(
	'salvar'    =>	array(
	    'buscabeneficiario',
	    'cadastro',
	    'calculaidade',
	    'distritos',
	    'educacao',
	    'endereco',
	    'geral',
	    'listabeneficiario',
	    'listapagamentos',
	    'numerobeneficiario',
	    'pagamento',
	    'removerpagamento',
	    'saveeducacao',
	    'saveendereco',
	    'savegeral',
	    'savepagamento',
	    'subdistritos',
	    'sukus',
	    'contratos'
	),
	'consultar' =>	array(
	    'index'
	)
    );
    
    /**
     *
     * @var array
     */
    protected $_abas = array(
	array(
	    'label'	=>  'Informação Geral',
	    'id'	=>  51,
	    'url'	=>  '/beneficiario/beneficiario/geral/id/',
	    'liberado'	=>  true,
	    'action'	=>  'geral',
	    'selected'	=>  true,
	    'require'	=>  'id_worker'
	),
	array(
	    'label'	=>  'Educação',
	    'id'	=>  52,
	    'url'	=>  '/beneficiario/beneficiario/educacao/id/',
	    'liberado'	=>  false,
	    'action'	=>  'educacao',
	    'require'	=>  'id_worker'
	),
	array(
	    'label'	=>  'Endereço',
	    'id'	=>  53,
	    'url'	=>  '/beneficiario/beneficiario/endereco/id/',
	    'liberado'	=>  false,
	    'action'	=>  'endereco',
	    'require'	=>  'fk_max_school_level'
	),
	array(
	    'label'	=>  'Pagamento',
	    'id'	=>  54,
	    'url'	=>  '/beneficiario/beneficiario/pagamento/id/',
	    'liberado'	=>  false,
	    'action'	=>  'pagamento',
	    'require'	=>  'id_worker'
	),
	array(
	    'label'	=>  'Contratos',
	    'id'	=>  157,
	    'url'	=>  '/beneficiario/beneficiario/contratos/id/',
	    'liberado'	=>  false,
	    'action'	=>  'contratos',
	    'require'	=>  'id_worker'
	)
    );
    
    /**
     *
     * @var string
     */
    protected $_action;
    
    /**
     * 
     */
    public function init()
    {
	$this->view->action = ILO_Router_Dispatcher::getAction();
    }
    
    /**
     *
     * @param array $data 
     */
    protected function _liberaAbas( array $data = null )
    {
	if ( !empty( $data ) ) {
	    	    
	    foreach ( $this->_abas as $key => $aba ) {

		$this->_abas[$key]['url'] .= $data['id_worker'];
		
		if ( !empty( $data[$aba['require']] ) )
		    $this->_abas[$key]['liberado'] = true;
		
		$this->_abas[$key]['selected'] = $aba['action'] == $this->view->action ? true : false;
	    }
	    
	}
	
	$this->view->renderNewView( 'formulario' );
	$this->view->abas =  $this->_abas;
	
	// Pega codigo do beneficiario para ser mostrado
	if ( !empty( $data['id_worker'] ) ) {
	    
	    $workerDAO = new Model_DAO_Worker();
	    $this->view->numero_beneficiario = $workerDAO->fetchRow( array( 'id_worker' => $data['id_worker'] ) )->getCodBeneficiario();
	}
    }
    
     /**
     * 
     */
    public function indexAction()
    {
	$workerDAO = new Model_DAO_Worker();
	$workers = $workerDAO->fetchAll( array( 'last_name', 'first_name' ) );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $workers ) ) {

            foreach ( $workers as $key => $worker ) {
                
		$status =   $worker->getStatusWorker() == 'A' ?
			    ILO_Util_Translate::get( 'Ativo', 88 ) :
			    ILO_Util_Translate::get( 'Inativo', 89 );
			 
		
                $dataJson['rows'][] = array(
                   'id'     => $worker->getIdWorker(),
                    'data'  => array(
                        ++$key,
                        $worker->getCodBeneficiario(),
                        $worker->getFirstName(),
                        $worker->getLastName(),
			$status
                    )
                );
            }
        }
	
	$this->view->data = json_encode( $dataJson );
    }
    
    /**
     * 
     */
    public function cadastroAction()
    {
	$orderContract = array(
	    'num_project',
	    'num_district',
	    'num_activity',
	    'num_year',
	    'id_contract'
	);
	
	$contractDAO = new Model_DAO_Contract();
	$contracts = $contractDAO->fetchAll( $orderContract );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $contracts ) ) {

            foreach ( $contracts as $key => $contract ) {
                
                $dataJson['rows'][] = array(
                   'id'     => $contract->getIdContract(),
                    'data'  => array(
                        ++$key,
                        $contract->getProjectCode(),
			$contract->getContractorName(),
			$contract->getIloContract(),
                    )
                );
            }
        }
	
	$this->view->dataProjetos = json_encode( $dataJson );   
    }
    
    /**
     * 
     */
    public function geralAction()
    {
	$project = $this->getParam( 'project' );
	$worker = $this->getParam( 'id' );
	
	if ( empty( $project ) && empty( $worker ) )
	    $this->redirect ( '/beneficiario/beneficiario/cadastro' );
	
	switch ( true ) {
	    case !empty( $project ):
		
		$contractDAO = new Model_DAO_Contract();
		$vo = $contractDAO->fetchRow( array( 'id_contract' => $project ) );
		
		$data = array( 
			    'project_code'	=> $vo->getProjectCode(),
			    'fk_id_contract'	=> $vo->getIdContract()
			);
		
		$this->_liberaAbas();
		
		break;
	    case !empty( $worker ):
		
		$workerDAO = new Model_DAO_Worker();
		$vo = $workerDAO->fetchRow( array( 'id_worker' => $worker ) );
		
		if ( empty( $vo ) )
		    $this->redirect ( '/beneficiario/beneficiario/cadastro' );
		
		// Trata dados do VO para popular formulario
		$data = $this->_workerVoToData( $vo );
		
		$this->_liberaAbas( $data );
		
		$this->view->altera = true;
		
		break;
	}
	
	// Lista setores da industria para cadastro
	$industrySectorDAO = new Model_DAO_IndustrySector();
	$this->view->industrysector = $industrySectorDAO->fetchAll( array( 'industry_sector' ) );
	
	// Lista subdistritos
	$subdistrictsDAO = new Model_DAO_AddSubdistrict();
	$this->view->subdistricts = $subdistrictsDAO->fetchAll( array( 'subdistrict' ) );
		
	$this->view->data = json_encode( $data );
    }
    
    /**
     *
     * @param Model_VO_Worker $vo
     * @return array
     */
    protected function _workerVoToData( Model_VO_Worker $vo )
    {
	$data = $vo->toArray();
			
	// Valores para popular formulario

	// data de nascimento
	$data['date_birth'] = ILO_Util_Geral::dateToBr( $data['date_birth'] );
	// data de registro
	$data['date_registration'] = ILO_Util_Geral::dateToBr( $data['date_registration'] );

	// Idade
	$data['age'] = ILO_Util_Geral::calculaIdade( $data['date_birth'] );

	// Codigo do beneficiario
	$data['cod_beneficiario'] = $vo->getCodBeneficiario();
	
	return $data;
    }
    
    /**
     * 
     */
    public function calculaidadeAction()
    {
	$idade = ILO_Util_Geral::calculaIdade( $this->getParam( 'nasc' ) );
	
	echo json_encode( array( 'idade' => $idade ) );
	exit;
    }
    
    /**
     * 
     */
    public function numerobeneficiarioAction()
    {
	$workerBO = new Model_BO_Worker();
	$numBeneficiario = $workerBO->montaNumBeneficiario( $this->getParams() );
	
	echo json_encode( array( 'num' => $numBeneficiario ) );
	exit;
    }
   
    /**
     * 
     */
    public function savegeralAction()
    {
	$workerBO = new Model_BO_Worker();
	$workerBO->setData( $this->getParams() );

	$idWorker = $workerBO->saveGeral();
	if ( $idWorker ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idWorker;
	    
	} else {
	 
	    $retorno['msg'] = $workerBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function educacaoAction()
    {
	$id = $this->getParam( 'id' );
	
	if ( empty( $id ) )
	    $this->redirect ( '/beneficiario/beneficiario/cadastro' );
	
	$workerDAO = new Model_DAO_Worker();
	$workerVO = $workerDAO->fetchRow( array( 'id_worker' => $id ) );
	
	if ( empty( $workerVO ) )
	    $this->redirect ( '/beneficiario/beneficiario/cadastro' );
	
	$dataForm = $workerVO->toArray();
	$this->view->data = json_encode( $dataForm );
	
	// busca niveis de escolaridade
	$formalSchoolLevelDAO = new Model_DAO_FormalSchoolLevel();
	$this->view->max_school_level = $formalSchoolLevelDAO->fetchAll( array( 'school_level' ) );
	
	// busca treinamentos profissionais
	$vocationalTrainingDAO = new Model_DAO_VocationalTraining();
	$vocationalTrainingVO = $vocationalTrainingDAO->fetchAll( array( 'vacational_training' ) );
	
	$dataVocationalTraining = array();
	foreach ( $vocationalTrainingVO as $vocational ) {
	    
	    $dataVocationalTraining[] = array(
		'id'	=>  $vocational->getIdVocationalTraining(),
		'name'	=>  $vocational->getVacationalTraining()
	    );
	}
	$this->view->vocational_training = $dataVocationalTraining;
	
	// Busca formacoes ja cadastradas para o beneficiario
	$workerHasVocatTrainingDAO = new Model_DAO_WorkerHasVocatTraining();
	$this->view->formacoes_cadastradas = $workerHasVocatTrainingDAO->fetchAll( array( 'year_completed DESC' ), array( 'fk_id_worker' => $id ) );
	
	$this->_liberaAbas( $dataForm );
    }
    
    /**
     * 
     */
    public function saveeducacaoAction()
    {
	$workerBO = new Model_BO_Worker();
	$workerBO->setData( $this->getParams() );

	$idWorker = $workerBO->saveEducacao();
	if ( $idWorker ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idWorker;
	    
	} else {
	 
	    $retorno['msg'] = $workerBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    public function enderecoAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/beneficiario/beneficiario/cadastro' );
	
	$workerDAO = new Model_DAO_Worker();
	$workerVO = $workerDAO->fetchRow( array( 'id_worker' => $id ) );
	
	if ( empty( $workerVO ) )
	    $this->redirect ( '/beneficiario/beneficiario/cadastro' );
	
	$data['id_worker'] = $workerVO->getIdWorker();
	
	// Busca endereco cadastrado para o beneficiario
	$addressGeneralDAO = new Model_DAO_AddressGeneral();
	$addressGeneralVO = $addressGeneralDAO->fetchRow( array( 'fk_id_worker' => $id ) );
	
	if ( !empty( $addressGeneralVO ))
	    $data = $data + $addressGeneralVO->toArray();
	
	$this->view->data = json_encode( $data );
	
	// Busca distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->distritos = $districtDAO->fetchAll( array( 'district' ), array( 'fk_id_add_country' => 1 ) );
	
	$this->_liberaAbas( $data );
    }
    
    /**
     * 
     */
    public function distritosAction()
    {
	$country = $this->getParam( 'id' );
	
	$distritosDAO = new Model_DAO_AddDistrict();
	$distritosVO = $distritosDAO->fetchAll( array( 'district' ), array( 'fk_id_add_country' => $country ) );
	
	$data = array();
	foreach ( $distritosVO as $distrito ) {
	    
	    $data[] = array(
		'id'	=> $distrito->getIdAddDistrict(),
		'name'	=> $distrito->getDistrict(),
	    );
	}
	
	echo json_encode( $data );
	exit;
    }
    
    /**
     * 
     */
    public function subdistritosAction()
    {
	$distrito = $this->getParam( 'id' );
	
	$subdistritoDAO = new Model_DAO_AddSubdistrict();
	$subdistritoVO = $subdistritoDAO->fetchAll( array( 'subdistrict' ), array( 'fk_id_add_district' => $distrito ) );
	
	$data = array();
	foreach ( $subdistritoVO as $subdistrito ) {
	    
	    $data[] = array(
		'id'	=> $subdistrito->getIdAddSubdistrict(),
		'name'	=> $subdistrito->getSubdistrict(),
	    );
	}
	
	echo json_encode( $data );
	exit;
    }
    
    /**
     * 
     */
    public function sukusAction()
    {
	$subdistrito = $this->getParam( 'id' );
	
	$sukuDAO = new Model_DAO_AddSuku();
	$sukuVO = $sukuDAO->fetchAll( array( 'suku' ), array( 'fk_id_add_subdistrict' => $subdistrito ) );
	
	$data = array();
	foreach ( $sukuVO as $suku ) {
	    
	    $data[] = array(
		'id'	=> $suku->getIdSuku(),
		'name'	=> $suku->getSuku(),
	    );
	}
	
	echo json_encode( $data );
	exit;
    }
    
    /**
     * 
     */
    public function saveenderecoAction()
    {
	$workerBO = new Model_BO_Worker();
	$workerBO->setData( $this->getParams() );

	$idWorker = $workerBO->saveEndereco();
	if ( $idWorker ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idWorker;
	    
	} else {
	 
	    $retorno['msg'] = $workerBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function pagamentoAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/beneficiario/beneficiario/cadastro' );
	
	$workerDAO = new Model_DAO_Worker();
	$workerVO = $workerDAO->fetchRow( array( 'id_worker' => $id ) );
	
	if ( empty( $workerVO ) )
	    $this->redirect ( '/beneficiario/beneficiario/cadastro' );
	
	$data = $workerVO->toArray();
	$this->view->data = json_encode( $data );
	
	// Lista pagamentos do beneficiairo
	$workerHasPayment = new Model_DAO_WorkerHasPayment();
	$this->view->pagamentos = $workerHasPayment->fetchAll( array( 'id_relationship DESC' ), array( 'fk_id_worker' => $id ) );
	
	$this->_liberaAbas( $data );
    }
    
    /**
     * 
     */
    public function listapagamentosAction()
    {
	$this->view->renderLayout( false );
	
	$id = $this->getParam( 'id' );
	// Lista pagamentos do beneficiairio
	$workerHasPayment = new Model_DAO_WorkerHasPayment();
	$this->view->pagamentos = $workerHasPayment->fetchAll( array( 'id_relationship DESC' ), array( 'fk_id_worker' => $id ) );
    }
    
    /**
     * 
     */
    public function savepagamentoAction()
    {
	$workerBO = new Model_BO_Worker();
	$workerBO->setData( $this->getParams() );

	$idWorker = $workerBO->savePagamento();
	if ( $idWorker ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idWorker;
	    
	} else {
	 
	    $retorno['msg'] = $workerBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    public function removerpagamentoAction()
    {
	$workerBO = new Model_BO_Worker();
	$workerBO->setData( $this->getParams() );

	$retorno['status'] = $workerBO->removerPagamento();

	echo json_encode( $retorno );
	exit;
    }
    
    public function buscabeneficiarioAction()
    {
	$this->view->renderLayout( false );
    }
    
    /**
     * 
     */
    public function listabeneficiarioAction()
    {
	$workerDAO = new Model_DAO_Worker();
	$workers = $workerDAO->listByFilters( $this->getParams() );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $workers ) ) {

            foreach ( $workers as $key => $worker ) {
                
		$status =   $worker->getStatusWorker() == 'A' ?
			    ILO_Util_Translate::get( 'Ativo', 88 ) :
			    ILO_Util_Translate::get( 'Inativo', 89 );
			 
		
                $dataJson['rows'][] = array(
                   'id'     => json_encode( $this->_workerVoToData( $worker ) ),
                    'data'  => array(
                        ++$key,
                        $worker->getCodBeneficiario(),
                        $worker->getFirstName(),
                        $worker->getLastName(),
			$status
                    )
                );
            }
        }
	
	echo json_encode( $dataJson );
	exit;
    }
    
    /**
     * 
     */
    public function contratosAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/beneficiario/beneficiario/cadastro' );
	
	$workerDAO = new Model_DAO_Worker();
	$workerVO = $workerDAO->fetchRow( array( 'id_worker' => $id ) );
	
	if ( empty( $workerVO ) )
	    $this->redirect ( '/beneficiario/beneficiario/cadastro' );
	
	$contractHasWorkerDAO = new Model_DAO_ContractHasWorker();
	$contracts = $contractHasWorkerDAO->fetchAll( array( 'id_relationship DESC' ), array( 'fk_id_worker' => $id ) );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $contracts ) ) {

            foreach ( $contracts as $key => $contract ) {
                
                $dataJson['rows'][] = array(
                   'id'     => $contract->getFkIdContract()->getIdContract(),
                    'data'  => array(
                        ++$key,
                        $contract->getFkIdContract()->getProjectCode(),
			$contract->getFkIdContract()->getContractorName(),
			$contract->getFkIdContract()->getIloContract(),
                    )
                );
            }
        }
	
	$this->view->dataProjetos = json_encode( $dataJson );   
	
	$this->_liberaAbas( $workerVO->toArray() );
    }
}