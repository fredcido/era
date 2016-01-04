$( document ).ready(
    function()
    {
	$( '#periodo_filtro input' ).change(
	    function()
	    {
		var fields = '#date_start, #date_finish';
		liberaFiltroItem( $( this ).val(), fields );
	    }
	);
	    
	    
	$( '.listas a' ).click(
	    function( e )
	    {
		e.stopPropagation();
		
		var contracts = gridContratosLista.getCheckedRows( 0 );
		if ( !contracts.length ) {

		    msgAlerta( t( 'Selecione os contratos para gerar relatorio', 661 ) );
		    return false;
		}
		
		var step = $( this ).attr( 'id' ).replace( 'lista_', '' );
		$( '#type' ).val( 'list' );
		$( '#detailed' ).val( step );
		$( '#contracts' ).val( contracts.join( ',' ) );
		
		$( '#form-report' ).submit();
	    }
	);
    }
);

var gridContratos;
function initGridContratos()
{
    if ( !$( '#gridContratos' ).length )
        return false;
    
    header = "#," + t( 'Project Cod', 38 ) + ',' + t( 'Contractor name', 49 ) + ',' + t( 'ILO Contract', 50 );
    
    gridContratos = new dhtmlXGridObject( 'gridContratos' );
    gridContratos.setHeader( header );
    gridContratos.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter" );
    gridContratos.setInitWidths( "50,*,350,200" );
    gridContratos.setColAlign( "center,left,left,left" );
    gridContratos.setColTypes( "ro,ro,ro,ro" );
    gridContratos.setColSorting( "str,str,str,str" );
    gridContratos.setSkin( config.grid );
    gridContratos.enablePaging( true, 30, 10, 'divPagContratos', true, 'divPagContratos' );
    gridContratos.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridContratos.attachEvent( 'onRowDblClicked', exportItem );
    gridContratos.init();
    
    return true;
}

var gridContratosLista;
function iniGridContratosLista()
{
    if ( !$( '#gridContratos' ).length )
        return false;
    
    header = "#master_checkbox," + t( 'Project Cod', 38 ) + ',' + t( 'Contractor name', 49 ) + ',' + t( 'ILO Contract', 50 );
    
    gridContratosLista = new dhtmlXGridObject( 'gridContratos' );
    gridContratosLista.setHeader( header );
    gridContratosLista.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter" );
    gridContratosLista.setInitWidths( "50,*,350,200" );
    gridContratosLista.setColAlign( "center,left,left,left" );
    gridContratosLista.setColTypes( "ch,ro,ro,ro,ro" );
    gridContratosLista.setColSorting( "str,str,str,str" );
    gridContratosLista.setSkin( config.grid );
    gridContratosLista.enablePaging( true, 30, 10, 'divPagContratos', true, 'divPagContratos' );
    gridContratosLista.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridContratosLista.init();
    
    filtraContratos();
    
    return true;
}

function filtraContratos()
{
    var url = baseUrl + '/relatorio/contrato/listcontracts/';
   
    $.ajax(
	{
	    url: url,
	    data: $( 'form' ).serialize(),
	    type: 'POST',
	    dataType: 'json',
	    beforeSend: function()
	    {
		loading( true );
		gridContratosLista.clearAll();
	    },
	    complete: function()
	    {
		loading( false )
	    },
	    success: function( response )
	    {
		gridContratosLista.parse( response, 'json' );
	    }
	}
    );
}

function exportItem()
{
    var id = gridContratos.getSelectedRowId();
    if ( !id ) {
	
	msgAlerta( t( 'Selecione o contrato para exportação', 653 ) );
	return false;
    }
	
    location.href = baseUrl + '/relatorio/contrato/exportrecord/id/' + id;
    setTimeout(
	function()
	{
	    loading( false );
	},
	2000
    );
}

