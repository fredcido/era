/**
 * 
 */
$(document).ready(
    function()
    {
        $( '.float' ).autoNumeric( "init", {vMax: '100', mDec: '5', wEmpty: 'zero', lZero: 'deny'})
        
        $( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/beneficiario/contrato/geral';
	    }
	);
	    
	$( '.money-contract' ).maskMoney( { showSymbol: true, allowZero: true } );
	    
	$( '#editar' ).click( editItem );
                
        $( '#date_finish_planned' ).change( validaDataPlanejamento );
                
        $( "#num_sequence" ).attr( 'readonly', true );
        $( "#num_district" ).attr("disabled",true);
        $( "#num_activity" ).attr( "disabled",true );
	
	$( '#busca-empresas' ).click( buscarEmpresas );
	
	$( '#add-empresa' ).click( salvaEmpresaContrato );
	$( '#remove-empresa' ).click( removeEmpresaContrato );
	
	$( '#category' ).change( obrigaContratoRegistro );
	
	// Calculos do Contract Record
	$( '#invoice_amount' ).blur( 
	    function()
	    {
                calcRecomendation();
                //alert("aqui");
//		calcRetention();
//		calcAdvances();
	    }
	);
        $( '#advances' ).blur(calcAdvances);
	$( '#retention' ).blur(calcRetention);
        $( '#amount').blur(calcWork);
	$( '#advances' ).change( calcNetPayment );
        $( '#retention' ).change( calcNetPayment );
	$( '#net_payment' ).change( calcContractBalance );
	$( '#indicator' ).blur( calcOtherValue );
	$( '#other_value' ).blur( calcOtherValue );
        $( '#type_amendment' ).click(
            function (){
                hideField ('type_amendment');
            }
        );
        $( '#type_amendment1' ).click( 
        function (){
                hideField ('type_amendment1');
            }
        );
    }
);

function editItem()
{
 
     if ( !gridContratos.getSelectedId() ) {
        msgAlerta( t( 'Selecione o item para edição', 20 ) );
        return false;
    }

    var id = gridContratos.getSelectedId();
    location.href = baseUrl + '/beneficiario/contrato/geral/id/' + id;
    return true;
 
}

var gridContratos;
function initGridContratos()
{
    if ( !$( '#gridContratos' ).length )
        return false;
    
    header = "#," + t( 'Project Cod', 38 ) + ',' + t( 'Contractor name', 49 ) + ',' + t( 'ILO Contract', 50 );
    
    gridContratos = new dhtmlXGridObject( 'gridContratos' );
    gridContratos.setHeader( header );
    gridContratos.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter" );
    gridContratos.setInitWidths( "50,*,350,200" );
    gridContratos.setColAlign( "center,left,left,left" );
    gridContratos.setColTypes( "ro,ro,ro,ro" );
    gridContratos.setColSorting( "str,str,str,str" );
    gridContratos.setSkin( config.grid );
    gridContratos.enablePaging( true, 30, 10, 'divPagContratos', true, 'divPagContratos' );
    gridContratos.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridContratos.init();
    
    return true;
}

function saveGeral( form )
{
    
    $( "#num_district" ).attr("disabled",false);
    $( "#num_activity" ).attr( "disabled",false );
    $( "#num_year" ).attr( "disabled",false );
    
    $( "#fk_id_add_district" ).attr( 'disabled', false );
    $( "#activity" ).attr( 'disabled', false );
    
    var obj = {
        callback: function( response )
        {
            
            if ( !response.error )
                location.href = baseUrl + '/beneficiario/contrato/registro/id/' + response.id;
        }
    };
    
    return submitAjax( form, obj );
}

function savePlanejamento( form )
{
    var obj = {
        callback: function( response )
        {
            
            if ( !response.error )
                location.href = baseUrl + '/beneficiario/contrato/execucao/id/' + response.id;
        }
    };
    
    return submitAjax( form, obj );
}

