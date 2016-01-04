<?php

class Beneficiario_Controller_Contrato extends ILO_Controller_Padrao
{
    
    /**
     *
     * @var array
     */
    protected $_accessMapping = array(
	'salvar'    =>	array(
	    'carregarfatinsuku',
	    'execucao',
	    'geral',
	    'planejamento',
	    'saveexecucao',
	    'savegeral',
	    'saveplanejamento',
	    'saveempresa',
            'pagamento',
            'savepagamento',
            'carregarsubdistrict',
	    'empresa',
	    'buscaempresas',
	    'registro',
	    'listcontractrecord',
	    'saveregistro',
            'amendment',
            'saveamendment',
            'deleteRecord'
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
	    'url'	=>  '/beneficiario/contrato/geral/id/',
	    'liberado'	=>  false,
	    'action'	=>  'geral',
	    'selected'	=>  true,
	    'require'	=>  'id_contract'
	),
        array(
	    'label'	=>  'Kontraktu Record',
	    'id'	=>  437,
	    'url'	=>  '/beneficiario/contrato/registro/id/',
	    'liberado'	=>  false,
	    'action'	=>  'registro',
	    'selected'	=>  true,
	    'require'	=>  'id_contract'
	),
	/*
	array(
	    'label'	=>  'Planejamento',
	    'id'	=>  108,
	    'url'	=>  '/beneficiario/contrato/planejamento/id/',
	    'liberado'	=>  false,
	    'action'	=>  'planejamento',
	    'require'	=>  'id_contract'
	),
	array(
	    'label'	=>  'Execução',
	    'id'	=>  109,
	    'url'	=>  '/beneficiario/contrato/execucao/id/',
	    'liberado'	=>  false,
	    'action'	=>  'execucao',
	    'require'	=>  'id_contract'
	),
	 */
	array(
	    'label'	=>  'Pagamento',
	    'id'	=>  54,
	    'url'	=>  '/beneficiario/contrato/pagamento/id/',
	    'liberado'	=>  false,
	    'action'	=>  'pagamento',
	    'require'	=>  'id_contract'
	),
	array(
	    'label'	=>  'Empresa/Contrato',
	    'id'	=>  438,
	    'url'	=>  '/beneficiario/contrato/empresa/id/',
	    'liberado'	=>  false,
	    'action'	=>  'empresa',
	    'require'	=>  'id_contract'
	),
        array(
	    'label'	=>  'Amendment',
	    'id'	=>  536,
	    'url'	=>  '/beneficiario/contrato/amendment/id/',
	    'liberado'	=>  false,
	    'action'	=>  'amendment',
	    'require'	=>  'id_contract'
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
     * @param Model_VO_Contract $contract 
     */
    protected function _liberaAbas( array $contract = null )
    {
	if ( !empty( $contract ) ) {
	    	    
	    foreach ( $this->_abas as $key => $aba ) {

		$this->_abas[$key]['url'] .= $contract['id_contract'];
		
		if ( !empty( $contract[$aba['require']] ) )
		    $this->_abas[$key]['liberado'] = true;
		
		$this->_abas[$key]['selected'] = $aba['action'] == $this->view->action ? true : false;
	    }
	    
	}
	    
	$this->view->renderNewView( 'formulario' );
	$this->view->abas =  $this->_abas;
    }
    
    /**
     * 
     */
    public function indexAction()
    {
	$orderContract = array(
	    'contractor_name'
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
	
	$this->view->dataContratos = json_encode( $dataJson );   
    }
    
    /**
     * 
     */
    public function geralAction()
    {
        $contract = $this->getParam( 'id' );
        
        $data = array();
        
        //Lista os Distritos
        $districtDAO = new Model_DAO_AddDistrict();
        $this->view->districts = $districtDAO->fetchAll( array( 'district' ) );
                
        if ( !empty( $contract ) ){
        
            $contractDAO = new Model_DAO_Contract();
            $contractBO = new Model_BO_Contract();
            $vo = $contractDAO->fetchRow( array( 'id_contract' => $contract ) );
        
            $data = $vo->toArray();
            $data['num_district'] = $data['fk_id_add_district'];

            //Busca os subdistrict do contrato
            $contractHasLocation = new Model_DAO_ContractHasLocation();
            $dadosContractHasLocation = $contractHasLocation->fetchAll( array('fk_id_add_subdistrict'), array( 'fk_id_contract' => $contract ) );

            foreach( $dadosContractHasLocation as $location ){
                $data['subdistrict'][] = $location->getFkIdAddSubdistrict()->getIdAddSubdistrict();
                $data['fatin_suku'][] = $location->getFkIdAddSuku()->getIdSuku();
            }
            $data['date_start_planned'] = ILO_Util_Geral::dateToBr($data['date_start_planned']);
            $data['date_finish_planned'] = ILO_Util_Geral::dateToBr($data['date_finish_planned']);
	    $data['signature_date'] = ILO_Util_Geral::dateToBr( $data['signature_date'] );
	    $data['nitl_valid'] = ILO_Util_Geral::dateToBr( $data['nitl_valid'] );
	    $data['bank_valid'] = ILO_Util_Geral::dateToBr( $data['bank_valid'] );
            
            $this->view->numContrato = $contractBO->buscaProjectCode( $contract );
            $this->view->data =  json_encode( $data );

        }
        
        $this->_liberaAbas( $data );
    }
    
    /**
     * 
     */
    public function planejamentoAction()
    {
        $id = $this->getParam( 'id' );
        $dataForm = array();
	
	if ( empty( $id ) )
	    $this->redirect ( '/beneficiario/contrato/cadastro' );
	
	$contractDAO = new Model_DAO_Contract();
	$contractVO = $contractDAO->fetchRow( array( 'id_contract' => $id ) );
        
        $contractBO = new Model_BO_Contract();
	
	if ( !empty( $contractVO ) ){
	                
            $dataForm = $contractVO->toArray();
            
            $dataForm['date_start_planned'] = ILO_Util_Geral::dateToBr( $dataForm['date_start_planned'] );
            $dataForm['date_finish_planned'] = ILO_Util_Geral::dateToBr( $dataForm['date_finish_planned'] );
            
        }else $this->redirect ( '/beneficiario/contrato/cadastro' );	
        
        $this->view->numContrato = $contractBO->buscaProjectCode( $id );
	$this->view->data = json_encode( $dataForm );
        
        $this->_liberaAbas( $dataForm );
    }
    
    /**
     * 
     */
    public function execucaoAction()
    {
        $id = $this->getParam( 'id' );
        $dataForm = array();
	
	if ( empty( $id ) )
	    $this->redirect ( '/beneficiario/contrato/cadastro' );
	
	$contractDAO = new Model_DAO_Contract();
	$contractBO = new Model_BO_Contract();
	$contractVO = $contractDAO->fetchRow( array( 'id_contract' => $id ) );
	
	if ( !empty( $contractVO ) ){
	                
            $dataForm = $contractVO->toArray();
            
            $dataForm['date_start_real'] = ILO_Util_Geral::dateToBr( $dataForm['date_start_real'] );
            $dataForm['date_finish_real'] = ILO_Util_Geral::dateToBr( $dataForm['date_finish_real'] );
            
            $this->view->numContrato = $contractBO->buscaProjectCode( $id );
            
        }else $this->redirect ( '/beneficiario/contrato/cadastro' );	
        
        $totalContract = $contractBO->buscarTotalContrato( $id );
        
        $this->view->total_salario = $totalContract[0]['total_salary'];
        $this->view->total_qtd = $totalContract[0]['qtd'];
        
        unset($dataForm['labour_cost_real']);
        unset($dataForm['workers_real']);
	$this->view->data = json_encode( $dataForm );
        
        $this->_liberaAbas( $dataForm );
    }
    
    
    public function savegeralAction()
    {
        
        $contractBO = new Model_BO_Contract();
	$contractBO->setData( $this->getParams() );
        
	$idContract = $contractBO->saveGeral();
	if ( $idContract ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idContract;
	    
	} else {
	 
	    $retorno['msg'] = $contractBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
        
    }    
    
    public function saveplanejamentoAction()
    {
        
        $contractBO = new Model_BO_Contract();
	$contractBO->setData( $this->getParams() );

        
	$idContract = $contractBO->savePlanejamento();
	if ( $idContract ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idContract;
	    
	} else {
	 
	    $retorno['msg'] = $contractBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
        
    }
    
    public function saveexecucaoAction()
    {
        
        $contractBO = new Model_BO_Contract();
	$contractBO->setData( $this->getParams() );

        
	$idContract = $contractBO->saveExecucao();
	if ( $idContract ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idContract;
	    
	} else {
	 
	    $retorno['msg'] = $contractBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
        
    }
    
    public function savepagamentoAction()
    {
        
        $contractBO = new Model_BO_Contract();
	$contractBO->setData( $this->getParams() );

        
	$idContract = $contractBO->savePagamento();
	if ( $idContract ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idContract;
	    
	} else {
	 
	    $retorno['msg'] = $contractBO->getError();
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
	    $this->redirect ( '/beneficiario/contrato/geral' );
	
	$contractHasWorkerDAO = new Model_DAO_ContractHasWorker();        
        $contractBO = new Model_BO_Contract();        
	
        $result = $contractHasWorkerDAO->queryResult( "SELECT 	wt.id_worker_payment,
                                                                CONCAT(wk.first_name,' ',wk.last_name) name,
                                                                wt.date_payment,
                                                                wt.total_days,
                                                                wt.salary_day,
                                                                wt.total_salary,
                                                                c.id_contract,
                                                                wk.id_worker
                                                        FROM worker wk
                                                        INNER JOIN contract_has_worker cw ON cw.fk_id_worker = wk.id_worker
                                                        INNER JOIN contract c ON c.id_contract = cw.fk_id_contract
                                                        LEFT JOIN worker_has_payment wp ON wp.fk_id_worker = wk.id_worker
                                                        LEFT JOIN worker_payment wt ON wt.id_worker_payment = wp.fk_id_worker_payment
                                                        WHERE c.id_contract = " . $id . " order by name, wt.date_payment desc" );
        
	if ( empty( $result ) ){
	    ILO_Util_Message::setMessage( ILO_Util_Translate::get('Não possui pagamento para este contrato', 321) );
            $this->redirect ( '/beneficiario/contrato/geral/id/'.$id );
        }
        
        $this->view->numContrato = $contractBO->buscaProjectCode( $id );
	$this->view->data = $result;
	
        $result['id_contract'] = $id;
	$this->_liberaAbas( $result );
    }
    
    /**
     * 
     */
    public function carregarfatinsukuAction()
    {
        
        if( is_array( $this->getParam( 'fk_id_add_subdistrict' ) ) )
            $id_add_subdistrict = implode( ",", $this->getParam( 'fk_id_add_subdistrict' ) );
        else
            $id_add_subdistrict = $this->getParam( 'fk_id_add_subdistrict' );
        
        // Busca subdistrito
	$sukuDAO = new Model_DAO_AddSuku();
	$sukuVO = $sukuDAO->fetchAll( array( 'id_suku' ) , array( 'fk_id_add_subdistrict IN ('.$id_add_subdistrict.')' ) );
        
        $data = array();
        
        foreach( $sukuVO as $suku ){
            $data[] = array( 'id_suku' => $suku->getIdSuku(), 'acronym' => $suku->getSuku() );
        }
        
	echo json_encode( $data );
        exit;
        
    }
    
    /**
     * 
     */
    public function carregarsubdistrictAction()
    {        
        
        // Busca subdistrito
	$subdistrictDAO = new Model_DAO_AddSubdistrict();
	$subdistrictVO = $subdistrictDAO->fetchAll( array( 'acronym' ) , array( 'fk_id_add_district' => $this->getParam( 'fk_id_add_district' ) ) );
 
        $data = array();
        
        foreach( $subdistrictVO as $subdistrict ){
            $data[] = array( 'id_add_subdistrict' => $subdistrict->getIdAddSubdistrict(), 'acronym' => $subdistrict->getSubdistrict() );
        }
        
	echo json_encode( $data );
        exit;
        
    }
    
    public function empresaAction()
    {
	$id = $this->getParam( 'id' );
        $dataForm = array();
	
	if ( empty( $id ) )
	    $this->redirect ( '/beneficiario/contrato/cadastro' );
	
	$contractDAO = new Model_DAO_Contract();
	$contractVO = $contractDAO->fetchRow( array( 'id_contract' => $id ) );
        
        $contractBO = new Model_BO_Contract();
	
	if ( !empty( $contractVO ) ){
	                
            $dataForm = $contractVO->toArray();
            
        } else 
	    $this->redirect( '/beneficiario/contrato/cadastro' );	
        
        $this->view->numContrato = $contractBO->buscaProjectCode( $id );
	$this->view->empresaContrato = $contractBO->nomeEmpresaContrato( $id );
	$this->view->data = json_encode( $dataForm );
        
        $this->_liberaAbas( $dataForm );
    }
    
    /**
     * 
     */
    public function buscaempresasAction()
    {
	// Lista Empresas
	$enterpriseDAO = new Model_BO_Enterprise();
	$enterprises = $enterpriseDAO->setData( $this->getParams() )->searchEnterprises();
	
	$dataJson['rows'] = array();
        
        if ( !empty( $enterprises ) ) {
	    
            foreach ( $enterprises as $enterprise ) {
		
                $dataJson['rows'][] = array(
                   'id'     => $enterprise->getIdEnterprise(),
                    'data'  => array(
			0,
                        $enterprise->getNumeroEmpresa(),
                        $enterprise->getEnterpriseName(),
			$enterprise->getOwnerName()
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
    public function saveempresaAction()
    {
        $contractBO = new Model_BO_Contract();
	$contractBO->setData( $this->getParams() );
   
	$idContract = $contractBO->saveEmpresa();
	if ( $idContract ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idContract;
	    $retorno['empresa'] = $contractBO->nomeEmpresaContrato( $idContract );
	    
	} else {
	 
	    $retorno['msg'] = $contractBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function registroAction()
    {
        $id = $this->getParam( 'id' );
        $dataForm = array();
	
	if ( empty( $id ) )
	    $this->redirect ( '/beneficiario/contrato/cadastro' );
	
	$contractDAO = new Model_DAO_Contract();
	$contractVO = $contractDAO->fetchRow( array( 'id_contract' => $id ) );
        
        $contractBO = new Model_BO_Contract();
	
	if ( !empty( $contractVO ) ){
	                
            $dataForm = $contractVO->toArray();
            
            if (empty($dataForm['total_contract'])) {
                ILO_Util_Message::setMessage(ILO_Util_Translate::get('Ita tenki preense Valor Kontraktu', 537));
                $this->redirect ( '/beneficiario/contrato/geral/id/'.$id );                
            }   
            
            
            $dataForm['date_start_planned'] = ILO_Util_Geral::dateToBr( $dataForm['date_start_planned'] );
            $dataForm['date_finish_planned'] = ILO_Util_Geral::dateToBr( $dataForm['date_finish_planned'] );
            
        }else $this->redirect ( '/beneficiario/contrato/cadastro' );	
        
        $this->view->numContrato = $contractBO->buscaProjectCode( $id );
	$this->view->data = json_encode( $dataForm );
	$this->view->totalContrato = $dataForm['total_contract'];
	
        $this->_liberaAbas( $dataForm );
    }
    
    /**
     * 
     */
    public function listcontractrecordAction()
    {
	$this->view->renderLayout( false );
	
	$contractBO = new Model_BO_Contract();
	$this->view->registros = $contractBO->listContratos( $this->getParam( 'id' ) );
    }
    
    /**
     * 
     */
    public function saveregistroAction()
    {  
        $contractBO = new Model_BO_Contract();
	$contractBO->setData( $this->getParams() );

	$idContract = $contractBO->saveRegistro();
	if ( $idContract ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idContract;
	    
	} else {
	 
	    $retorno['msg'] = $contractBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    public function amendmentAction()
    {
        $id = $this->getParam( 'id' );
        $dataForm = array();
	
	if ( empty( $id ) )
	    $this->redirect ( '/beneficiario/contrato/cadastro' );
	
	$contractDAO = new Model_DAO_Contract();
        $amendmentDAo = new Model_DAO_Amendment();
	
        $contractVO = $contractDAO->fetchRow( array( 'id_contract' => $id ) );
        
        $amendmentVO = $amendmentDAo->fetchAll(array('date_registration'),array('fk_id_contract' => $id));
        foreach ( $amendmentVO as $k => $vo){
            $data = $vo->toArray();
            foreach ($data as $key=>$value){
                if (empty($value) || ($value == "0000-00-00")){
                    $data[$key] = "";
                }
            }
            $vo->setValues($data);
            $amendmentVO[$k] = $vo;
        }
        
        $contractBO = new Model_BO_Contract();
	
	if ( !empty( $contractVO ) ){
	                
            $dataForm = $contractVO->toArray();
                        
            if (empty($dataForm['total_contract'])) {
                ILO_Util_Message::setMessage(ILO_Util_Translate::get('Ita tenki preense Valor Kontraktu', 537));
                $this->redirect ( '/beneficiario/contrato/geral/id/'.$id );                
            }
            if (empty($dataForm['date_finish_planned'])){
                ILO_Util_Message::setMessage(ILO_Util_Translate::get('Ita tenki preense Data Remata', 545));
                $this->redirect ( '/beneficiario/contrato/geral/id/'.$id );
            }
            
        }else $this->redirect ( '/beneficiario/contrato/cadastro' );	
        
        unset($dataForm['date_registration']);
        
        $dataForm['contract_value'] = $dataForm['total_contract'];
               
        $this->view->numContrato = $contractBO->buscaProjectCode( $id );
        $this->view->data = json_encode( $dataForm );
	$this->view->totalContrato = $dataForm['total_contract'];
        $this->view->amendments = $amendmentVO;
	
        $this->_liberaAbas( $dataForm );
    }
    public function saveamendmentAction()
    {  
        $contractBO = new Model_BO_Contract();
	$contractBO->setData( $this->getParams() );

	$idContract = $contractBO->saveAmendment();
	if ( $idContract ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idContract;
	    
	} else {
	 
	    $retorno['msg'] = $contractBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    public function deleteRecordAction()
    {
        $this->view->renderLayout( false );
	
	$contractBO = new Model_BO_Contract();
	$contractBO->deleteRecord( $this->getParam( 'id' ) );
        
    }
}