<?php

class Model_BO_SysForm extends ILO_Model_BO
{
    
    /**
     *
     * @var string 
     */
    protected $_auditDescription = 'REJISTU/ATUALIZA FORMULARIO: %s';

    /**
     *
     * @return bool
     */
    public function save()
    {
	$sysFormDAO = new Model_DAO_SysForm();
	$sysFormVO = new Model_VO_SysForm();

	$sysFormVO->setValues( $this->_data );

	try {

	    $sysFormDAO->beginTransaction();

	    $formHasOperationDAO = new Model_DAO_SysFormHasOperation();
	    $formHasOperationVO = new Model_VO_SysFormHasOperation();

	    $arrayFormOperations = array();

	    if ( !empty( $this->_data['fk_id_sysoperation'] ) )
		$arrayFormOperations = $this->_data['fk_id_sysoperation'];

	    if ( null == $sysFormVO->getIdSysform() ) {

		$idForm = $sysFormDAO->insert( $sysFormVO );

		if ( !empty( $arrayFormOperations ) ) {

		    $dataSysHasOperation = array();

		    foreach ( $arrayFormOperations as $operation ) {

			$dataSysHasOperation = array(
			    'fk_id_sysform' => $idForm,
			    'fk_id_sysoperation' => $operation
			);

			$formHasOperationVO->setValues( $dataSysHasOperation );
			$formHasOperationDAO->insert( $formHasOperationVO );
		    }
		}
		
		$this->_auditForm( $idForm );

		$sysFormDAO->commit();

		return $idForm;
	    } else {

		$operatinsForm = $formHasOperationDAO->fetchAll( null, array('fk_id_sysform' => $sysFormVO->getIdSysform()) );

		$dadosOperationInserir = array();
		$arrayOperation = array();

		if ( !empty( $operatinsForm ) ) {

		    foreach ( $operatinsForm as $operation ) {

			$arrayOperation[] = $operation->getFkIdSysoperation()->getIdSysoperation();
		    }
		}
		
		//dados que estao na tela e nao esta no banco
		$dadosOperationInserir = array_diff( $arrayFormOperations, $arrayOperation );

		//dados que estao no banco e nao estao na tela
		$dadosOperationDelete = array_diff( $arrayOperation, $arrayFormOperations );

		if ( !empty( $dadosOperationInserir ) ) {

		    foreach ( $dadosOperationInserir as $operationInserir ) {

			$dataSysHasOperation = array(
			    'fk_id_sysform' => $sysFormVO->getIdSysform(),
			    'fk_id_sysoperation' => $operationInserir
			);

			$formHasOperationVO->setValues( $dataSysHasOperation );
			$formHasOperationDAO->insert( $formHasOperationVO );
		    }
		}

		if ( !empty( $dadosOperationDelete ) ) {

		    foreach ( $dadosOperationDelete as $operationDelete ) {

			//deleta na tabela sys_form_has_operation
			$formHasOperationDAO->delete( array(
			    'fk_id_sysform' => $sysFormVO->getIdSysform(),
			    'fk_id_sysoperation' => $operationDelete
				)
			);

			//deleta na tabela sys_user_has_form
			$userHasFormDAO = new Model_DAO_SysUserHasForm();
			$userHasFormDAO->delete( array(
			    'fk_id_sysform' => $sysFormVO->getIdSysform(),
			    'fk_id_sysoperation' => $operationDelete
			) );
		    }
		}
		
		// Auditoria
		$this->_auditForm( $sysFormVO->getIdSysform() );

		$sysFormDAO->commit();

		return $sysFormDAO->update( $sysFormVO, array( 'id_sysform' => $sysFormVO->getIdSysform() ) );
	    }
	} catch ( Exception $e ) {

	    $sysFormDAO->rollBack();
	}
    }
    
    /**
     *
     * @param type $sysFormId 
     */
    protected function _auditForm( $sysFormId )
    {
	$description = sprintf( $this->_auditDescription, $sysFormId );
	$this->audit( $description, self::SALVAR );
    }
}