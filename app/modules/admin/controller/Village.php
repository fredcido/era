<?php

class Admin_Controller_Village extends ILO_Controller_Padrao
{
    public function init()
    {
    
        
    }
    
    public function indexAction()
    {
        $sql = 'select d.district,c.subdistrict,b.suku,a.village_name,a.village_code,a.id_village
                from add_village a
                inner join add_suku b on (a.fk_id_suku = b.id_suku)
                inner join add_subdistrict c on (b.fk_id_add_subdistrict = c.id_add_subdistrict)
                inner join add_district d on (c.fk_id_add_district = d.id_add_district)
                order by d.district,c.subdistrict,b.suku,a.village_name';
        
        $villageDAO = new Model_DAO_AddVillage();
        $villages   = $villageDAO->queryResult( $sql );
        
        $dataJson['rows'] = array();
        
        if( !empty( $villages ) ){
            
            foreach ($villages as $key => $village){
                
                $dataJson['rows'][] = array(
                    'id'    => $village['id_village'],
                    'data'  => array(
                        ++$key,
                        $village['district'],
                        $village['subdistrict'],
                        $village['suku'],
                        $village['village_name'],
                        $village['village_code'],
                    )
                );
            }
        }
//        var_dump($dataJson);
//        exit();
        $this->view->data = json_encode($dataJson);

    }
    
    public function saveAction()
    {
        $villageBO = new Model_BO_AddVillage();
        $villageBO->setData( $this->getParams() );
        
       //var_dump($this->getParams());exit;
        
        if ( $villageBO->save() ){
            $retorno['error'] = false;
        }else{
            $retorno['error'] = true;
            $retorno['msg'] = $villageBO->getError();
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
        
        $villageDAO = new Model_DAO_AddVillage();
        $villageVO  = $villageDAO->fetchRow( array( 'id_village' => $id ) );
        
        $data = $villageVO->toArray();
        
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
