$( document ).ready(
    function()
    {
	$( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/admin/formulario/cadastro';
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
    location.href = baseUrl + '/admin/formulario/editar/id/' + id;
    return true;
}
    
var grid;
function initGrid()
{
    if ( !$( '#gridFormulario' ).length )
	return false;
    
    grid = new dhtmlXGridObject( 'gridFormulario' );
    grid.setHeader( "#," + t( 'Formulário', 3 ) +"," + t( 'Módulo', 2 ) +"," + t( 'Path', 140 ) );
    grid.attachHeader( "#rspan,#text_filter,#select_filter,#text_filter" );
    grid.setInitWidths( "50,*,300,200" );
    grid.setColAlign( "center,left,left,left" );
    grid.setColTypes( "ro,ro,ro,ro" );
    grid.setColSorting( "str,str,str,str" );
    grid.setSkin( config.grid );
    grid.enablePaging( true, 30, 10, 'divPagFormulario', true, 'divPagFormulario' );
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