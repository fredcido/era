$( document ).ready(
    function()
    {
	$( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/admin/village/cadastro';
	    }
	);
	    
	$( '#editar' ).click( editItem );
    }
);
    
function editItem()
{
    if ( !grid.getSelectedId() ) {
	msgAlerta( 'Selecione o item para edição.' );
	return false;
    }

    var id = grid.getSelectedId();
    location.href = baseUrl + '/admin/village/editar/id/' + id;
    return true;
}

var grid;
function initGrid()
{
    if ( !$( '#gridVillage' ).length )
	return false;
    
    grid = new dhtmlXGridObject( 'gridVillage' );
    grid.setHeader( "#," + t( 'Distritu', 0 ) +"," + t( 'SubDistritu', 0 ) +"," + t( 'Suku', 0 ) +"," + t( 'Aldeia Naran', 0 ) +"," + t( 'Aldeia Code', 0 ) );
    grid.attachHeader( "#rspan,#select_filter,#text_filter,#text_filter,#text_filter,#text_filter" );
    grid.setInitWidths( "50,*,*,*,*,*" );
    grid.setColAlign( "center,left,left,left,left" );
    grid.setColTypes( "ro,ro,ro,ro,ro,ro" );
    grid.setColSorting( "str,str,str,str,str,str" );
    grid.setSkin( config.grid );
    grid.enablePaging( true, 30, 10, 'divPagVillage', true, 'divPagVillage' );
    grid.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    grid.init();
    
    return true;
}

function save( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error )
		history.go( 0 );//location.href = baseUrl + '/admin/formulario/';
	}
    };
    
    return submitAjax( form, obj );
}
