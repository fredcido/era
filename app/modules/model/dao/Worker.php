<?php

class Model_DAO_Worker extends ILO_Model_DAO
{

    protected $_table = 'worker';
    protected $_class = 'Model_VO_Worker';

    /**
     *
     * @return int
     */
    public function lastIdWorker()
    {
	$sql = 'SELECT MAX( id_worker ) id FROM ' . $this->getTable();
	$result = $this->queryResult( $sql );
	return empty( $result ) ? 0 : $result[0]['id'];
    }
    
    /**
     *
     * @param array $filters
     * @return array Model_VO_Worker 
     */
    public function listByFilters( array $filters = array() )
    {
	$sql = 'SELECT w.*
		FROM ' . $this->getTable() . ' w
		WHERE 1 = 1';
	
	$bind = array();
	
	// Filtra pelo primeiro nome
	if ( !empty( $filters['first_name'] ) ) {
	    
	    $sql .= ' AND w.first_name LIKE :first_name';
	    $bind[':first_name'] = '%' . $filters['first_name'] . '%';
	}
	
	// Filtra por sobrenome
	if ( !empty( $filters['last_name'] ) ) {
	    
	    $sql .= ' AND w.last_name LIKE :last_name';
	    $bind[':last_name'] = '%' . $filters['last_name'] . '%';
	}
	
	// Filtra por sobrenome
	if ( !empty( $filters['cod_beneficiario'] ) ) {
	    
	    $sql .= ' AND CONCAT( w.num_birthplace, "-", w.num_year, "-", w.id_worker ) = :cod_beneficiario';
	    $bind[':cod_beneficiario'] = $filters['cod_beneficiario'];
	}
	
	$result = $this->queryResult( $sql, $bind );
	
	if ( empty( $result ) )
	    return array();
	else {
	    
	    $vos = array();
	    foreach ( $result as $r ) {
		
		$vo = new Model_VO_Worker();
		$vo->setValues( $r );
		$vos[] = $vo;
	    }
	    
	    return $vos;
	}
    }
}