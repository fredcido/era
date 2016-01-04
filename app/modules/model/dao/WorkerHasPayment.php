<?php

class Model_DAO_WorkerHasPayment extends ILO_Model_DAO
{

    protected $_table = 'worker_has_payment';
    protected $_class = 'Model_VO_WorkerHasPayment';

    /**
     *
     * @param array $data
     * @return boolean 
     */
    public function validaPagamentoBeneficiario( $data )
    {
	$sql = 'SELECT *
		FROM worker_payment wp
		INNER JOIN worker_has_payment whp ON
		    whp.fk_id_worker_payment = wp.id_worker_payment
		WHERE
		    whp.fk_id_worker = :worker
		    AND wp.date_payment = :date';
	
	$bind = array(
	    ':worker'	=> $data['id_worker'],
	    ':date'	=> ILO_Util_Geral::dateToBd( $data['date_payment'] )
	);
	
	$result = $this->queryResult( $sql, $bind );
	
	return empty( $result );
    }
}