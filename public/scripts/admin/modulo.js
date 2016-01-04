$( document ).ready(
    function()
    {
	$( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/admin/modulo/cadastro';
	    }
	);
	    
	$( '#editar' ).click( editItem );
    }
);
    
function editItem()
{
    if ( !grid.getSelectedId() ) {
	msgAlerta( t( 'Selecione o item para edição', 20 ) );
	return false;
    }

    var id = grid.getSelectedId();
    location.href = baseUrl + '/admin/modulo/editar/id/' + id;
    return true;
}
    
var grid;
function initGrid()
{
    if ( !$( '#gridModulo' ).length )
	return false;
    
    grid = new dhtmlXGridObject( 'gridModulo' );
    grid.setHeader( "#," + t( 'Nome', 10 ) );
    grid.attachHeader( "#rspan,#text_filter" );
    grid.setInitWidths( "50,*" );
    grid.setColAlign( "center,left" );
    grid.setColTypes( "ro,ro" );
    grid.setColSorting( "str,str" );
    grid.setSkin( config.grid );
    grid.enablePaging( true, 30, 10, 'divPagModulo', true, 'divPagModulo' );
    grid.attachFooter( t( 'Total', 19 ) + ",{#stat_count}" );
    grid.init();
    
    return true;
}

function save( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error )
		history.go( 0 );//location.href = baseUrl + '/admin/modulo/';
	}
    };
    
    return submitAjax( form, obj );
}