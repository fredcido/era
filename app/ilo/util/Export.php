<?php

abstract class ILO_Util_Export
{
    
    /**
     * 
     */
    public static function toExcel( $fileName, $content )
    {
	header ( "Cache-Control: no-cache, must-revalidate" );
	header ( "Pragma: no-cache" );
	header ( "Content-type: application/vnd.ms-excel;charset=UTF-8" );
	header ( "Content-Disposition: attachment; filename=" . $fileName . ".xls" );
	
	echo $content;
    }
    
    public static function toDoc( $fileName, $content )
    {
	header ( "Cache-Control: no-cache, must-revalidate" );
	header ( "Pragma: no-cache" );
	header ( "Content-type: application/vnd.ms-word" );
	header ( "Content-Disposition: attachment; filename=" . $fileName . ".doc" );
	
	echo $content;
    }
    
    public static function toPdf( $fileName, $content, $papel = 'a4', $orientacao = 'portrait' )
    {
	require_once( APPDIR . "/../library/DomPDF/dompdf_config.inc.php" );
	spl_autoload_unregister( 'iloAutoloader' );
	spl_autoload_register( 'DOMPDF_autoload' );
	
	setlocale( LC_NUMERIC, 'en_US' );

        $dom = new DOMPDF();
        $dom->set_paper( $papel, $orientacao );
	$dom->load_html( $content );
	$dom->render();
	$dom->stream( $fileName );
	
	spl_autoload_unregister( 'DOMPDF_autoload' );
	spl_autoload_register( 'iloAutoloader' );
    }
}
