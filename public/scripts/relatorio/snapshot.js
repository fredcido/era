$( document ).ready(
    function()
    {
	$( '.listas a' ).click(
	    function( e )
	    {               
		e.stopPropagation();
		
		id = gridSnapshot.getSelectedRowId();
		if ( !id ) {
		    
		    msgErro( t( 'Selecione o Snapshot para gerar o relatório.', 658 ) );
		    return false;
		}
		
		var step = $( this ).attr( 'id' ).replace( 'lista_', '' );
		$( '#type' ).val( 'list' );
		$( '#id_snapshot' ).val( id );
		$( '#detailed' ).val( step );
		
		$( '#form-report' ).submit();
	    }
	);
    }
);

var gridSnapshot;
function initGridSnapshot()
{
    if ( !$( '#gridSnapshot' ).length )
        return false;
    
    header = "#," + t( 'Distrito', 96 ) + ',' + t( 'Sub distrito', 98 )
	    + ',' + t( 'Suku', 100 ) + ',' + t( 'Road Location', 626 ) + ',' + t( 'Code', 628 )+ ',' + t( 'Reference', 621 );
    
    gridSnapshot = new dhtmlXGridObject( 'gridSnapshot' );
    gridSnapshot.setHeader( header );
    gridSnapshot.attachHeader( "#rspan,#select_filter,#select_filter,#select_filter,#text_filter,#text_filter,#text_filter" );
    gridSnapshot.setInitWidths( "30,150,180,150,180,80,120" );
    gridSnapshot.setColAlign( "center,left,left,left,left,left,left" );
    gridSnapshot.setColTypes( "ro,ro,ro,ro,ro,ro,ro" );
    gridSnapshot.setColSorting( "str,str,str,str,str,str,str" );
    gridSnapshot.setSkin( config.grid );
    gridSnapshot.enablePaging( true, 30, 10, 'divPagSnapshot', true, 'divPagSnapshot' );
    gridSnapshot.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,#cspan,#cspan,{#stat_count}" );
    gridSnapshot.init();
    
    return true;
}

function reportTreinamento( form )
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
    
    var url = baseUrl + '/relatorio/me/' + type;
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

var gridEndBaseLine;
function initGridBaseEndline()
{
    if ( !$( '#gridEndBaseLine' ).length )
        return false;
    
    header = "#," + t( 'Distrito', 96 ) + ',' + t( 'Sub distrito', 98 )
	    + ',' + t( 'Suku', 100 ) + ',' + t( 'Road Location', 626 ) + ',' + t( 'Code', 628 );
    
    gridEndBaseLine = new dhtmlXGridObject( 'gridEndBaseLine' );
    gridEndBaseLine.setHeader( header );
    gridEndBaseLine.attachHeader( "#rspan,#select_filter,#select_filter,#select_filter,#text_filter,#text_filter" );
    gridEndBaseLine.setInitWidths( "30,200,220,150,200,80" );
    gridEndBaseLine.setColAlign( "center,left,left,left,left,left" );
    gridEndBaseLine.setColTypes( "ro,ro,ro,ro,ro,ro" );
    gridEndBaseLine.setColSorting( "str,str,str,str,str,str" );
    gridEndBaseLine.setSkin( config.grid );
    gridEndBaseLine.enablePaging( true, 30, 10, 'divPagEndBaseLine', true, 'divPagEndBaseLine' );
    gridEndBaseLine.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,#cspan,{#stat_count}" );
    gridEndBaseLine.attachEvent( 'onRowDblClicked', exportBaseEndline );
    gridEndBaseLine.init();
    
    return true;
}

function exportBaseEndline()
{
     var id = gridEndBaseLine.getSelectedRowId();
    if ( !id ) {
	
	msgAlerta( t( 'Selecione o snapshot para exportação', 690 ) );
	return false;
    }
	
    location.href = baseUrl + '/relatorio/me/exportbaseendline/id/' + id;
    setTimeout(
	function()
	{
	    loading( false );
	},
	2000
    );
}
function ReportloadSnapshotDocuments()
{
    $.ajax({
        type: 'GET',
        url: baseUrl + '/relatorio/me/listdocuments/id/'+gridSnapshot.getSelectedId(),
        dataType: 'text',
        beforeSend: function () 
        {
            loading( true );
        },
	complete: function()
	{
	    loading( false );
	},
        success: function ( response ) 
        {
            $( '#list-document-container' ).html( response );
        },
        error: function () 
        {
            msgErro( t( 'Erro ao efetuar operação', 25 ) );
        }
    });
}
function showDocument( name, path, size )
{
    $( '#document-container .module_bottom' ).empty();

    $( '#hidden-container' ).hide();
    $( '#doc-size' ).html( size );
    $( '#doc-name' ).html( name );

    iframe  = $( '<iframe />' );
    iframe.addClass( 'iframe-document' ).attr( 'src', baseUrl + '/' + path );

    $( '#document-container .module_bottom' ).append( iframe );
    $( '#document-container' ).show();
    scrollTo( iframe );
}