function saveExecucao( form )
{
    var obj = {
        callback: function( response )
        {
            
            if ( !response.error ){
                msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		location.href = baseUrl + '/beneficiario/contrato/geral';
            }
        }
    };
    
    return submitAjax( form, obj );
}

function savePagamento( form )
{
    var obj = {
        callback: function( response )
        {
            
            if ( !response.error ){
                msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		location.href = baseUrl + '/beneficiario/contrato/pagamento/id/'+response.id;
            }
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

function carregarFatinSuku( subdistrict, callback )
{
    
    if( !empty( subdistrict ) )
        subdistrict = subdistrict;
    else
        subdistrict = $('#subdistrict').val();
    
    $.ajax({
        type: 'POST',
        data: {
            fk_id_add_subdistrict: subdistrict
        },
        url: baseUrl + '/beneficiario/contrato/carregarfatinsuku/',
        dataType: 'json',
        beforeSend: function () 
        {
            $('#fatin_suku').attr('disabled', true);
            $('#fatin_suku').html('<option>Carregando...</option>');
        },
        success: function ( response ) 
        {
            $('#fatin_suku').empty();
			
            if ( response ) {
				
                for ( i in response ) {
                    $('#fatin_suku').append('<option>');
					
                    $('#fatin_suku option').eq(i).val(response[i].id_suku);
                    $('#fatin_suku option').eq(i).html(response[i].acronym);
                }
				
                $('#fatin_suku').attr('disabled', false);		
                $('#fatin_suku').focus();
		
		if ( callback )
		    callback();
	
            } else $('#fatin_suku').attr('disabled', true);
        },
        error: function ( response ) 
        {
            $('#fatin_suku').html('<option>Erro</option>');
        }
    });
    
    return true;
    
}

function carregarSubDistrict( district, callback )
{
    
    $('#num_district').val( district );
    
    $.ajax({
        type: 'POST',
        data: {
            fk_id_add_district: district
        },
        url: baseUrl + '/beneficiario/contrato/carregarsubdistrict/',
        dataType: 'json',
        beforeSend: function () 
        {
            $('#subdistrict').attr('disabled', true);
            $('#subdistrict').html('<option>Carregando...</option>');
        },
        success: function ( response ) 
        {
            $('#subdistrict').empty();
            $('#fatin_suku').empty();
			
            if ( response ) {
				
                for ( i in response ) {
                    
                    $('#subdistrict').append('<option>');
					
                    $('#subdistrict option').eq(i).val(response[i].id_add_subdistrict);
                    $('#subdistrict option').eq(i).html(response[i].acronym);
                }
				
                $('#subdistrict').attr('disabled', false);		
                $('#subdistrict').focus();
		
		if ( callback )
		    callback();
	
            } else $('#subdistrict').attr('disabled', true);
        },
        error: function ( response ) 
        {
            $('#subdistrict').html('<option>Erro</option>');
        }
    });
    
    return true;
    
}

function setNumActivity( id ){
    
    if( !empty( id ) )
        $('#num_activity').val( id );
    
}


function validaDataPlanejamento()
{
    
    date_start_planned = $( '#date_start_planned' ).val();
    date_finish_planned = $( '#date_finish_planned' ).val();
    
    if ( empty( date_start_planned ) )
	return false;
    
    date_start = new Date( date_start_planned.split( '/' ).reverse().join( '-' ) );
    date_finish = new Date( date_finish_planned.split( '/' ).reverse().join( '-' ) );
    
    if ( date_start.getTime() > date_finish.getTime() ) {
	
	msgErro( t( 'Data Hari não pode ser maior que a data Remata.', 250 ) );
	$( '#date_start_planned' ).val( '' ).focus();
	$( '#date_finish_planned' ).val( '' ).focus();
    }
    
    return false;
}

var gridEmpresas;
function initGridEmpresas()
{
    if ( !$( '#gridEmpresas' ).length )
        return false;
    
    header =  t( 'Selecione', 85 ) + "," + t( 'Código da Empresa', 339 ) + ',' + t( 'Naran Empreza', 304 ) + ',' + t( "Naran Diretor/Na'in", 313 );
    
    gridEmpresas = new dhtmlXGridObject( 'gridEmpresas' );
    gridEmpresas.setHeader( header );
    gridEmpresas.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter" );
    gridEmpresas.setInitWidths( "87,*,350,200" );
    gridEmpresas.setColAlign( "center,left,left,left" );
    gridEmpresas.setColTypes( "ra,ro,ro,ro" );
    gridEmpresas.setColSorting( "str,str,str,str" );
    gridEmpresas.setSkin( config.grid );
    gridEmpresas.enablePaging( true, 30, 10, 'divPagEmpresas', true, 'divPagEmpresas' );
    gridEmpresas.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridEmpresas.init();
    
    return true;
}

function buscarEmpresas()
{
    if ( !empty( $( '#enterprise').val() ) ) {
	
	msgErro( t( "ERRO: Ita boot iha rejistu empreza tiha ona ba kontraktu ne'e.", 497 ) );
	return false;
    }
    
    $.ajax({
	type: 'POST',
	data: {
	    name: $( '#enterprise_name' ).val(),
	    num: $( '#enterprise_id' ).val()
	},
	dataType: 'json',
	url: baseUrl + '/beneficiario/contrato/buscaempresas/',
	beforeSend: function()
	{
	    loading( true );
	    gridEmpresas.clearAll();
	},
	complete: function()
	{
	    loading( false );
	},
	success: function ( response )
	{
	    gridEmpresas.parse( response, 'json' );
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao buscar empresas', 498 ) );
	}
    });
    
    return false;
}

function salvaEmpresaContrato()
{
    if ( !empty( $( '#enterprise').val() ) ) {
	
	msgErro( t( "ERRO: Ita boot iha rejistu empreza tiha ona ba kontraktu ne'e.", 497 ) );
	return false;
    }
    
    var empresa = gridEmpresas.getCheckedRows(0);
    if ( empty( empresa ) ) {
	
	msgAlerta( t( 'Selecione a empresa', 499 ) );
	return false;
    }
    
    $.ajax({
	type: 'POST',
	data: {
	    empresa: empresa[0],
	    id_contract: $( '#id_contract' ).val()
	},
	dataType: 'json',
	url: baseUrl + '/beneficiario/contrato/saveempresa/',
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
		
		msgErro( t( 'Erro ao salvar empresa', 500 ) );
		$( '#empresa-selecionada' ).html( '' );
		
	    } else {
		
		$( '#empresa-selecionada' ).html( response.empresa );
		$( '#enterprise' ).val( response.empresa );
	    }
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao salvar empresa', 500 ) );
	    $( '#empresa-selecionada' ).html( '' );
	}
    });
    
    return false;
}

function removeEmpresaContrato()
{
    $.ajax({
	type: 'POST',
	data: {
	    id_contract: $( '#id_contract' ).val(),
	    empresa: null
	},
	dataType: 'json',
	url: baseUrl + '/beneficiario/contrato/saveempresa/',
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
		
		msgErro( t( 'Erro ao remover empresa', 501 ) );
	    } else {
		
		$( '#empresa-selecionada' ).html( '' );
		$( '#enterprise' ).val( '' );
	    }
		
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao remover empresa', 501 ) );
	}
    });
    
    return false;
}

