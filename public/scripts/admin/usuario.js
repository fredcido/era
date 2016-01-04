$( document ).ready(
    function()
    {
	$( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/admin/usuario/cadastro';
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
    location.href = baseUrl + '/admin/usuario/editar/id/' + id;
    return true;
}
    
var grid;
function initGrid()
{
    if ( !$( '#gridUsuario' ).length )
	return false;
    
    grid = new dhtmlXGridObject( 'gridUsuario' );
    grid.setHeader( "#," + t( 'Nome', 10 ) + "," + t( 'Login', 21 ) + "," + t( 'Status', 22 ) );
    grid.attachHeader( "#rspan,#text_filter,#text_filter,#select_filter" );
    grid.setInitWidths( "50,*,300,200" );
    grid.setColAlign( "center,left,left,left" );
    grid.setColTypes( "ro,ro,ro,ro" );
    grid.setColSorting( "str,str,str,str" );
    grid.setSkin( config.grid );
    grid.enablePaging( true, 30, 10, 'divPagUsuario', true, 'divPagUsuario' );
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
		history.go( 0 );//location.href = baseUrl + '/admin/usuario/';
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

function verificaUsuario()
{
    var login = $( '#nick_name' ).val();
    var id = $( '#id_sysuser' ).val();
    
    $.ajax({
	type: 'POST',
	data: {
	    login: login,
	    id: id
	},
	dataType: 'json',
	url: baseUrl + '/admin/usuario/verificalogin/',
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
	    if ( response.existe ) {
		
		$( '#nick_name' ).val( '' );
		msgErro( t( 'Login já cadastrado', 24 ) );
		$( '#nick_name' ).focus();
	    }
	},
	error: function ( response )
	{
	    $( '#nick_name' ).val( '' );
	    msgErro( t( 'Erro ao efetuar operação', 25 ) );
	}
    });
}

function populaFormUser( data )
{
    $( '#form-usuario' ).populate( data );
    
    $( '#nick_name' ).attr( 'readonly', true );
    $( '#password' ).removeClass( 'required' ).closest( '.row' ).find( 'label span' ).remove();
    $( '#confirm_password' ).removeClass( 'required' ).closest( '.row' ).find( 'label span' ).remove();
}