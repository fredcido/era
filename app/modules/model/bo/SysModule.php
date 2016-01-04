<?php

class Model_BO_SysModule extends ILO_Model_BO
{
    /**
     *
     * @var string 
     */
    protected $_auditDescription = 'REJISTU/ATUALIZA MODULO: %s';
    
    /**
     *
     * @return boolean 
     */
    public function save()
    {
	$sysModuleDAO = new Model_DAO_SysModule();
	$sysModuleVO = new Model_VO_SysModule();
	
	$sysModuleDAO->beginTransaction();

	try {
	    
	    $sysModuleVO->setValues( $this->_data );

	    if ( null == $sysModuleVO->getIdSysmodule() ) {
		
		$sysModuleId = $sysModuleDAO->insert( $sysModuleVO );
		$this->_auditModule( $sysModuleId );
		
	    } else {
		
		$sysModuleId = $sysModuleVO->getIdSysmodule();
		$sysModuleDAO->update( $sysModuleVO, array( 'id_sysmodule' => $sysModuleId ) );
		$this->_auditModule( $sysModuleId );
	    }
	    
	    $sysModuleDAO->commit();
	    return $sysModuleId;
	
	} catch ( Exception $e ) {
	    
	    $sysModuleDAO->rollBack();
	    return false;
	}
    }
    
     /**
      *
      * @param type $sysModuleId 
      */
    protected function _auditModule( $sysModuleId )
    {
	$description = sprintf( $this->_auditDescription, $sysModuleId );
	$this->audit( $description, self::SALVAR );
    }

}