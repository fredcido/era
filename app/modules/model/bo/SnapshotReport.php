<?php

class Model_BO_SnapshotReport extends ILO_Model_BO
{
    
    const EXCEL_TYPE = 'Excel2007';
    
    /**
     *
     * @var Model_DAO_Snapshot
     */
    protected $_dao;
    
    /**
     *
     * @var type 
     */
    protected $_activeSheet;
    
    /**
     * 
     */
    public function __construct()
    {
	$this->_dao = new Model_DAO_Snapshot();
    }
    
     /**
     *
     * @return array
     */
    public function listReport()
    {
	$method = $this->toCamelCase( $this->_data['detailed'] );
	    
	$method = 'list' . $method;
	
	$data = array();
	if ( method_exists( $this, $method ) )
	    $data = call_user_func( array( $this, $method ) );
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function listSnapshot()
    {
	$snapshotDAO = new Model_DAO_Snapshot();
	$snapshot = $snapshotDAO->fetchRow( array( 'id_snapshot' => $this->_data['id_snapshot'] ) );
	
	$snapshotBO = new Model_BO_Snapshot();
	$villages = $snapshotBO->getVillageData( $this->_data['id_snapshot'] );
	
	$data = array(
	    'villages'	 =>  $villages,
	    'snapshot'   =>  $snapshot,
	    'indicators' => $snapshotBO->getKeys( $this->_data['id_snapshot'], 1 )
	);
	
	return $data;
    }
    
    public function listOverall()
    {
	$snapshotBO = new Model_BO_Snapshot();
	
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $this->_data['id_snapshot'] ) );
	
	$data = array();
	$colors = array();
	foreach ( array( 1, 2, 3 ) as $indicator ) {

	    $rows = $snapshotBO->getIndicators( $this->_data['id_snapshot'], $indicator );

	    $score = 0;
	    $total = 0;
	    foreach ( $rows as $value )
		$total += $value['value'];

	    $score = round( ( $total * 100 ) / ( count( $rows ) * 2 ) );
	    
	    switch ( true ) {
		case $score >= 41 && $score <= 80:
		    $ranking = 'yellow-ranking';
		    break;
		case $score >= 81:
		    $ranking = 'green-ranking';
		    break;
		default:
		    $ranking = 'red-ranking';
	    }

	    switch ( $indicator ) {
		case 1:
		    $data['ranking_market'] = $score;
		    $colors['ranking_market'] = $ranking;
		    
		    break;
		case 2:
		    $data['ranking_education'] = $score;
		    $colors['ranking_education'] = $ranking;
		    
		    break;
		case 3:
		    $data['ranking_health'] = $score;
		    $colors['ranking_health'] = $ranking;
		    break;
	    }
	}
	
