<?php

class Model_DAO_ContractReport extends ILO_Model_DAO
{

    /**
     *
     * @param int $id
     * @return array
     */
    public function getContractWorkersGender( $id )
    {
	$sql = 'SELECT
		    w.gender,
		    COUNT(1) total,
		    SUM( IFNULL( wp.total_days, 0 ) ) dias
		FROM contract c
		INNER JOIN contract_has_worker cw ON
		    cw.fk_id_contract = c.id_contract
		INNER JOIN worker w ON
		    w.id_worker = cw.fk_id_worker
		LEFT JOIN worker_has_payment whp ON
		    whp.fk_id_worker = w.id_worker
		LEFT JOIN worker_payment wp ON
		    wp.id_worker_payment = whp.fk_id_worker_payment
		WHERE c.id_contract = :id
		GROUP BY w.gender';
	
	return $this->queryResult( $sql, array( ':id' => $id ) );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function beneficiarioSexo( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT
		  c.id_contract,
		  w.gender,
		  COUNT(1) AS total
		FROM contract c
		INNER JOIN contract_has_worker chc ON
		   chc.fk_id_contract = c.id_contract
		INNER JOIN worker w ON
		  w.id_worker = chc.fk_id_worker
		WHERE 1 = 1
		      %s
		GROUP BY w.gender';
	
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND c.date_start_planned >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND c.date_finish_planned <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['contracts'] ) )
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function beneficiarioGrupoIdade( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	$sql = 'SELECT
		    TIMESTAMPDIFF(YEAR, w.date_birth, NOW()) idade,
		    w.gender
		FROM contract c
		INNER JOIN contract_has_worker chw ON
		    chw.fk_id_contract = c.id_contract
		INNER JOIN worker w ON
		    w.id_worker = chw.fk_id_worker
		WHERE 1 = 1
		      %s';
	
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND c.date_start_planned >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND c.date_finish_planned <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['contracts'] ) )
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function beneficiariosEducacao( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	$sql = 'SELECT
		    fsc.id_school_level,
		    fsc.school_level,
		    w.gender,
		    COUNT(1) AS total
		FROM contract c
		INNER JOIN contract_has_worker chw ON
		    chw.fk_id_contract = c.id_contract
		INNER JOIN worker w ON
		    w.id_worker = chw.fk_id_worker
		INNER JOIN formal_school_level fsc ON
		    fsc.id_school_level = w.fk_max_school_level
		WHERE 1 = 1
		      %s
		GROUP BY fsc.id_school_level, w.gender';
	
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND c.date_start_planned >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND c.date_finish_planned <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['contracts'] ) )
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function beneficiarioDistritoSexo( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT
		  d.id_add_district,
		  d.district,
		  w.gender,
		  COUNT(1) AS total
		FROM contract c
		INNER JOIN contract_has_worker chw ON
		    chw.fk_id_contract = c.id_contract
		INNER JOIN worker w ON
		    w.id_worker = chw.fk_id_worker
		INNER JOIN add_subdistrict sd ON
		   sd.id_add_subdistrict = w.fk_id_add_subdistrict
		INNER JOIN add_district d ON
		   d.id_add_district = sd.fk_id_add_district
		WHERE 1 = 1
		      %s
		GROUP BY d.id_add_district, w.gender';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND c.date_start_planned >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND c.date_finish_planned <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['contracts'] ) )
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function beneficiarioProfissao( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT
		  w.occupation,
		  w.gender,
		  COUNT(1) AS total
		FROM contract c
		INNER JOIN contract_has_worker chw ON
		    chw.fk_id_contract = c.id_contract
		INNER JOIN worker w ON
		    w.id_worker = chw.fk_id_worker
		WHERE 1 = 1
		      %s
		GROUP BY w.occupation, w.gender';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND c.date_start_planned >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND c.date_finish_planned <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['contracts'] ) )
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function beneficiarioEnderecoSexo( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT
		  d.id_add_district,
		  d.district,
		  w.gender,
		  COUNT(1) AS total
		FROM contract c
		INNER JOIN contract_has_worker chw ON
		    chw.fk_id_contract = c.id_contract
		INNER JOIN worker w ON
		    w.id_worker = chw.fk_id_worker
		INNER JOIN address_general ag ON
		   ag.fk_id_worker = w.id_worker
		INNER JOIN add_district d ON
		   d.id_add_district = ag.fk_id_add_district
		WHERE 1 = 1
		      %s
		GROUP BY d.id_add_district, w.gender';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND c.date_start_planned >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND c.date_finish_planned <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['contracts'] ) )
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function listPagamento( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT
		    c.id_contract,
		    w.id_worker,
		    w.first_name,
		    w.last_name,
		    wp.salary_day,
		    wp.total_days,
		    wp.total_salary
		FROM contract c
		INNER JOIN contract_has_worker chw ON
		    chw.fk_id_contract = c.id_contract
		INNER JOIN worker w ON
		    w.id_worker = chw.fk_id_worker
		INNER JOIN worker_has_payment whp ON
		    whp.fk_id_worker = w.id_worker
		INNER JOIN worker_payment wp ON
		    wp.id_worker_payment = whp.fk_id_worker_payment
		WHERE 1 = 1
		      %s
		ORDER BY w.id_worker, wp.salary_day';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['date_start'] ) ) {
	    
	    $bindColumns[':date_start'] = ILO_Util_Geral::dateToBd( $filters['date_start'] );
	    $where .= ' AND c.date_start_planned >= :date_start';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['date_finish'] ) ) {
	    
	    $bindColumns[':date_finish'] = ILO_Util_Geral::dateToBd( $filters['date_finish'] );
	    $where .= ' AND c.date_finish_planned <= :date_finish';
	}
	
	// se tiver filtro por turma ID
	if ( !empty( $filters['contracts'] ) )
	    $where .= $this->prepareIdFilter( $filters, $bindColumns );
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @param string $bind
     * @return string 
     */
    protected function prepareIdFilter( $filters, &$bind )
    {
	if ( empty( $filters['contracts'] ) )
	    return '';
	
	$contracts = (array)$filters['contracts'];
	
	return sprintf( ' AND c.id_contract IN(%s)', implode( ',', $contracts ) );
    }
}