<?php

class ILO_Helper_Subdistrict extends ILO_Helper_Abstract
{
    /**
     * 
     */
    public function __invoke()
    {
	return $this->render();
    }
    
    /**
     *
     * @return string
     */
    public function __toString()
    {
	return $this->render();
    }
    
    /**
     *
     * @return type 
     */
    public function render()
    {
	$subdistrictsDAO = new Model_DAO_AddSubdistrict();
	$subdistricts = $subdistrictsDAO->fetchAll( array( 'subdistrict' ) );
	
	$data = array();
	foreach ( $subdistricts as $subdistrict ) {
	    
	    $district = $subdistrict->getFkIdAddDistrict();
	    $districtName = $district->getDistrict();
	    
	    if ( !array_key_exists( $districtName, $data ) ) {
		
		$data[$districtName] = array();
	    }
	    
	    $data[$districtName][] = $subdistrict;
	}
	
	ksort( $data );
	
	$options = '';
	foreach ( $data as $district => $subs ) {
	    
	    $options .= "<option disabled>--" . $district . "--</option>\n";
	    
	    foreach ( $subs as $sub )
		$options .= "<option value='" . $sub->getIdAddSubdistrict() . "'>" . $sub->getSubdistrict() . "</option>\n";
	}
	
	return $options;
    }
}