var gridGroup;
function initGridContratosGroup()
{
    if ( !$( '#gridGroup' ).length )
        return false;
    
    header = "#master_checkbox," + t( 'Project Cod', 38 ) + ',' + t( 'Contractor name', 49 ) + ',' + t( 'ILO Contract', 50 );
    
    gridGroup = new dhtmlXGridObject( 'gridGroup' );
    gridGroup.setHeader( header );
    gridGroup.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter" );
    gridGroup.setInitWidths( "50,*,350,200" );
    gridGroup.setColAlign( "center,left,left,left" );
    gridGroup.setColTypes( "ch,ro,ro,ro" );
    gridGroup.setColSorting( "str,str,str,str" );
    gridGroup.setSkin( config.grid );
    gridGroup.enablePaging( true, 30, 10, 'divPagContratos', true, 'divPagContratos' );
    gridGroup.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridGroup.init();
    
    return true;
}

function exportGroup()
{
    contracts = gridGroup.getCheckedRows(0);
    if ( contracts.length < 1 ) {
	
	msgAlerta( t( 'Selecione os contratos para exportação', 654 ) );
	return false;
    }
    
    if ( contracts.length > 10 ) {
	
	msgAlerta( t( 'Selecione no máximo 10 contratos para exportação', 655 ) );
	return false;
    }
    
    location.href = baseUrl + '/relatorio/contrato/exportgroup/id/' + contracts.join( ',' );
    setTimeout(
	function()
	{
	    loading( false );
	},
	2000
    );
}

function liberaFiltroItem( flag, seletor )
{
    if ( 'S' == flag )
	$( seletor ).addClass( 'required' ).removeAttr( 'disabled' ).eq( 0 ).focus();	
    else
	$( seletor ).removeClass( 'required' ).attr( 'disabled', true ).val( '' );
}

function setTypeReport( type )
{
    $( '#type' ).val( type );
}

function reportContrato( form )
{
    if( !validaForm( form ) ) {
	
	msgErro( t( 'Verifique os campos do formulário.', 206 ) );
	return false;
    }
    
    var type = $( '#type' ).val();
    
    if ( 'summary' == type ) {
	
	if ( !$( '.summary-itens .itens-floating input:checked' ).length ) {
	    
	    msgErro( t( 'Selecione um dos itens do sumário.', 999 ) );
	    return false;
	}
    }
    
    clone = cloneForm( form );
    
    var url = baseUrl + '/relatorio/contrato/' + type;
    clone.attr( 'action', url );
    
    var popupName = parseId( url );
    window.open( url, popupName );
    clone.removeAttr('onsubmit')
	 .unbind( 'submit' )
	 .attr( 'target', popupName );

    clone.submit();
    clone.remove();
    
    return false;
}

var gridBatch;
function initGridContratosBatch()
{
    if ( !$( '#gridBatch' ).length )
        return false;
    
    header = t( 'Contract Batch', 688 );
    
    gridBatch = new dhtmlXGridObject( 'gridBatch' );
    gridBatch.setHeader( header );
    gridBatch.attachHeader( "#text_filter" );
    gridBatch.setInitWidths( "*" );
    gridBatch.setColAlign( "left" );
    gridBatch.setColTypes( "ro" );
    gridBatch.setColSorting( "str" );
    gridBatch.setSkin( config.grid );
    gridBatch.enablePaging( true, 30, 10, 'divPagBatches', true, 'divPagBatches' );
    gridBatch.attachEvent( 'onRowDblClicked', exportBatch );
    gridBatch.init();
    
    return true;
}

function exportBatch()
{
    var id = gridBatch.getSelectedRowId();
    if ( !id ) {
	
	msgAlerta( t( 'Selecione o batch para exportação', 689 ) );
	return false;
    }
    
    location.href = baseUrl + '/relatorio/contrato/exportbatch/id/' + id;
    setTimeout(
	function()
	{
	    loading( false );
	},
	2000
    );
}