$.extend(
    $.inputmask.defaults.definitions, {
	't': {
	    "validator": "[1-3]",
	    "cardinality": 1,
	    'prevalidator': null
	}
    }
);

$( document ).ready(
    function()
    {
	$( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/treinamento/treinamento/cadastro';
	    }
	);
	    
	$( '#editar' ).click( editItem );
	
	// Calcula total de participantes
	$( '#man_student, #woman_student' ).change( somaTotalParticipantes );
	
        // Calcula total de dias de treinamento
	$( '#class_days, #field_days' ).change( somaTotalDiasTreino );
	
	// Busca unidades de competencia o curso
	$( '#fk_id_course' ).change( buscaUnidadesCompentencia );
	
	// Adiciona participantes
	$( '#add-participantes' ).click( addParticipantes );
	
	// Remove participantes
	$( '#remover-participantes' ).click( removeParticipantes );
	
	// Avancar participantes
	$( '#avancar-participantes' ).click( avancaParticipantes );
	
	// Buscar participantes
	$( '#busca-participantes' ).click( buscarParticipantes );
	
	// Valida treinador principal
	$( '#fk_id_trainer_prin' ).change( validaTrainerPrinc );
	
	// Valida treinadores secundarios
	$( '#trainers-sec li input' ).change( validaTrainSec );
	
	// Avancar assessment
	$( '#avancar-assessment' ).click( avancaAssessment );
	
	// Avancar testclass
	$( '#avancar-testclass' ).click( avancaTestclass );
	
	// Avancar practicaltraining
	$( '#avancar-practicaltraining' ).click( avancaPracticalTraining );
	
	// Avancar attendence
	$( '#avancar-attendence' ).click( avancaAttendence );
	
	// Avancar teste
	$( '#avancar-teste' ).click( avancaTest );
	
	// Avanca Evolucao
	$( '#avancar-evolucao' ).click( avancaEvolucao );
	
	// Trata valores de evolucao
	$( '#evolucao-itens input' ).change( evolucaoValores );
	
	$( '#num_year' ).change(
	    function()
	    {
		$( '#num_year_short' ).val( $( this ).val() );
	    }
	);
	    
	$( '.float' ).autoNumeric( "init", {vMax: '10', mDec: '1', wEmpty: 'zero', lZero: 'deny'});
    }
);
    
function editItem()
{
    if ( !gridTreinamento.getSelectedId() ) {
	msgAlerta( t( 'Selecione o item para edição', 20 ) );
	return false;
    }

    var id = gridTreinamento.getSelectedId();
    location.href = baseUrl + '/treinamento/treinamento/cadastro/id/' + id;
    return true;
}
 
