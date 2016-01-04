<?php

class Model_BO_ProfessionalExperience extends ILO_Model_BO {

    /**
     *
     * @return boolean 
     */
    public function removerExperiencia()
    {
	$experienceDAO = new Model_DAO_ProfessionalExperience();

	$experienceDAO->beginTransaction();
	try {
            
            $data['id_professional_experience'] = $this->_data['id_professional_experience'];
            
	    $experienceDAO->delete( $data );
	  
	    $experienceDAO->commit();
	    return true;
	
	} catch ( Exception $e ) {
	    
	    $experienceDAO->rollBack();
	    return false;
	}
    }

}