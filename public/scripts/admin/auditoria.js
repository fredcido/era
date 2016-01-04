var grid;
function initGrid()
{
    if ( !$( '#gridAuditoria' ).length )
	return false;
    
    header = "#," + t( 'Módulo', 2 ) 
	     + ',' + t( 'Fomulário', 3 ) 
	     + ',' + t( 'Operação', 111 )
	     + ',' + t( 'Usuário', 1 )
	     + ',' + t( 'Descrição', 13 )
	     + ',' + t( 'Data/hora', 6 );
    
    grid = new dhtmlXGridObject( 'gridAuditoria' );
    grid.setHeader( header );
    grid.attachHeader( "#rspan,#select_filter,#select_filter,#select_filter,#select_filter,#text_filter,#text_filter" );
    grid.setInitWidths( "50,100,120,70,100,*,110" );
    grid.setColAlign( "center,left,left,left,left,left,left" );
    grid.setColTypes( "ro,ro,ro,ro,ro,ro,ro" );
    grid.setColSorting( "str,str,str,str,str,str,str" );
    grid.setSkin( config.grid );
    grid.enablePaging( true, 30, 10, 'divPagModulo', true, 'divPagModulo' );
    grid.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,#cspan,#cspan,{#stat_count}" );
    grid.init();
    
    return true;
}