var gridTreinamento;
function initGridTreinamento()
{
    if ( !$( '#gridTreinamento' ).length )
	return false;
    
    header = "#," + t( 'TURMA', 223 ) + 
	     ',' + t( 'DESKRISAUN', 172 ) + 
	     ',' + t( 'PARTISIPANTE HIRA', 224 ) + 
	     ',' + t( 'STATUS', 22 );
    
    gridTreinamento = new dhtmlXGridObject( 'gridTreinamento' );
    gridTreinamento.setHeader( header );
    gridTreinamento.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter,#select_filter" );
    gridTreinamento.setInitWidths( "50,*,350,200,100" );
    gridTreinamento.setColAlign( "center,left,left,left,left" );
    gridTreinamento.setColTypes( "ro,ro,ro,ro,ro" );
    gridTreinamento.setColSorting( "str,str,str,str,str" );
    gridTreinamento.setSkin( config.grid );
    gridTreinamento.enablePaging( true, 30, 10, 'divPagTreinamento', true, 'divPagTreinamento' );
    gridTreinamento.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,{#stat_count}" );
    gridTreinamento.init();
    
    return true;
}

var gridParticipantes;
function initGridParticipantes()
{
    if ( !$( '#gridParticipantes' ).length )
	return false;
    
    header = '#,#master_checkbox' +
	     ',' + t( 'Nome', 10 ) + 
	     ',' + t( 'Sobrenome', 57 ) + 
	     ',' + t( 'Numero participante', 225 ) +
	     ',' + t( 'Sexo', 69 );
    
    gridParticipantes = new dhtmlXGridObject( 'gridParticipantes' );
    gridParticipantes.setHeader( header );
    gridParticipantes.attachHeader( "#rspan,#rspan,#text_filter,#text_filter,#text_filter,#text_filter" );
    gridParticipantes.setInitWidths( "50,50,*,250,200,100" );
    gridParticipantes.setColAlign( "center,center,left,left,left,left" );
    gridParticipantes.setColTypes( "ro,ch,ro,ro,ro,ro" );
    gridParticipantes.setColSorting( "str,str,str,str,str,str" );
    gridParticipantes.setSkin( config.grid );
    gridParticipantes.enablePaging( true, 30, 10, 'divPagParticipantes', true, 'divPagParticipantes' );
    gridParticipantes.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,#cspan,{#stat_count}" );
    gridParticipantes.init();
    
    return true;
}

var gridTurmaParticipantes;
function initGridTurmaParticipantes()
{
    if ( !$( '#gridTurmaParticipantes' ).length )
	return false;
    
    header = '#,#master_checkbox' +
	     ',' + t( 'Nome', 10 ) + 
	     ',' + t( 'Numero participante', 225 ) +
	     ',' + t( 'Sexo', 69 );
    
    gridTurmaParticipantes = new dhtmlXGridObject( 'gridTurmaParticipantes' );
    gridTurmaParticipantes.setHeader( header );
    gridTurmaParticipantes.attachHeader( "#rspan,#rspan,#text_filter,#text_filter,#text_filter" );
    gridTurmaParticipantes.setInitWidths( "50,50,*,200,100" );
    gridTurmaParticipantes.setColAlign( "center,center,left,left,left" );
    gridTurmaParticipantes.setColTypes( "ro,ch,ro,ro,ro" );
    gridTurmaParticipantes.setColSorting( "str,str,str,str,str" );
    gridTurmaParticipantes.setSkin( config.grid );
    gridTurmaParticipantes.enablePaging( true, 30, 10, 'divPagTurmaParticipantes', true, 'divPagTurmaParticipantes' );
    gridTurmaParticipantes.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,{#stat_count}" );
    gridTurmaParticipantes.init();
    
    return true;
}

var gridParticipantesTeste;
function initGridParticipantesTeste()
{
    if ( !$( '#gridParticipantesTeste' ).length )
	return false;
    
    header = '#,' + t( 'Nome', 10 ) + 
	     ',' + t( 'Sobrenome', 57 ) + 
	     ',' + t( 'Numero participante', 225 ) +
	     ',' + t( 'Sexo', 69 );
    
    gridParticipantesTeste = new dhtmlXGridObject( 'gridParticipantesTeste' );
    gridParticipantesTeste.setHeader( header );
    gridParticipantesTeste.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter,#text_filter" );
    gridParticipantesTeste.setInitWidths( "50,*,250,200,100" );
    gridParticipantesTeste.setColAlign( "center,left,left,left,left" );
    gridParticipantesTeste.setColTypes( "ro,ro,ro,ro,ro" );
    gridParticipantesTeste.setColSorting( "str,str,str,str,str" );
    gridParticipantesTeste.setSkin( config.grid );
    gridParticipantesTeste.attachEvent( 'onRowSelect', clearTests );
    gridParticipantesTeste.enablePaging( true, 30, 10, 'divPagParticipantesTeste', true, 'divPagParticipantesTeste' );
    gridParticipantesTeste.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,{#stat_count}" );
    gridParticipantesTeste.init();
    
    return true;
}

var gridParticipantesAssessment;
function initGridParticipantesAssessment()
{
    if ( !$( '#gridParticipantesAssessment' ).length )
	return false;
    
    header = '#,' + t( 'Nome', 10 ) + 
	     ',' + t( 'Sobrenome', 57 ) + 
	     ',' + t( 'Numero participante', 225 ) +
	     ',' + t( 'Sexo', 69 );
    
    gridParticipantesAssessment = new dhtmlXGridObject( 'gridParticipantesAssessment' );
    gridParticipantesAssessment.setHeader( header );
    gridParticipantesAssessment.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter,#text_filter" );
    gridParticipantesAssessment.setInitWidths( "50,*,250,200,100" );
    gridParticipantesAssessment.setColAlign( "center,left,left,left,left" );
    gridParticipantesAssessment.setColTypes( "ro,ro,ro,ro,ro" );
    gridParticipantesAssessment.setColSorting( "str,str,str,str,str" );
    gridParticipantesAssessment.setSkin( config.grid );
    gridParticipantesAssessment.attachEvent( 'onRowDblClicked', assessmentParticipant );
    gridParticipantesAssessment.enablePaging( true, 30, 10, 'divPagParticipantesAssessment', true, 'divPagParticipantesAssessment' );
    gridParticipantesAssessment.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,{#stat_count}" );
    gridParticipantesAssessment.init();
    
    return true;
}

var gridParticipantesTestClass;
function initGridParticipantesTestClass()
{
    if ( !$( '#gridParticipantesTestClass' ).length )
	return false;
    
    header = '#,' + t( 'Nome Completo', 530 ) + 
	     ',' + t( 'Numero participante', 225 ) +
	     ',' + t( 'Sexo', 69 );
    
    gridParticipantesTestClass = new dhtmlXGridObject( 'gridParticipantesTestClass' );
    gridParticipantesTestClass.setHeader( header );
    gridParticipantesTestClass.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter" );
    gridParticipantesTestClass.setInitWidths( "50,*,200,100" );
    gridParticipantesTestClass.setColAlign( "center,left,left,left" );
    gridParticipantesTestClass.setColTypes( "ro,ro,ro,ro" );
    gridParticipantesTestClass.setColSorting( "str,str,str,str" );
    gridParticipantesTestClass.setSkin( config.grid );
    gridParticipantesTestClass.attachEvent( 'onRowDblClicked', testClassParticipante );
    gridParticipantesTestClass.enablePaging( true, 30, 10, 'divPagParticipantesTestClass', true, 'divPagParticipantesTestClass' );
    gridParticipantesTestClass.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridParticipantesTestClass.init();
    
    return true;
}

var gridParticipantesPracticalTraining;
function initGridParticipantesPracticalTraining()
{
    if ( !$( '#gridParticipantesPracticalTraining' ).length )
	return false;
    
    header = '#,' + t( 'Nome Completo', 530 ) + 
	     ',' + t( 'Numero participante', 225 ) +
	     ',' + t( 'Sexo', 69 );
    
    gridParticipantesPracticalTraining = new dhtmlXGridObject( 'gridParticipantesPracticalTraining' );
    gridParticipantesPracticalTraining.setHeader( header );
    gridParticipantesPracticalTraining.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter" );
    gridParticipantesPracticalTraining.setInitWidths( "50,*,200,100" );
    gridParticipantesPracticalTraining.setColAlign( "center,left,left,left" );
    gridParticipantesPracticalTraining.setColTypes( "ro,ro,ro,ro" );
    gridParticipantesPracticalTraining.setColSorting( "str,str,str,str" );
    gridParticipantesPracticalTraining.setSkin( config.grid );
    gridParticipantesPracticalTraining.attachEvent( 'onRowDblClicked', practicalTrainingParticipante );
    gridParticipantesPracticalTraining.enablePaging( true, 30, 10, 'divPagParticipantesPracticalTraining', true, 'divPagParticipantesPracticalTraining' );
    gridParticipantesPracticalTraining.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridParticipantesPracticalTraining.init();
    
    return true;
}

var gridParticipantesAttendence;
function initGridParticipantesAttendence()
{
    if ( !$( '#gridParticipantesAttendence' ).length )
	return false;
    
    header = '#,' + t( 'Nome Completo', 530 ) + 
	     ',' + t( 'Numero participante', 225 ) +
	     ',' + t( 'Sexo', 69 );
    
    gridParticipantesAttendence = new dhtmlXGridObject( 'gridParticipantesAttendence' );
    gridParticipantesAttendence.setHeader( header );
    gridParticipantesAttendence.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter" );
    gridParticipantesAttendence.setInitWidths( "50,*,200,100" );
    gridParticipantesAttendence.setColAlign( "center,left,left,left" );
    gridParticipantesAttendence.setColTypes( "ro,ro,ro,ro" );
    gridParticipantesAttendence.setColSorting( "str,str,str,str" );
    gridParticipantesAttendence.setSkin( config.grid );
    gridParticipantesAttendence.attachEvent( 'onRowDblClicked', attendenceParticipante );
    gridParticipantesAttendence.enablePaging( true, 30, 10, 'divPagParticipantesAttendence', true, 'divPagParticipantesAttendence' );
    gridParticipantesAttendence.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridParticipantesAttendence.init();
    
    return true;
}

function attendenceParticipante( id )
{
    $( '#fk_id_client' ).val( id );
    $( '.attendence-container input' ).val( 0 );
    
    $.ajax({
	type: 'POST',
	data: {
	    client: id,
	    student_class: $( '#id_student_class' ).val()
	},
	dataType: 'json',
	url: baseUrl + '/treinamento/treinamento/searchattendence/',
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
	    $( '#name-participant' ).html( response.participant );
	    $('#option-field-attendance').removeAttr('checked').trigger('change');
	    
	    for ( i in response.test ) {
		var type = response.test[i].type;
		
		if ( 'F' == type && response.test[i].sick == null ) {
		    
		    $('#option-field-attendance').attr('checked', true).trigger('change');
		    
		} else {

		    for ( x in response.test[i] ) {

			id =  'C' == type ? 'class-attendance' : 'field-attendance';
			$( '#' + id + ' input#' + x ).val( response.test[i][x] );
		    }
		
		}
	    }
	    
	    calcPresentAttendence();
	    
	    $( '#sick' ).focus();
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao buscar Attendence', 531 ) );
	}
    });
}

function practicalTrainingParticipante( id )
{
    $( '#fk_id_client' ).val( id );
    $( '.practical-training-container input' ).val( 0 );
    
    $.ajax({
	type: 'POST',
	data: {
	    client: id,
	    student_class: $( '#id_student_class' ).val()
	},
	dataType: 'json',
	url: baseUrl + '/treinamento/treinamento/searchpracticaltraining/',
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
	    $( '#name-participant' ).html( response.participant );
	    $('.optional-check').removeAttr('checked').trigger('change');
	    
	    for ( i in response.test ) {
		var value = response.test[i];
		
		if ( value == null ) {
		    
		    if ( $('#option-' + i ).length )
			$('#option-' + i ).attr('checked', true).trigger('change');
		    
		} else {
		    value = toFloat( value ).toFixed( 1 );
		}

		$( '.practical-training-container input#' + i ).val( value );
	    }
	    
	    $( '#road_construction' ).focus();
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao buscar pracitcal training', 532 ) );
	}
    });
}

function testClassParticipante( id )
{
    $( '#fk_id_client' ).val( id );
    $( '.testclass-container input' ).val( 0 );
    
    $.ajax({
	type: 'POST',
	data: {
	    client: id,
	    student_class: $( '#id_student_class' ).val()
	},
	dataType: 'json',
	url: baseUrl + '/treinamento/treinamento/searchtestclass/',
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
	    $( '#name-participant' ).html( response.participant );
	    
	    $('.optional-check').removeAttr('checked').trigger('change');
	    
	    for ( i in response.test ) {
		var value = response.test[i];
		
		if ( value == null ) {
		    
		    if ( $('#option-' + i ).length )
			$('#option-' + i ).attr('checked', true).trigger('change');
		    
		} else {
		    value = toFloat( value ).toFixed( 1 );
		}
		
		$( '.testclass-container input#' + i ).val( value );
	    }
	    
	    $( '#pre_test' ).focus();
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao buscar testes', 266 ) );
	}
    });
}


function somaTotalParticipantes()
{
    var man = parseInt( $( '#man_student' ).val() );
    var woman = parseInt( $( '#woman_student' ).val() );
    
    $( '#total_student' ).val( man + woman );
}

function somaTotalDiasTreino()
{
    var classe = parseInt( $( '#class_days' ).val() );
    var field = parseInt( $( '#field_days' ).val() );
    
    $( '#duration_time' ).val( classe + field );
}

function saveGeral( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error )
		location.href = baseUrl + '/treinamento/treinamento/endereco/id/' + response.id;
	},
	validate: function()
	{
	    if ( $( '#start_date').inputmask( 'unmaskedvalue' ).length != 8 ) {
		
		msgAlerta( t( 'Data inicial inválida', 215 ) );
		return false;
	    }
	    
	    if ( $( '#start_date').inputmask( 'unmaskedvalue' ).length != 8 ) {
		
		msgAlerta( t( 'Data final inválida', 216 ) );
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
		location.href = baseUrl + '/treinamento/treinamento/turma/id/' + response.id;
	}
    };
    
    return submitAjax( form, obj );
}

