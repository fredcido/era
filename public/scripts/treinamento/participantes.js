/**
 * 
 */
$(document).ready(
    function()
    {
        
        $( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/treinamento/participantes/geral';
	    }
	);
	    
	$( '#editar' ).click( editItem );
            
        $( '#finish_date' ).change( validaDataExperiencia );
        
        $( '#date_registration' ).change( setYear );
        
        $(".phone").inputmask("mask", {"mask": "(999) 99999999"});
        
    }
);

function setYear(){
    
    var data = $( '#date_registration' ).val();
    
    if( !empty( data ) ){
        var ano = data.substr(8,2);
        $('#num_year').val(ano);
    }else{
        $('#num_year').val(ano);
    }
    
}

function editItem()
{
 
     if ( !gridParticipantes.getSelectedId() ) {
        msgAlerta( t( 'Selecione o item para edição', 20 ) );
        return false;
    }

    var id = gridParticipantes.getSelectedId();
    location.href = baseUrl + '/treinamento/participantes/geral/id/' + id;
    return true;
 
}

var gridParticipantes;
function initGridParticipantes()
{
    if ( !$( '#gridParticipantes' ).length )
        return false;
    
    header = "#," + t( 'Código do Cliente', 38 ) + ',' + t( 'Nome do Participante', 49 ) + ',' + t( 'Telemovel', 50 );
    
    gridParticipantes = new dhtmlXGridObject( 'gridParticipantes' );
    gridParticipantes.setHeader( header );
    gridParticipantes.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter" );
    gridParticipantes.setInitWidths( "50,*,350,200" );
    gridParticipantes.setColAlign( "center,left,left,left" );
    gridParticipantes.setColTypes( "ro,ro,ro,ro" );
    gridParticipantes.setColSorting( "str,str,str,str" );
    gridParticipantes.setSkin( config.grid );
    gridParticipantes.enablePaging( true, 30, 10, 'divPagParticipantes', true, 'divPagParticipantes' );
    gridParticipantes.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridParticipantes.init();
    
    return true;
}

function saveGeral( form )
{
    
    $( "#num_district" ).attr( "disabled",false );
    $( "#num_activity" ).attr( "disabled",false );
    $( "#num_year" ).attr( "disabled",false );
    $( "#fk_id_add_district" ).attr( "disabled",false );
    
    var obj = {
        callback: function( response )
        {
            
            if ( !response.error )
                location.href = baseUrl + '/treinamento/participantes/documento/id/' + response.id;
        }
    };
    
    return submitAjax( form, obj );    
    $( "#num_year" ).attr( "disabled",true);
}

function saveDocumento( form )
{
    var obj = {
        callback: function( response )
        {            
            if ( !response.error ){
                msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
                $( '#form-participantes-documento' )[0].reset();
		$( 'tbody#lista-documentos' ).load( baseUrl + '/treinamento/participantes/listadocumentos/id/' + response.id );
            }
        }
    };
    
    return submitAjax( form, obj );
}

function excluiDocumento( documento, link )
{
    if ( !confirm( t( 'Deseja remover este item?', 93 ) ) )
	return false;
    
    $.ajax({
	type: 'POST',
	data: documento,
	dataType: 'json',
	url: baseUrl + '/treinamento/participantes/removerdocumento/',
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
	    if ( response.status ) {
		
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		$( link ).closest( 'tr' ).remove();
		
	    } else
		msgErro( t( 'Erro ao efetuar operação', 25 ) );
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao efetuar operação', 25 ) );
	}
    });
    
    return false;
}


function mudaFormacaoProfissional()
{
    var vocational = $( '#vocational_training' ).val();
    
    if ( vocational == 'L' )
	$( '#formacao-profissional' ).hide();
    else
	$( '#formacao-profissional' ).show();
}

