$( document ).ready(
    function()
    {
	// arvore de permissoes
	$( "#permissoes_usuario" ).treeview();
	$( "#permissoes_usuario input" ).click(
	    function()
	    {
		mudaPermissao( $( this ) );
	    }
	);
    }
);
    
function buscaPermissoes()
{
    var usuario = $( '#id_sysuser' ).val();
    $( "#permissoes_usuario input" ).attr( 'checked', false );
    
    if ( empty( usuario ) )
	return false;

    $.ajax({
	type: 'POST',
	dataType: 'json',
	url: baseUrl + '/admin/permissao/busca/id/' + usuario,
	beforeSend: function()
	{
	    loading( true );
	},
	complete: function()
	{
	    loading( false );
	},
	success: function ( response )
	{
	    for ( i in response ) {
		
		var idOper =  response[i].idOper;
		var idForm = response[i].idForm;
		
		var idField = 'oper_' + idForm + '_' + idOper;
		
		$( "#permissoes_usuario input[id=" + idField + "]" ).attr( 'checked', true );
	    }
	}
    });
    
    return true;
}

function mudaPermissao( check )
{
    var usuario = $( '#id_sysuser' ).val();
    if ( empty( usuario ) )
	return false;
    
    var operacao = eval( '(' + check.val() + ')' );
    
    operacao.usuario = usuario;
    operacao.inserir = check.attr( 'checked' ) ? 1 : 0;
    
    $.ajax({
	type: 'POST',
	dataType: 'json',
	data: operacao,
	url: baseUrl + '/admin/permissao/save/',
	beforeSend: function()
	{
	    loading( true );
	},
	complete: function()
	{
	    loading( false );
	},
	error: function()
	{
	    check.attr( 'checked', !check.attr( 'checked' ) );
	}
    });
    
    return true;
}