function buscaUnidadesCompentencia( units )
{
    $( '#unit-compentency' ).empty();
    
    var course = $( '#fk_id_course' ).val();
    if ( empty( course ) )
	return false;
    
    $.ajax({
	type: 'POST',
	data: {id: course},
	dataType: 'json',
	url: baseUrl + '/treinamento/treinamento/unidadescompentencia/',
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
		
		var li = $( '<li />' );
		var id = 'units_competency_' + response[i].id;
		
		var input = $( '<input />' );
		input.attr( 'type', 'checkbox' )
		     .attr( 'name', 'units_competency[]' )
		     .attr( 'id', id )
		     .val( response[i].id );
		     
		var label = $( '<label />' );
		label.attr( 'for', id ).html( response[i].name ).prepend( input );
		
		if ( units && $.inArray( response[i].id, units ) > -1 )
		    input.attr( 'checked', true );
		
		li.append( label );
		
		$( '#unit-compentency' ).append( li );
	    }
	},
	error: function ()
	{
	    msgAlerta( t( 'Erro ao buscar unidades de compentência', 226 ) );
	    $( '#unit-compentency' ).empty();
	}
    });
    
    return true;
}

function saveTurma( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error )
		location.href = baseUrl + '/treinamento/treinamento/participantes/id/' + response.id;
	},
	validate: function()
	{
	    /*
	    if ( $( '#unit-compentency input' ).filter( function(){return $( this ).attr( 'checked' );} ).length < 1 ) {
		
		msgAlerta( t( 'Selecione alguma unidade de compentência', 227 ) );
		return false;
	    }
	    */
	    
	    if ( $( '#trainers-sec input' ).filter( function(){return $( this ).attr( 'checked' );} ).length < 1 ) {
		
		msgAlerta( t( 'Selecione algum treinador assistente', 264 ) );
		return false;
	    }
	    
	    return true;
	}
    };
    
    return submitAjax( form, obj );
}

