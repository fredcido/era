<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Village
 *
 * @author calos
 */
class Model_BO_AddVillage extends ILO_Model_BO
{
     protected $_auditDescription = 'REJISTU/ATUALIZA ALDEIA: %s';
     
     public function save()
     {
         $addVillageDAO = new Model_DAO_AddVillage();
         $addVillageVO  = new Model_VO_AddVillage();
         
         $addVillageVO->setValues($this->_data);
         
         //var_dump($addVillageVO->getIdVillage());exit;
         
         try {
             
             $addVillageDAO->beginTransaction();
             
             if( null == $addVillageVO->getIdVillage()){//Novo registro
                 //verifica se ja tem essa aldeia para esse suku ou codigo para qualquer aldeia
                 $VillageRegistered = $addVillageDAO->fetchAll( array(),
                                                                array( 
                                                                     'fk_id_suku' => $addVillageVO->getFkIdSuku()->getIdSuku(),
                                                                     'village_name' => $addVillageVO->getVillageName()
                                                                     
                                                                                                   
                                                                ));
                 
                 $VillageCodeRegistered = $addVillageDAO->fetchAll( array(),
                                                                array( 
                                                                     'village_code' => $addVillageVO->getVillageCode()
                                                                                                   
                                                           ));
                 
                 if( !empty($VillageRegistered) || !empty($VillageCodeRegistered) ){
                     
                     $this->setError (ILO_Util_Translate::get("Labele save. Iha Rejistu ba Aldeia ka Aldeia code hanesa ne'e tiha ona", 0));
                     return false;
                 }  else {
                     //caso este valores nao exista no banco, salva
                     $idVillage = $addVillageDAO->insert($addVillageVO);
                     
                     $description = 'REJISTA ALDEIA ID: '.$idVillage;
                     $this->audit($description, self::SALVAR);
                     
                     $addVillageDAO->commit();
                     
                     return $idVillage;
                 }
                 
                 
                 var_dump($VillageRegistered).'/n';
                 var_dump($VillageCodeRegistered);exit;
                 
                 
                                  
             }  else {//atualiza registro no banco
                 //verifica se ja tem essa aldeia para esse suku ou codigo para qualquer aldeia
                 $VillageRegistered = $addVillageDAO->fetchAll( array(),
                                                                array(
                                                                     'id_village <>'.$addVillageVO->getIdVillage(),
                                                                     'fk_id_suku' => $addVillageVO->getFkIdSuku()->getIdSuku(),
                                                                     'village_name' => $addVillageVO->getVillageName()
                                                                     
                                                                                                   
                                                           ) 
                                                       );
                 $VillageCodeRegistered = $addVillageDAO->fetchAll( array(),
                                                                array(
                                                                     'id_village <>'.$addVillageVO->getIdVillage(),
                                                                     'village_code' => $addVillageVO->getVillageCode()
                                                                                                   
                                                           ) 
                                                       );
                 if( !empty($VillageRegistered) || !empty($VillageCodeRegistered) ){
                     
                     $this->setError (ILO_Util_Translate::get("Labele save. Iha Rejistu ba Aldeia ka Aldeia code hanesa ne'e tiha ona", 0));
                     return false;
                 }  else {
                     //caso este valores nao exista no banco, salva
                     $idVillage = $addVillageDAO->update( $addVillageVO, array( 'id_village' => $addVillageVO->getIdVillage() ) );
                     //$idVillage = $addVillageDAO->insert($addVillageVO);
                     
                     $description = 'ATUALIZA ALDEIA ID: '.$idVillage;
                     $this->audit($description, self::SALVAR);
                     
                     $addVillageDAO->commit();
                     
                     return $idVillage;
                 }
             }
                 
         } catch ( Exception $e ) {
            var_dump($e);
	    return false;
         }
     }
     
     
     protected function _auditVillage()
     {
         
         
     }
}

?>
