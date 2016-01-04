$( document ).ready(
    function()
    {
	$( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/treinamento/competencia/cadastro';
	    }
	);
	    
	$('#editar').click(editItem);
    }
);
    
function editItem()
{
    if ( !grid.getSelectedId() ) {
	msgAlerta( 'Selecione o item para edição.' );
	return false;
    }

    var id = grid.getSelectedId();
    location.href = baseUrl + '/treinamento/competencia/editar/id/' + id;
    return true;
}
    
var grid;
function initGrid()
{
    if ( !$( '#gridCompetencia' ).length )
	return false;
    
    grid = new dhtmlXGridObject( 'gridCompetencia' );
    grid.setHeader( "#," + t( 'Unidades de competência', 697 ) + "," + t( 'Acrônimo', 693 ) );
    grid.attachHeader( "#rspan,#text_filter,#text_filter" );
    grid.setInitWidths( "50,*,200" );
    grid.setColAlign( "center,left,left" );
    grid.setColTypes( "ro,ro,ro" );
    grid.setColSorting( "str,str,str" );
    grid.setSkin( config.grid );
    grid.enablePaging( true, 30, 10, 'divPagCompetencia', true, 'divPagCompetencia' );
    grid.attachFooter( t( 'Total', 19 ) + ",#cspan,{#stat_count}" );
    grid.init();
    
    return true;
}

function save( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error )
		location.href = baseUrl + '/treinamento/competencia/editar/id/' + response.id;
	}
    };
    
    return submitAjax( form, obj );
}