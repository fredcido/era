<?php

class Model_BO_Snapshot extends ILO_Model_BO
{
    /*
     * 
     */
    public function saveInformation()
    {
	$snapshotDAO = new Model_DAO_Snapshot();
	$snapshotVO = new Model_VO_Snapshot();

	$snapshotDAO->beginTransaction();
	try {
	    
	    $snapshotVO->setValues( $this->_data );
	    
	    $snapshotVO->setDateSnapshot( ILO_Util_Geral::dateToBd( $snapshotVO->getDateSnapshot() ) );

	    if ( null == $snapshotVO->getIdSnapshot() )
		$snapshotId = $snapshotDAO->insert( $snapshotVO );
	    else {

		$snapshotId = $snapshotVO->getIdSnapshot();
		$snapshotDAO->update( $snapshotVO, array( 'id_snapshot' => $snapshotId ) );
	    }
	    
	    $snapshotHasVillageDAO = new Model_DAO_SnapshotHasVillage();
	    $snapshotHasVillageVO = new Model_VO_SnapshotHasVillage();
	    
	    $snapshotHasVillageDAO->delete( array( 'fk_id_snapshot' => $snapshotId ) );
	    
	    if ( !empty( $this->_data['village_combo'] ) ) {
		
		$snapshotHasVillageVO->setFkIdSnapshot( $snapshotId );
		
		foreach ( $this->_data['village_combo'] as $key => $combo ) {
		
		    $vo = clone $snapshotHasVillageVO;
		    $vo->setFkIdVillage( $this->_data['village_id'][$key] );
		    $vo->setTotal( $this->_data['village_total'][$key] );
		    $vo->setTotalMen( $this->_data['village_men'][$key] );
		    $vo->setTotalWomen( $this->_data['village_women'][$key] );
		    $vo->setTotalHh( $this->_data['village_hh'][$key] );
		    
		    $snapshotHasVillageDAO->insert( $vo );
		}
	    }
	    
	    $snapshotKeyDAO = new Model_DAO_SnapshotKey();
	    $snapshotkeyVO = new Model_VO_SnapshotKey();
	    
	    $snapshotKeyDAO->delete( array( 'fk_id_snapshot' => $snapshotId, 'step' => 1 ) );
	    
	    $keys = $this->_parseKeys( $this->_data['key'] );
	    
	    $snapshotkeyVO->setFkIdSnapshot( $snapshotId );
	    $snapshotkeyVO->setStep( 1 );
	    
	    foreach ( $keys as $key => $value ) {
		
		$vo = clone $snapshotkeyVO;
		$vo->setIdentifier( $key );
		$vo->setValue( $value );
		
		$snapshotKeyDAO->insert( $vo );
	    }

	    // Salva auditoria
	    $description = 'REJISTU/ATUALIZA SNAPSHOT BASELINE: ' . $snapshotId . ' BA HAKAT 1 – INFORMASAUN GERAL';
	    $this->audit( $description, self::SALVAR );
	    
	    $this->_createFolderImages( $snapshotId );

	    $snapshotDAO->commit();
	    return $snapshotId;
	    
	} catch ( Exception $e ) {

	    $snapshotDAO->rollBack();
	    return false;
	}
    }
    
    
    /**
     *
     * @return boolean 
     */
    public function saveOverall()
    {
	$snapshotDAO = new Model_DAO_Snapshot();
	$snapshotVO = new Model_VO_Snapshot();

	$snapshotDAO->beginTransaction();
	try {
	    
	    $snapshotVO->setValues( $this->_data );

	    $snapshotId = $snapshotVO->getIdSnapshot();
	    $snapshotDAO->update( $snapshotVO, array( 'id_snapshot' => $snapshotId ) );
	
	    // Salva auditoria
	    $description = 'ATUALIZA SNAPSHOT BASELINE: ' . $snapshotId . ' BA HAKAT 8 – OVERALL RANKINGS';
	    $this->audit( $description, self::SALVAR );

	    $snapshotDAO->commit();
	    return $snapshotId;
	    
	} catch ( Exception $e ) {

	    $snapshotDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @return boolean 
     */
    public function saveSocio()
    {
	$snapshotDAO = new Model_DAO_Snapshot();

	$snapshotDAO->beginTransaction();
	try {
	    
	    $snapshotKeyDAO = new Model_DAO_SnapshotKey();
	    $snapshotkeyVO = new Model_VO_SnapshotKey();
	    
	    $snapshotKeyDAO->delete( array( 'fk_id_snapshot' => $this->_data['id_snapshot'], 'step' => 2 ) );
	    
	    $keys = $this->_parseKeys( $this->_data['key'] );
	    
	    $snapshotkeyVO->setFkIdSnapshot( $this->_data['id_snapshot'] );
	    $snapshotkeyVO->setStep( 2 );
	    
	    foreach ( $keys as $key => $value ) {
		
		$vo = clone $snapshotkeyVO;
		$vo->setIdentifier( $key );
		$vo->setValue( $value );
		
		$snapshotKeyDAO->insert( $vo );
	    }

	    // Salva auditoria
	    $description = 'REJISTU/ATUALIZA SNAPSHOT BASELINE: ' . $this->_data['id_snapshot'] . ' BA HAKAT 3 – SOCIO-ECONOMIC';
	    $this->audit( $description, self::SALVAR );

	    $snapshotDAO->commit();
	    return $this->_data['id_snapshot'];
	    
	} catch ( Exception $e ) {

	    $snapshotDAO->rollBack();
	    return false;
	}
    }
    
    
    /**
     *
     * @return boolean 
     */
    public function saveAccessMarket()
    {
	$snapshotDAO = new Model_DAO_Snapshot();

	$snapshotDAO->beginTransaction();
	try {
	    
	    $snapshotKeyDAO = new Model_DAO_SnapshotKey();
	    $snapshotkeyVO = new Model_VO_SnapshotKey();
	    
	    $snapshotKeyDAO->delete( array( 'fk_id_snapshot' => $this->_data['id_snapshot'], 'step' => 3 ) );
	    
	    $keys = $this->_parseKeys( $this->_data['key'] );
	    
	    $snapshotkeyVO->setFkIdSnapshot( $this->_data['id_snapshot'] );
	    $snapshotkeyVO->setStep( 3 );
	    
	    foreach ( $keys as $key => $value ) {
		
		$vo = clone $snapshotkeyVO;
		$vo->setIdentifier( $key );
		$vo->setValue( $value );
		
		$snapshotKeyDAO->insert( $vo );
	    }
	    
	    $snapshotMarketDAO = new Model_DAO_SnapshotMarket();
	    $snapshotMarketVO = new Model_VO_SnapshotMarket();
	    
	    $snapshotMarketDAO->delete( array( 'fk_id_snapshot' => $this->_data['id_snapshot'] ) );
	    
	    $snapshotMarketVO->setFkIdSnapshot( $this->_data['id_snapshot'] );
	    if ( !empty( $this->_data['market_location'] ) ) {
		foreach ( $this->_data['market_location'] as $key => $market ) {

		    $vo = clone $snapshotMarketVO;
		    $vo->setPlace( $market );
		    $vo->setDaysWeek( $this->_data['days_week'][$key] );
		    $vo->setWetSeasonMotor( $this->_data['wet_season_motor'][$key] );
		    $vo->setDrySeasonMotor( $this->_data['dry_season_motor'][$key] );
		    $vo->setWetSeasonWalk( $this->_data['wet_season_walk'][$key] );
		    $vo->setDrySeasonWalk( $this->_data['dry_season_walk'][$key] );
		    $vo->setDrySeasonWalk( $this->_data['dry_season_walk'][$key] );
		    $vo->setTravelCostMotor( $this->_data['travel_cost_motor'][$key] );
		    $vo->setTravelCostWalk( $this->_data['travel_cost_walk'][$key] );

		    $snapshotMarketDAO->insert( $vo );
		}
	    }

	    // Salva auditoria
	    $description = 'REJISTU/ATUALIZA SNAPSHOT BASELINE: ' . $this->_data['id_snapshot'] . ' BA HAKAT 4 – ACCESS TO MARKET';
	    $this->audit( $description, self::SALVAR );

	    $snapshotDAO->commit();
	    return $this->_data['id_snapshot'];
	    
	} catch ( Exception $e ) {

	    $snapshotDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @return boolean 
     */
    public function saveAccessEducation()
    {
	$snapshotDAO = new Model_DAO_Snapshot();

	$snapshotDAO->beginTransaction();
	try {
	    
	    $snapshotKeyDAO = new Model_DAO_SnapshotKey();
	    $snapshotkeyVO = new Model_VO_SnapshotKey();
	    
	    $snapshotKeyDAO->delete( array( 'fk_id_snapshot' => $this->_data['id_snapshot'], 'step' => 4 ) );
	    
	    $keys = $this->_parseKeys( $this->_data['key'] );
	    
	    $snapshotkeyVO->setFkIdSnapshot( $this->_data['id_snapshot'] );
	    $snapshotkeyVO->setStep( 4 );
	    
	    foreach ( $keys as $key => $value ) {
		
		$vo = clone $snapshotkeyVO;
		$vo->setIdentifier( $key );
		$vo->setValue( $value );
		
		$snapshotKeyDAO->insert( $vo );
	    }

	    // Salva auditoria
	    $description = 'REJISTU/ATUALIZA SNAPSHOT BASELINE: ' . $this->_data['id_snapshot'] . ' BA HAKAT 5 – ACCESS-EDUCATION';
	    $this->audit( $description, self::SALVAR );

	    $snapshotDAO->commit();
	    return $this->_data['id_snapshot'];
	    
	} catch ( Exception $e ) {

	    $snapshotDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @return boolean 
     */
    public function saveAccessHealth()
    {
	$snapshotDAO = new Model_DAO_Snapshot();

	$snapshotDAO->beginTransaction();
	try {
	    
	    $snapshotKeyDAO = new Model_DAO_SnapshotKey();
	    $snapshotkeyVO = new Model_VO_SnapshotKey();
	    
	    $snapshotKeyDAO->delete( array( 'fk_id_snapshot' => $this->_data['id_snapshot'], 'step' => 5 ) );
	    
	    $keys = $this->_parseKeys( $this->_data['key'] );
	    
	    $snapshotkeyVO->setFkIdSnapshot( $this->_data['id_snapshot'] );
	    $snapshotkeyVO->setStep( 5 );
	    
	    foreach ( $keys as $key => $value ) {
		
		$vo = clone $snapshotkeyVO;
		$vo->setIdentifier( $key );
		$vo->setValue( $value );
		
		$snapshotKeyDAO->insert( $vo );
	    }

	    // Salva auditoria
	    $description = 'REJISTU/ATUALIZA SNAPSHOT BASELINE: ' . $this->_data['id_snapshot'] . ' BA HAKAT 6 – ACCESS-HEALTH';
	    $this->audit( $description, self::SALVAR );

	    $snapshotDAO->commit();
	    return $this->_data['id_snapshot'];
	    
	} catch ( Exception $e ) {

	    $snapshotDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @param array $keys
     * @return array
     */
    protected function _parseKeys( $keys )
    {
	$finalKeys = array();
	foreach ( $keys as $k => $value )
	    $finalKeys[$k] = trim( $value );
	
	return $finalKeys;
    }
    
    /**
     *
     * @param int $id 
     */
    protected function _createFolderImages( $id )
    {
	$dirBase = 'public/images/snapshot/';
	if ( !is_dir( $dirBase ) )
	    mkdir ( $dirBase );
	
	$dirSnapshot = $dirBase . md5( $id );
	if ( !is_dir( $dirSnapshot ) )
	    mkdir( $dirSnapshot );
    }
    
    /**
     *
     * @param type $id
     * @return type 
     */
    public function listImages( $id )
    {
	$data = array( 
	    'total' =>	0,
	    'itens' =>	array()
	);
	
	$this->_createFolderImages( $id );
	
	$dirBase = 'public/images/snapshot/' . md5( $id );
	
	$iterator = new DirectoryIterator( $dirBase );
	foreach ( $iterator as $fileinfo ) {
	    
	    if ( !$fileinfo->isDot() && $fileinfo->isFile() ) {
	
		$size = $fileinfo->getSize();
		
		$data['itens'][] = array(
		    'name'  =>	BASE . '/' . $dirBase . '/' . $fileinfo->getFilename(),
		    'size'  => ILO_Util_ByteSize::calculator( $size )
		);
		
		$data['total'] += $size;
	    }
	}
	
	$data['total'] = ILO_Util_ByteSize::calculator( $data['total'] );
	
	return $data;
    }
    
    /**
     *
     * @return boolean 
     */
    public function saveImages()
    {
	try {
	    
	    $dirBase = 'public/images/snapshot/' . md5( $this->_data['id_snapshot'] );
	    
	    $images = $_FILES['image'];
	    
	    $valid = false;
	    foreach ( $images['name'] as $key => $value ) {
		
		if ( $images['error'][$key] > 0 )
		    continue;
		
		if ( !preg_match( '/(jpe?g|gif|png)$/i', $images['type'][$key] ) ) {
		 
		    $this->setError( ILO_Util_Translate::get( 'Somente imagens são permitidas', 630 ) );
		    continue;
		}
		
		$new = $dirBase . DIRECTORY_SEPARATOR .  md5( uniqid( time() ) );
		$splFileInfo = new SplFileInfo( $value );
		$new .= '.' . $splFileInfo->getExtension();
		
		if ( move_uploaded_file( $images['tmp_name'][$key], $new ) )
		    $valid = true;
	    }
	    
	    if ( $valid ) {
		
		 // Salva auditoria
		$description = 'REJISTU IMAGE SNAPSHOT: ' . $this->_data['id_snapshot'] . ' BA HAKAT 3';
		$this->audit( $description, self::SALVAR );
	    }
	    
	    return $valid;
	    
        } catch ( Exception $e ) {
	    return false;
	}
    }
    
    /**
     *
     * @return array 
     */
    public function removeImage()
    {
	$return = array( 'status' => false );
	try {
	    
	    $image = $this->_data['image'];
	    $imagePath = trim( str_replace( BASE, '', $image  ), '/' );
	    
	    if ( file_exists( $imagePath ) )
		unlink( $imagePath );
	    
	    $return['status'] = true;
	    
	    return $return;
	} catch ( Exception $e ) {
	    return $return;
	}
    }
    
     /**
     *
     * @return array 
     */
    public function removeDocument()
    {
	$return = array( 'status' => false );
	try {
	    
	    $document = $this->_data['document'];
	    $documentPath = trim( str_replace( BASE, '', $document  ), '/' );
	    
	    if ( file_exists( $documentPath ) )
		unlink( $documentPath );
	    
	    $return['status'] = true;
	    
	    return $return;
	} catch ( Exception $e ) {
	    return $return;
	}
    }
    
    /**
     *
     * @return boolean 
     */
    public function saveDocument()
    {
	try {
	    
	    $document = $_FILES['document'];
	    
	    if ( $document['error'] > 0 ) {
		
		$this->setError( ILO_Util_Translate::get( 'Erro ao fazer upload de arquivo', 631 ) );
		return false;
	    }
		
	    if ( !preg_match( '/pdf$/i', $document['type'] ) ) {

		$this->setError( ILO_Util_Translate::get( 'Somente arquivo PDF é permitido', 632 ) );
		return false;
	    }
	    
	    $dirBase = 'public/snapshot/';
	    if ( !is_dir( $dirBase ) )
		mkdir( $dirBase );
	    
	    $dirBase .= md5( $this->_data['id_snapshot'] ) . '/';
	    if ( !is_dir( $dirBase ) )
		mkdir( $dirBase );
	    
	    $fileName = ILO_Util_Geral::nameFile( $document['name'], 'pdf' );
	    
	    $file = $dirBase . $fileName;
	    if ( !move_uploaded_file( $document['tmp_name'], $file ) )
		return false;
	    
	     // Salva auditoria
	    $description = 'INSERE DOCUMENTO SNAPSHOT: ' . $this->_data['id_snapshot'] . ' BA HAKAT 4';
	    $this->audit( $description, self::SALVAR );
	    
	    return true;
	    
        } catch ( Exception $e ) {
	    return false;
	}
    }
    
    /**
     *
     * @return array
     */
    public function detalhaDocumento()
    {
	$return = array( 'status' => false );
	try {
	    
	    $dirBase = 'public/snapshot/';
	    if ( !is_dir( $dirBase ) )
		mkdir( $dirBase );
	    
	    $fileName = $dirBase . md5( $this->_data['id'] ) . '.pdf';
	    if ( !file_exists( $fileName ) )
		return $return;
	    
	    $return = array(
		'size'	  =>	ILO_Util_ByteSize::calculator( filesize( $fileName ) ),
		'path'	  =>	$fileName,
		'status'  =>	true
	    );
	    
	    return $return;
	    
	} catch ( Exception $e ) {
	    return $return;
	}
    }
    
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
    
    /**
     *
     * @return array 
     
    public function removeDocument()
    {
	$return = array( 'status' => false );
	try {
	    
	    $dirBase = 'public/snapshot/';
	    if ( !is_dir( $dirBase ) )
		mkdir( $dirBase );
	    
	    $fileName = $dirBase . md5( $this->_data['id'] ) . '.pdf';
	    
	    if ( file_exists( $fileName ) )
		unlink( $fileName );
	    
	     // Salva auditoria
	    $description = 'REMOVE DOCUMENTO SNAPSHOT: ' . $this->_data['id'] . ' BA HAKAT 4';
	    $this->audit( $description, self::SALVAR );
	    
	    $return['status'] = true;
	    
	    return $return;
	} catch ( Exception $e ) {
	    return $return;
	}
    } 
     */
    
    /*
     * 
     */
    public function saveIndicator()
    {
	$snapshotIndicatorDAO = new Model_DAO_SnapshotIndicator();

	$snapshotIndicatorDAO->beginTransaction();
	try {

	    $snapshotIndicatorVO = new Model_VO_SnapshotIndicator();
	    $snapshotIndicatorDAO = new Model_DAO_SnapshotIndicator();
	    
	    $where = array( 
		'fk_id_snapshot' => $this->_data['id_snapshot'],
		'type'		 => $this->_data['type']
	    );
	    $snapshotIndicatorDAO->delete( $where );
	    
	    $snapshotIndicatorVO->setValues( $this->_data );
	    $snapshotIndicatorVO->setFkIdSnapshot( $this->_data['id_snapshot'] );
	    
	    foreach ( $this->_data['indicator'] as $indicator => $value ) {
		
		$vo = clone $snapshotIndicatorVO;
		
		$vo->setIndicator( $indicator );
		$vo->setValue( $value );
		
		$snapshotIndicatorDAO->insert( $vo );
	    }
	    
	    // Salva auditoria
	    $description = sprintf( 'REJISTU/ATUALIZA SNAPSHOT INDICATOR: ' . $this->_data['id_snapshot'] . ' BA HAKAT %s', ( $this->_data['type'] + 5 ) );
	    $this->audit( $description, self::SALVAR );
	    
	    $snapshotIndicatorDAO->commit();
	    return true;
	    
	} catch ( Exception $e ) {

	    $snapshotIndicatorDAO->rollBack();
	    return false;
	}
    }
    
    /**
     *
     * @param int $id
     * @param int $step
     * @return array
     */
    public function getKeys( $id, $step )
    {
	$where = array(
	    'step'	     => $step,
	    'fk_id_snapshot' =>	$id
	);
	
	$snapshotKeyDAO = new Model_DAO_SnapshotKey();
	$keys = $snapshotKeyDAO->fetchAll( array(), $where );
	
	$data = array();
	if ( !empty( $keys ) ) {
	 
	    foreach ( $keys as $key )
		$data[$key->getIdentifier()] = $key->getValue();
	}
	
	return array( 'key' => $data );
    }
    
    /**
     *
     * @param int $id
     * @return array
     */
    public function getVillageData( $id )
    {
	$snapshotHasVillage = new Model_DAO_SnapshotHasVillage();
	$villages = $snapshotHasVillage->fetchAll( array(), array( 'fk_id_snapshot' => $id ) );
	
	$data = array();
	if ( !empty( $villages ) ) {
	    
	    foreach ( $villages as $village ) {

		$data[] = array(
		    'combo' => json_encode( $village->getFkIdVillage()->toArray() ),
		    'id'	=> $village->getFkIdVillage()->getIdVillage(),
		    'village'	=> $village->getFkIdVillage()->getVillageName(),
		    'code'	=> $village->getFkIdVillage()->getVillageCode(),
		    'total'	=> $village->getTotal(),
		    'men'	=> $village->getTotalMen(),
		    'women'	=> $village->getTotalWomen(),
		    'hh'	=> $village->getTotalHh()
		);
	    }
	}
	
	return $data;
    }
    
    /**
     *
     * @param int $id
     * @return array
     */
    public function getAccessMarketData( $id )
    {
	$snapshotMarket = new Model_DAO_SnapshotMarket();
	$rows = $snapshotMarket->fetchAll( array( 'id_snapshot_market' ), array( 'fk_id_snapshot' => $id ) );
	
	$data = array();
	if ( !empty( $rows ) ) {
	    
	    foreach ( $rows as $row )
		$data[] = $row->toArray();
	}
	
	return $data;
    }
    
    public function getIndicators( $id, $type )
    {
	$data = array();
	try {
	    
	    switch ( $type ) {
		case 1:
		    $data = $this->_loadMarketIndicators( $id );
		    break;
		case 2:
		    $data = $this->_loadEducationIndicators( $id );
		    break;
		case 3:
		    $data = $this->_loadHealthIndicators( $id );
		    break;
	    }
	    
	    $json = array();
	    foreach ( $data as $key => $value )
		$json[] = array( 'value' => $value, 'indicator' => $key );
	    
	    $data = $json;
	    
	} catch ( Exception $e ) {
	    
	}
	
	return $data;
    }
    
    protected function _loadHealthIndicators( $id )
    {
	$indicators = $this->getKeys($id, 5 );
	$keys = $indicators['key'];
	
	$data = array();
	switch ( @$keys['health_sisca'] ) {
	    case 'both':
		$data[] = 2;
		break;
	    case 'dry':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['health_medical'] ) {
	    case 'both':
		$data[] = 2;
		break;
	    case 'dry':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['health_emergency'] ) {
	    case 'both':
		$data[] = 2;
		break;
	    case 'dry':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['health_post_walk_wet'] ) {
	    case '<1h':
		$data[] = 2;
		break;
	    case '1-2h':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['health_post_motor_wet'] ) {
	    case '<1h':
		$data[] = 2;
		break;
	    case '1-2h':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['health_centre_walk_wet'] ) {
	    case '<1h':
		$data[] = 2;
		break;
	    case '1-2h':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['health_centre_motor_wet'] ) {
	    case '<1h':
		$data[] = 2;
		break;
	    case '1-2h':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['health_midwife_walk_wet'] ) {
	    case '<1h':
		$data[] = 2;
		break;
	    case '1-2h':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['health_midwife_motor_wet'] ) {
	    case '<1h':
		$data[] = 2;
		break;
	    case '1-2h':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	$indicators = $this->getKeys( $id, 2 );
	$keys = $indicators['key'];
	
	switch ( @$keys['births_assisted'] ) {
	    case '60-100':
		$data[] = 2;
		break;
	    case '40-59.9':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	return $data;
    }
    
    protected function _loadMarketIndicators( $id )
    {
	$indicators = $this->getKeys( $id, 3 );
	$keys = $indicators['key'];
	
	$data = array();
	
	switch ( true ) {
	    case !empty( $keys['road_vehicles_wet_all'] ):
		$data[] = 2;
		break;
	    case !empty( $keys['road_vehicles_wet_trucks'] ):
	    case !empty( $keys['road_vehicles_wet_4wd'] ):
	    case !empty( $keys['road_vehicles_wet_bikes'] ):
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['market_service'] ) {
	    case 'wet':
		$data[] = 2;
		break;
	    case 'dry':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['market_forhire'] ) {
	    case 'wet':
		$data[] = 2;
		break;
	    case 'dry':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['market_travel_motorised'] ) {
	    case 'many':
		$data[] = 2;
		break;
	    case 'some':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	$accessMarketData = $this->getAccessMarketData( $id );
	
	if ( empty( $accessMarketData ) ) {
	    
	    $data[] = 0;
	    $data[] = 0;
	    
	} else {
	    
	    $first = array_shift( $accessMarketData );
	    
	    
	    switch ( @$first['wet_season_walk'] ) {
		case '<1h':
		    $data[] = 2;
		break;
		case '1-2h':
		    $data[] = 1;
		    break;
		default:
		    $data[] = 0;
	    }
	    
	    switch ( @$first['wet_season_motor'] ) {
		case '<1h':
		    $data[] = 2;
		break;
		case '1-2h':
		    $data[] = 1;
		    break;
		default:
		    $data[] = 0;
	    }
	}
	
	switch ( @$keys['market_visiting_traders'] ) {
	    case 'both':
		$data[] = 2;
		break;
	    case 'dry':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	return $data;
    }
    
    protected function _loadEducationIndicators( $id )
    {
	$indicators = $this->getKeys( $id, 2 );
	$keys = $indicators['key'];
	
	$data = array();
	
	switch ( @$keys['primary_enrollments'] ) {
	    case '60-100':
		$data[] = 2;
		break;
	    case '40-59.9':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	$indicators = $this->getKeys( $id, 4 );
	$keys = $indicators['key'];
	
	switch ( @$keys['education_sd_travel_wet'] ) {
	    case '<1h':
		    $data[] = 2;
		break;
	    case '1-2h':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['education_smp_walk_travel_wet'] ) {
	    case '<1h':
		    $data[] = 2;
		break;
	    case '1-2h':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['education_smp_motor_travel_wet'] ) {
	    case '<1h':
		    $data[] = 2;
		break;
	    case '1-2h':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['education_smp_transport'] ) {
	    case 'many':
		    $data[] = 2;
		break;
	    case 'some':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['education_sma_walk_travel_wet'] ) {
	    case '<1h':
		    $data[] = 2;
		break;
	    case '1-2h':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['education_sma_motor_travel_wet'] ) {
	    case '<1h':
		    $data[] = 2;
		break;
	    case '1-2h':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	switch ( @$keys['education_sma_transport'] ) {
	    case 'many':
		    $data[] = 2;
		break;
	    case 'some':
		$data[] = 1;
		break;
	    default:
		$data[] = 0;
	}
	
	return $data;
    }
}