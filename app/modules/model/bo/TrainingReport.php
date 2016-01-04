<?php

class Model_BO_TrainingReport extends ILO_Model_BO
{
    /**
     *
     * @var Model_DAO_TrainingReport 
     */
    protected $_dao;
    
    const FINAL_GRADE = 5;
    
    const PRESENT_PERCENT = 75;
    
    /**
     * 
     */
    public function __construct()
    {
	$this->_dao = new Model_DAO_TrainingReport();
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
    public function evolucao()
    {
	$rows = $this->_dao->evolucao( $this->_data );
	
	$data = array(
	    'rows'  => array(),
	    'perc'  => array(),
	    'graph' => array()
	);
	
	$total = 0;
	foreach ( $rows as $row ) {
	    
	    $data['graph'][] = array( $row['level_evaluation'], $row['total'] );
	    $data['rows'][$row['level_evaluation']] = $row['total'];
	    $total += (int)$row['total'];
	}
	
	foreach ( $data['rows'] as $level => $value )
	    $data['perc'][$level] = round( ( 100 * $value ) / $total, 2 ); 
	
	$data['rows']['TOTAL'] = $total;
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function atividadesTreinador()
    {
	$rows = $this->_dao->atividadesTreinador( $this->_data );
	
	$treinadores = array();
	foreach ( $rows as $row )
	    $treinadores[$row['name_trainer']][ trim( $row['trainer_type'] ) ] = $row['total'];
	
	$data = array(
	    'rows'		=> array(),
	    'total_assistente'  => 0,
	    'total_principal'	=> 0,
	    'total'		=> 0
	);
	
	foreach ( $treinadores as $trainer => $row ) {
	    
	    $row['ASSIS'] = empty( $row['ASSIS'] ) ? 0 : (int)$row['ASSIS'];
	    $row['MAIN'] = empty( $row['MAIN'] ) ? 0 : (int)$row['MAIN'];
	    
	    $data['total_assistente'] += (int)$row['ASSIS'];
	    $data['total_principal'] += (int)$row['MAIN'];
	    
	    $total = $row['ASSIS'] + $row['MAIN'];
	    
	    $data['rows'][] = array(
		'total'		=> $total,
		'principal'	=> $row['MAIN'],
		'treinador'	=> $trainer,
		'assistente'	=> $row['ASSIS']
	    );
	    
	     $data['total'] += $total;
	}
	
	foreach ( $data['rows'] as $key => $value ) {
	    
	    $percent = round( ( 100 * $value['total'] ) / $data['total'], 2 );
	    $data['rows'][$key]['porcentagem'] = $percent; 
	}
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function participantesSexo()
    {
	$rows = $this->_dao->participantesSexo( $this->_data );
	
	
	$data = array(
	    'rows'	=> array(),
	    'total'	=> 0,
	    'graph'	=>  array()
	);
	
	foreach ( $rows as $row ) {
	    
	    $data['rows'][] = array(
				'sexo'	=>  $row['gender'],
				'total'	=>  $row['total']
			    );
	    
	    $data['total'] += (int)$row['total'];
	}

	foreach ( $data['rows'] as $key => $value ) {
	    
	    $percent = round( ( 100 * $value['total'] ) / $data['total'], 2 );
	    $data['rows'][$key]['porcentagem'] = $percent; 
	    $data['graph'][] = array( $value['sexo'], (float)$percent );
	}
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function participantesDistritoSexo()
    {
	$rows = $this->_dao->participantesDistritoSexo( $this->_data );
	
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
	    
	    $row['homens'] = empty( $row['Mane'] ) ? 0 : (int)$row['Mane'];
	    $row['mulheres'] = empty( $row['Feto'] ) ? 0 : (int)$row['Feto'];
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
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function curso()
    {
	$rows = $this->_dao->curso( $this->_data );
	
	$cursos = array();
	foreach ( $rows as $row )
	    $cursos[$row['course']][ trim( $row['gender'] ) ] = $row['total'];
	
	$data = array(
	    'rows'	=> array(),
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
	
	foreach ( $cursos as $key => $row ) {
	    
	    $row['homens'] = empty( $row['Mane'] ) ? 0 : (int)$row['Mane'];
	    $row['mulheres'] = empty( $row['Feto'] ) ? 0 : (int)$row['Feto'];
	    $total = $row['homens'] + $row['mulheres'];
	    $percentWoman = round( ( 100 * $row['mulheres'] ) / $total, 2 );
	    $percentMan = round( ( 100 * $row['homens'] ) / $total, 2 );
	    
	    $data['rows'][] = array(
				'curso'			  =>  $key,
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
	    $data['graph_pie'][] = array( $value['curso'], (float)$percent );
	    
	    $data['graph_bar']['cursos'][] = $value['curso'];
	    $data['graph_bar']['mane'][] = $value['total_homens'];
	    $data['graph_bar']['feto'][] = $value['total_mulheres'];
	}
	
	$data['total_homens_porcent'] = round( ( 100 * $data['total_homens'] ) / $data['total'], 2 );
	$data['total_mulheres_porcent'] = round( ( 100 * $data['total_mulheres'] ) / $data['total'], 2 );
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function participanteGrupoIdade()
    {
	$rows = $this->_dao->participanteGrupoIdade( $this->_data );
	
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
			$grupos['15 - 24'][ trim( $row['gender'] ) ]++;
		    break;
		case $row['idade'] >= 25 && $row['idade'] <= 39:
			$grupos['25 - 39'][ trim( $row['gender'] ) ]++;
		    break;
		case $row['idade'] >= 40 && $row['idade'] <= 54:
			$grupos['40 - 54'][ trim( $row['gender'] ) ]++;
		    break;
		case $row['idade'] >= 55:
			$grupos['55+'][ trim( $row['gender'] ) ]++;
		    break;
	    }
	}
	
	foreach ( $grupos as $key => $row ) {
	    
	    $row['homens'] = empty( $row['Mane'] ) ? 0 : (int)$row['Mane'];
	    $row['mulheres'] = empty( $row['Feto'] ) ? 0 : (int)$row['Feto'];
	    $total = $row['homens'] + $row['mulheres'];
	    $percentWoman = round( ( 100 * $row['mulheres'] ) / $total, 2 );
	    $percentMan = round( ( 100 * $row['homens'] ) / $total, 2 );
	    
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
		
	return $data;
    }
    
    /**
     *
     * @return array
     */
    /**
     *
     * @return array
     */
    public function participantesEducacao()
    {
	$rows = $this->_dao->participantesEducacao( $this->_data );
	
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
	    
	    $row['homens'] = empty( $row['Mane'] ) ? 0 : (int)$row['Mane'];
	    $row['mulheres'] = empty( $row['Feto'] ) ? 0 : (int)$row['Feto'];
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
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function desempenho()
    {
	$rows = $this->_dao->desempenho( $this->_data );
	
	$tests = array();
	foreach ( $rows as $row ) {
	 
	    $key = array(
		$row['id_student_class'],
		$row['fk_id_unit_competency'],
		$row['fk_id_client']
	    );
	    
	    $tests[ implode( '_', $key )][$row['type']] = $row['score'];
	}
	
	$items = array(
	    'melhorou'   => 0,
	    'manteve'	 => 0,
	    'piorou'	 => 0,
	    'total'	 => 0
	);
	
	foreach ( $tests as $id => $value ) {
	    
	    if ( empty( $value['POS'] ) )
		continue;
	    
	    $items['total']++;
	    
	    switch ( true ) {
		case $value['POS'] > $value['PRE']:
		    $items['melhorou']++;
		    break;
		
		case $value['POS'] < $value['PRE']:
		    $items['piorou']++;
		    break;
		
		default:
		    $items['manteve']++;
		    break;
	    }
	}
	
	$items['melhorou'] = round( ( 100 * $items['melhorou'] ) / $items['total'], 2 ); 
	$items['piorou'] = round( ( 100 * $items['piorou'] ) / $items['total'], 2 ); 
	$items['manteve'] = round( ( 100 * $items['manteve'] ) / $items['total'], 2 ); 
	
	return $items;
    }
    
    /**
     *
     * @return array
     */
    public function andamentoMes()
    {
	$rows = $this->_dao->andamentoMes( $this->_data );
	
	$meses = array();
	foreach ( $rows as $row )
	    $meses[$row['data']][ trim( $row['gender'] ) ] = $row['total'];
	
	$data = array(
	    'rows'	=> array(),
	    'total_homens'		=> 0,
	    'total_mulheres'		=> 0,
	    'total'			=> 0,
	    'graph_pie'			=>  array(),
	    'graph_bar'			=>  array(
		'mes'    => array(),
		'mane'	    => array(),
		'feto'	    => array()
	    ),
	    'graph_line'    => array()
	);
	
	foreach ( $meses as $key => $row ) {
	    
	    $row['homens'] = empty( $row['Mane'] ) ? 0 : (int)$row['Mane'];
	    $row['mulheres'] = empty( $row['Feto'] ) ? 0 : (int)$row['Feto'];
	    $total = $row['homens'] + $row['mulheres'];
	    
	    $data['rows'][] = array(
				'mes'			  =>  $key,
				'total_homens'		  =>  $row['homens'],
				'total_mulheres'	  =>  $row['mulheres'],
				'total'			  =>  $total
			    );
	    
	    $data['total'] += $total;
	    $data['total_homens'] += $row['homens'];
	    $data['total_mulheres'] += $row['mulheres'];
	}
	
	
	foreach ( $data['rows'] as $key => $value ) {
	    
	    $percent = round( ( 100 * $value['total'] ) / $data['total'], 2 );
	    
	    $data['rows'][$key]['total_porcent'] = $percent; 
	    $data['graph_pie'][] = array( $value['mes'], (float)$percent );
	    
	    $data['graph_line'][] = $value['total'];
	    $data['graph_bar']['mes'][] = $value['mes'];
	    $data['graph_bar']['mane'][] = $value['total_homens'];
	    $data['graph_bar']['feto'][] = $value['total_mulheres'];
	}
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function listaTreinamento()
    {
	$rows = $this->_dao->listaTreinamento( $this->_data );
	
	$data = array();
	foreach ( $rows as $row ) {
	    
	    $dataInicial = ILO_Util_Geral::dateToBr( $row['start_date'] );
	    
	    if ( !array_key_exists( $dataInicial, $data ) ) {
		
		$data[ $dataInicial ] = array(
		    'total' => 0,
		    'rows'  => array()
		);
	    }
	    
	    if ( !array_key_exists( $row['id_student_class'], $data[ $dataInicial ]['rows'] ) ) {
		
		$numTurma = array(
		    $row['num_course'],
		    $row['num_year'],
		    $row['num_title'],
		    $row['num_sequence']
		);

		$data[ $dataInicial ]['rows'][ $row['id_student_class'] ] = array(
		    'numero_turma'  =>	implode( '-', $numTurma ),
		    'course'	    =>	$row['course'],
		    'total_student' =>	$row['total_student'],
		    'name_trainer'  =>	$row['name_trainer'],
		    'active'	    =>	$row['active'],
		    'units'	    =>	array()
		);
	    }
	    
	    $data[ $dataInicial ]['total']++;
	    $data[ $dataInicial ]['rows'][ $row['id_student_class'] ]['units'][] = $row['name_unit'];
	}
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function reportTurmas()
    {
	$turmas = $this->_dao->listTurmas( $this->_data );
	
	$studentClassVO = new Model_VO_StudentClass();
	
	$turmaVo = array();
	foreach ( $turmas as $turma ) {
	    
	    $vo = clone $studentClassVO;
	    $vo->setValues( $turma );
	    
	    $turmaVo[] = $vo;
	}
	
	return $turmaVo;
    }
    
    /**
     *
     * @return int
     */
    public function reportNoParticipantes()
    {
	$rows = $this->_dao->participantesSexo( $this->_data );
	
	$total = 0;
	
	foreach ( $rows as $row )
	    $total += (int)$row['total'];
	
	return $total;
    }
    
    /**
     *
     * @return array
     */
    public function reportSexo()
    {
	$rows = $this->_dao->participantesSexo( $this->_data );
	
	$data = array(
	    'qtd_mulheres'	    => 0,
	    'qtd_mulheres_percent'  => 0,
	    'qtd_homens'	    => 0,
	    'qtd_homens_percent'    => 0,
	    'total'		    => 0,
	);
	
	foreach ( $rows as $row ) {
	    
	    switch ( $row['gender'] ) {
		case 'Feto':
			$data['qtd_mulheres'] = $row['total'];
		    break;
		case 'Mane':
			$data['qtd_homens'] = $row['total'];
		    break;
	    }
	    
	    $data['total'] += (int)$row['total'];
	}
	
	$data['qtd_mulheres_percent'] = round( ( 100 * $data['qtd_mulheres'] ) / $data['total'], 2 );
	$data['qtd_homens_percent'] = round( ( 100 * $data['qtd_homens'] ) / $data['total'], 2 );

	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function reportPassRate()
    {
	$rows = $this->_dao->listFinalAssessment( $this->_data );
	
	$data = array(
	    'passed'		=> 0,
	    'passed_percent'	=> 0,
	    'failed'		=> 0,
	    'failed_percent'	=> 0,
	    'total'		=> 0,
	);
	
	foreach ( $rows as &$row ) {
	    
	    $data['total']++;
	    
	    $row['score_final'] = round( ( $row['test_class'] * 0.6 ) + ( $row['practical'] * 0.4 ), 1 );
	    
	    if ( 
		 $row['score_final'] >= self::FINAL_GRADE &&
		 $row['present_percent'] > self::PRESENT_PERCENT &&
		 $row['present_percent_field'] > self::PRESENT_PERCENT
	    ) 
		$data['passed']++;
	    else
		$data['failed']++;
	}
	
	$data['passed_percent'] = round( ( 100 * $data['passed'] ) / $data['total'], 2 );
	$data['failed_percent'] = round( ( 100 * $data['failed'] ) / $data['total'], 2 );

	return $data;
    }
    
    public function reportGrupoIdade()
    {
	$rows = $this->_dao->participanteGrupoIdade( $this->_data );
	
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
	
	ksort($grupos);
	
	foreach ( $grupos as $key => $row ) {
	    
	    $row['homens'] = empty( $row['Mane'] ) ? 0 : (int)$row['Mane'];
	    $row['mulheres'] = empty( $row['Feto'] ) ? 0 : (int)$row['Feto'];
	    $total = $row['homens'] + $row['mulheres'];
	    $percentWoman = round( ( 100 * $row['mulheres'] ) / $total, 2 );
	    $percentMan = round( ( 100 * $row['homens'] ) / $total, 2 );
	    
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
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function reportParticipantesDistrito()
    {
	$rows = $this->_dao->participantesDistritoSexo( $this->_data );
	
	$data = array(
	    'total'	=> 0,
	    'distritos' => array()
	);
		
	$distritos = array();
	foreach ( $rows as $row ) {
	    
	    if ( !array_key_exists( $row['id_add_district'], $distritos ) ) {
		
		    $distritos[$row['id_add_district']] = array(
			'distrito' => $row['district'],
			'total'	   => 0
		    );
	    }
	    
	    $distritos[$row['id_add_district']]['total'] += (int)$row['total'];
	    
	    $data['total'] += (int)$row['total'];
	}
	
	$data['distritos'] = $distritos;
	
	return $data;
    }
    
    public function reportTreinadores()
    {
	$rows = $this->_dao->listTreinadores( $this->_data );
	
	$treinadores = array(
	    'rows'		=> array(),
	    'total_principal'	=> 0,
	    'total_assistente'	=> 0,
	    'total_geral'	=> 0
	);
	
	foreach ( $rows as $row ) {
	    
	    if ( !array_key_exists( $row['id_trainer'], $treinadores['rows'] ) ) {
		
		$treinadores['rows'][ $row['id_trainer'] ] = array(
		    'treinador'		=> $row['name_trainer'],
		    'total_principal'	=> 0,
		    'total_assistente'	=> 0,
		    'total_geral'	=> 0,
		    'total_percent'	=> 0,
		);
	    }
	    
	    switch ( $row['trainer_type'] ) {
		case 'ASSIS':
		    $treinadores['rows'][ $row['id_trainer'] ]['total_assistente']++;
		    $treinadores['total_assistente']++;
		    break;
		case 'MAIN':
		    $treinadores['rows'][ $row['id_trainer'] ]['total_principal']++;
		    $treinadores['total_principal']++;
		    break;
	    }
	    
	    $treinadores['rows'][ $row['id_trainer'] ]['total_geral']++;
	    $treinadores['total_geral']++;
	}
	
	foreach ( $treinadores['rows'] as $key => $treinador )
	    $treinadores['rows'][$key]['total_percent'] = round( ( 100 * $treinador['total_geral'] ) / $treinadores['total_geral'], 2 );
	
	return $treinadores;
    }
    
    /**
     *
     * @return type 
     */
    public function summaryReport()
    {
	$reportData = array();
	
	$this->_data['summary']['turmas'] = 1;
	
	foreach ( $this->_data['summary'] as $item => $value ) {
	    
	    $method = $this->toCamelCase( $item );
	    
	    $method = 'report' . $method;
	    
	    if ( method_exists( $this, $method ) )
		$reportData[$item] = call_user_func( array( $this, $method ) );
	}
	
	return $reportData;
    }
    
    /**
     *
     * @return array
     */
    public function detailedTurmas()
    {
	$data = $this->reportTurmas();
	return $data;
    }
    
    public function hasPassed( $rates )
    {
	$rates['score_final'] = $rates['test_class'];
	if ( !is_null($rates['practical']) )
	    $rates['score_final'] = round( ( $rates['test_class'] * 0.6 ) + ( $rates['practical'] * 0.4 ), 1 );

	return $rates['score_final'] >= self::FINAL_GRADE && $rates['present_percent'] > self::PRESENT_PERCENT && ( is_null($rates['present_percent_field']   ) || $rates['present_percent_field'] > self::PRESENT_PERCENT );
    }
    
    public function detailedPassRate()
    {
	$rows = $this->_dao->listFinalAssessment( $this->_data );
	
	$data = array(
	    'passed'		=> 0,
	    'passed_percent'	=> 0,
	    'failed'		=> 0,
	    'failed_percent'	=> 0,
	    'total'		=> 0,
	);
	
	$turmas = array();
	foreach ( $rows as $row ) {
	    
	    if ( !array_key_exists( $row['id_student_class'], $turmas ) )
		 $turmas[$row['id_student_class']] = $data;
	    
	    $turmas[$row['id_student_class']]['total']++;
	    
	    $row['score_final'] = round( ( $row['test_class'] * 0.6 ) + ( $row['practical'] * 0.4 ), 1 );
	    
	    if ( $this->hasPassed( $row ) ) 
		$turmas[$row['id_student_class']]['passed']++;
	    else
		$turmas[$row['id_student_class']]['failed']++;
	}
	
	$studentClassDAO = new Model_DAO_StudentClass();
	
	foreach ( $turmas as $key => $turma ) {
	    
	    $turmas[$key]['turma'] = $studentClassDAO->fetchRow( array( 'id_student_class' => $key ) );
	    $turmas[$key]['passed_percent'] = round( ( 100 * $turma['passed'] ) / $turma['total'], 2 );
	    $turmas[$key]['failed_percent'] = round( ( 100 * $turma['failed'] ) / $turma['total'], 2 );
	}
	
	return $turmas;
    }
    
    public function detailedNoParticipantes()
    {
	$data = $this->_dao->listTurmasParticipantes( $this->_data );
	
	$return = array(
	    'total'	=> 0,
	    'turmas'	=> array()
	);
	
	$studentClassDAO = new Model_DAO_StudentClass();
	
	foreach ( $data as $row ) {
	    
	    $turma = array(
		'participantes' => $row['participantes'],
		'turma'		=> $studentClassDAO->fetchRow( array( 'id_student_class' => $row['id_student_class'] ) )
	    );
	    
	    $return['turmas'][] = $turma;
	    $return['total'] += $row['participantes'];
	}
	
	return $return;
    }
    
    public function detailedNoParticipantesDistrito()
    {
	$data = $this->reportParticipantesDistrito();
	
	return array( 'participantes_distrito' => $data );
    }
    
    public function detailedGrupoIdade()
    {
	$data = $this->reportGrupoIdade();
	
	return array( 'grupo_idade' => $data );
    }
    
    public function detailedSexo()
    {
	$rows = $this->_dao->participantesTurmaSexo( $this->_data );
	
	$turmas = array();
	foreach ( $rows as $row )
	    $turmas[$row['id_student_class']][ trim( $row['gender'] ) ] = $row['total'];
	
	$data = array(
	    'rows'	=> array(),
	    'total_homens'		=> 0,
	    'total_homens_porcent'	=> 0,
	    'total_mulheres'		=> 0,
	    'total_mulheres_porcent'	=> 0,
	    'total'			=> 0,
	    'graph'			=>  array()
	);
	
	$studentClassDAO = new Model_DAO_StudentClass();
	
	foreach ( $turmas as $key => $row ) {
	    
	    $row['homens'] = empty( $row['Mane'] ) ? 0 : (int)$row['Mane'];
	    $row['mulheres'] = empty( $row['Feto'] ) ? 0 : (int)$row['Feto'];
	    $total = $row['homens'] + $row['mulheres'];
	    $percentWoman = round( ( 100 * $row['mulheres'] ) / $total, 2 );
	    $percentMan = round( ( 100 * $row['homens'] ) / $total, 2 );
	    
	    $data['rows'][] = array(
				'turma'			  =>  $studentClassDAO->fetchRow( array( 'id_student_class' => $key ) ),
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
	    $data['graph'][] = array( $value['turma']->getNumeroTurma(), (float)$percent );
	}
	
	$data['total_homens_porcent'] = round( ( 100 * $data['total_homens'] ) / $data['total'], 2 );
	$data['total_mulheres_porcent'] = round( ( 100 * $data['total_mulheres'] ) / $data['total'], 2 );
	
	return $data;
    }
    
    public function detailedEmpresaTreinamento()
    {
	$data = $this->reportEmpresaTreinamento();
	
	$total = 0;
	foreach ( $data as $row )
	    foreach ( $row['turmas'] as $turma )
		$total += count( $turma['enterprises'] );
	
	return array( 'empresa_treinamento' => $data, 'empresas' => $total );
    }
    
    public function detailedTreinadores()
    {
	$data = $this->atividadesTreinador();
	
	return $data;
    }

     /**
     *
     * @return array
     */
    public function detailedReport()
    {
	$method = $this->toCamelCase( $this->_data['detailed'] );
	    
	$method = 'detailed' . $method;
	
	$data = array();
	if ( method_exists( $this, $method ) )
	    $data = call_user_func( array( $this, $method ) );
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function listTurmas()
    {
	$turmas = $this->listaTreinamento();
	
	return $turmas;
    }
    
    /**
     *
     * @return array
     */
    public function listScore()
    {
	$rows = $this->_dao->listScoreClassRoom( $this->_data );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	
	$data = array();
	foreach ( $rows as $row ) {
	    
	    if ( !array_key_exists( $row['id_student_class'], $data ) ) {
		
		$data[ $row['id_student_class'] ] = array(
		    'turma'	=> $studentClassDAO->fetchRow( array( 'id_student_class' => $row['id_student_class'] ) ),
		    'empresas'	=> array(),
		    'total'	=> 0
		);
	    }
	    
	    if ( !array_key_exists( $row['enterprise_name'], $data[ $row['id_student_class'] ]['empresas'] ) )
		$data[ $row['id_student_class'] ]['empresas'][ $row['enterprise_name'] ] = array();
	    
	    $row['nome'] = $row['first_name'] . ' ' . $row['last_name'];
	    
	    $data[ $row['id_student_class'] ]['empresas'][ $row['enterprise_name'] ][] = $row;
	    $data[ $row['id_student_class'] ]['total']++;
	}
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function listAttendance()
    {
	$rows = $this->_dao->listAttendance( $this->_data );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	
	$data = array();
	foreach ( $rows as $row ) {
	    
	    if ( !array_key_exists( $row['id_student_class'], $data ) ) {
		
		$data[ $row['id_student_class'] ] = array(
		    'turma'	=> $studentClassDAO->fetchRow( array( 'id_student_class' => $row['id_student_class'] ) ),
		    'empresas'	=> array(),
		    'total'	=> 0
		);
	    }
	    
	    if ( !array_key_exists( $row['enterprise_name'], $data[ $row['id_student_class'] ]['empresas'] ) )
		$data[ $row['id_student_class'] ]['empresas'][ $row['enterprise_name'] ] = array();
	    
	    $row['nome'] = $row['first_name'] . ' ' . $row['last_name'];
	    
	    $data[ $row['id_student_class'] ]['empresas'][ $row['enterprise_name'] ][] = $row;
	    $data[ $row['id_student_class'] ]['total']++;
	}
	
	return $data;
    }
    
    public function listScorePratica()
    {
	$rows = $this->_dao->listScorePratica( $this->_data );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	
	$data = array();
	foreach ( $rows as $row ) {
	    
	    if ( !array_key_exists( $row['id_student_class'], $data ) ) {
		
		$data[ $row['id_student_class'] ] = array(
		    'turma'	=> $studentClassDAO->fetchRow( array( 'id_student_class' => $row['id_student_class'] ) ),
		    'empresas'	=> array(),
		    'total'	=> 0
		);
	    }
	    
	    if ( !array_key_exists( $row['enterprise_name'], $data[ $row['id_student_class'] ]['empresas'] ) )
		$data[ $row['id_student_class'] ]['empresas'][ $row['enterprise_name'] ] = array();
	    
	    $row['nome'] = $row['first_name'] . ' ' . $row['last_name'];
	    
	    $data[ $row['id_student_class'] ]['empresas'][ $row['enterprise_name'] ][] = $row;
	    $data[ $row['id_student_class'] ]['total']++;
	}
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function reportEmpresaTreinamento()
    {
	$rows = $this->_dao->listDistritosEmpresa( $this->_data );
	
	$data = array(
	    'total'	 => array(),
	    'supervisor' => 0,
	    'engineer'	 => 0
	);
	
	foreach ( $rows as $row ) {
	    
	    $data['total'][] = $row['id_enterprise'];
	    
	    if ( 'S' == $row['num_title'] )
		$data['supervisor']++;
	    else
		$data['engineer']++;
	}
	
	$data['total'] = count( array_unique( $data['total'] ) );
	
	return $data;
    }
    
    /**
     *
     * @return array
     */
    public function listEmpresa()
    {
	$rows = $this->_dao->listDistritosEmpresa( $this->_data );
	
	$data = array();
	foreach ( $rows as $row ) {
	    
	    if ( !array_key_exists( $row['id_add_district'], $data ) ) {
		
		$data[ $row['id_add_district'] ] = array(
		    'district'	    => $row['district'],
		    'turmas'	    => array()
		);
	    }
	    
	    if ( !array_key_exists( $row['turma_id'], $data[$row['id_add_district']]['turmas'] ) ) {
		
		$data[ $row['id_add_district'] ][ 'turmas' ][ $row['turma_id'] ] = array(
		    'turma'		=> $row['turma_id'],
		    'enterprises'	=> array()
		);
	    }
	    
	    $data[ $row['id_add_district'] ][ 'turmas' ][ $row['turma_id'] ]['enterprises'][ $row['id_enterprise'] ] = $row['enterprise_name'];
	}
	
	foreach ( $data as $key => $row ) {
	    
	    $data[$key]['rows'] = 0;
	    
	    foreach ( $row['turmas'] as $turma )
		$data[$key]['rows'] += count( $turma['enterprises'] );
	}
	
	return array( 'empresa_treinamento' => $data );
    }
    
    /**
     * 
     */
    public function listAssessment()
    {
	$rows = $this->_dao->listFinalAssessment( $this->_data );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	
	$data = array();
	foreach ( $rows as $row ) {
	    
	    if ( !array_key_exists( $row['id_student_class'], $data ) ) {
		
		$data[ $row['id_student_class'] ] = array(
		    'turma'	=> $studentClassDAO->fetchRow( array( 'id_student_class' => $row['id_student_class'] ) ),
		    'empresas'	=> array(),
		    'total'	=> 0
		);
	    }
	    
	    if ( !array_key_exists( $row['enterprise_name'], $data[ $row['id_student_class'] ]['empresas'] ) )
		$data[ $row['id_student_class'] ]['empresas'][ $row['enterprise_name'] ] = array();
	    
	    $row['nome'] = $row['first_name'] . ' ' . $row['last_name'];
	    
	    $row['score_final'] = $row['test_class'];
	    if ( !is_null($row['practical']) )
		$row['score_final'] = round( ( $row['test_class'] * 0.6 ) + ( $row['practical'] * 0.4 ), 1 );
	    
	    $row['pass'] = $this->hasPassed( $row ) ? 'Passed' : 'Fail';
	    
	    $data[ $row['id_student_class'] ]['empresas'][ $row['enterprise_name'] ][] = $row;
	    $data[ $row['id_student_class'] ]['total']++;
	}
	
	return $data;
    }
    
    public function listParticipantes()
    {
	$rows = $this->_dao->listFinalAssessment( $this->_data );
	
	$studentClassDAO = new Model_DAO_StudentClass();
	
	$data = array();
	foreach ( $rows as $row ) {
	    
	    if ( !array_key_exists( $row['id_student_class'], $data ) ) {
		
		$data[$row['id_student_class']] = array(
		    'turma' => $studentClassDAO->fetchRow( array( 'id_student_class' => $row['id_student_class'] ) ),
		    'participantes' => array()
		 );
	    }
	    
	    $row['nome'] = $row['first_name'] . ' ' . $row['last_name'];
	    
	    $data[$row['id_student_class']]['participantes'][] = $row;
	}
	
	return $data;
    }
    
    public function listFullCourse()
    {
	$rows = $this->_dao->listFullCourse( $this->_data );
	
	$data = new ArrayObject( array() );
	foreach ( $rows as $row )
	{
	    if ( !array_key_exists( $row['id_enterprise'], $data ) ) {
		
		$data[$row['id_enterprise']] = array(
		    'empresa'	=>  $row['enterprise_name'],
		    'turmas'	=> array()
		);
	    }
	    
	    $this->_setTurmaEmpresa( $data[$row['id_enterprise']]['turmas'], $row );
	    $this->_setClient( $data[$row['id_enterprise']]['turmas'], $row );
	}	
	
	$this->_organizaFullCourse( $data );
	
	return $data;
    }
    
    protected function _organizaFullCourse( &$data )
    {
	foreach ( $data as &$empresa ) {
	    
	    $empresa['rows'] = 0;
	    
	    foreach ( $empresa['turmas'] as $t => &$turma ) {
		
		$titles = array();
		foreach ( $turma as $c )
		    $titles[] = count( $c );
		
		$maior = max( $titles );
	
		$empresa['rows'] += $maior + 1;
		
		foreach ( $turma as $y => &$clients ) {
		    
		    $diff = $maior - count( $clients );
		    if ( $diff > 0 ) {
			for ( $i = 0; $i < $diff; $i++ )
			    $clients[] = '-';
		    }
		}
	    }
	}
    }
    
    /**
     *
     * @param array $data
     * @param array $row 
     */
    protected function _setClient( &$data, $row )
    {
	$class = implode( '_', array( $row['num_course'], $row['num_year'], $row['num_sequence'] ) );
	$data[$class][$row['num_title']][] = $row['complete_name'];
    }
    
    /**
     *
     * @param array $data
     * @param array $row 
     */
    protected function _setTurmaEmpresa( &$data, $row )
    {
	$types = array( 'E', 'S', 'D' );
	$class = implode( '_', array( $row['num_course'], $row['num_year'], $row['num_sequence'] ) );
	
	if ( !array_key_exists( $class, $data ) )
	    $data[$class] = array();
	
	foreach ( $types as $title ) {
	    
	    if ( !array_key_exists( $title, $data[$class] ) )
		$data[$class][$title] = array();
	}
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
}