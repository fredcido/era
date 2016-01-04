<?php

class Model_BO_EnterpriseReport extends ILO_Model_BO
{
    /**
     *
     * @var Model_DAO_EnterpriseReport 
     */
    protected $_dao;
    
    /**
     * 
     */
    public function __construct()
    {
	$this->_dao = new Model_DAO_EnterpriseReport();
    }
    
    /**
     *
     * @return array
     */
    public function porDistrito()
    {
	$rows = $this->_dao->porDistrito( $this->_data );
	
	$data = array(
	    'rows'  => array(),
	    'total' => 0,
	    'graph' => array()
	);
	
	foreach ( $rows as $row ) {
	    
	    $data['rows'][] = $row;
	    $data['total'] += (int)$row['total'];
	}
	
	foreach ( $data['rows'] as $key => $value ) {
	    
	    $percent = round( ( 100 * $value['total'] ) / $data['total'], 2 );
	    $data['rows'][$key]['perc'] = $percent; 
	    $data['graph'][] = array( $value['district'], (float)$percent );
	}
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function volumeNegocio()
    {
	$rows = $this->_dao->volumeNegocio( $this->_data );
	
	$volume = array(
	    'mikro' => 0,
	    'kiik'  => 0,
	    'medio' => 0,
	    'boot'  => 0
	);
	
	$data = array(
	    'rows'  => array(),
	    'total' => $volume,
	    'perce' => $volume,
	    'graph' => array()
	);
	
	foreach ( $rows as $row ) {
	    
	    // Se ainda nao tiver o distrito
	    if ( empty( $data['rows'][ $row['id_add_district'] ] ) ) {
		
		$data['rows'][ $row['id_add_district'] ] = $volume;
		$data['rows'][ $row['id_add_district'] ]['distrito'] = $row['district'];
	    }
	    
	    $row['size_business'] = trim( $row['size_business'] );
	    
	    switch ( true ) {
		case preg_match( '/mikro/i', $row['size_business'] ):
			$data['rows'][ $row['id_add_district'] ]['mikro']++;
			$data['total']['mikro']++;
		    break;
		case preg_match( '/kiik/i', $row['size_business'] ):
			$data['rows'][ $row['id_add_district'] ]['kiik']++;
			$data['total']['kiik']++;
		    break;
		case preg_match( '/medio/i', $row['size_business'] ):
			$data['rows'][ $row['id_add_district'] ]['medio']++;
			$data['total']['medio']++;
		    break;
		case preg_match( '/^bo/i', $row['size_business'] ):
			$data['rows'][ $row['id_add_district'] ]['boot']++;
			$data['total']['boot']++;
		    break;
	    }
	}
	
	foreach ( $data['total'] as $nivel => $value ) {
	    
	    $percent = round( ( 100 * $value ) / count( $rows ), 2 );
	    $data['perce'][ $nivel ] = $percent;
	    $data['graph'][] = array( ucfirst( $nivel ), $percent );
	}
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function generoDiretor()
    {
	$rows = $this->_dao->generoDiretor( $this->_data );
	
	$distritos = array();
	foreach ( $rows as $row )
	    $distritos[$row['district']][ trim( $row['owner_gender'] ) ] = $row['total'];
	
	$data = array(
	    'rows'	=> array(),
	    'total_homens'		=> 0,
	    'total_homens_porcent'	=> 0,
	    'total_mulheres'		=> 0,
	    'total_mulheres_porcent'	=> 0,
	    'total'			=> 0,
	    'graph_pie'			=>  array(),
	    'graph_bar'			=>  array(
		'distritos' => array(),
		'mane'	    => array(),
		'feto'	    => array()
	    )
	);
	
	foreach ( $distritos as $key => $row ) {
	    
	    $row['homens'] = empty( $row['M'] ) ? 0 : (int)$row['M'];
	    $row['mulheres'] = empty( $row['F'] ) ? 0 : (int)$row['F'];
	    $total = $row['homens'] + $row['mulheres'];
	    $percentWoman = round( ( 100 * $row['mulheres'] ) / $total, 2 );
	    $percentMan = round( ( 100 * $row['homens'] ) / $total, 2 );
	    
	    $data['rows'][] = array(
				'distrito'		  =>  $key,
				'total'			  =>  $total,
				'total_homens'		  =>  $row['homens'],
				'total_homens_porcent'	  =>  $percentMan,
				'total_mulheres'	  =>  $row['mulheres'],
				'total_mulheres_porcent'  =>  $percentWoman
			    );
	    
	    $data['total'] += $total;
	    $data['total_homens'] += $row['homens'];
	    $data['total_mulheres'] += $row['mulheres'];
	}
	
	
	foreach ( $data['rows'] as $key => $value ) {
	    
	    $percent = round( ( 100 * $value['total'] ) / $data['total'], 2 );
	    
	    $data['rows'][$key]['total_porcent'] = $percent;
	    
	    $data['graph_bar']['distritos'][] = $value['distrito'];
	    $data['graph_bar']['mane'][] = $value['total_homens'];
	    $data['graph_bar']['feto'][] = $value['total_mulheres'];
	}
	
	if ( !empty( $data['total'] ) ) {
	    
	    $data['total_homens_porcent'] = round( ( 100 * $data['total_homens'] ) / $data['total'], 2 );
	    $data['total_mulheres_porcent'] = round( ( 100 * $data['total_mulheres'] ) / $data['total'], 2 );
	}
	
	$data['graph_pie'][] = array( 'Mane', $data['total_homens_porcent'] );
	$data['graph_pie'][] = array( 'Feto', $data['total_mulheres_porcent'] );
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function setor()
    {
	$rows = $this->_dao->setor( $this->_data );
	
	$data = array(
	    'rows'  => $rows
	);
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function listaEmpresa()
    {
	$rows = $this->_dao->listaEmpresa( $this->_data );
	
	$data = array();
	foreach ( $rows as $row ) {
	    
	    $dataInicial = ILO_Util_Geral::dateTimeToBr( $row['date_registration'], false );
	    
	    if ( !array_key_exists( $dataInicial, $data ) ) {
		
		$data[ $dataInicial ] = array(
		    'total' => 0,
		    'rows'  => array()
		);
	    }
	    
	    if ( !array_key_exists( $row['id_enterprise'], $data[ $dataInicial ]['rows'] ) ) {
		
		$numTurma = array(
		    $row['num_district'],
		    $row['num_year'],
		    $row['num_sequence']
		);

		$data[ $dataInicial ]['rows'][ $row['id_enterprise'] ] = array(
		    'numero_empresa'	=>  implode( '-', $numTurma ),
		    'enterprise_name'	=>  $row['enterprise_name'],
		    'owner_name'	=>  $row['owner_name'],
		    'main_phone'	=>  $row['main_phone'],
		    'iade_client'	=>  $row['iade_client'],
		    'setores'		=>  array()
		);
	    }
	    
	    if ( !in_array( $row['name_sector'], $data[ $dataInicial ]['rows'][ $row['id_enterprise'] ]['setores'] ) ) {
		
		$data[ $dataInicial ]['rows'][ $row['id_enterprise'] ]['setores'][] = $row['name_sector'];
		$data[ $dataInicial ]['total']++;
	    }
	}
	
	return $data;
    }
}