/**
 * 
 */
function addParticipantes()
{
    participantes = gridParticipantes.getCheckedRows(1);
    if ( empty( participantes ) ) {
	
	msgAlerta( t( 'Selecione os participantes para inserir na turma.', 228 ) );
	return false;
    }
    
    participantesTurma = gridTurmaParticipantes.getAllRowIds( ',' );
    participantesTurma = empty( participantesTurma ) ? [] : participantesTurma.split( ',' );
    
    data = [];
    for ( i in participantes ) {
	if ( $.inArray( participantes[i], participantesTurma ) < 0 )
	    data.push( participantes[i] );
    }
    
    if ( empty( data ) ) {
	
	msgAlerta( t( 'Todos participantes selecionados já estão na turma.', 217 ) );
	return false;
    }
    
    var total = data.length + participantesTurma.length;
        
    if ( total > parseInt( $( '#total_student').val() ) ) {
	
	msgAlerta( t( 'Quantidade de participantes ultrapassa a definida. Verifique.', 218 ) );
	return false;
    }
    
    $.ajax({
	type: 'POST',
	data: {
	    id: $( '#id_student_class' ).val(),
	    students: participantes
	},
	dataType: 'json',
	url: baseUrl + '/treinamento/treinamento/saveparticipantes/',
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
	    if ( response.error ) {
		
		msg = empty( response.msg ) ? t( 'Erro ao cadastrar participantes', 229 ) : response.msg;
		msgErro( msg );
		
	    } else {
		
		gridParticipantes.uncheckAll();
		loadParticipantesTurma();
	    }
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao cadastrar participantes.', 229 ) );
	}
    });
    
    return true;
}

