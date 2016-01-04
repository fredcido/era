<?php

class Model_DAO_Snapshot extends ILO_Model_DAO
{

    protected $_table = 'snapshot';
    protected $_class = 'Model_VO_Snapshot';
    
    
    /**
     * 
     * @return array
     */
    public function listBaseEndLine()
    {
	$sql = 'SELECT 
		    b.id_snapshot id_base,
		    e.id_snapshot id_end,
		    b.road_location,
		    b.code,
		    ad.district,
		    asb.subdistrict,
		    ask.suku
		 FROM snapshot b
		 INNER JOIN snapshot e ON
		    e.fk_id_add_district = b.fk_id_add_district
		    AND e.fk_id_add_subdistrict = b.fk_id_add_subdistrict
		    AND e.fk_id_add_suku = b.fk_id_add_suku
		    AND TRIM(e.road_location) = TRIM(b.road_location)
		 INNER JOIN add_district ad ON
		    ad.id_add_district = b.fk_id_add_district
		 INNER JOIN add_subdistrict asb ON
		    asb.id_add_subdistrict = b.fk_id_add_subdistrict
		 INNER JOIN add_suku ask ON
		    ask.id_suku = b.fk_id_add_suku
		 WHERE b.reference = 0
		 AND e.reference = 1
		 ORDER BY ad.district, asb.subdistrict, ask.suku';
	
	return $this->queryResult( $sql );
    }

}