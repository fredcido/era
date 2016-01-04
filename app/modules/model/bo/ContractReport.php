<?php

class Model_BO_ContractReport extends ILO_Model_BO
{
    const EXCEL_TYPE = 'Excel2007';
    
    /**
     *
     * @var Model_DAO_ContractReport 
     */
    protected $_dao;
    
    /**
     *
     * @var int
     */
    protected $_maxIpc = 0;
    
    /**
     * 
     */
    public function __construct()
    {
	$this->_dao = new Model_DAO_ContractReport();
    }
    
    /**
     *
     * @param int $id 
     */
    public function exportRecord( $id )
    {
	$data = $this->_getDataContract( $id );
	$this->_excelRecord( $data['data'], $data['records'] );
    }
    
    public function exportGroup( $id )
    {
	$contracts = explode( ',', $id );
	
	$data = array();
	$this->_maxIpc = 0;
	foreach ( $contracts as $id )
	    $data[] = $this->_getDataContract ( $id );
	
	$this->_excelBatch( $data );
    }
    
    /**
     * 
     * @param int $batch
     */
    public function exportBatch( $batch )
    {
	$contractDAO = new Model_DAO_Contract();
	$contracts = $contractDAO->fetchAll( array(), array( 'batch' => $batch ) );
	
	$ids = array();
	foreach ( $contracts as $contract )
	    $ids[] = $contract->getIdContract();
	
	$this->exportGroup( implode( ',', $ids ) );
    }
    
    /**
     *
     * @param int $id
     * @return array
     */
    protected function _getDataContract( $id )
    {
	$contractDAO = new Model_DAO_Contract();
	$contractVO = $contractDAO->fetchRow( array( 'id_contract' => $id ) );
	
	$contractHasLocationDAO = new Model_DAO_ContractHasLocation();
	$locations = $contractHasLocationDAO->fetchAll( array( 'id_relationship' ), array( 'fk_id_contract' => $id ) );
	
	// Contract data
	$data = $contractVO->toArray();
	
	$data['signature_date'] = ILO_Util_Geral::dateToBr( $data['signature_date'] );
	$data['date_start_planned'] = ILO_Util_Geral::dateToBr( $data['date_start_planned'] );
	$data['date_finish_planned'] = ILO_Util_Geral::dateToBr( $data['date_finish_planned'] );
	$data['nitl_valid'] = ILO_Util_Geral::dateToBr( $data['nitl_valid'] );
	$data['bank_valid'] = ILO_Util_Geral::dateToBr( $data['bank_valid'] );
	$data['total_contract'] = number_format( $data['total_contract'], 2, '.', ',' );
	
        $data['road_name'] = $data['road_name'].' - '.$data['road_length'].' - '.$data['road_section'].' - '.$data['section_length'];
        
	// District
	$data['district'] = $contractVO->getFkIdAddDistrict()->getDistrict();
	
	// Contract locations data
	if ( !empty( $locations ) ) {
	    
	    $subdistrict = array_shift( $locations );
	    $data['subdistrict'] = $subdistrict->getFkIdAddSubdistrict()->getSubdistrict();
	    
	} else
	    $data['subdistrict'] = '';
	
	if ( !empty( $data['fk_id_enterprise'] ) ) {
	    
	    $data['enterprise'] = $contractVO->getFkIdEnterprise()->getEnterpriseName();
	    $data['enterprise_owner'] = $contractVO->getFkIdEnterprise()->getOwnerName();
	    $data['enterprise_phone'] = $contractVO->getFkIdEnterprise()->getCellPhone1();
	    
//	    $cellPhone = $contractVO->getFkIdEnterprise()->getCellPhone1();
//	    if ( !empty( $cellPhone ) )
//		$data['enterprise_phone'] .= " / \n" . $cellPhone;
	    
	} else {
	    
	    $data['enterprise'] = '';
	    $data['enterprise_phone'] = '';
	    $data['enterprise_owner'] = '';
	}
	
	// Amendments
	$amendmentDAO = new Model_DAO_Amendment();
	$amendments = $amendmentDAO->fetchAll( array( 'date_registration' ), array( 'fk_id_contract' => $id ) );
	
	if ( !empty( $amendments ) ) {
	    
	    $data['amendment_date'] = array();
	    $data['amendment_value'] = array();
	    
	    foreach ( $amendments as $amendment ) {
		
		$row = $amendment->toArray();
		if ( !empty( $row['amendment_date'] ) ) {// && empty( $data['amendment_date'] ) ) {
		    
		    $data['amendment_date'][] = array(
			'date'		=> ILO_Util_Geral::dateToBr(  $row['amendment_date'] ),
			'registration'	=> ILO_Util_Geral::dateToBr(  $row['date_registration'] )
		    );
		}
		
		if ( !empty( $row['amendment_value'] ) ) { //&& empty( $data['amendment_value'] ) ) {
		    
		    $data['amendment_value'][] = array(
			'value'		=> number_format( $row['amendment_value'], 2, '.', ',' ),
			'registration'	=> ILO_Util_Geral::dateToBr(  $row['date_registration'] )
		    );
		}
		
		if ( !empty( $row['original_value'] ) ) { //&& empty( $data['amendment_value'] ) ) {
		    
		    $data['amendment_value'][] = array(
			'value'		=> number_format( $row['original_value'], 2, '.', ',' )
		    );
		}
	    }
	}
	
	// Workers
	$workers = $this->_dao->getContractWorkersGender( $id );
	$data['men'] = 0;
	$data['women'] = 0;
	$data['total_days'] = 0;
	
	foreach ( $workers as $worker ) {
	    if ( $worker['gender'] == 'M' )
		$data['men'] = $worker['total'];
	    
	    if ( $worker['gender'] == 'F' )
		$data['women'] = $worker['total'];
	    
	    $data['total_days'] += $worker['dias'];
	}
	
	$data['total_workers'] = $data['men'] + $data['women'];
	
	// Records
	$contractBO = new Model_BO_Contract();
	$records = $contractBO->listContratos( $id );
	
	return array(
	    'data'	=> $data,
	    'records'	=>  $records
	);
    }
	    