function loadParticipantesTurma()
{
    loading( true );
    gridTurmaParticipantes.clearAll();
    gridTurmaParticipantes.load( baseUrl + '/treinamento/treinamento/listparticipantes/id/' + $( '#id_student_class' ).val(), function(){loading( false )}, 'json' );
}

function removeParticipantes()
{
    participantesTurma = gridTurmaParticipantes.getCheckedRows(1);
    if ( empty( participantesTurma ) ) {
	
	msgAlerta( t( 'Selecione os participantes para remover', 230 ) );
	return false;
    }
    
    if ( !confirm( t( 'Deseja realmente remover estes participantes?', 231 ) ) )
	return false;
    
    $.ajax({
	type: 'POST',
	data: {
	    id: $( '#id_student_class' ).val(),
	    students: participantesTurma
	},
	dataType: 'json',
	url: baseUrl + '/treinamento/treinamento/removeparticipantes/',
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
	    if ( response.error )
		msgErro( t( 'Erro ao remover participantes', 232 ) );
	    else {
		
		gridTurmaParticipantes.clearAll();
		loadParticipantesTurma();
	    }
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao remover participantes', 232 ) );
	}
    });
    
    return true;
}

function avancaParticipantes()
{
    participantes = gridTurmaParticipantes.getRowsNum();
    
    if ( empty( participantes ) ) {
	
	msgAlerta( t( 'Nenhum participante foi inserido', 233 ) );
	return false;
    }
    
    location.href = baseUrl + '/treinamento/treinamento/testclass/id/' + $( '#id_student_class' ).val();
    
    return true;
}

function validaTrainerPrinc()
{
    var trainerPrinc = $( '#fk_id_trainer_prin' ).val();
    if ( empty( trainerPrinc ) )
	return false;
    
    if ( $( '#trainers-sec li input' ).filter( function(){return $( this ).attr( 'checked' ) && $( this ).val() == trainerPrinc ;} ).length > 0 ) {
	
	$( '#fk_id_trainer_prin' ).val( '' );
	msgAlerta( t( 'Treinador principal já definido como assistente', 234 ) );
	return false;
    }
    
    return true;
}

function validaTrainSec( event )
{
    var element =  $( event.target );
    var trainerPrinc = $( '#fk_id_trainer_prin' ).val();
    
    if ( empty( trainerPrinc ) || !element.attr( 'checked' ) )
	return false;
    
    if ( element.val() == trainerPrinc ) {
	
	element.attr( 'checked', false );
	msgAlerta( t( 'Treinador secundário já definido como principal', 235 ) );
	return false;
    }
    
    return true;
}

