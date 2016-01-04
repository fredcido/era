<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddSuku
 *
 * @author calos
 */
class Model_BO_AddSuku extends ILO_Model_BO
{
    protected $_auditDescription = 'REJISTU/ATUALIZA SUKU: %s';
    
    public function save()
    {
        $addSukuDAO = new Model_DAO_AddSuku();
        $addSukuVO  = new Model_VO_AddSuku();
        
        $addSukuVO->setValues($this->_data);
         
        //var_dump($addSukuVO);exit;
        
        try {
            $addSukuDAO->beginTransaction();
            
            if( null == $addSukuVO->getIdSuku() ){ //novo registro
                //verifica se ja tem esse suku pra esse subdistrict
                $sukuRegistered = $addSukuDAO->fetchAll( array(),
                                                         array( 'fk_id_add_subdistrict' => $addSukuVO->getFkIdAddSubdistrict()->getIdAddSubdistrict(),
                                                                'suku' => $addSukuVO->getSuku(),
                                                                'acronym' => $addSukuVO->getAcronym(),
                                                                'acronym <> null'
                                                         ) );
                
                $acronymRegistered = $addSukuDAO->fetchAll( array(),
                                                            array( 'acronym' => $addSukuVO->getAcronym(),
                                                                   'acronym <> null'
                                                                 ) );
                
                //var_dump($acronymRegistered);exit;
                if( !empty($sukuRegistered) || !empty($acronymRegistered) ){
                     
                     $this->setError (ILO_Util_Translate::get("Labele save. Iha Rejistu ba Suku ka Suku code hanesa ne'e tiha ona", 0));
                     return false;
                                      
                }  else {
                    
                    //caso este valores nao exista no banco, salva.
                    $idSuku = $addSukuDAO->insert($addSukuVO);
                    
                    $description = 'REJISTA ALDEIA ID: '.$idSuku;
                    
                    $this->audit($description, self::SALVAR);
                    
                    $addSukuDAO->commit();
                    return $idSuku;
                     
                }
                
            }  else { //atualiza registro
                //verifica se ja tem esse suku pra esse subdistrict
                $sukuRegistered = $addSukuDAO->fetchAll( array(),
                                                         array( 'fk_id_add_subdistrict' => $addSukuVO->getFkIdAddSubdistrict()->getIdAddSubdistrict(),
                                                                'suku' => $addSukuVO->getSuku(),
                                                                'acronym' => $addSukuVO->getAcronym(),
                                                                'acronym <> null',
                                                                'id_suku <>'.$addSukuVO->getIdSuku()
                                                         ) );
                
                $acronymRegistered = $addSukuDAO->fetchAll( array(),
                                                            array( 'acronym' => $addSukuVO->getAcronym(),
                                                                   'acronym <> null',
                                                                   'id_suku <>'.$addSukuVO->getIdSuku()
                                                                 ) );
                
                if( !empty($sukuRegistered) || !empty($acronymRegistered) ){
                     
                     $this->setError (ILO_Util_Translate::get("Labele save. Iha Rejistu ba Suku ka Suku code hanesa ne'e tiha ona", 0));
                     return false;
                                      
                }  else {
                    
                    //caso este valores nao exista no banco, salva.
                    $idSuku = $addSukuDAO->update( $addSukuVO, array( 'id_suku' => $addSukuVO->getIdSuku() ) );
                    
                    $description = 'ATUALIZA ALDEIA ID: '.$idSuku;
                    
                    $this->audit($description, self::SALVAR);
                    
                    $addSukuDAO->commit();
                    return $idSuku;
                     
                }
            }
            
        } catch ( Exception $e ) {
            var_dump($e);
	    return false;
        }
                    
    }
}

?>
