<?php

class Admin_Controller_Auditoria extends ILO_Controller_Padrao
{
    public function init()
    {
    }
    
    /**
     * 
     */
    public function indexAction()
    {
	$sysAuditDAO = new Model_DAO_SysAudit();
	$auditorias = $sysAuditDAO->fetchAll( array( 'date_time DESC' ) );
	
	$dataJson['rows'] = array();
        
        if ( !empty( $auditorias ) ) {

            foreach ( $auditorias as $key => $auditoria ) {
                
                $dataJson['rows'][] = array(
                   'id'     => $auditoria->getIdSysaudit(),
                    'data'  => array(
                        ++$key,
                        $auditoria->getFkIdSysmodule()->getModule(),
                        $auditoria->getFkIdSysform()->getFormName(),
                        $auditoria->getFkIdSysoperation()->getOperation(),
                        $auditoria->getFkIdSysuser()->getName(),
                        $auditoria->getDescription(),
                        ILO_Util_Geral::dateTimeToBr( $auditoria->getDateTime() )
                    )
                );
            }
        }
	
	$this->view->data = json_encode( $dataJson );
    }
}