function unselectTests()
{
    $( '#buttons-test .button' ).removeClass( 'green_button' ).addClass( 'gray_button' );
}

function searchTest( type, button )
{
    unselectTests();
		
    $( button ).parent().removeClass( 'gray_button' ).addClass( 'green_button' );
    
    var cli = gridParticipantesTeste.getSelectedId();
    if ( empty( cli ) ) {
	
	msgAlerta( t( 'Selecione o participante para efetuar o teste', 265 ) );
	return false;
    }
    
    $( '#type' ).val( type );
    
    $.ajax({
	type: 'POST',
	data: {
	    id: $( '#id_student_class' ).val(),
	    type: type,
	    cli: cli
	},
	dataType: 'json',
	url: baseUrl + '/treinamento/treinamento/searchtest/',
	beforeSend: function()
	{
	    loading( true );
	    $( '#lista-competencias' ).empty();
	},
	complete: function()
	{
	    loading( false );
	},
	success: function ( response )
	{
	    if ( response.error ) {
		
		msg = empty( response.msg ) ? t( 'Erro ao buscar testes', 266 ) : response.msg;
		msgAlerta( msg );
		
	    } else {
		
		$( '#score' ).val( response.media );
		createCompetencyTest( response.unidades );
	    }
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao buscar testes', 266 ) );
	}
    });
    
    return false;
}

function createCompetencyTest( response )
{
    cont = 1;
    for ( i in response ) {

	tr = $( '<tr />' );
	tr.append( $( '<td />' ).html( cont++ ) );

	td = $( '<td />' );

	input = $( '<input />' );
	input.attr( 'type', 'hidden' )
		.attr( 'name', 'competency[]' )
		.val( response[i].id );

	td.html( response[i].competency ).prepend( input );
	tr.append( td );

	td = $( '<td />' );

	div = $( '<div />' );
	div.addClass( 'inputs' );

	span = $( '<span />' );
	span.addClass( 'input_wrapper medium_input' );

	score = $( '<input />' );
	score.attr( 'type', 'text' )
		.attr( 'name', 'score_competency[]' )
		.attr( 'msgError', t( 'Preencha este score', 267 ) )
		.addClass( 'text required tip-error text-numeric score-competency' )
		.val( response[i].score );

	tr.append( td.append( div.append( span.append( score ) ) ) );
	
	$( '#lista-competencias' ).append( tr );
    }
    
    $( '.text-numeric' ).inputmask( {'mask': 't', 'repeat': 1, 'greedy': false} );
    
    $( '.score-competency' ).change(
	function()
	{
	    var total = 0;
	    $( '.score-competency' ).each(
		function( index, element )
		{
		    value = $( element ).val();
		    
		    if ( empty( value ) ) {
			
			$( element ).val( 0 )
			value = 0;
		    }
		    
		    total += parseInt( value );
		}
	    );
	
	    total = total / parseInt( $( '.score-competency' ).length );
	    $( '#score' ).val( total.toFixed( 0 ) );
	}
    );
}

function clearTests()
{
    $( '#lista-competencias' ).empty();
    $( '#score' ).val( 0 );
    $( '#fk_id_client' ).val( gridParticipantesTeste.getSelectedId() );
    $( '#type' ).val( '' );
    unselectTests();
}

function buscarParticipantes()
{
    $.ajax({
	type: 'POST',
	data: {
	    name: $( '#cli_name' ).val(),
	    num: $( '#cli_num' ).val()
	},
	dataType: 'json',
	url: baseUrl + '/treinamento/treinamento/buscaparticipantes/',
	beforeSend: function()
	{
	    loading( true );
	    gridParticipantes.clearAll();
	},
	complete: function()
	{
	    loading( false );
	},
	success: function ( response )
	{
	    gridParticipantes.parse( response, 'json' );
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao buscar participantes', 268 ) );
	}
    });
    
    return false;
}

function saveTeste( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error )
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
	},
	validate: function()
	{
	    if ( empty( $( '#fk_id_client' ).val() ) ) {
		
		msgAlerta( t( 'Selecione o participante para efetuar o teste', 265 ) );
		return false;
	    }
	    
	    if ( empty( $( '#type' ).val() ) ) {
		
		msgAlerta( t( 'Selecione o teste para realizar a execução', 269 ) );
		return false;
	    }
	    
	    if ( $( '#lista-competencias tr' ).length < 1 ) {
		
		msgAlerta( t( 'Sem unidades de compentência para realizar teste', 270 ) );
		return false;
	    }

	    return true;
	}
    };
    
    return submitAjax( form, obj );
}

function avancaAssessment()
{
    location.href = baseUrl + '/treinamento/treinamento/teste/id/' + $( '#id_student_class' ).val();
}

