var translateObj = null;

$.ajax(
    {
	type: "GET",
	url: baseUrl + "/auth/translate",
	dataType: "xml",
	async: false,
	success: function( xml )
	{
	    translateObj = xml;
	}
    }
);
    
function t( termo, id )
{
    if ( empty( translateObj ) )
	return termo;
    
    $( translateObj ).find( 'termo' ).each(
	function( index, tag )
	{
	    if ( id == $( tag ).find( 'id' ).text() ) {
		
		termo = $( tag ).find( 'traducao' ).text();
		return false;
	    }
	}
    );
	
    return termo;
}