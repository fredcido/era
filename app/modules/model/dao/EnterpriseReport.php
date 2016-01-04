<?php

class Model_DAO_EnterpriseReport extends ILO_Model_DAO
{

    /**
     *
     * @param array $filters
     * @return array 
     */
    public function porDistrito( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	$sql = 'SELECT
		  d.district,
		  COUNT(1) AS total
		FROM enterprise e
		INNER JOIN add_district d ON
		  d.id_add_district = e.fk_id_add_district
		WHERE 1 = 1
		      %s
		GROUP BY d.id_add_district
		ORDER BY d.district';
	
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['dt_ini'] ) ) {
	    
	    $bindColumns[':dt_ini'] = ILO_Util_Geral::dateToBd( $filters['dt_ini'] );
	    $where .= ' AND DATE(e.date_registration) >= :dt_ini';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['dt_fim'] ) ) {
	    
	    $bindColumns[':dt_fim'] = ILO_Util_Geral::dateToBd( $filters['dt_fim'] );
	    $where .= ' AND DATE(e.date_registration) <= :dt_fim';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array
     */
    public function volumeNegocio( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT
		    d.id_add_district,
		    d.district,
		    e.size_business
		FROM enterprise e
		INNER JOIN add_district d ON
		    d.id_add_district = e.fk_id_add_district
		WHERE 1 = 1
		      %s
		ORDER BY d.district';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['dt_ini'] ) ) {
	    
	    $bindColumns[':dt_ini'] = ILO_Util_Geral::dateToBd( $filters['dt_ini'] );
	    $where .= ' AND DATE(e.date_registration) >= :dt_ini';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['dt_fim'] ) ) {
	    
	    $bindColumns[':dt_fim'] = ILO_Util_Geral::dateToBd( $filters['dt_fim'] );
	    $where .= ' AND DATE(e.date_registration) <= :dt_fim';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['fk_id_add_district'] ) ) {
	    
	    $bindColumns[':district'] = $filters['fk_id_add_district'];
	    $where .= ' AND e.fk_id_add_district = :district';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array
     */
    public function generoDiretor( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT
		    d.id_add_district,
		    d.district,
		    e.owner_gender,
		    COUNT(1) AS total
		FROM enterprise e
		INNER JOIN add_district d ON
		 d.id_add_district = e.fk_id_add_district
		WHERE 1 = 1
		      %s
		GROUP BY d.id_add_district, e.owner_gender';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['dt_ini'] ) ) {
	    
	    $bindColumns[':dt_ini'] = ILO_Util_Geral::dateToBd( $filters['dt_ini'] );
	    $where .= ' AND DATE(e.date_registration) >= :dt_ini';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['dt_fim'] ) ) {
	    
	    $bindColumns[':dt_fim'] = ILO_Util_Geral::dateToBd( $filters['dt_fim'] );
	    $where .= ' AND DATE(e.date_registration) <= :dt_fim';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['fk_id_add_district'] ) ) {
	    
	    $bindColumns[':district'] = $filters['fk_id_add_district'];
	    $where .= ' AND e.fk_id_add_district = :district';
	}
	
	$sql = sprintf( $sql, $where );
		
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array
     */
    public function setor( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	
	$sql = 'SELECT
		    es.name_sector,
		    COUNT(1) AS total
		FROM enterprise e
		INNER JOIN enterprise_has_sector_subsector ess ON
		ess.fk_id_enterprise = e.id_enterprise
		INNER JOIN enterprise_sector es ON
		es.id_sector = ess.fk_id_sector
		WHERE 1 = 1
		    %s
		GROUP BY es.id_sector';
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['dt_ini'] ) ) {
	    
	    $bindColumns[':dt_ini'] = ILO_Util_Geral::dateToBd( $filters['dt_ini'] );
	    $where .= ' AND DATE(e.date_registration) >= :dt_ini';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['dt_fim'] ) ) {
	    
	    $bindColumns[':dt_fim'] = ILO_Util_Geral::dateToBd( $filters['dt_fim'] );
	    $where .= ' AND DATE(e.date_registration) <= :dt_fim';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['fk_id_add_district'] ) ) {
	    
	    $bindColumns[':district'] = $filters['fk_id_add_district'];
	    $where .= ' AND e.fk_id_add_district = :district';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
    
    /**
     *
     * @param array $filters
     * @return array 
     */
    public function listaEmpresa( $filters = array() )
    {
	$bindColumns = array();
	$where = '';
	$sql = "SELECT
		    e.*,
		    es.name_sector
		FROM enterprise e
		INNER JOIN enterprise_has_sector_subsector ess ON
		    ess.fk_id_enterprise = e.id_enterprise
		INNER JOIN enterprise_sector es ON
		    es.id_sector = ess.fk_id_sector
		WHERE 1 = 1
		      %s
		ORDER BY e.date_registration";
	
	// se tiver filtro por data inicial
	if ( !empty( $filters['dt_ini'] ) ) {
	    
	    $bindColumns[':dt_ini'] = ILO_Util_Geral::dateToBd( $filters['dt_ini'] );
	    $where .= ' AND DATE(e.date_registration) >= :dt_ini';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['dt_fim'] ) ) {
	    
	    $bindColumns[':dt_fim'] = ILO_Util_Geral::dateToBd( $filters['dt_fim'] );
	    $where .= ' AND DATE(e.date_registration) <= :dt_fim';
	}
	
	// se tiver filtro por data final
	if ( !empty( $filters['fk_id_add_district'] ) ) {
	    
	    $bindColumns[':district'] = $filters['fk_id_add_district'];
	    $where .= ' AND e.fk_id_add_district = :district';
	}
	
	$sql = sprintf( $sql, $where );
	
	return $this->queryResult( $sql, $bindColumns );
    }
}