function avancaTestclass()
{
    location.href = baseUrl + '/treinamento/treinamento/practicaltraining/id/' + $( '#id_student_class' ).val();
}

function avancaPracticalTraining()
{
    location.href = baseUrl + '/treinamento/treinamento/attendence/id/' + $( '#id_student_class' ).val();
}

function avancaAttendence()
{
    location.href = baseUrl + '/treinamento/treinamento/evolucao/id/' + $( '#id_student_class' ).val();
}

function avancaTest()
{
    location.href = baseUrl + '/treinamento/treinamento/evolucao/id/' + $( '#id_student_class' ).val();
}

function avancaEvolucao()
{
    if ( empty( $( '#has_evolucao' ).val() ) )
	return false;
    
    location.href = baseUrl + '/treinamento/treinamento/finaliza/id/' + $( '#id_student_class' ).val();
    return true;
}

function assessmentParticipant( id )
{
    $( '#fk_id_client' ).val( id );
    $( '.assessment-container select' ).val( '' );
    
    name = gridParticipantesAssessment.cells( id, 1 ).getValue();
    lastName = gridParticipantesAssessment.cells( id, 2 ).getValue();
    cod = gridParticipantesAssessment.cells( id, 3 ).getValue();
    
    var completeName = cod + ' - ' + name + ' ' + lastName;
    $( '#name-participant' ).html( completeName );
    
    $.ajax({
	type: 'POST',
	data: {
	    client: id,
	    student_class: $( '#id_student_class' ).val()
	},
	dataType: 'json',
	url: baseUrl + '/treinamento/treinamento/searchassessment/',
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
		
		var test = response[i].type.toLowerCase();
		$( '#assessment_' + test ).val( response[i].score );
	    }
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao buscar testes', 266 ) );
	}
    });
}

function saveTestclass( form )
{
    var obj = {
	callback: function( response )
	{
	    //if ( !response.error )
		//msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
	},
	validate: function()
	{
	    if ( empty( $( '#fk_id_client' ).val() ) ) {
		
		msgAlerta( t( 'Selecione o participante.', 503 ) );
		return false;
	    }

	    return true;
	}
    };
    
    return submitAjax( form, obj );
}

function savePracticaltraining( form )
{
    var obj = {
	callback: function( response )
	{
	    //if ( !response.error )
	//	msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
	},
	validate: function()
	{
	    if ( empty( $( '#fk_id_client' ).val() ) ) {
		
		msgAlerta( t( 'Selecione o participante.', 503 ) );
		return false;
	    }

	    return true;
	}
    };
    
    return submitAjax( form, obj );
}

function saveAttendence( form )
{
    var obj = {
	callback: function( response )
	{
	    //if ( !response.error )
		//msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		
	    $( '.short_input :input' ).removeAttr( 'disabled' );
	},
	validate: function()
	{
	    if ( empty( $( '#fk_id_client' ).val() ) ) {
		
		msgAlerta( t( 'Selecione o participante.', 503 ) );
		return false;
	    }

	    return true;
	}
    };
    
    return submitAjax( form, obj );
}

function submitAttendence( flag )
{
    $( '#type' ).val( flag );
    if ( 'C' == flag ) {
	
	$( '#field-attendance .short_input :input' ).attr( 'disabled', true );
	$( '#class-attendance .short_input :input' ).removeAttr( 'disabled' );
	
    } else {
	
	$( '#class-attendance .short_input :input' ).attr( 'disabled', true );
	$( '#field-attendance .short_input :input' ).removeAttr( 'disabled' );
    }

    $( '#form-treinamento-attendence' ).submit();
}

function saveAssessment( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error )
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
	},
	validate: function()
	{
	    if ( empty( $( '#fk_id_client' ).val() ) ) {
		
		msgAlerta( t( 'Selecione o participante.', 503 ) );
		return false;
	    }

	    return true;
	}
    };
    
    return submitAjax( form, obj );
}

function evolucaoValores( event )
{
    var element =  $( event.target );
    
    if ( empty( element.val() ) )
	return false;
    
    var total = 0;
    element.closest( 'tr' ).find( 'input' ).each(
	function( index, input )
	{
	    total += parseInt( $( input ).val() );
	}
    );
	
    // Se ultrapassa total de participantes da turma
    if ( total > parseInt( $( '#total_student' ).val() ) ) {
	
	msgAlerta(  t( 'Ultrapassou total de alunos.', 504 )  );
	element.val( 0 );
    }
    
    var indexPai = element.closest( 'td' ).index();
    
    var subTotal = 0;
    $( '#evolucao-itens tr' ).each(
	function( index, tr )
	{
	    value = $( tr ).find( 'td input' ).eq( indexPai - 1 ).val();
	    value = empty( value ) ? 0 : value;
	    subTotal += parseInt( value );
	}
    );
	
    $( '#evolucao-itens' ).parent().find( 'tfoot th input' ).eq( indexPai - 1 ).val( subTotal );
    
    return true;
}

