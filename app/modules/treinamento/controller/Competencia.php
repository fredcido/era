<?php

class Treinamento_Controller_Competencia extends ILO_Controller_Padrao
{  
    /**
     * 
     */
    public function init()
    {
    }
    
    /**
     * 
     */
    public function indexAction()
    {
	$unitCompetency = new Model_DAO_UnitCompetency();
	$units = $unitCompetency->fetchAll( array( 'name_unit' ) );
        
	$dataJson['rows'] = array();
        
        if ( !empty( $units ) ) {

            foreach ( $units as $key => $unit ) {
                
                $dataJson['rows'][] = array(
                   'id'     => $unit->getIdUnitCompetency(),
                    'data'  => array(
                        ++$key,
                        $unit->getNameUnit(),
                        $unit->getCodUnit(),
                    )
                );
            }
        }
	
	$this->view->data = json_encode( $dataJson );
    }
    
    
    public function saveAction()
    {
	$unitCompetencyBO = new Model_BO_UnitCompetency();
	$unitCompetencyBO->setData( $this->getParams() );

	$id = $unitCompetencyBO->save();
	if ( $id ) {
	    $retorno['error'] = false;
	    $retorno['id'] = $id;
	} else {
	    $retorno['error'] = true;
	    $retorno['msg'] = $unitCompetencyBO->getError();
	}

	echo json_encode( $retorno );
	exit;
    }
    
    public function cadastroAction()
    {
    }
    
    /**
     * 
     */
    public function editarAction()
    {
	$id = $this->getParam( 'id' );
	
	$unitCompetencyDAO = new Model_DAO_UnitCompetency();
	$unitCompetencyVO = $unitCompetencyDAO->fetchRow( array( 'id_unit_competency' => $id ) );
	
        $data = $unitCompetencyVO->toArray();
        
	$this->view->dadosForm = $data;
	$this->view->renderNewView( 'cadastro' );
    }
}