var gridContractRecord;
function initGridContratosRecord()
{
    if ( !$( '#gridContractRecord' ).length )
        return false;
    
    header = t( 'Referência', 453 ) + ',#cspan,&nbsp;,&nbsp;,' + t( 'Progress Payment', 454 ) + ',#cspan,#cspan,#cspan,#cspan,#cspan,#cspan';
    subHeader = t( 'Data', 455 ) + ',' + t( 'Cert. No', 456 ) + ',' + t( 'Categoria', 457 ) + ',' + t( 'Origem Pag.', 458 ) +
		',' + t( 'Invoice Amount', 459 ) + ',' + t( 'Net Payment', 460 ) + ',' + t( 'Amount', 461 ) + ',' + t( 'Advances', 462 ) + 
		',' + t( 'Retention', 463 ) + ',' + t( 'Kontratu Balance', 464 ) + ',' + t( 'Finan. % Compl.', 465 );
	    
    footer = t( 'Total', 19 ) + ',#cspan,#cspan,#cspan,' + t( 'Invoices', 466 ) + ',' + t( 'Net Pays', 467 ) + ',' + t( 'Progress Pay', 468 ) 
	     + ',' + t( 'Advances', 462 ) + ',' + t( 'Retentions', 469 ) + ',' + t( 'Balances', 470 ) + ',' + t( '% Compl.', 471 );
	 
    subFooter = '#rspan,#rspan,#rspan,#rspan,{#stat_total},{#stat_total},{#stat_total},{#stat_total},{#stat_total},{#stat_total},{#stat_total}';
    
    gridContractRecord = new dhtmlXGridObject( 'gridContractRecord' );
    gridContractRecord.setHeader( header );
    gridContractRecord.attachHeader( subHeader );
    gridContractRecord.setInitWidths( "87,87,87,87,87,87,87,87,87,87,170" );
    gridContractRecord.setColAlign( "center,center,center,center,center,center,center,center,center,center,center" );
    gridContractRecord.setColTypes( "ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro" );
    gridContractRecord.setColSorting( "na,na,na,na,na,na,na,na,na,na,na" );
    gridContractRecord.setSkin( config.grid );
    gridContractRecord.attachFooter( footer );
    gridContractRecord.attachFooter( subFooter );
    gridContractRecord.init();
    
    return true;
}