function saveEvolucao( form )
{
    $( '#evolucao-itens input' ).each(
	function( index, element )
	{
	    if ( empty( $( element ).val() ) )
		$( element ).val( 0 );
	}
    );
    
    var obj = {
	callback: function( response )
	{
	    if ( !response.error ) {
		
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		$( '#has_evolucao' ).val( 1 );
	    }
	}
    };
    
    return submitAjax( form, obj );
}

function saveFinaliza( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error ) {
		
		msgSucesso( t( 'Turma finalizada com sucesso', 505 ) );
		$( '.row-button' ).remove();
	    }
	}
    };
    
    return submitAjax( form, obj );
}

function calcFinalScoreTestClass()
{
    var finalTest = toFloat( $( '#final_test' ).val() );
    var finalScore = finalTest;
    
    if ( !$('#understanding').hasClass('optional-field') ) {
	
	var understanding = toFloat( $( '#understanding' ).val() );
	finalScore = ( finalTest * 0.6 ) + ( understanding * 0.4 );
    }
    
    finalScore = isNaN( finalScore ) ? 0 : finalScore;
    $( '#final_score' ).val( finalScore.toFixed( 2 ) );
}

function calcFinalScorePracticalTraining()
{
    var roadConstruction = null;
    var discipline = null;
    var finalScore = 0;
    
    if ( !$('#road_construction').hasClass('optional-field') )
	roadConstruction = toFloat( $( '#road_construction' ).val() );
	
    if ( !$('#discipline').hasClass('optional-field') )
	discipline = toFloat( $( '#discipline' ).val() );
    
    if ( roadConstruction !== null && discipline !== null )
	finalScore = ( roadConstruction * 0.6 ) + ( discipline * 0.4 );
    
    if ( roadConstruction === null )
	finalScore = discipline;
    
    if ( discipline === null )
	finalScore = roadConstruction;
    
    finalScore = empty( finalScore ) ? 0 : finalScore;
    $( '#final_score' ).val( finalScore.toFixed( 2 ) );
}

function calcPresentAttendence()
{
    $( '.attendance-values' ).each(
	function()
	{  	    
            var sick = toFloat( $( this ).find( '#sick' ).eq( 0 ).val() );
	    var permission = toFloat( $( this ).find( '#permission' ).eq( 0 ).val() );
	    var absence = toFloat( $( this ).find( '#absence' ).eq( 0 ).val() );
	    var durationTime = toFloat( $( '#duration_time' ).val() );
	    var classeDays = toFloat( $( '#class_days' ).val() );
	    var fieldDays = toFloat( $( '#field_days' ).val() );
	    
	    var present = durationTime - absence - sick - permission;
	    
            var presentClass = classeDays - absence - sick - permission;
            
            presentClass = isNaN( presentClass ) ? 0 : presentClass;
	    $( this ).find( '#present_class' ).eq( 0 ).val( presentClass );
	    
	    var presentPercentClass = ( presentClass / classeDays ) * 100;
	    $( this ).find( '#present_percent_class' ).eq( 0 ).val( presentPercentClass.toFixed( 2 ) );
            
	    if ( !empty( fieldDays ) ) {
		var presentField = fieldDays - absence - sick - permission;

		presentField = isNaN( presentField ) ? 0 : presentField;
		$( this ).find( '#present' ).eq( 0 ).val( presentField );

		var presentPercent = ( presentField / fieldDays ) * 100;

		if ( isNaN(presentPercent) )
		    presentPercent = 0;
	    } else {
		
		$('#field-attendance :input').val(0).attr('disabled', true);
		presentPercent = 100;
	    }
	    
	    $( this ).find( '#present_percent' ).eq( 0 ).val( presentPercent.toFixed( 2 ) );
	}
    );
    
    checkPresentAttendence();
}

function checkPresentAttendence()
{
    if ( empty( $( '#fk_id_client').val() ) )
	return;
     
     var presentPercentClass = toFloat( $( '#class-attendance #present_percent_class' ).val() );
     var presentPercentField = $('#option-field-attendance').is(':checked') ? 100 : toFloat( $( '#field-attendance #present_percent' ).val() );
     
     if ( presentPercentClass >= 75 && presentPercentField >= 75 )
	 $( '#check-present' ).removeClass( 'failed' ).addClass( 'passed' ).html( t( 'Passou', 533 ) );
     else
	 $( '#check-present' ).removeClass( 'passed' ).addClass( 'failed' ).html( t( 'Falhou', 534 ));
}