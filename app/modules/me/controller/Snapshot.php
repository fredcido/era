<?php

class Me_Controller_Snapshot extends ILO_Controller_Padrao
{

    /**
     *
     * @var array
     */
    protected $_accessMapping = array(
	'salvar' => array(
	    'information',
	    'socio',
	    'accessmarket',
	    'accesseducation',
	    'accesshealth',
	    'healthservice',
	    'marketservice',
	    'educationservice',
	    'overall',
	    'saveoverall',
	    'savesocio',
	    'saveaccessmarket',
	    'saveaccesseducation',
	    'saveaccesshealth',
	    'saveinformation',
	    'searchvillages',
	    'image',
	    'subdistritos',
	    'sukus',
	    'saveimage',
	    'listimage',
	    'listdocuments',
	    'removeimage',
	    'document',
	    'savedocument',
	    'detalhadocument',
	    'removedocument',
	    'health',
	    'education',
	    'market',
	    'saveindicator',
	    'loadindicators'
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
	    'url' => '/me/snapshot/information/id/',
	    'liberado' => false,
	    'action' => 'information',
	    'selected' => true,
	    'require' => 'id_snapshot'
	),
	array(
	    'label' => 'Documento',
	    'id' => 614,
	    'url' => '/me/snapshot/document/id/',
	    'liberado' => false,
	    'action' => 'document',
	    'require' => 'id_snapshot'
	),
	array(
	    'label' => 'Socio-economic',
	    'id' => 999,
	    'url' => '/me/snapshot/socio/id/',
	    'liberado' => false,
	    'action' => 'socio',
	    'require' => 'id_snapshot'
	),
	array(
	    'label' => 'Access to markets',
	    'id' => 999,
	    'url' => '/me/snapshot/accessmarket/id/',
	    'liberado' => false,
	    'action' => 'accessmarket',
	    'require' => 'id_snapshot'
	),
	array(
	    'label' => 'Access to education',
	    'id' => 999,
	    'url' => '/me/snapshot/accesseducation/id/',
	    'liberado' => false,
	    'action' => 'accesseducation',
	    'require' => 'id_snapshot'
	),
	array(
	    'label' => 'Access to Health',
	    'id' => 999,
	    'url' => '/me/snapshot/accesshealth/id/',
	    'liberado' => false,
	    'action' => 'accesshealth',
	    'require' => 'id_snapshot'
	),
	array(
	    'label' => 'Images',
	    'id' => 613,
	    'url' => '/me/snapshot/image/id/',
	    'liberado' => false,
	    'action' => 'image',
	    'require' => 'id_snapshot'
	),
	array(
	    'label' => 'Overall Rankings',
	    'id' => 999,
	    'url' => '/me/snapshot/overall/id/',
	    'liberado' => false,
	    'action' => 'overall',
	    'require' => 'id_snapshot'
	),
	array(
	    'label'	=> 'Market',
	    'id'	=> 647,
	    'url'	=> '/me/snapshot/market/id/',
	    'liberado'	=> false,
	    'action'	=> 'market',
	    'require'	=> 'id_snapshot'
	),
	array(
	    'label'	=> 'Education',
	    'id'	=> 646,
	    'url'	=> '/me/snapshot/education/id/',
	    'liberado'	=> false,
	    'action'	=> 'education',
	    'require'	=> 'id_snapshot'
	),
	array(
	    'label'	=> 'Health Services',
	    'id'	=> 645,
	    'url'	=> '/me/snapshot/health/id/',
	    'liberado'	=> false,
	    'action'	=> 'health',
	    'require'	=> 'id_snapshot'
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
     * @param Model_VO_Empresa $data 
     */
    protected function _liberaAbas( array $data = null )
    {
	$snapshotBO = new Model_BO_Snapshot();
	$document = $snapshotBO->setData( array( 'id' => @$data['id_snapshot'] ) )->detalhaDocumento();
	
	$data['document'] = !empty( $document['status'] );
	
	foreach ( $this->_abas as $key => $aba ) {

	    $this->_abas[$key]['url'] .= @$data['id_snapshot'];

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
	$snapshotDAO = new Model_DAO_Snapshot();
	$rows = $snapshotDAO->fetchAll( array( 'id_snapshot DESC' ) );

	$dataJson['rows'] = array();

	if ( !empty( $rows ) ) {

	    foreach ( $rows as $key => $row ) {

		$dataJson['rows'][] = array(
		    'id' => $row->getIdSnapshot(),
		    'data' => array(
			++$key,
			$row->getFkIdAddDistrict()->getDistrict(),
			$row->getFkIdAddSubdistrict()->getSubdistrict(),
			$row->getFkIdAddSuku()->getSuku(),
			$row->getRoadLocation(),
			$row->getCode(),
			( $row->getReference() ? 'Endline' : 'Baseline' )
		    )
		);
	    }
	}

	$this->view->dataSnapshot = json_encode( $dataJson );
    }

    /**
     * 
     */
    public function informationAction()
    {
	$snapshot = $this->getParam( 'id' );
        
        $data = array();
        
        //Lista os Distritos
        $districtDAO = new Model_DAO_AddDistrict();
        $this->view->distritos = $districtDAO->fetchAll( array( 'district' ) );
                
        if ( !empty( $snapshot ) ) {
	    
	    $snapshotDAO = new Model_DAO_Snapshot();
            $vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $snapshot ) );
	    
            $data = $vo->toArray();
	    
	    $snapshotBO = new Model_BO_Snapshot();
	    $data['indicators'] = true;

	    foreach ( array( 1, 2, 3 ) as $indicator ) {

		$rows = $snapshotBO->getIndicators( $snapshot, $indicator );
		
		$score = 0;
		$total = 0;
		foreach ( $rows as $value )
		    $total += $value['value'];
		
		$score = floor( ( $total * 100 ) / ( count( $rows ) * 2 ) );

		switch ( $indicator ) {
		    case 1:
			$data['ranking_health'] = $score;
			break;
		    case 2:
			$data['ranking_education'] = $score;
			break;
		    case 3:
			$data['ranking_market'] = $score;
			break;
		}
	    }
	    
	    $snapshotBO = new Model_BO_Snapshot();
	    $keys = $snapshotBO->getKeys( $snapshot, 1 );
	    
	    $data += $keys;
	    
	    $this->view->villages = $snapshotBO->getVillageData( $snapshot );
	    
	    $data['date_snapshot'] = ILO_Util_Geral::dateToBr( $data['date_snapshot'] );
        }
        
	$this->view->data = json_encode( $data );
        $this->_liberaAbas( $data );
    }
    
    /**
     * 
     */
    public function overallAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/me/snapshot/' );
        
        $data = array();
	
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $id ) );
        
	if ( empty( $vo ) )
	    $this->redirect ( '/me/snapshot/' );
        
	$data = $vo->toArray();
	
	$snapshotBO = new Model_BO_Snapshot();
	$data['indicators'] = true;

	foreach ( array( 1, 2, 3 ) as $indicator ) {

	    $rows = $snapshotBO->getIndicators( $id, $indicator );

	    $score = 0;
	    $total = 0;
	    foreach ( $rows as $value )
		$total += $value['value'];

	    $score = round( ( $total * 100 ) / ( count( $rows ) * 2 ) );

	    switch ( $indicator ) {
		case 1:
		    $data['ranking_market'] = $score;
		    break;
		case 2:
		    $data['ranking_education'] = $score;
		    break;
		case 3:
		    $data['ranking_health'] = $score;
		    break;
	    }
	}
	
	$this->view->data = json_encode( $data );
        $this->_liberaAbas( $data );
    }
    
    /**
     * 
     */
    public function socioAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/me/snapshot/' );
        
        $data = array();
	
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $id ) );
        
	if ( empty( $vo ) )
	    $this->redirect ( '/me/snapshot/' );
        
	$data = $vo->toArray();
	
	$snapshotBO = new Model_BO_Snapshot();
	$keys = $snapshotBO->getKeys( $id, 2 );

	$data += $keys;
	
	$this->view->data = json_encode( $data );
        $this->_liberaAbas( $data );
    }
    
    /**
     * 
     */
    public function accessmarketAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/me/snapshot/' );
        
        $data = array();
	
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $id ) );
        
	if ( empty( $vo ) )
	    $this->redirect ( '/me/snapshot/' );
        
	$data = $vo->toArray();
	
	$snapshotBO = new Model_BO_Snapshot();
	$keys = $snapshotBO->getKeys( $id, 3 );

	$data += $keys;
	
	$this->view->access = $snapshotBO->getAccessMarketData( $id );
	
	$this->view->data = json_encode( $data );
        $this->_liberaAbas( $data );
    }
    
    /**
     * 
     */
    public function accesseducationAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/me/snapshot/' );
        
        $data = array();
	
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $id ) );
        
	if ( empty( $vo ) )
	    $this->redirect ( '/me/snapshot/' );
        
	$data = $vo->toArray();
	
	$snapshotBO = new Model_BO_Snapshot();
	$keys = $snapshotBO->getKeys( $id, 4 );

	$data += $keys;
	
	$this->view->data = json_encode( $data );
        $this->_liberaAbas( $data );
    }
    
    /**
     * 
     */
    public function accesshealthAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/me/snapshot/' );
        
        $data = array();
	
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $id ) );
        
	if ( empty( $vo ) )
	    $this->redirect ( '/me/snapshot/' );
        
	$data = $vo->toArray();
	
	$snapshotBO = new Model_BO_Snapshot();
	$keys = $snapshotBO->getKeys( $id, 5 );

	$data += $keys;
	
	$this->view->data = json_encode( $data );
        $this->_liberaAbas( $data );
    }
    
    /**
     * 
     */
    public function imageAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/me/snapshot/' );
        
        $data = array();
	
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $id ) );
        
	if ( empty( $vo ) )
	    $this->redirect ( '/me/snapshot/' );
        
	$data = $vo->toArray();
	
	$this->view->data = json_encode( $data );
        $this->_liberaAbas( $data );
    }
    
    /**
     * 
     */
    public function documentAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/me/snapshot/' );
        
        $data = array();
	
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $id ) );
        
	if ( empty( $vo ) )
	    $this->redirect ( '/me/snapshot/' );
        
	$data = $vo->toArray();
	
	$this->view->data = json_encode( $data );
        $this->_liberaAbas( $data );
    }
    
    /**
     * 
     */
    public function healthAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/me/snapshot/' );
        
        $data = array();
	
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $id ) );
        
	if ( empty( $vo ) )
	    $this->redirect ( '/me/snapshot/' );
        
	$data = $vo->toArray();
	
	$this->view->data = json_encode( $data );
	$this->view->snapshot = $id;
        $this->_liberaAbas( $data );
    }
    
     /**
     * 
     */
    public function educationAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/me/snapshot/' );
        
        $data = array();
	
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $id ) );
        
	if ( empty( $vo ) )
	    $this->redirect ( '/me/snapshot/' );
        
	$data = $vo->toArray();
	
	$this->view->data = json_encode( $data );
	$this->view->snapshot = $id;
        $this->_liberaAbas( $data );
    }
    
     /**
     * 
     */
    public function marketAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/me/snapshot/' );
        
        $data = array();
	
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $id ) );
        
	if ( empty( $vo ) )
	    $this->redirect ( '/me/snapshot/' );
        
	$data = $vo->toArray();
	
	$this->view->data = json_encode( $data );
	$this->view->snapshot = $id;
        $this->_liberaAbas( $data );
    }
    
    /**
     * 
     */
    public function saveinformationAction()
    {
	$snapshotBO = new Model_BO_Snapshot();
	$snapshotBO->setData( $this->getParams() );

	$idSnapshot = $snapshotBO->saveInformation();
	if ( $idSnapshot ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idSnapshot;
	    
	} else {
	 
	    $retorno['msg'] = $snapshotBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function saveoverallAction()
    {
	$snapshotBO = new Model_BO_Snapshot();
	$snapshotBO->setData( $this->getParams() );

	$idSnapshot = $snapshotBO->saveOverall();
	if ( $idSnapshot ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idSnapshot;
	    
	} else {
	 
	    $retorno['msg'] = $snapshotBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function savesocioAction()
    {
	$snapshotBO = new Model_BO_Snapshot();
	$snapshotBO->setData( $this->getParams() );

	$idSnapshot = $snapshotBO->saveSocio();
	if ( $idSnapshot ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idSnapshot;
	    
	} else {
	 
	    $retorno['msg'] = $snapshotBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function saveaccessmarketAction()
    {
	$snapshotBO = new Model_BO_Snapshot();
	$snapshotBO->setData( $this->getParams() );

	$idSnapshot = $snapshotBO->saveAccessMarket();
	if ( $idSnapshot ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idSnapshot;
	    
	} else {
	 
	    $retorno['msg'] = $snapshotBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function saveaccesseducationAction()
    {
	$snapshotBO = new Model_BO_Snapshot();
	$snapshotBO->setData( $this->getParams() );

	$idSnapshot = $snapshotBO->saveAccessEducation();
	if ( $idSnapshot ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idSnapshot;
	    
	} else {
	 
	    $retorno['msg'] = $snapshotBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    /**
     * 
     */
    public function saveaccesshealthAction()
    {
	$snapshotBO = new Model_BO_Snapshot();
	$snapshotBO->setData( $this->getParams() );

	$idSnapshot = $snapshotBO->saveAccessHealth();
	if ( $idSnapshot ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idSnapshot;
	    
	} else {
	 
	    $retorno['msg'] = $snapshotBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
     /**
     * 
     */
    public function saveimageAction()
    {
	$this->view->renderLayout( false );
	
	$snapshotBO = new Model_BO_Snapshot();
	$snapshotBO->setData( $this->getParams() );

	$status = $snapshotBO->saveImages();
	if ( $status ) {
	  
	    $retorno['error'] = false;
	    
	} else {
	 
	    $retorno['msg'] = $snapshotBO->getError();
	    $retorno['error'] = true;
	}

	$this->view->retorno = json_encode( $retorno );
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
    public function listimageAction()
    {
	$this->view->renderLayout( false );
	
	$snapshotBO = new Model_BO_Snapshot();
	$images = $snapshotBO->listImages( $this->getParam( 'id' ) );
	
	$this->view->images = $images;
    }
    
    /**
     * 
     */
    public function removeimageAction()
    {
	$snapshotBO = new Model_BO_Snapshot();
	$return = $snapshotBO->setData( $this->getParams() )->removeImage();

	echo json_encode( $return );
	exit;
    }
    
    /**
     * 
     */
    public function savedocumentAction()
    {
	$this->view->renderLayout( false );
	
	$snapshotBO = new Model_BO_Snapshot();
	$snapshotBO->setData( $this->getParams() );

	$status = $snapshotBO->saveDocument();
	if ( $status ) {
	  
	    $retorno['error'] = false;
	    
	} else {
	 
	    $retorno['msg'] = $snapshotBO->getError();
	    $retorno['error'] = true;
	}

	$this->view->retorno = json_encode( $retorno );
    }
    
    public function detalhadocumentAction()
    {
	$snapshotBO = new Model_BO_Snapshot();
	$data = $snapshotBO->setData( $this->getParams() )->detalhaDocumento();
	
	echo json_encode( $data );
	exit;
    }
    
    public function listdocumentsAction()
    {
	$this->view->renderLayout( false );
	
	$snapshotBO = new Model_BO_Snapshot();
	$data = $snapshotBO->listDocuments( $this->getParam( 'id' ) );
	
	$this->view->files = $data;
    }
    
    /**
     * 
     */
    public function removedocumentAction()
    {
	$snapshotBO = new Model_BO_Snapshot();
	$return = $snapshotBO->setData( $this->getParams() )->removeDocument();

	echo json_encode( $return );
	exit;
    }
    
    /**
     * 
     */
    public function saveindicatorAction()
    {
	$snapshotBO = new Model_BO_Snapshot();
	$snapshotBO->setData( $this->getParams() );

	$idSnapshot = $snapshotBO->saveIndicator();
	if ( $idSnapshot ) {
	  
	    $retorno['error'] = false;
	    $retorno['id'] = $idSnapshot;
	    
	} else {
	 
	    $retorno['msg'] = $snapshotBO->getError();
	    $retorno['error'] = true;
	}

	echo json_encode( $retorno );
	exit;
    }
    
    public function loadindicatorsAction()
    {
	/*
	$snapshotIndicatorDAO = new Model_DAO_SnapshotIndicator();
	$where = array(
	    'fk_id_snapshot' => $this->getParam( 'id' ),
	    'type'	     => $this->getParam( 'type' )
	);
	
	$indicators = $snapshotIndicatorDAO->fetchAll( array(), $where );
	
	$data = array();
	foreach ( $indicators as $indicator )
	    $data[] = $indicator->toArray();
	 * 
	 */
	
	$snapshotBO = new Model_BO_Snapshot();
	$data = $snapshotBO->getIndicators( $this->getParam( 'id' ), $this->getParam( 'type' ) );
	
	echo json_encode( $data );
	exit;
    }
    
    public function searchvillagesAction()
    {
	$villagesDAO = new Model_DAO_AddVillage();
	$villages = $villagesDAO->fetchAll( array( 'village_name' ), array( 'fk_id_suku' => $this->getParam( 'id' ) ) );
	
	$opt = array();
	foreach ( $villages as $village )
	    $opt[] = array( 'id' => json_encode( $village->toArray() ), 'label' => $village->getVillageName() );
	
	echo json_encode( $opt );
	exit;
    }
    
    /**
     * 
     */
    public function healthserviceAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/me/snapshot/' );
        
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $id ) );
        
	if ( empty( $vo ) )
	    $this->redirect ( '/me/snapshot/' );
	
	$data = $vo->toArray();
	
	$this->view->data = json_encode( $data );
	$this->view->snapshot = $vo;	
	$this->view->setLayout( 'relatorio/layout/main.php' );
    }
    
    /**
     * 
     */
    public function marketserviceAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/me/snapshot/' );
        
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $id ) );
        
	if ( empty( $vo ) )
	    $this->redirect ( '/me/snapshot/' );
	
	$data = $vo->toArray();
	
	$this->view->data = json_encode( $data );
	$this->view->snapshot = $vo;	
	$this->view->setLayout( 'relatorio/layout/main.php' );
    }
    
    /**
     * 
     */
    public function educationserviceAction()
    {
	$id = $this->getParam( 'id' );
	if ( empty( $id ) )
	    $this->redirect ( '/me/snapshot/' );
        
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $id ) );
        
	if ( empty( $vo ) )
	    $this->redirect ( '/me/snapshot/' );
	
	$data = $vo->toArray();
	
	$this->view->data = json_encode( $data );
	$this->view->snapshot = $vo;	
	$this->view->setLayout( 'relatorio/layout/main.php' );
    }
}