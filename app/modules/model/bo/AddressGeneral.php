<?php

class Model_BO_AddressGeneral extends ILO_Model_BO {

    /**
     *
     * @return boolean 
     */
    public function removerEndereco()
    {
	$enderecoDAO = new Model_DAO_AddressGeneral();

	$enderecoDAO->beginTransaction();
	try {
            
            $data['id_address_general'] = $this->_data['id_address_general'];
            
	    $enderecoDAO->delete( $data );
	  
	    $enderecoDAO->commit();
	    return true;
	
	} catch ( Exception $e ) {
	    
	    $enderecoDAO->rollBack();
	    return false;
	}
    }

}