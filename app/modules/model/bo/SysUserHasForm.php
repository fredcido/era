<?php

class Model_BO_SysUserHasForm extends ILO_Model_BO
{
    /**
     *
     * @var string 
     */
    protected $_auditDescription = 'REJISTU/ATUALIZA PERMISSAO: %s';
    
    /**
     *
     * @return mixed 
     */
    public function save()
    {
	$sysUserHasFormDAO = new Model_DAO_SysUserHasForm();
	$sysUserHasFormVO = new Model_VO_SysUserHasForm();
	
	$sysUserHasFormDAO->beginTransaction();
	try {
	
	    if ( !empty( $this->_data['inserir'] ) ) {

		$sysUserHasFormVO->setFkIdSysuser( $this->_data['usuario'] );
		$sysUserHasFormVO->setFkIdSysform( $this->_data['fk_id_sysform'] );
		$sysUserHasFormVO->setFkIdSysoperation( $this->_data['fk_id_sysoperation'] );

		$sysUserHasFormId = $sysUserHasFormDAO->insert( $sysUserHasFormVO );
	    } else {

		$where = array(
		    'fk_id_sysform'		=>  $this->_data['fk_id_sysform'],
		    'fk_id_sysoperation'	=>  $this->_data['fk_id_sysoperation'],
		    'fk_id_sysuser'		=>  $this->_data['usuario']
		);
		
		$sysUserHasFormDAO->delete( $where );
		
		$sysUserHasFormId = true;
	    }
	    
	    $sysUserHasFormDAO->commit();
	    return $sysUserHasFormId;
	    
	} catch ( Exception $e ) {
	    
	    $sysUserHasFormDAO->rollBack();
	    return false;
	}
    }

}