function listContractRecord()
{
    $.ajax({
	type: 'POST',
	data: {
	    id: $( '#id_contract' ).val()
	},
	dataType: 'text',
	url: baseUrl + '/beneficiario/contrato/listcontractrecord/',
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
	    $( '#list-registros' ).html( response );
	},
	error: function ()
	{
	    $( '#list-registros' ).html( '' );
	    msgErro( t( 'Erro ao listar registros', 502 ) );
	}
    });
}

function obrigaContratoRegistro()
{
    var cat = $( '#category' ).val();
    requiredFields = ['date_record', 'category', 'payment_origin', 'net_payment', 'amount'];
    seletorFields = '#form-contrato-registro .input_wrapper select, #form-contrato-registro .input_wrapper input';
    
    if ( cat != 'WA' ) {
	
	$( seletorFields ).each(
	    function( index, element )
	    {
		if ( !empty( $( element ).attr( 'readonly' ) ) )
		    $( element ).attr( 'data-readonly', 'true' ).removeAttr( 'readonly' );
		
		if ( $.inArray( $( element ).attr( 'id' ), requiredFields ) > -1 ) 
		    return true;
		
		$( element ).removeClass( 'required' );
	    }
	);
	
    } else {
	
	$( seletorFields ).each(
	    function( index, element )
	    {
		if ( !empty( $( element ).attr( 'data-readonly' ) ) )
		    $( element ).attr( 'readonly', 'true' ).removeAttr( 'data-readonly' );
		
		if ( $.inArray( $( element ).attr( 'id' ), requiredFields ) > -1 ) 
		    return true;
		
		$( element ).addClass( 'required' );
	    }
	);
	    
	$( '#invoice_amount' ).blur();
    }
}

function getFieldRecordValue( seletor )
{
    var value = $( seletor ).val();
    return toFloat( empty( value ) ? 0 : value );
}

function calcRetention()
{
    if ( $( '#category' ).val() == 'FA' )
	return false;
    
    var invoice = getFieldRecordValue( '#invoice_amount' );
        retention = getFieldRecordValue( '#retention' );
        
    retention_percent = ( retention * 100 ) / invoice;
    
    $( '#retention_percent' ).val( retention_percent.toFixed( 2 ) ).trigger( 'change' );
    
    return true;
}