	return array( 
	    'data'	=> $data,
	    'comments'	=> $vo->toArray(),
	    'colors'	=> $colors
	);
    }
    
    /**
     *
     * @return type 
     */
    public function listMarket()
    {
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $this->_data['id_snapshot'] ) );
	
	$snapshotBO = new Model_BO_Snapshot();
	$data = $snapshotBO->getIndicators( $this->_data['id_snapshot'], 1 );
	
	return array(
	    'snapshot'	 => $vo,
	    'indicators' => $data,
	    'total'	 => $this->totalIndicators( $data )
	);
    }
    
     /**
     *
     * @return type 
     */
    public function listEducation()
    {
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $this->_data['id_snapshot'] ) );
	
	$snapshotBO = new Model_BO_Snapshot();
	$data = $snapshotBO->getIndicators( $this->_data['id_snapshot'], 2 );
	
	return array(
	    'snapshot'	 => $vo,
	    'indicators' => $data,
	    'total'	 => $this->totalIndicators( $data )
	);
    }
    
    /**
     *
     * @return type 
     */
    public function listHealth()
    {
	$snapshotDAO = new Model_DAO_Snapshot();
	$vo = $snapshotDAO->fetchRow( array( 'id_snapshot' => $this->_data['id_snapshot'] ) );
	
	$snapshotBO = new Model_BO_Snapshot();
	$data = $snapshotBO->getIndicators( $this->_data['id_snapshot'], 3 );
	
	return array(
	    'snapshot'	 => $vo,
	    'indicators' => $data,
	    'total'	 => $this->totalIndicators( $data )
	);
    }
    
    public function totalIndicators( $data )
    {
	$total = 0;
	foreach ( $data as $i )
	    $total += $i['value'];
	
	$score = ceil( $total * 100 / ( count( $data ) * 2 ) );
	
	return array(
	    'total' => $total,
	    'score' => $score
	);
    }
    
    public function detailQuestionnaire( $id )
    {
	$questionnaireDAO = new Model_DAO_Questionnaire();
	$questionnaireVO = $questionnaireDAO->fetchRow( array( 'id_questionnaire' => $id ) );
	
	$questionnaireConfigVO = $questionnaireVO->getFkIdQuestionnaireConfig();
	
	// Search for the questions
	$questionnaireConfigBO = new Model_BO_QuestionnaireConfig();
	$questions = $questionnaireConfigBO->getListQuestions( $questionnaireConfigVO->getIdQuestionnaireConfig() );
	
	// Get Anwers
	$questionnaireBO = new Model_BO_Questionnaire();
	$answers = $questionnaireBO->getAnswer( $id );
	
	$data = array(
	    'questionnaire' => $questionnaireVO,
	    'questions'	    => $questions,
	    'answers'	    => $answers
	);
	
//	ILO_Util_Debug::dump( $data );
//	exit;
	
	return $data;
    }
    
    /**
     * 
     * @param string $id
     */
    public function exportBaseEndLine( $id )
    {
	$id = explode( '-', $id );
	$base = $id[0];
	$end = $id[1];
	
	$data = array(
	    'base' => $this->_getDataSnapshot( $base ),
	    'end'  => $this->_getDataSnapshot( $end )
	);
	
	$excelPath = APPDIR . '/../library/PHPExcel/';
	
	spl_autoload_unregister( 'iloAutoloader' );
	
	require_once( $excelPath . 'PHPExcel/IOFactory.php' );
	
	$objReader = PHPExcel_IOFactory::createReader( self::EXCEL_TYPE );
	$objPHPExcel = $objReader->load( $excelPath . 'templates/base_endline.xlsx' );
	
	$styleBase = new PHPExcel_Style();
	$styleEnd = new PHPExcel_Style();
	
	$borders = array(
	    'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN,
		'color'	=>  array( 'argb' => 'FF000000' )
	   )
	);
	
	$alignment = array(
			'wrap'       => true,
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
		    );
	
	$styleBase->applyFromArray(
			    array( 
				'fill' => array(
				    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
				    'color' => array( 'argb' => 'FFFFFFFF' )
				),
				'font'  => array(
				    'bold'  => true,
				    'color' => array('rgb' => '000000'),
				    'size'  => 8,
				    'name'  => 'Calibri'
				),
				'borders' => $borders,
				'alignment'  =>	$alignment
			    )
			);
	
	$styleEnd->applyFromArray(
			    array( 
				'fill' => array(
				    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
				    'color' => array( 'argb' => 'FF000000' )
				),
				'font'  => array(
				    'bold'  => true,
				    'color' => array('rgb' => 'FFFFFF'),
				    'size'  => 8,
				    'name'  => 'Calibri'
				),
				'borders' => $borders,
				'alignment'  =>	$alignment
			    )
			);
	
	$this->_activeSheet = $objPHPExcel->getActiveSheet();
	$this->_baseEndLineSetValues( $data );
	
	
	// Markets
	$this->_setIndicators( $data['base']['indicators']['markets'], 'F17', $styleBase );
	$this->_setIndicators( $data['end']['indicators']['markets'], 'F18', $styleEnd );
	
	// Education
	$this->_setIndicators( $data['base']['indicators']['education'], 'N17', $styleBase );
	$this->_setIndicators( $data['end']['indicators']['education'], 'N18', $styleEnd );
	
	// Education
	$this->_setIndicators( $data['base']['indicators']['health'], 'V17', $styleBase );
	$this->_setIndicators( $data['end']['indicators']['health'], 'V18', $styleEnd );
	
	// Market Indicators overall
	$this->_indicartorsOverall( $data['base']['data']['ranking_market']['score'], 'F64', $styleBase );
	$this->_indicartorsOverall( $data['end']['data']['ranking_market']['score'], 'F65', $styleEnd );
	
	// Education Indicators overall
	$this->_indicartorsOverall( $data['base']['data']['ranking_education']['score'], 'F68', $styleBase );
	$this->_indicartorsOverall( $data['end']['data']['ranking_education']['score'], 'F69', $styleEnd );
	
	// Health Indicators overall
	$this->_indicartorsOverall( $data['base']['data']['ranking_health']['score'], 'F72', $styleBase );
	$this->_indicartorsOverall( $data['end']['data']['ranking_health']['score'], 'F73', $styleEnd );
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Snapshot_Baseline_Endline.xlsx"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter( $objPHPExcel, self::EXCEL_TYPE );
	$objWriter->save( 'php://output' );
	exit;
    }
    
    /**
     * 
     * @param array $indicators
     * @param string $start
     * @param type $style
     */
    protected function _setIndicators( $indicators, $start, $style )
    {
	$coordinates = PHPExcel_Cell::coordinateFromString( $start );
	$columnStartIndex = PHPExcel_Cell::columnIndexFromString( $coordinates[0] );
	
	foreach ( $indicators as $indicator ) {
	    
	    $current = $indicator['value'] + $columnStartIndex;
	    
	    $range = array(
		$coordinates[0] . $coordinates[1],
		PHPExcel_Cell::stringFromColumnIndex( $current - 1 ) . $coordinates[1]
	    );

	    $range = implode( ':', $range );
	    
	    $this->_activeSheet->setSharedStyle( $style, $range );
	    $this->_activeSheet->mergeCells( $range );
	    
	    $coordinates[1] += 4;
	}
    }
    
    /**
     * 
     * @param int $value
     * @param string $start
     * @param type $style
     */
    protected function _indicartorsOverall( $value, $start, $style )
    {
	$coordinates = PHPExcel_Cell::coordinateFromString( $start );
	$columnStartIndex = PHPExcel_Cell::columnIndexFromString( $coordinates[0] );
	
	if ( empty( $value ) ) {
	   return false;
	} else {
	    
	    $cellsToFille = ceil( $value / 20 );
	    $current = $columnStartIndex + ( $cellsToFille - 1 );
	}
	
	$range = array(
	    $coordinates[0] . $coordinates[1],
	    PHPExcel_Cell::stringFromColumnIndex( $current - 1 ) . $coordinates[1]
	);

	$range = implode( ':', $range );
	
	$this->_activeSheet->setSharedStyle( $style, $range );
	$this->_activeSheet->mergeCells( $range );
	$this->_activeSheet->setCellValue( $start, $value . '%' );
    }
    
    /**
     * 
     * @param array $data
     */
    protected function _baseEndLineSetValues( $data )
    {
	$suku = $data['base']['suku'];
	
	$this->_activeSheet->setCellValue( 'B1', $suku . ', Access to Markets' );
	$this->_activeSheet->setCellValue( 'J1', $suku . ', Access to Education' );
	$this->_activeSheet->setCellValue( 'R1', $suku . ', Access to Health' );
	$this->_activeSheet->setCellValue( 'B48', $suku . ', Overall Ranking' );
	
	// Set the base data
	$this->_activeSheet->setCellValue( 'D6', $data['base']['date'] );
	$this->_activeSheet->setCellValue( 'L6', $data['base']['date'] );
	$this->_activeSheet->setCellValue( 'T6', $data['base']['date'] );
	$this->_activeSheet->setCellValue( 'D54', $data['base']['date'] );
	
	$this->_activeSheet->setCellValue( 'D9', $data['end']['date'] );
	$this->_activeSheet->setCellValue( 'L9', $data['end']['date'] );
	$this->_activeSheet->setCellValue( 'T9', $data['end']['date'] );
	$this->_activeSheet->setCellValue( 'D57', $data['end']['date'] );
	
	// Market
	$this->_activeSheet->setCellValue( 'E6', $data['base']['data']['ranking_market']['total'] . '/' . $data['base']['data']['ranking_market']['count'] );
	$this->_activeSheet->setCellValue( 'F6', $data['base']['data']['ranking_market']['score'] . '%' );
	
	$this->_activeSheet->setCellValue( 'E9', $data['end']['data']['ranking_market']['total'] . '/' . $data['base']['data']['ranking_market']['count'] );
	$this->_activeSheet->setCellValue( 'F9', $data['end']['data']['ranking_market']['score'] . '%' );
	
	// Education
	$this->_activeSheet->setCellValue( 'M6', $data['base']['data']['ranking_education']['total'] . '/' . $data['base']['data']['ranking_education']['count'] );
	$this->_activeSheet->setCellValue( 'N6', $data['base']['data']['ranking_education']['score'] . '%' );
	
	$this->_activeSheet->setCellValue( 'M9', $data['end']['data']['ranking_education']['total'] . '/' . $data['base']['data']['ranking_education']['count'] );
	$this->_activeSheet->setCellValue( 'N9', $data['end']['data']['ranking_education']['score'] . '%' );
	
	// Health
	$this->_activeSheet->setCellValue( 'U6', $data['base']['data']['ranking_health']['total'] . '/' . $data['base']['data']['ranking_health']['count'] );
	$this->_activeSheet->setCellValue( 'V6', $data['base']['data']['ranking_health']['score'] . '%' );
	
	$this->_activeSheet->setCellValue( 'U9', $data['end']['data']['ranking_health']['total'] . '/' . $data['base']['data']['ranking_health']['count'] );
	$this->_activeSheet->setCellValue( 'V9', $data['end']['data']['ranking_health']['score'] . '%' );
	
	$this->_activeSheet->setCellValue( 'E54', $data['base']['data']['ranking_market']['score'] . '%' );
	$this->_activeSheet->setCellValue( 'F54', $data['base']['data']['ranking_education']['score'] . '%' );
	$this->_activeSheet->setCellValue( 'G54', $data['base']['data']['ranking_health']['score'] . '%' );
	
	$this->_activeSheet->setCellValue( 'E57', $data['end']['data']['ranking_market']['score'] . '%' );
	$this->_activeSheet->setCellValue( 'F57', $data['end']['data']['ranking_education']['score'] . '%' );
	$this->_activeSheet->setCellValue( 'G57', $data['end']['data']['ranking_health']['score'] . '%' );
    }
    
    /**
     * 
     * @param int $id
     * @return Array
     */
    protected function _getDataSnapshot( $id )
    {
	$mapperSnapshot = new Model_DAO_Snapshot();
	$snapshotVO = $mapperSnapshot->fetchRow( array( 'id_snapshot' => $id ) );
	
	$snapshotBO = new Model_BO_Snapshot();
	
	$ranking = array();
	foreach ( array( 1, 2, 3 ) as $indicator ) {

	    $rows = $snapshotBO->getIndicators( $id, $indicator );

	    $score = 0;
	    $total = 0;
	    foreach ( $rows as $value )
		$total += $value['value'];

	    $countRows = ( count( $rows ) * 2 );
	    $score = round( ( $total * 100 ) / $countRows );
	    
	    switch ( $indicator ) {
		case 1:
		    $rankingPos = 'ranking_market';
		    break;
		case 2:
		    $rankingPos = 'ranking_education';
		    break;
		case 3:
		    $rankingPos = 'ranking_health';
		    break;
	    }
	    
	    $ranking[$rankingPos] = array(
		'score' => $score,
		'count' => $countRows,
		'total' => $total,
	    );
	}
	
	$indicators = array();
	$indicators['markets'] = $snapshotBO->getIndicators( $id, 1 );
	$indicators['education'] = $snapshotBO->getIndicators( $id, 2 );
	$indicators['health'] = $snapshotBO->getIndicators( $id, 3 );
	
	return array( 
	    'data'	    => $ranking,
	    'snapshot'	    => $snapshotVO,
	    'suku'	    => $snapshotVO->getFkIdAddSuku()->getSuku(),
	    'date'	    => ILO_Util_Geral::dateToBr( $snapshotVO->getDateSnapshot() ),
	    'indicators'    => $indicators
	);
    }
    
    /**
     * 
     * @param int $id
     * @return Array
     */
    public function listDocuments( $id )
    {
	$files = array();
	
	$dirBase = 'public/snapshot/';
	if ( !is_dir( $dirBase ) )
	    mkdir( $dirBase );
	    
	$dirBase .= md5( $id ) . '/';
	if ( !is_dir( $dirBase ) )
	    mkdir( $dirBase );
	
	$dirH = opendir( $dirBase );
	while( $file = readdir( $dirH ) ) {
	    
	    if ( $file == '.' || $file == '..' )
		continue;
	    
	    $filepath = $dirBase . $file;
	    
	    $files[] = array(
		'size'	  => ILO_Util_ByteSize::calculator( filesize( $filepath ) ),
		'path'	  => $filepath,
		'name'	  => $file,
	    );
	}
	
	return $files;
    }
}