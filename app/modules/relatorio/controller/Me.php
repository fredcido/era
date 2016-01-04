<?php

class Relatorio_Controller_Me extends ILO_Controller_Padrao
{
    /**
     *
     * @var Model_BO_Snapshot
     */
    protected $_bo;
    
    /**
     * 
     */
    public function init()
    {
	$this->view->relatorio_mode = true;
	$this->_bo = new Model_BO_SnapshotReport();
    }
    
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
    public function baseendlineAction()
    {
	$snapshotDAO = new Model_DAO_Snapshot();
	$rows = $snapshotDAO->listBaseEndLine();

	$dataJson['rows'] = array();

	if ( !empty( $rows ) ) {

	    foreach ( $rows as $key => $row ) {

		$dataJson['rows'][] = array(
		    'id' => $row['id_base'] . '-' . $row['id_end'],
		    'data' => array(
			++$key,
			$row['district'],
			$row['subdistrict'],
			$row['suku'],
			$row['road_location'],
			$row['code']
		    )
		);
	    }
	}

	$this->view->dataSnapshot = json_encode( $dataJson );
    }
    
    public function listAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	
	$data = $this->getParams();
	
	$this->view->report = $this->_bo->setData( $data )->listReport();
	$this->view->data = $data;
    }
    
    public function topdfAction()
    {
	ILO_Util_Session::set( 'download', true );
	
	$data = unserialize( $this->getParam( 'data' ) );
	
	$name = ucfirst( array_pop( explode( '/', $_SERVER['HTTP_REFERER'] ) ) );
	
	$client = new ILO_Util_HttpClient();
	$content = $client->setUrl( $_SERVER['HTTP_REFERER'] )
			  ->setPost( $data )
			  ->request();
	
	ILO_Util_Export::toPdf( $name, $this->_treatContent( $content ) );
	
	ILO_Util_Session::set( 'download', false );
        exit;
    }
    
    public function todocAction()
    {
	ILO_Util_Session::set( 'download', true );
	
	$data = unserialize( $this->getParam( 'data' ) );
	
	$name = ucfirst( array_pop( explode( '/', $_SERVER['HTTP_REFERER'] ) ) );

	$name = ucfirst( array_pop( explode( '/', $_SERVER['HTTP_REFERER'] ) ) );
	
	$client = new ILO_Util_HttpClient();
	$content = $client->setUrl( $_SERVER['HTTP_REFERER'] )
			  ->setPost( $data )
			  ->request();
	
	ILO_Util_Export::toDoc( $name, $this->_treatContent( $content ) );
	
	ILO_Util_Session::set( 'download', false );
        exit;
    }
    
    public function toexcelAction()
    {
	ILO_Util_Session::set( 'download', true );
	
	$data = unserialize( $this->getParam( 'data' ) );
	
	$name = ucfirst( array_pop( explode( '/', $_SERVER['HTTP_REFERER'] ) ) );
	
        $name = ucfirst( array_pop( explode( '/', $_SERVER['HTTP_REFERER'] ) ) );
	
	$client = new ILO_Util_HttpClient();
	$content = $client->setUrl( $_SERVER['HTTP_REFERER'] )
			  ->setPost( $data )
			  ->request();
        
	ILO_Util_Export::toExcel( $name, $this->_treatContent( $content ) );

	ILO_Util_Session::set( 'download', false );
        exit;
    }
    
    public function checkdownloadAction()
    {
	$download = ILO_Util_Session::get( 'download' );
	
	echo json_encode( array( 'status' => $download ) );
	exit;
    }
    
    protected function _treatContent( $content )
    {
	$domDocument = new DOMDocument();
	@$domDocument->loadHTML( $content );
	
	$xpath = new DOMXPath( $domDocument );
	
	$notPrint = $xpath->query( "//div[@class='noPrint']" );
	
	foreach ( $notPrint as $node )
	    $node->parentNode->removeChild( $node );
	
	$style = $xpath->query( "//link[@rel='stylesheet']" );
	
	foreach ( $style as $node )
	    $node->parentNode->removeChild( $node );
	
	$styles = file_get_contents( APPDIR . '/../public/styles/report.css' );
	
	$styleElement = $domDocument->createElement( 'style' );
	$styleElement->setAttribute( 'type', 'text/css' );
	$styleElement->appendChild( $domDocument->createTextNode( $styles ) );
	
	$domDocument->getElementsByTagName( 'head' )->item( 0 )->appendChild( $styleElement );
	
	return $domDocument->saveHTML();
    }
    
     /**
     * 
     */
    public function questionnaireAction()
    {
	$questionnaireConfigDAO = new Model_DAO_QuestionnaireConfig();
	$this->view->questions = $questionnaireConfigDAO->fetchAll( array( 'title' ) );
	
	 $districtDAO = new Model_DAO_AddDistrict();
        $this->view->distritos = $districtDAO->fetchAll( array( 'district' ) );
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
    
    public function getquestionnaireAction()
    {
	$this->view->renderLayout( false );
	
	$questionnaireConfigDAO = new Model_BO_QuestionnaireConfig();
	$this->view->questions = $questionnaireConfigDAO->getListQuestions( $this->getParam( 'quest' ) );
    }
    
    public function listquestionnaireAction()
    {
	$questionnaireDAO = new Model_DAO_Questionnaire();
	$rows = $questionnaireDAO->listQuestionaires( $this->getParams() );
	
	$dataJson['rows'] = array();

	if ( !empty( $rows ) ) {

	    foreach ( $rows as $key => $row ) {

		$dataJson['rows'][] = array(
		    'id' => $row['id_questionnaire'],
		    'data' => array(
			++$key,
			$row['identifier'],
			$row['config'],
			$row['district'],
			$row['subdistrict'],
			$row['suku'],
			$row['road_location']
		    )
		);
	    }
	}
	
	echo json_encode( $dataJson );
	exit;
    }
    
    public function printquestionnaireAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	
	$data = $this->getParams();
	
	$this->view->report = $this->_bo->detailQuestionnaire( $this->getParam( 'id' ) );
	$this->view->data = $data;
    }
    
    /**
     * 
     */
    public function exportbaseendlineAction()
    {
	$this->_bo->exportBaseEndLine( $this->getParam( 'id' ) );
    }
    
    public function listdocumentsAction()
    {
	$this->view->renderLayout( false );
	
	$snapshotBO = new Model_BO_SnapshotReport();
	$data = $snapshotBO->listDocuments( $this->getParam( 'id' ) );
	//var_dump($data);die;
	
	$this->view->files = $data;
    }
    
    public function reportquestionnaireAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	
	$data = $this->getParams();
	
	$bo = new Model_BO_QuestionnaireReport();
	
	$this->view->report = $bo->setData( $data )->fetchReport();
	$this->view->data = $data;
    }
}