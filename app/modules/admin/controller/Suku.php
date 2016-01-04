<?php

class Admin_Controller_Suku extends ILO_Controller_Padrao
{
    public function init()
    {
    
        
    }
    
    public function indexAction()
    {
        $sql = 'select d.district,c.subdistrict,b.suku, b.id_suku
                from add_suku b 
                inner join add_subdistrict c on (b.fk_id_add_subdistrict = c.id_add_subdistrict)
                inner join add_district d on (c.fk_id_add_district = d.id_add_district)
                order by d.district,c.subdistrict,b.suku';
        
        $addSukuDAO = new Model_DAO_AddSuku();
        $sukus = $addSukuDAO->queryResult($sql);
        
        $dataJson['rows'] = array();
        
        if( !empty( $sukus ) ){
            
            foreach ($sukus as $key => $suku){
                
                $dataJson['rows'][] = array(
                    'id'    => $suku['id_suku'],
                    'data'  => array(
                        ++$key,
                        $suku['district'],
                        $suku['subdistrict'],
                        $suku['suku'],
                    )
                );
            }
        }
        
        $this->view->data = json_encode($dataJson);
    }
    
    public function saveAction()
    {
        $sukuBO = new Model_BO_AddSuku();
        $sukuBO->setData( $this->getParams() );
        
       //var_dump($this->getParams());exit;
        
        if ( $sukuBO->save() ){
            $retorno['error'] = false;
        }else{
            $retorno['error'] = true;
            $retorno['msg'] = $sukuBO->getError();
        }
        
        if( empty( $retorno['error'] ) ){
            
            ILO_Util_Message::setMessage( ILO_Util_Translate::get( 'Operação realizada com sucesso', 46 ), 'confirm');
        }  
        
        echo json_encode( $retorno );
	exit;

    }
    
    public function editarAction()
    {
        $id = $this->getParam('id');
        //Lista os Distritos
        $districtDAO = new Model_DAO_AddDistrict();
        $this->view->distritos = $districtDAO->fetchAll( array( 'district' ) );
        
        $sukuDAO = new Model_DAO_AddSuku();
        $sukuVO  = $sukuDAO->fetchRow( array( 'id_suku' => $id ) );
        
        $data = $sukuVO->toArray();
        
        //var_dump($data); exit;
        
        $this->view->dadosForm = $data;
        
        $this->view->renderNewView( 'cadastro' );
    }
    
    public function cadastroAction()
    {
        $addDistrictDAO = new Model_DAO_AddDistrict();
        $this->view->distritos = $addDistrictDAO->fetchAll( array( 'district' ) );
	
    }
}

?>
