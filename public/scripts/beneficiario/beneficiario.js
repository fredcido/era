$( document ).ready(
    function()
    {
	$( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/beneficiario/beneficiario/cadastro';
	    }
	);
	    
	$( '#editar' ).click( editItem );
	    
	$( '#date_payment' ).change( validaDataPagamento );
    }
);
    
function editItem()
{
    if ( !gridBeneficiario.getSelectedId() ) {
	msgAlerta( t( 'Selecione o item para edição', 20 ) );
	return false;
    }

    var id = gridBeneficiario.getSelectedId();
    location.href = baseUrl + '/beneficiario/beneficiario/geral/id/' + id;
    return true;
}
    
var gridProjetos;
var eventGridProjetos;
function initGridProjetos()
{
    if ( !$( '#gridProjetos' ).length )
	return false;
    
    header = "#," + t( 'Project Cod', 38 ) + ',' + t( 'Contractor name', 49 ) + ',' + t( 'ILO Contract', 50 );
    
    gridProjetos = new dhtmlXGridObject( 'gridProjetos' );
    gridProjetos.setHeader( header );
    gridProjetos.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter" );
    gridProjetos.setInitWidths( "50,*,350,200" );
    gridProjetos.setColAlign( "center,left,left,left" );
    gridProjetos.setColTypes( "ro,ro,ro,ro" );
    gridProjetos.setColSorting( "str,str,str,str" );
    gridProjetos.setSkin( config.grid );
    gridProjetos.enablePaging( true, 30, 10, 'divPagProjetos', true, 'divPagProjetos' );
    eventGridProjetos = gridProjetos.attachEvent( 'onRowSelect', function( id ){location.href = baseUrl + '/beneficiario/beneficiario/geral/project/' + id} );
    gridProjetos.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridProjetos.init();
    
    return true;
}

var gridBeneficiario;
function initGridBeneficiario()
{
    if ( !$( '#gridBeneficiario' ).length )
	return false;
    
    header = "#," + t( 'Número beneficiário', 55 ) + 
	     ',' + t( 'Primeiro nome', 56 ) + 
	     ',' + t( 'Sobrenome', 57 ) + 
	     ',' + t( 'Status', 22 );
    
    gridBeneficiario = new dhtmlXGridObject( 'gridBeneficiario' );
    gridBeneficiario.setHeader( header );
    gridBeneficiario.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter,#select_filter" );
    gridBeneficiario.setInitWidths( "50,*,350,200,100" );
    gridBeneficiario.setColAlign( "center,left,left,left,left" );
    gridBeneficiario.setColTypes( "ro,ro,ro,ro,ro" );
    gridBeneficiario.setColSorting( "str,str,str,str,str" );
    gridBeneficiario.setSkin( config.grid );
    gridBeneficiario.enablePaging( true, 30, 10, 'divPagBeneficiario', true, 'divPagBeneficiario' );
    gridBeneficiario.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,{#stat_count}" );
    gridBeneficiario.init();
    
    return true;
}

function calculaIdade()
{
    var dtNascimento = $( '#date_birth' ).val();
    if ( $( '#date_birth').inputmask( 'unmaskedvalue' ).length != 8 ) {
	
	$( '#age' ).val( '' );
	return false;
    }
	
    $.ajax({
	type: 'POST',
	data: {nasc: dtNascimento},
	dataType: 'json',
	url: baseUrl + '/beneficiario/beneficiario/calculaidade/',
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
	    if ( response.idade ) {
		$( '#age' ).val( response.idade );
	    } else {
		$( '#age' ).val( '' );
	    }
	},
	error: function ( response )
	{
	    $( '#age' ).val( '' );
	}
    });
    
    return true;
}

function saveGeral( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error )
		location.href = baseUrl + '/beneficiario/beneficiario/educacao/id/' + response.id;
	},
	validate: function()
	{
	    if ( $( '#date_birth').inputmask( 'unmaskedvalue' ).length != 8 ) {
		
		msgAlerta( t( 'Data de nascimento inválida', 78 ) );
		return false;
	    }
	    
	    if ( $( '#date_registration').inputmask( 'unmaskedvalue' ).length != 8 ) {
		
		msgAlerta( t( 'Data de registro inválida', 79 ) );
		return false;
	    }

	    return true;
	}
    };
    
    return submitAjax( form, obj );
}

function montaNumeroBenef()
{
    var subDistrict = $( '#fk_id_add_subdistrict' ).val();
    var registration = $( '#date_registration' ).val();
    
    if ( empty( subDistrict ) || empty( registration ) ) {
	
	$( '#cod_beneficiario' ).val( '' );
	return false;
    }
    
    $.ajax({
	type: 'POST',
	data: { sub: subDistrict, registration: registration },
	dataType: 'json',
	url: baseUrl + '/beneficiario/beneficiario/numerobeneficiario/',
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
	    if ( response.num ) {
		$( '#cod_beneficiario' ).val( response.num ).attr( 'disabled', true );
	    } else {
		$( '#cod_beneficiario' ).val( '' ).attr( 'disabled', false );
	    }
	},
	error: function ( response )
	{
	    $( '#cod_beneficiario' ).val( '' ).attr( 'disabled', false );
	}
    });
    
    return true;
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
		location.href = baseUrl + '/beneficiario/beneficiario/endereco/id/' + response.id;
	},
	validate: function()
	{
	    if ( $( '#vocational_training').val() == 'S' && $( '#formacao-profissional tbody tr' ).length < 1 ) {
		
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
		location.href = baseUrl + '/beneficiario/beneficiario/pagamento/id/' + response.id;
	}
    };
    
    return submitAjax( form, obj );
}

function calculaTotalSalario()
{
    var totalDias = $( '#total_days' ).val();
    var salarioDia = $( '#salary_day' ).val();
    
    if ( empty( totalDias ) || empty( salarioDia ) ) {
	
	$( '#total_salary' ).val( 0 );
	return false;
    }
    
    var totalSalary = parseInt( totalDias ) * toFloat( salarioDia );
    $( '#total_salary' ).val( parseFloat( totalSalary ) );
    
    return true;
}

function savePagamento( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error ) {
		
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		$( '#form-beneficiario-pagamento' )[0].reset();
		$( 'tbody#lista-pagamentos' ).load( baseUrl + '/beneficiario/beneficiario/listapagamentos/id/' + response.id );
	    }
	}
    };
    
    return submitAjax( form, obj );
}

function excluiPagamento( pagamento, link )
{
    if ( !confirm( t( 'Deseja remover este item?', 93 ) ) )
	return false;
    
    $.ajax({
	type: 'POST',
	data: pagamento,
	dataType: 'json',
	url: baseUrl + '/beneficiario/beneficiario/removerpagamento/',
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

function buscaBeneficiarios( form )
{
    $.ajax({
	type: 'POST',
	data: $( form ).serialize(),
	dataType: 'json',
	url: form.action,
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
	   gridBeneficiario.clearAll();
	   gridBeneficiario.parse( response, 'json' );
	},
	error: function ()
	{
	   gridBeneficiario.clearAll();
	}
    });
    
    return false;
}


function validaDataPagamento()
{
    date = $( '#date_payment' ).val();
    if ( empty( date ) )
	return false;
    
    now = new Date();
    date = new Date( date.split( '/' ).reverse().join( '-' ) );
    
    if ( date.getTime() > now.getTime() ) {
	
	msgErro( t( 'Data de pagamento não pode ser maior que a data atual.', 171 ) );
	$( '#date_payment' ).val( '' ).focus();
    }
    
    return false;
}