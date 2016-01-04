function exporting( url, button )
{
    if ( $( button ).hasClass( 'disabled' ) )
	return false;
    
    $( '#control-bar a' ).addClass( 'disabled' );
    
    $( '#path' ).val( location.pathname );
    url = baseUrl + '/' + url;
    
    var load = $( '<div />' );
    load.addClass( 'loader' ).html( 'Hein ituan...' );
	
    $( '#control-bar' ).append( load );
    
    if ( $( '#exporting-iframe' ).length )
	$( '#exporting-iframe' ).remove();
    
    iframe = $( '<iframe />' );
    iframe.attr( 'id', 'exporting-frame' )
	.attr( 'name', 'exporting-frame' )
	.hide();
	
    $( 'body' ).append( iframe );
    
    $( '#hidden-form' ).attr( 'target', 'exporting-frame' )
			.attr( 'action', url )
			.submit();
			
    setTimeout( 'checkDownload()', 2000 );	
}

function checkDownload()
{
    $.ajax({
	type: 'POST',
	dataType: 'json',
	url: baseUrl + '/relatorio/treinamento/checkdownload',
	success: function ( response )
	{
	   if ( response.status )
	       setTimeout( 'checkDownload()', 2000 );
	   else {
	       
		$( '#control-bar .loader' ).remove();
		$( '#control-bar a' ).removeClass( 'disabled' );
	   }   
	}
    });
}