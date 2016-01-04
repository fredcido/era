function save( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error )
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
	},
	validate: function()
	{
	    if ( $( '#password' ).val() != $( '#confirm_password' ).val() ) {
		
		msgAlerta( t( 'Senhas não conferem', 23 ) );
		return false;
	    }
	    
	    return true;
	}
    };
    
    return submitAjax( form, obj );
}