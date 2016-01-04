
<?php

class Relatorio_Controller_Treinamento extends ILO_Controller_Padrao
{
    /**
     *
     * @var Model_BO_TrainingReport
     */
    protected $_bo;
    
    /**
     * 
     */
    public function init()
    {
	$this->view->relatorio_mode = true;
	$this->_bo = new Model_BO_TrainingReport();
    }
    
    public function indexAction()
    {
	
    }
    
    public function summaryAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	
	$data = $this->getParams();
	$this->view->report = $this->_bo->setData( $data )->summaryReport();
	$this->view->data = $data;
    }
    
    public function detailedAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	
	$data = $this->getParams();
	
	$this->view->report = $this->_bo->setData( $data )->detailedReport();
	$this->view->data = $data;
    }
    
    public function listAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	
	$data = $this->getParams();
	
	$this->view->report = $this->_bo->setData( $data )->listReport();
	$this->view->data = $data;
    }
    
    /**
     * 
     */
    public function pordistritoAction()
    {
    }
    
    /**
     * 
     */
    public function relatoriopordistritoAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->porDistrito();
    }
    
    /**
     * 
     */
    public function evolucaoAction()
    {
	// Lista distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->districts = $districtDAO->fetchAll( 'district' );
    }
    
     /**
     * 
     */
    public function relatorioevolucaoAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->evolucao();
    }
    
    /**
     * 
     */
    public function atividadesAction()
    {
	// Lista distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->districts = $districtDAO->fetchAll( 'district' );
    }
    
    /**
     * 
     */
    public function relatorioatividadesAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->atividadesTreinador();
    }
    
    /**
     * 
     */
    public function participantessexoAction()
    {
    }
    
    /**
     * 
     */
    public function relatorioparticipantessexoAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->participantesSexo();
    }
    
    /**
     * 
     */
    public function participantesdistritosexoAction()
    {
    }
    
    /**
     * 
     */
    public function relatorioparticipantesdistritosexoAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->participantesDistritoSexo();
    }
    
    
    /**
     * 
     */
    public function cursoAction()
    {
	// Lista distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->districts = $districtDAO->fetchAll( 'district' );
    }
    
    /**
     * 
     */
    public function relatoriocursoAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->curso();
    }
    
    /**
     * 
     */
    public function participantesgrupoidadeAction()
    {
	// Lista distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->districts = $districtDAO->fetchAll( 'district' );
    }
    
    /**
     * 
     */
    public function relatorioparticipantesgrupoidadeAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->participanteGrupoIdade();
    }
    
    /**
     * 
     */
    public function participanteseducacaoAction()
    {
	// Lista distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->districts = $districtDAO->fetchAll( 'district' );
    }
    
    /**
     * 
     */
    public function relatorioparticipanteseducacaoAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->participantesEducacao();
    }
    
    /**
     * 
     */
    public function desempenhoAction()
    {
	// Lista distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->districts = $districtDAO->fetchAll( 'district' );
    }
    
    /**
     * 
     */
    public function relatoriodesempenhoAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->desempenho();
    }
    
    /**
     * 
     */
    public function andamentomesAction()
    {
	// Lista distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->districts = $districtDAO->fetchAll( 'district' );
    }
    
    /**
     * 
     */
    public function relatorioandamentomesAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->andamentoMes();
    }
    
    /**
     * 
     */
    public function listatreinamentoAction()
    {
	// Lista distritos
	$districtDAO = new Model_DAO_AddDistrict();
	$this->view->districts = $districtDAO->fetchAll( 'district' );
    }
    
    /**
     * 
     */
    public function relatoriolistatreinamentoAction()
    {
	$this->view->setLayout( 'relatorio/layout/main.php' );
	$this->view->data = $this->_bo->setData( $this->getParams() )->listaTreinamento();
    }
    
    public function topdfAction()
    {
	ILO_Util_Session::set( 'download', true );
	
	$data = unserialize( $this->getParam( 'data' ) );
	
	//$url = str_replace ( 'http://' . $_SERVER['HTTP_HOST'], 'http://127.0.0.1' , $_SERVER['HTTP_REFERER'] );
	
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
	
	//$url = str_replace ( 'http://' . $_SERVER['HTTP_HOST'], 'http://127.0.0.1' , $_SERVER['HTTP_REFERER'] );
	
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
	
	//$url = str_replace ( 'http://' . $_SERVER['HTTP_HOST'], 'http://127.0.0.1' , $_SERVER['HTTP_REFERER'] );
	
        //var_dump($_SERVER['HTTP_REFERER']); die($url);
	
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
}