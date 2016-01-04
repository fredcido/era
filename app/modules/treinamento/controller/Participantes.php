<?php

class Treinamento_Controller_Participantes extends ILO_Controller_Padrao
{
    
    /**
     *
     * @var array
     */
    protected $_accessMapping = array(
	'salvar'    =>	array(
	    'geral',
	    'savegeral',
            'documento',
            'listadocumentos',
            'savedocumento',
            'removerdocumento',
            'educacao',
            'saveeducacao',
            'endereco',
            'saveendereco',
            'distritos',
            'experiencia',
            'saveexperiencia',
            'removerexperiencia'
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
	    'url'	=>  '/treinamento/participantes/geral/id/',
	    'liberado'	=>  false,
	    'action'	=>  'geral',
	    'selected'	=>  true,
	    'require'	=>  'id_client'
	),
	array(
	    'label'	=>  'Documentos',
	    'id'	=>  67,
	    'url'	=>  '/treinamento/participantes/documento/id/',
	    'liberado'	=>  false,
	    'action'	=>  'documento',
	    'require'	=>  'id_client'
	),
	array(
	    'label'	=>  'Nível de educação',
	    'id'	=>  80,
	    'url'	=>  '/treinamento/participantes/educacao/id/',
	    'liberado'	=>  false,
	    'action'	=>  'educacao',
	    'require'	=>  'id_client'
	),
	array(
	    'label'	=>  'Endereço',
	    'id'	=>  53,
	    'url'	=>  '/treinamento/participantes/endereco/id/',
	    'liberado'	=>  false,
	    'action'	=>  'endereco',
	    'require'	=>  'id_client'
	),
	array(
	    'label'	=>  'Esperiensia Servisu',
	    'id'	=>  163,
	    'url'	=>  '/treinamento/participantes/experiencia/id/',
	    'liberado'	=>  false,
	    'action'	=>  'experiencia',
	    'require'	=>  'id_client'
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
        
        $cliClientBO = new Model_BO_CliClient();
        $id = $this->getParam( 'id' );
        
        if( isset( $id ) )
            $this->view->numCliente = $cliClientBO->getNumCliente( $id );
    }
    
    /**
     *
     * @param Model_VO_CliClient $data 
     */
    protected function _liberaAbas( array $data = null )
    {
        
	if ( !empty( $data ) ) {
	    	    
	    foreach ( $this->_abas as $key => $aba ) {

		$this->_abas[$key]['url'] .= $data['id_client'];
		
		if ( !empty( $data[$aba['require']] ) )
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
	$orderCliClient = array(
	    'num_district',
	    'num_year',
            'num_sequence'
	);
	
	$cliClientDAO = new Model_DAO_CliClient();
	$cliClients = $cliClientDAO->fetchAll( $orderCliClient );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $cliClients ) ) {

            foreach ( $cliClients as $key => $cliClient ) {
                
                $dataJson['rows'][] = array(
                   'id'     => $cliClient->getIdClient(),
                    'data'  => array(
                        ++$key,
                        $cliClient->getNumeroCliente(),
			$cliClient->getFirstName().' '.$cliClient->getLastName(),
			$cliClient->getCellPhone(),
                    )
                );
            }
        }
	
	$this->view->dataParticipantes = json_encode( $dataJson );   
    }
    
    /**
     * 
     */
    public function geralAction()
    {
        
        $cliClient = $this->getParam( 'id' );
        
        $data = array();
        
        //Lista os Distritos
        $districtDAO = new Model_DAO_AddDistrict();
        $this->view->districts = $districtDAO->fetchAll( array( 'acronym' ) );
                
        if ( !empty( $cliClient ) ){
        
            $cliClientDAO = new Model_DAO_CliClient();            
            $vo = $cliClientDAO->fetchRow( array( 'id_client' => $cliClient ) );
            
            $data = $vo->toArray();
            
            $incomesDAO = new Model_DAO_Incomes();
            $incomesVO = $incomesDAO->fetchAll( array( 'income_date desc' ), array( 'fk_id_client' => $cliClient ) );
        
            if( !empty( $incomesVO ) ){
                
                $this->view->incomes = $incomesVO;            
                $data['montly_value'] = $incomesVO[0]->getMontlyValue();
                $data['annual_value'] = $incomesVO[0]->getAnnualValue();
                
            }                    
            
            $data['date_registration'] = ILO_Util_Geral::dateTimeToBr( $data['date_registration'] );
            $data['date_birth'] = ILO_Util_Geral::dateToBr( $data['date_birth'] );
            $data['num_district'] = $data['fk_id_add_district'];            
            
            $this->view->data =  json_encode( $data );

        }
        
        $this->_liberaAbas( $data );
    }   
    
    public function savegeralAction()
    {
        
        $cliClientBO = new Model_BO_CliClient();
	$cliClientBO->setData( $this->getParams() );

	$idCliClient = $cliClientBO->saveGeral();
        
	if ( $idCliClient ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idCliClient;
	    
	} else {
	 
	    $retorno['msg'] = $cliClientBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
        
    }    
    
    public function savedocumentoAction()
    {
        
        $cliClientBO = new Model_BO_CliClient();
	$cliClientBO->setData( $this->getParams() );

        
	$idCliClient = $cliClientBO->saveDocumento();
	if ( $idCliClient ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idCliClient;
	    
	} else {
	 
	    $retorno['msg'] = $cliClientBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
        
    }
    
    
    /**
     * 
     */
    public function documentoAction()
    {
	$id = $this->getParam( 'id' );
      
	if ( empty( $id ) )
	    $this->redirect ( '/treinamento/participantes/geral' );
        
        //Lista os Distritos
        $districtDAO = new Model_DAO_AddDistrict();
        $this->view->districts = $districtDAO->fetchAll( array( 'acronym' ) );
	
	$typeDocumentDAO = new Model_DAO_TypeDocument();
        $this->view->typeDocuments = $typeDocumentDAO->fetchAll( );
        
        // Lista documentos
	$clientHasDocument = new Model_DAO_ClientHasDocument();        
	$this->view->documentos = $clientHasDocument->fetchAll( array( 'id_relationship DESC' ), array( 'fk_id_client' => $id ) );
        
        $this->view->data = json_encode( array( 'id_client' => $id ) );
	$this->_liberaAbas( array( 'id_client' => $id ) );
    }   
    
    /**
     * 
     */
    public function educacaoAction()
    {
	$id = $this->getParam( 'id' );
	
	if ( empty( $id ) )
	    $this->redirect ( '/treinamento/participantes/geral' );
	
	$clientDAO = new Model_DAO_CliClient();
	$clientVO = $clientDAO->fetchRow( array( 'id_client' => $id ) );
	
	if ( empty( $clientVO ) )
	    $this->redirect ( '/treinamento/participantes/geral' );
	
	$dataForm = $clientVO->toArray();
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
	$clientHasVocatTrainingDAO = new Model_DAO_ClientHasVacatTraining();
	$this->view->formacoes_cadastradas = $clientHasVocatTrainingDAO->fetchAll( array( 'year_completed DESC' ), array( 'fk_id_client' => $id ) );

	$this->_liberaAbas( $dataForm );
    }
    
    /**
     * 
     */
    public function saveeducacaoAction()
    {
	$clientBO = new Model_BO_CliClient();
	$clientBO->setData( $this->getParams() );
        
	$idClient = $clientBO->saveEducacao();
	if ( $idClient ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idClient;
	    
	} else {
	 
	    $retorno['msg'] = $clientBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    public function enderecoAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/treinamento/participantes/geral' );
	
	$clientDAO = new Model_DAO_CliClient();
	$clientVO = $clientDAO->fetchRow( array( 'id_client' => $id ) );
	
	if ( empty( $clientVO ) )
	    $this->redirect ( '/treinamento/participantes/geral' );
	
	$data['id_client'] = $clientVO->getIdClient();
	
	// Busca endereco cadastrado para o beneficiario
	$addressGeneralDAO = new Model_DAO_AddressGeneral();
	$addressGeneralVO = $addressGeneralDAO->fetchRow( array( 'fk_id_client' => $id ) );
	
	if ( !empty( $addressGeneralVO ))
	    $data = $data + $addressGeneralVO->toArray();
	
	$this->view->data = json_encode( $data );
	
	// Busca distritos
	$countryDAO = new Model_DAO_AddCountry();
	$this->view->countrys = $countryDAO->fetchAll( array( 'country' ) );
	
	$this->_liberaAbas( $data );
    }    
    
    /**
     * 
     */
    public function saveenderecoAction()
    {
	$clientBO = new Model_BO_CliClient();
	$clientBO->setData( $this->getParams() );

	$idClient = $clientBO->saveEndereco();
	if ( $idClient ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idClient;
	    
	} else {
	 
	    $retorno['msg'] = $clientBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    public function experienciaAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/treinamento/participantes/geral' );
        
        $idExperience = $this->getParam( 'experience' );
	
	$clientDAO = new Model_DAO_CliClient();
	$clientVO = $clientDAO->fetchRow( array( 'id_client' => $id ) );
	
	if ( empty( $clientVO ) )
	    $this->redirect ( '/treinamento/participantes/geral' );
	
	$data['id_client'] = $clientVO->getIdClient();
	
        // Busca a experiencia do cliente
        $profExperienceDAO = new Model_DAO_ProfessionalExperience();
        
        if( !empty( $idExperience ) ){
            
            $profExperienceVO = $profExperienceDAO->fetchRow( array( 'id_professional_experience' => $idExperience ) );

            if ( !empty( $profExperienceVO )){

                $data = $data + $profExperienceVO->toArray();

                $data['start_date'] = ILO_Util_Geral::dateToBr( $data['start_date'] );
                $data['finish_date'] = ILO_Util_Geral::dateToBr( $data['finish_date'] );

            }
            
            $data['id_professional_experience'] = $idExperience;
        
        } 
            
        $profExperienceVO = $profExperienceDAO->fetchAll( array( 'finish_date desc' ), array( 'fk_id_client' => $clientVO->getIdClient() ) );
        $this->view->experiences = $profExperienceVO;
	
	$this->view->data = json_encode( $data );
        	
	$this->_liberaAbas( $data );
    }
    
    /**
     * 
     */
    public function saveexperienciaAction()
    {
	$clientBO = new Model_BO_CliClient();
	$clientBO->setData( $this->getParams() );

	$idClient = $clientBO->saveExperiencia();
        
	if ( $idClient ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idClient;
	    
	} else {
	 
	    $retorno['msg'] = $clientBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    
    public function removerdocumentoAction()
    {
	$cliClientBO = new Model_BO_CliClient();
	$cliClientBO->setData( $this->getParams() );

	$retorno['status'] = $cliClientBO->removerDocumento();

	echo json_encode( $retorno );
	exit;
    }
    
    
    /**
     * 
     */
    public function listadocumentosAction()
    {        
	$this->view->renderLayout( false );
	
	$id = $this->getParam( 'id' );
        
	// Lista documentos
	$clientHasDocument = new Model_DAO_ClientHasDocument();
	$this->view->documentos = $clientHasDocument->fetchAll( array( 'id_relationship DESC' ), array( 'fk_id_client' => $id ) );
    }   
    
    /**
     * 
     */    
    public function distritosAction()
    {
        
	$country = $this->getParam( 'idCity' );
	
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
    
    public function removerexperienciaAction()
    {
        
        $professionalExperienceBO = new Model_BO_ProfessionalExperience();
	$professionalExperienceBO->setData( $this->getParams() );

	$retorno['status'] = $professionalExperienceBO->removerExperiencia();

	echo json_encode( $retorno );
	exit;
        
    }
    
}