function calcAdvances()
{
    if ( $( '#category' ).val() == 'FA' )
	return false;
   
    var invoice = getFieldRecordValue( '#invoice_amount' );
        advances = getFieldRecordValue( '#advances' );
        
    advances_percent = ( 100 * advances ) / invoice ;
    
    $( '#advances_percent' ).val( advances_percent.toFixed( 2 ) ).trigger( 'change' );
    
    return true;
}

function calcNetPayment()
{
    if ( $( '#category' ).val() == 'FA' )
	return false;
    
    var invoice = getFieldRecordValue( '#invoice_amount' );
    var retention = getFieldRecordValue( '#retention' );
    var advances = getFieldRecordValue( '#advances' );
    
    netPayment = invoice - retention - advances;
    
    $( '#net_payment' ).val( netPayment.toFixed( 2 ) ).trigger( 'change' );
    
    return true;
}

function calcContractBalance()
{
    if ( $( '#category' ).val() == 'FA' )
	return false;
    
    var contractTotal = getFieldRecordValue( '#total_contract' );
    var netPayment = getFieldRecordValue( '#net_payment' );
    
    contractBalance = contractTotal - netPayment;
    
    $( '#contract_balance' ).val( contractBalance.toFixed( 2 ) );
    
    return true;
}
function calcWork()
{
    var netPayment = getFieldRecordValue( '#net_payment' );
        amount = getFieldRecordValue('#amount' );
    
    //alert(amount);return;
    
    if ( $( '#category' ).val() == 'FA' )
	return false;
    if ( amount == 0 )
        return false;
    else
        works = netPayment - amount;
        $( '#works' ).val( works.toFixed( 2 ) );
        return true;
    
}
function calcRecomendation()
{
    var totalContract = getFieldRecordValue( '#total_contract' );
        invoice = getFieldRecordValue( '#invoice_amount' );
        
    //alert('total:'+totalContract+' invoice: '+invoice);
    recomended = ( invoice / totalContract ) * 100;
    //alert('recomendation: '+recomended);
    $( '#recomendation' ).val( recomended.toFixed( 5 ) );
    $( '#advances_percent' ).val( recomended.toFixed( 5 ) );
}
function calcOtherValue()
{    
    var otherValue = getFieldRecordValue( '#other_value' );
        netPayment = getFieldRecordValue( '#net_payment' );
        indicator  = $( "#indicator" ).val();
        
        addsNetPayment = netPayment + otherValue;
        subtractsNetPayment = netPayment - otherValue;        
        
    if ( indicator === '+' )
        $( '#net_payment' ).val( addsNetPayment.toFixed(2) );
    
    else if (indicator === '-')
        $( '#net_payment' ).val( subtractsNetPayment.toFixed(2) );
    
}

function saveRegistro( form )
{
    var obj = {
        callback: function( response )
        {
            
            if ( !response.error ){
                
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		$( '#form-contrato-registro' )[0].reset();
		listContractRecord();
            }
        }
    };
    
    return submitAjax( form, obj );
}
function hideField (type_amendment)
{
    if ( type_amendment == 'type_amendment' ){
        $('.valeuContract').show().find('.text').addClass('required');
        $('.dateContract').hide().find('.required').removeClass('required');
    }else if ( type_amendment == 'type_amendment1' ){
        $('.valeuContract').hide().find('.required').removeClass('required');
        $('.dateContract').show().find('.text').addClass('required');
    }
}
function saveAmendment( form )
{
    var obj = {
        callback: function( response )
        {
            
            if ( !response.error ){
                
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		$( '#form-contrato-amendment' )[0].reset();
		history.go(0);
            }
        }
    };
    
    return submitAjax( form, obj );
}

function deleteRecord(id_relationship)
{
    $.ajax({
	type: 'POST',
	data: {
	    id: id_relationship            
	},
        dataType: 'text',
	url: baseUrl + '/beneficiario/contrato/deleteRecord/',
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
	    listContractRecord();
	},
	error: function ()
	{
	    $( '#list-registros' ).html( '' );
	    msgErro( t( 'Error to delete record', 999 ) );
	}
    });
}