    /**
     *
     * @param array $data 
     */
    protected function _excelRecord( $data, $records )
    {
       	$excelPath = APPDIR . '/../library/PHPExcel/';
	$logo = $excelPath . 'templates/logo_era.png';
	
	spl_autoload_unregister( 'iloAutoloader' );
	
	require_once( $excelPath . 'PHPExcel/IOFactory.php' );
	
	$objReader = PHPExcel_IOFactory::createReader( self::EXCEL_TYPE );
	$objPHPExcel = $objReader->load( $excelPath . 'templates/record.xlsx' );
	
	$activeSheet = $objPHPExcel->getActiveSheet();
	
//	$objDrawing = new PHPExcel_Worksheet_Drawing();
//	$objDrawing->setPath( $logo )
//		    ->setCoordinates( 'A2' )
//		    ->setWorksheet( $activeSheet );
	
	$activeSheet->setCellValue( 'E7', $data['ilo_contract'] );
	$activeSheet->setCellValue( 'H7', $data['contractor_name'] );
	$activeSheet->setCellValue( 'C9', $data['district'] );
	$activeSheet->setCellValue( 'E9', $data['subdistrict'] );
	$activeSheet->setCellValue( 'C10', $data['road_name'] );        
	//$activeSheet->setCellValue( 'E10', $data['road_length'] );
	$activeSheet->setCellValue( 'C12', $data['signature_date'] );
	$activeSheet->setCellValue( 'E12', $data['date_start_planned'] );
	$activeSheet->setCellValue( 'C13', $data['date_finish_planned'] );
	$activeSheet->setCellValue( 'C14', $data['total_contract'] );
	$activeSheet->setCellValue( 'E14', $data['total_contract'] );
	$activeSheet->setCellValue( 'K10', $data['nitl_valid'] );
	$activeSheet->setCellValue( 'K9', $data['bank_valid'] );
	$activeSheet->setCellValue( 'D11', $data['enterprise_owner'] );
	$activeSheet->setCellValue( 'F11', $data['enterprise_phone'] );

	$activeSheet->getStyle( 'F11' )->getAlignment()->setWrapText(true);

        $activeSheet->mergeCells( 'C10:F10');
        $activeSheet->mergeCells( 'F11:G11');
	
	$activeSheet->setCellValue( 'N10', $data['total_workers'] );
	$activeSheet->setCellValue( 'P10', $data['women'] );
	$activeSheet->setCellValue( 'O10', $data['men'] );
	$activeSheet->setCellValue( 'Q10', $data['total_days'] );
	
	$startAmendments = 13;
	$higherAmendment = 13;
        
	// Amendment Date
	if ( !empty( $data['amendment_date'] ) ) {
	    
	    $colStart = PHPExcel_Cell::columnIndexFromString( 'K' ) - 1;
	    
	    foreach ( $data['amendment_date'] as $amendmentDate ) {
		
		if ( $higherAmendment > 14 )
		    $activeSheet->insertNewRowBefore( $higherAmendment, 1 );
		
		$activeSheet->setCellValueByColumnAndRow( $colStart, $higherAmendment, $amendmentDate['registration'] );
		$activeSheet->setCellValueByColumnAndRow( $colStart + 1, $higherAmendment++, $amendmentDate['date'] );
	    }
	    
	    $activeSheet->setCellValue( 'E13', $amendmentDate['date'] );
	    $activeSheet->setCellValue( 'L' . $higherAmendment, $amendmentDate['date'] );
	}
	
	// Amendment Value
	if ( !empty( $data['amendment_value'] ) ) {
	    
	    $colStart = PHPExcel_Cell::columnIndexFromString( 'I' ) - 1;
	    
	    $current = 0;
	    $total = 0;
	    $original = 0;
	    
	    foreach ( $data['amendment_value'] as $amendmentValue ) {
		
		if ( empty( $current ) )
		    $value = ILO_Util_Geral::toFloat( $amendmentValue['value'] );
		else    
		    $value =  ILO_Util_Geral::toFloat( $amendmentValue['value'] ) - $current;
		
		$current = ILO_Util_Geral::toFloat( $amendmentValue['value'] );
		
		if ( empty( $amendmentValue['registration'] ) ) {
		    
		    $original = $value;
		    continue;
		}
		
		$total += $value;
		$value = number_format( $value, 2, ',', '.' );
		
		if ( $startAmendments > $higherAmendment ) {
		    $higherAmendment = $startAmendments;
		    $activeSheet->insertNewRowBefore( $startAmendments + 1, 1 );
		}
		
		$activeSheet->setCellValueByColumnAndRow( $colStart, $startAmendments, $amendmentValue['registration'] );
		$activeSheet->setCellValueByColumnAndRow( $colStart + 1, $startAmendments++, $value );
	    }
	    
	    
	    $activeSheet->setCellValue( 'E14', $amendmentValue['value'] );
	    $activeSheet->setCellValue( 'C14', number_format( $original, 2, '.', ',' ) );
	    $activeSheet->setCellValue( 'J' . $startAmendments, number_format( $total, 2, '.', ',' ) );
	}
	
	$higherAmendment += 2;
	
	$row = 18;
	if ( $higherAmendment >= $row ) {
	    
	    $row = $higherAmendment;
	    $activeSheet->insertNewRowBefore( $higherAmendment - 1, 1 );
	    
	    $activeSheet->duplicateStyle( $activeSheet->getStyle( 'A8' ), 'C15:E' . $higherAmendment );
	    $activeSheet->duplicateStyle( $activeSheet->getStyle( 'A8' ), 'I' . ( $higherAmendment - 1 ). ':L' . ( $higherAmendment - 1 ) );
	    
	    $row += 2;
	}
	
	foreach ( $records['rows'] as $record ) {
	    
	    $activeSheet->insertNewRowBefore( ++$row, 1 );
	    $activeSheet->setCellValue( 'A' . $row, $record['date_record'] );
	    $activeSheet->setCellValue( 'B' . $row, $record['cert_num'] );
	    $activeSheet->setCellValue( 'C' . $row, $record['category'] );
	    $activeSheet->setCellValue( 'D' . $row, $record['invoice_amount'] );
	    $activeSheet->setCellValue( 'E' . $row, $record['net_payment'] );
	    $activeSheet->setCellValue( 'F' . $row, $record['payment_origin'] );
	    $activeSheet->setCellValue( 'H' . $row, $record['amount'] );
	    $activeSheet->setCellValue( 'I' . $row, $record['contract_balance'] );
	    $activeSheet->setCellValue( 'J' . $row, $record['advances'] );
	    $activeSheet->setCellValue( 'K' . $row, $record['retention'] );
	    $activeSheet->setCellValue( 'L' . $row, $record['finan_compl'] );
	    
	    $activeSheet->mergeCells( 'F' . $row. ':G' . $row );
	    
	    if ( $record['category'] == 'First Advance' ) {
		
		$activeSheet->setCellValue( 'J11', $record['date_record'] );
		$activeSheet->setCellValue( 'K11', $record['amount'] );
	    }
	}
	
	
	$row += 2;
	$activeSheet->setCellValue( 'D' . $row, $records['invoices'] );
	$activeSheet->setCellValue( 'E' . $row, $records['net_pays'] );
	$activeSheet->setCellValue( 'H' . $row, $records['progress_pay'] );
	$activeSheet->setCellValue( 'I' . $row, $records['balances'] );
	$activeSheet->setCellValue( 'J' . $row, $records['advances'] );
	$activeSheet->setCellValue( 'K' . $row, $records['retentions'] );
	$activeSheet->setCellValue( 'L' . $row, $records['compl'] );
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Contract_Record.xlsx"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter( $objPHPExcel, self::EXCEL_TYPE );
	$objWriter->save( 'php://output' );
	exit;
    }
    
