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
	    
	$( '#filtro_turma input' ).change(
	    function()
	    {
		var fields = '.turma-id';
		liberaFiltroItem( $( this ).val(), fields );
	    }
	);
	    
	$( '.detalhado a' ).click(
	    function( e )
	    {
		e.stopPropagation();
		
		var step = $( this ).attr( 'id' ).replace( 'detalhado_', '' );
		$( '#type' ).val( 'detailed' );
		$( '#detailed' ).val( step );
		
		$( '#form-report' ).submit();
	    }
	);
	    
	$( '.listas a' ).click(
	    function( e )
	    {
		e.stopPropagation();
		
		var step = $( this ).attr( 'id' ).replace( 'lista_', '' );
		$( '#type' ).val( 'list' );
		$( '#detailed' ).val( step );
		
		$( '#form-report' ).submit();
	    }
	);
	    
	$( '#ico-add-turma' ).click( addTurma );
    }
);
    
function addTurma()
{
    link = $( '#ico-add-turma' );
    
    if ( !link.hasClass( 'duplicated' ) ) {
	
	disabled = $( '#turma_id' ).attr( 'disabled' ) == undefined ? false : true;
	if ( disabled )
	    return false;
	
	row = link.closest( 'div.row' ).clone();
	row.find( '#ico-add-turma' ).remove();
	link.closest( 'div.module_bottom' ).append( row );
	link.addClass( 'duplicated' );
	link.find( 'span' ).removeClass( 'ico-add' ).addClass( 'ico-remove' );
	
    } else {
	
	link.removeClass( 'duplicated' );
	link.find( 'span' ).removeClass( 'ico-remove' ).addClass( 'ico-add' );
	link.closest( 'div.module_bottom' ).find( '.row' ).eq( 2 ).remove();
    }
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

function checkAllItens( master )
{
    var check = $( master ).attr( 'checked' ) ? true : false;
    $( '.summary-itens .itens-floating input' ).attr( 'checked', check );
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
    
    var url = baseUrl + '/relatorio/treinamento/' + type;
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