var contadorFormacao = 0;
function addFormacaoProfissional( data )
{
    contadorFormacao++;
    
    var tr = $( '<tr />' );
    tr.addClass( contadorFormacao % 2 ? 'first' : 'second' );
    
    tr.append( $( '<td />').html( contadorFormacao ) );
    
    // Cria select de formacoes profissionais
    var divInput = $( '<div />' );
    divInput.addClass( 'inputs' );
    
    var spanWrapper = $( '<span />' );
    spanWrapper.addClass( 'input_wrapper' );
    
    var selectVocational = $( '<select />' );
    selectVocational.addClass( 'text' )
		    .addClass( 'required' )
		    .attr( 'name', 'vocat_training[]' );
		    
    var option = $( '<option />' );
    option.val( '' );
    option.html( t( 'Selecine', 85 ) );

    selectVocational.append( option );
		    
    for ( i in vocationalTraining ) {
	
	option = $( '<option />' );
	option.val( vocationalTraining[i].id );
	option.html( vocationalTraining[i].name );
	
	selectVocational.append( option );
    }
    
    if ( data && data.fk_id_vocational_training )
	selectVocational.val( data.fk_id_vocational_training );

    tr.append( $( '<td />' ).append( divInput.append( spanWrapper.append( selectVocational ) ) ) );
    
    // Cria input para ano de finalização
    var divInputAno = $( '<div />' );
    divInputAno.addClass( 'inputs' )
		.addClass( 'ano' );
		
    var spanWrapperYear = $( '<span />' );
    spanWrapperYear.addClass( 'input_wrapper' );
    
    var inputYear = $( '<input />' );
    inputYear.attr( 'type', 'text' )
	    .addClass( 'text' )
	    .addClass( 'required' )
	    .addClass( 'year' )
	    .attr( 'name', 'year_completed[]' );
	    
    if ( data && data.year_completed )
	inputYear.val( data.year_completed );
	    
    tr.append( $( '<td />' ).append( divInputAno.append( spanWrapperYear.append( inputYear ) ) ) );
    
    var divActions = $( '<div />' );
    divActions.addClass( 'actions' );
    
    var aAction = $( '<a />');
    aAction.attr( 'href', 'javascript:;' )
	    .addClass( 'action4' )
	    .html( '4' )
	    .click(
		function()
		{
		    if ( !confirm( t( 'Deseja remover este item?', 93 ) ) )
			return false;
		    
		    $( this ).closest( 'tr' ).remove();
		    
		    return true;
		}
	    );
		
    tr.append( $( '<td />' ).append( divActions.append( $( '<ul />' ).append( $( '<li />' ).append( aAction ) ) ) ) );
    
    $( '#formacao-profissional tbody' ).append( tr );
    
    $( '.year' ).inputmask( 'y', {"clearIncomplete": true} );
}   

function saveEducacao( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error )
		location.href = baseUrl + '/treinamento/participantes/endereco/id/' + response.id;
	},
	validate: function()
	{
	    if ( $( '#formacao-profissional tbody tr' ).length < 1 ) {
		
		msgAlerta( t( 'Selecione as formações profissionais', 236 ) );
		return false;
	    }
	    
	    return true;
	}
    };
    
    return submitAjax( form, obj );
}


function saveEndereco( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error )
		location.href = baseUrl + '/treinamento/participantes/experiencia/id/' + response.id;
	}
    };
    
    return submitAjax( form, obj );
}

function saveExperiencia( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error ){
                msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		location.href = baseUrl + '/treinamento/participantes/experiencia/id/' + response.id;
            }
	}
    };
    
    return submitAjax( form, obj );
}

function setNumClient( id ){
    
    if( !empty( id ) )
        $('#num_district').val( id );
    
}

function calculaSalarioMontly()
{
    
    var montly_value = $( '#montly_value' ).val();
    
    if ( empty( montly_value ) ) {
	
	$( '#annual_value' ).val( 0 );
	return false;
    }
    
    var annual_value = toFloat( montly_value ) * 12;
    $( '#annual_value' ).val( parseFloat( annual_value.toFixed(2) ) );
    
    return true;
}

function calculaSalarioAnnual()
{
    
    var annual_value = $( '#annual_value' ).val();
    
    if ( empty( annual_value ) ) {
	
	$( '#montly_value' ).val( 0 );
	return false;
    }
    
    var montly_value = toFloat( annual_value ) / 12;
    $( '#montly_value' ).val( parseFloat( montly_value.toFixed(2) ) );
    
    return true;
}

function editarExperiencia( dados )
{
    
    location.href = baseUrl + '/treinamento/participantes/experiencia/id/' + dados.fk_id_client + '/experience/' + dados.id_professional_experience;
    
}


function excluiExperiencia( experiencia, link )
{
    if ( !confirm( t( 'Deseja remover este item?', 93 ) ) )
	return false;
    
    $.ajax({
	type: 'POST',
	data: experiencia,
	dataType: 'json',
	url: baseUrl + '/treinamento/participantes/removerexperiencia/',
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
	    if ( response.status ) {
		
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		$( link ).closest( 'tr' ).remove();
		
	    } else
		msgErro( t( 'Erro ao efetuar operação', 25 ) );
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao efetuar operação', 25 ) );
	}
    });
    
    return false;
}


function validaDataExperiencia()
{
    
    start_date = $( '#start_date' ).val();
    finish_date = $( '#finish_date' ).val();
    
    if ( empty( start_date ) )
	return false;
    
    start = new Date( start_date.split( '/' ).reverse().join( '-' ) );
    finish = new Date( finish_date.split( '/' ).reverse().join( '-' ) );
    
    if ( start.getTime() > finish.getTime() ) {
	
	msgErro( t( 'Data Hari não pode ser maior que a data Remata.', 250 ) );
	$( '#start_date' ).val( '' ).focus();
	$( '#finish_date' ).val( '' ).focus();
    }
    
    return false;
}