     /**
     *
     * @param array $data 
     */
    protected function _excelBatch( $data )
    {
	$excelPath = APPDIR . '/../library/PHPExcel/';
	
	spl_autoload_unregister( 'iloAutoloader' );
	
	require_once( $excelPath . 'PHPExcel/IOFactory.php' );
	
	$objReader = PHPExcel_IOFactory::createReader( self::EXCEL_TYPE );
	$objPHPExcel = $objReader->load( $excelPath . 'templates/contract.xlsx' );
	
	$activeSheet = $objPHPExcel->getActiveSheet();
	$colStart = 2;
	
	foreach ( $data as $contract ) {
	    
	    $dataContract = $contract['data'];
	
	    $rowStart = 2;
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['district'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['subdistrict'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['road_name'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['road_length'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['ilo_contract'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['enterprise'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['enterprise_owner'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['enterprise_phone'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['signature_date'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['date_start_planned'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['date_finish_planned'] );
	    
	    // Amendment Date
	    if ( !empty( $data['amendment_date'] ) ) {

		$amendmentDate = array_shift( $data['amendment_date'] );
		$activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart, $amendmentDate['date'] );
	    }
	    
	    $rowStart++;
	    
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['bank_valid'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['nitl_valid'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $dataContract['total_contract'] );
	    
	    $totalContract = $dataContract['total_contract'];
	    
	    // Amendment Value
	    if ( !empty( $data['amendment_value'] ) ) {

		$amendmentValue = array_shift( $data['amendment_value'] );
		$activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart, $amendmentValue['value'] );
		$totalContract += (float)number_format( $amendmentValue['value'], 2, '', '.' );
	    }
	    
	    $rowStart++;
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $totalContract );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $contract['records']['retentions'] );
	    $firstAdvance = 0;
	    
	    foreach ( $contract['records']['rows'] as $record ) {
		
		if ( $record['category'] == 'First Advance' ) {
		    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart, $record['date_record'] );
		    $firstAdvance = $record['amount'];
		}
	    }
	    $rowStart++;
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $contract['records']['advances'] );
	    
	    $maxIpcCurrentContract = 0;
	    foreach ( $contract['records']['rows'] as $record ) {
		
		if ( $record['category'] == 'Wages' ) {
		    
		    if ( $record['cert_num'] > $maxIpcCurrentContract )
			$maxIpcCurrentContract = $record['cert_num'];
		    
		    if ( $record['cert_num'] > $this->_maxIpc ) {
			
			$this->_maxIpc = (int)$record['cert_num'];
			$activeSheet->insertNewRowBefore( $rowStart, 3 );
			
			$activeSheet->mergeCells( 'A' . $rowStart . ':A' . ( $rowStart + 2 ) );
			$activeSheet->setCellValueByColumnAndRow( 0, $rowStart, 'IPC ' . $record['cert_num'] );
			$activeSheet->setCellValueByColumnAndRow( 1, $rowStart, 'Date' );
			$activeSheet->setCellValueByColumnAndRow( 1, ( $rowStart + 1 ), 'Claim Amount' );
			$activeSheet->setCellValueByColumnAndRow( 1, ( $rowStart + 2 ), 'Net Paid' );
		    }
		 
		    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $record['date_record'] );
		    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $record['amount'] );
		    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $record['net_payment'] );
		}
	    }
	    
	    if ( $maxIpcCurrentContract < $this->_maxIpc )
		$rowStart += ( $this->_maxIpc - $maxIpcCurrentContract ) * 3;
	    
	    //$activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $contract['records']['retentions'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $firstAdvance );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $contract['records']['advances'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $contract['records']['progress_pay'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $contract['records']['balances'] );
	    $activeSheet->setCellValueByColumnAndRow( $colStart, $rowStart++, $contract['records']['compl'] . '%' );
	    
	 
	    $colStart++;
	}
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Contract_Batch.xlsx"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter( $objPHPExcel, self::EXCEL_TYPE );
	$objWriter->save( 'php://output' );
	exit;
    }
    
    /**
     *
     * @return array
     */
    public function listReport()
    {
	$method = $this->toCamelCase( $this->_data['detailed'] );
	
	$this->_data['contracts'] = explode( ',', $this->_data['contracts'] );
	    
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
    public function listSexo()
    {
	$rows = $this->_dao->beneficiarioSexo( $this->_data );
	
	$data = array(
	    'rows'	=> array(),
	    'total'	=> 0,
	    'graph'	=>  array()
	);
	
	foreach ( $rows as $row ) {
	    
	    $data['rows'][] = array(
				'sexo'	=>  ( $row['gender'] == 'M' ? 'Mane' : 'Feto' ),
				'total'	=>  $row['total']
			    );
	    
	    $data['total'] += (int)$row['total'];
	}

	foreach ( $data['rows'] as $key => $value ) {
	    
	    $percent = round( ( 100 * $value['total'] ) / $data['total'], 2 );
	    $data['rows'][$key]['porcentagem'] = $percent; 
	    $data['graph'][] = array( $value['sexo'], (float)$percent );
	}
	
	$data['contracts'] = $this->_getContracts();
	
	return $data;
    }
    
    public function listIdade()
    {
	$rows = $this->_dao->beneficiarioGrupoIdade( $this->_data );
	
	$data = array(
	    'rows'			=> array(),
	    'total_homens'		=> 0,
	    'total_homens_porcent'	=> 0,
	    'total_mulheres'		=> 0,
	    'total_mulheres_porcent'	=> 0,
	    'total'			=> 0,
	    'graph_pie'			=>  array(),
	    'graph_bar'			=>  array(
		'cursos'    => array(),
		'mane'	    => array(),
		'feto'	    => array()
	    )
	);
	
	$grupos = array();
	foreach ( $rows as $row ) {
	    
	    switch ( $row['idade'] ) {
		case $row['idade'] >= 15 && $row['idade'] <= 24:
			@$grupos['15 - 24'][ trim( $row['gender'] ) ]++;
		    break;
		case $row['idade'] >= 25 && $row['idade'] <= 39:
			@$grupos['25 - 39'][ trim( $row['gender'] ) ]++;
		    break;
		case $row['idade'] >= 40 && $row['idade'] <= 54:
			@$grupos['40 - 54'][ trim( $row['gender'] ) ]++;
		    break;
		case $row['idade'] >= 55:
			@$grupos['55+'][ trim( $row['gender'] ) ]++;
		    break;
	    }
	}
	
	foreach ( $grupos as $key => $row ) {
	    
	    $row['homens'] = empty( $row['M'] ) ? 0 : (int)$row['M'];
	    $row['mulheres'] = empty( $row['F'] ) ? 0 : (int)$row['F'];
	    $total = $row['homens'] + $row['mulheres'];
	    
	    $percentWoman = empty( $total ) ? 0 : round( ( 100 * $row['mulheres'] ) / $total, 2 );
	    $percentMan = empty( $total ) ? 0 : round( ( 100 * $row['homens'] ) / $total, 2 );
	    
	    $data['rows'][] = array(
				'grupo'			  =>  $key,
				'total_homens'		  =>  $row['homens'],
				'total_homens_porcent'	  =>  $percentMan,
				'total_mulheres'	  =>  $row['mulheres'],
				'total_mulheres_porcent'  =>  $percentWoman,
				'total'			  =>  $total
			    );
	    
	    $data['total'] += $total;
	    $data['total_homens'] += $row['homens'];
	    $data['total_mulheres'] += $row['mulheres'];
	}
	
	foreach ( $data['rows'] as $key => $value ) {
	    
	    $percent = round( ( 100 * $value['total'] ) / $data['total'], 2 );
	    
	    $data['rows'][$key]['total_porcent'] = $percent; 
	    $data['graph_pie'][] = array( $value['grupo'], (float)$percent );
	    
	    $data['graph_bar']['grupos'][] = $value['grupo'];
	    $data['graph_bar']['mane'][] = $value['total_homens'];
	    $data['graph_bar']['feto'][] = $value['total_mulheres'];
	}
	
	$data['total_homens_porcent'] = round( ( 100 * $data['total_homens'] ) / $data['total'], 2 );
	$data['total_mulheres_porcent'] = round( ( 100 * $data['total_mulheres'] ) / $data['total'], 2 );
	
	$data['contracts'] = $this->_getContracts();
	
	return $data;
    }
    
     /**
     *
     * @return array
     */
    public function listEducacao()
    {
	$rows = $this->_dao->beneficiariosEducacao( $this->_data );
	
	$cursos = array();
	foreach ( $rows as $row )
	    $cursos[$row['school_level']][ trim( $row['gender'] ) ] = $row['total'];
	
	$data = array(
	    'rows'	=> array(),
	    'total_homens'		=> 0,
	    'total_homens_porcent'	=> 0,
	    'total_mulheres'		=> 0,
	    'total_mulheres_porcent'	=> 0,
	    'total'			=> 0,
	    'graph_pie'			=>  array(),
	    'graph_bar'			=>  array(
		'educacao'  => array(),
		'mane'	    => array(),
		'feto'	    => array()
	    )
	);
	
	foreach ( $cursos as $key => $row ) {
	    
	    $row['homens'] = empty( $row['M'] ) ? 0 : (int)$row['M'];
	    $row['mulheres'] = empty( $row['F'] ) ? 0 : (int)$row['F'];
	    $total = $row['homens'] + $row['mulheres'];
	    $percentWoman = round( ( 100 * $row['mulheres'] ) / $total, 2 );
	    $percentMan = round( ( 100 * $row['homens'] ) / $total, 2 );
	    
	    $data['rows'][] = array(
				'educacao'		  =>  $key,
				'total_homens'		  =>  $row['homens'],
				'total_homens_porcent'	  =>  $percentMan,
				'total_mulheres'	  =>  $row['mulheres'],
				'total_mulheres_porcent'  =>  $percentWoman,
				'total'			  =>  $total
			    );
	    
	    $data['total'] += $total;
	    $data['total_homens'] += $row['homens'];
	    $data['total_mulheres'] += $row['mulheres'];
	}
	
	
	foreach ( $data['rows'] as $key => $value ) {
	    
	    $percent = round( ( 100 * $value['total'] ) / $data['total'], 2 );
	    
	    $data['rows'][$key]['total_porcent'] = $percent; 
	    $data['graph_pie'][] = array( $value['educacao'], (float)$percent );
	    
	    $data['graph_bar']['educacao'][] = $value['educacao'];
	    $data['graph_bar']['mane'][] = $value['total_homens'];
	    $data['graph_bar']['feto'][] = $value['total_mulheres'];
	}
	
	$data['total_homens_porcent'] = round( ( 100 * $data['total_homens'] ) / $data['total'], 2 );
	$data['total_mulheres_porcent'] = round( ( 100 * $data['total_mulheres'] ) / $data['total'], 2 );
	
	$data['contracts'] = $this->_getContracts();
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function listDistrito()
    {
	$rows = $this->_dao->beneficiarioDistritoSexo( $this->_data );
	
	$distritos = array();
	foreach ( $rows as $row )
	    $distritos[$row['district']][ trim( $row['gender'] ) ] = $row['total'];
	
	$data = array(
	    'rows'	=> array(),
	    'total_homens'		=> 0,
	    'total_homens_porcent'	=> 0,
	    'total_mulheres'		=> 0,
	    'total_mulheres_porcent'	=> 0,
	    'total'			=> 0,
	    'graph'			=>  array()
	);
	
	foreach ( $distritos as $key => $row ) {
	    
	    $row['homens'] = empty( $row['M'] ) ? 0 : (int)$row['M'];
	    $row['mulheres'] = empty( $row['F'] ) ? 0 : (int)$row['F'];
	    $total = $row['homens'] + $row['mulheres'];
	    $percentWoman = round( ( 100 * $row['mulheres'] ) / $total, 2 );
	    $percentMan = round( ( 100 * $row['homens'] ) / $total, 2 );
	    
	    $data['rows'][] = array(
				'distrito'		  =>  $key,
				'total_homens'		  =>  $row['homens'],
				'total_homens_porcent'	  =>  $percentMan,
				'total_mulheres'	  =>  $row['mulheres'],
				'total_mulheres_porcent'  =>  $percentWoman,
				'total'			  =>  $total
			    );
	    
	    $data['total'] += $total;
	    $data['total_homens'] += $row['homens'];
	    $data['total_mulheres'] += $row['mulheres'];
	}
	
	
	foreach ( $data['rows'] as $key => $value ) {
	    
	    $percent = round( ( 100 * $value['total'] ) / $data['total'], 2 );
	    
	    $data['rows'][$key]['total_porcent'] = $percent; 
	    $data['graph'][] = array( $value['distrito'], (float)$percent );
	}
	
	$data['total_homens_porcent'] = round( ( 100 * $data['total_homens'] ) / $data['total'], 2 );
	$data['total_mulheres_porcent'] = round( ( 100 * $data['total_mulheres'] ) / $data['total'], 2 );
	
	$data['contracts'] = $this->_getContracts();
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function listProfissao()
    {
	$rows = $this->_dao->beneficiarioProfissao( $this->_data );
	
	$distritos = array();
	foreach ( $rows as $row )
	    $distritos[$row['occupation']][ trim( $row['gender'] ) ] = $row['total'];
	
	$data = array(
	    'rows'	=> array(),
	    'total_homens'		=> 0,
	    'total_homens_porcent'	=> 0,
	    'total_mulheres'		=> 0,
	    'total_mulheres_porcent'	=> 0,
	    'total'			=> 0,
	    'graph'			=>  array()
	);
	
	foreach ( $distritos as $key => $row ) {
	    
	    $row['homens'] = empty( $row['M'] ) ? 0 : (int)$row['M'];
	    $row['mulheres'] = empty( $row['F'] ) ? 0 : (int)$row['F'];
	    $total = $row['homens'] + $row['mulheres'];
	    $percentWoman = round( ( 100 * $row['mulheres'] ) / $total, 2 );
	    $percentMan = round( ( 100 * $row['homens'] ) / $total, 2 );
	    
	    $data['rows'][] = array(
				'profissao'		  =>  $key,
				'total_homens'		  =>  $row['homens'],
				'total_homens_porcent'	  =>  $percentMan,
				'total_mulheres'	  =>  $row['mulheres'],
				'total_mulheres_porcent'  =>  $percentWoman,
				'total'			  =>  $total
			    );
	    
	    $data['total'] += $total;
	    $data['total_homens'] += $row['homens'];
	    $data['total_mulheres'] += $row['mulheres'];
	}
	
	
	foreach ( $data['rows'] as $key => $value ) {
	    
	    $percent = round( ( 100 * $value['total'] ) / $data['total'], 2 );
	    
	    $data['rows'][$key]['total_porcent'] = $percent; 
	    $data['graph'][] = array( $value['profissao'], (float)$percent );
	}
	
	$data['total_homens_porcent'] = round( ( 100 * $data['total_homens'] ) / $data['total'], 2 );
	$data['total_mulheres_porcent'] = round( ( 100 * $data['total_mulheres'] ) / $data['total'], 2 );
	
	$data['contracts'] = $this->_getContracts();
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function listEndereco()
    {
	$rows = $this->_dao->beneficiarioEnderecoSexo( $this->_data );
	
	$distritos = array();
	foreach ( $rows as $row )
	    $distritos[$row['district']][ trim( $row['gender'] ) ] = $row['total'];
	
	$data = array(
	    'rows'	=> array(),
	    'total_homens'		=> 0,
	    'total_homens_porcent'	=> 0,
	    'total_mulheres'		=> 0,
	    'total_mulheres_porcent'	=> 0,
	    'total'			=> 0,
	    'graph'			=>  array()
	);
	
	foreach ( $distritos as $key => $row ) {
	    
	    $row['homens'] = empty( $row['M'] ) ? 0 : (int)$row['M'];
	    $row['mulheres'] = empty( $row['F'] ) ? 0 : (int)$row['F'];
	    $total = $row['homens'] + $row['mulheres'];
	    $percentWoman = round( ( 100 * $row['mulheres'] ) / $total, 2 );
	    $percentMan = round( ( 100 * $row['homens'] ) / $total, 2 );
	    
	    $data['rows'][] = array(
				'distrito'		  =>  $key,
				'total_homens'		  =>  $row['homens'],
				'total_homens_porcent'	  =>  $percentMan,
				'total_mulheres'	  =>  $row['mulheres'],
				'total_mulheres_porcent'  =>  $percentWoman,
				'total'			  =>  $total
			    );
	    
	    $data['total'] += $total;
	    $data['total_homens'] += $row['homens'];
	    $data['total_mulheres'] += $row['mulheres'];
	}
	
	
	foreach ( $data['rows'] as $key => $value ) {
	    
	    $percent = round( ( 100 * $value['total'] ) / $data['total'], 2 );
	    
	    $data['rows'][$key]['total_porcent'] = $percent; 
	    $data['graph'][] = array( $value['distrito'], (float)$percent );
	}
	
	$data['total_homens_porcent'] = round( ( 100 * $data['total_homens'] ) / $data['total'], 2 );
	$data['total_mulheres_porcent'] = round( ( 100 * $data['total_mulheres'] ) / $data['total'], 2 );
	
	$data['contracts'] = $this->_getContracts();
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function listPagamento()
    {
	$rows = $this->_dao->listPagamento( $this->_data );
	
	$contractDAO = new Model_DAO_Contract();
	$workerDAO = new Model_DAO_Worker();
	
	$data = array();
	$totals = array(
	    'days'  => 0,
	    'valor' => 0
	);
	
	foreach ( $rows as $row ) {
	    
	    if ( !array_key_exists( $row['id_contract'], $data ) ) {
		
		$data[ $row['id_contract'] ] = array(
		    'contrato'		=> $contractDAO->fetchRow( array( 'id_contract' => $row['id_contract'] ) ),
		    'beneficiarios'	=> array(),
		    'total'		=> 0
		);
	    }
	    
	    $worker = $workerDAO->fetchRow( array( 'id_worker' => $row['id_worker'] ) );
	    
	    $nome = $worker->getCodBeneficiario() . ' - ' . $row['first_name'] . ' ' . $row['last_name'];
	    
	    if ( !array_key_exists( $nome, $data[ $row['id_contract'] ]['beneficiarios'] ) )
		$data[ $row['id_contract'] ]['beneficiarios'][ $nome ] = array();
	    
	    $row['nome'] = $nome;
	    
	    $data[ $row['id_contract'] ]['beneficiarios'][ $nome ][] = $row;
	    $data[ $row['id_contract'] ]['total']++;
	    
	    $totals['days'] += $row['total_days'];
	    $totals['valor'] += $row['total_salary'];
	}
	
	$data = array(
	    'rows'	=> $data,
	    'totals'	=> $totals,
	    'contracts' => $this->_getContracts()
	);
	
	return $data;
    }
    
    /**
     *
     * @return string 
     */
    protected function _getContracts()
    {
	$contractDAO = new Model_DAO_Contract();
	$contracts = $contractDAO->fetchAll( array(), array( sprintf( 'id_contract IN(%s)', implode( ',', $this->_data['contracts'] ) ) ) );
	
	$data = array();
	foreach ( $contracts as $row )
	    $data[] = $row->getProjectCode() . ' - ' . $row->getContractorName();
	
	return $data;
    }
}