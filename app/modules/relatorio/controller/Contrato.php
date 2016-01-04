<?php

class Relatorio_Controller_Contrato extends ILO_Controller_Padrao
{
    /**
     *
     * @var Model_BO_ContractReport
     */
    protected $_bo;
    
    /**
     * 
     */
    public function init()
    {
	$this->view->relatorio_mode = true;
	$this->_bo = new Model_BO_ContractReport();
    }
    
    /**
     * 
     */
    public function recordAction()
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
    public function exportrecordAction()
    {
	$this->_bo->exportRecord( $this->getParam( 'id' ) );
    }
    
    
    /**
     * 
     */
    public function groupAction()
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
                        0,
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
    public function batchAction()
    {
	$orderContract = array(
	    'contractor_name'
	);
	
	$contractDAO = new Model_DAO_Contract();
	$contracts = $contractDAO->fetchAll( $orderContract );
	
	$batches = array();
	foreach ( $contracts as $contract ) {
	    $batch = $contract->getBatch();
	    if ( !empty( $batch ) && !in_array( $batch, $batches ) )
	    $batches[] = $batch;
	}
	
	$batches = array_unique( $batches );
	sort( $batches );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $contracts ) ) {

            foreach ( $batches as $key => $batch ) {
                
                $dataJson['rows'][] = array(
                   'id'     => $batch,
                    'data'  => array(
                        'Batch: ' . $batch
                    )
                );
            }
        }
	
	$this->view->dataBatches = json_encode( $dataJson );   
    }
    
    /**
     * 
     */
    public function exportgroupAction()
    {
	$this->_bo->exportGroup( $this->getParam( 'id' ) );
    }
    
    /**
     * 
     */
    public function exportbatchAction()
    {
	$this->_bo->exportBatch( $this->getParam( 'id' ) );
    }
    
    public function listcontractsAction()
    {
	$orderContract = array(
	    'contractor_name'
	);
	
	$where = array();
	
	$params = $this->getParams();
	if ( !empty( $params['date_start'] ) )
	    $where['date_start_planned'] = array( '>=', ILO_Util_Geral::dateToBd( $params['date_start'] ) );
	
	if ( !empty( $params['date_finish'] ) )
	    $where['date_finish_planned'] = array( '<=', ILO_Util_Geral::dateToBd( $params['date_finish'] ) );
	
	$contractDAO = new Model_DAO_Contract();
	$contracts = $contractDAO->fetchAll( $orderContract, $where );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $contracts ) ) {

            foreach ( $contracts as $key => $contract ) {
                
                $dataJson['rows'][] = array(
                   'id'     => $contract->getIdContract(),
                    'data'  => array(
                        0,
                        $contract->getProjectCode(),
			$contract->getContractorName(),
			$contract->getIloContract(),
                    )
                );
            }
        }
	
	echo json_encode( $dataJson );
	exit;
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
}