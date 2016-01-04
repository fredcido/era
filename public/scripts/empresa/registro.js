/**
 * 
 */
$(document).ready(
    function()
    {
        
        $( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/empresa/registro/geral';
	    }
	);
	    
	$( '#editar' ).click( editItem );
        
        // Buscar clientes
	$( '#busca-clientes' ).click( buscarClientes );
        
        // Adiciona clientes
	$( '#add-clientes' ).click( addClientes );
        
        // Avancar clientes
	$( '#avancar-clientes' ).click( avancaClientes );
	
	// Remove participantes
	$( '#remover-clientes' ).click( removeClientes );
        
        //Calcula valor anual
        $( '#sales_monthly' ).keypress( calculoAnual );
        
        //Calcula valor mensal
        $( '#sales_annual' ).keypress( calculoMensal );
        
	// Busca os sub sector
	$( '#fk_id_sector' ).change( buscaSubSector );
        
        $("#district_operation_0").click( function( e ){
            
            checkedAll( this );
            
        } );
        
        $("#iade_client").change( function( e ){
            
            if( this.value == "S" ) {
		
                $("#busca-clientes").removeClass("none");
		
	    } else {
                $("#busca-clientes").addClass("none");
	    }
            
        } );
        
        $(".phone").inputmask("mask", {"mask": "(999) 99999999"});
        
	if ( $( '.table_tabs_menu li a.selected' ).length ) {
	    
	    offetScroll = $( '.table_tabs_menu li a.selected' ).parent().position().left;
	    $( '.table_tabs_menu' ).scrollingCarousel( { looped: false, scrollerOffset: offetScroll } );
	}
    }
);
    
window.eXcell_deleteAsset = function( cell )
{                                    
    if ( cell ) {   
	this.cell = cell;
	this.grid = this.cell.parentNode.grid;
    }

    this.edit = function(){}
    this.isDisabled = function(){ return true; }

    this.setValue = function( id )
    {		
	var span = $( '<span />' );
	span.addClass( 'ico-remove' )
		.css( 'cursor', 'pointer' )
		.attr( 'onclick',  'deleteAsset(' + id + ');' );

	div = $( '<div />' );
	div.append( span );

	this.setCValue( div.html(), id );                                     
    }
}

window.eXcell_deletePreviousContract = function( cell )
{                                    
    if ( cell ) {   
	this.cell = cell;
	this.grid = this.cell.parentNode.grid;
    }

    this.edit = function(){}
    this.isDisabled = function(){ return true; }

    this.setValue = function( id )
    {		
	var span = $( '<span />' );
	span.addClass( 'ico-remove' )
		.css( 'cursor', 'pointer' )
		.attr( 'onclick',  'deletePreviousContract(' + id + ');' );

	div = $( '<div />' );
	div.append( span );

	this.setCValue( div.html(), id );                                     
    }
}

window.eXcell_deleteAsset.prototype = new eXcell;
window.eXcell_deletePreviousContract.prototype = new eXcell;
    
function checkedAll( e ){
    
    if( $(e).is(":checked") )
        $(":checkbox[id*=district_operation_]").attr("checked",true);
    else
        $(":checkbox[id*=district_operation_]").attr("checked",false);
    
}    
    
function calculoAnual(){
    
    sales_monthly = $( '#sales_monthly' ).val();
    total = toFloat(sales_monthly) * 12;
    
    $( '#sales_annual' ).val( Math.round(total) );
    
}
    
function calculoMensal(){
    
    sales_annual = $( '#sales_annual' ).val();
    total = toFloat(sales_annual) / 12;
    
    $( '#sales_monthly' ).val( Math.round(total) );
    
}

function editItem()
{
 
     if ( !gridEmpresas.getSelectedId() ) {
        msgAlerta( t( 'Selecione o item para edição', 20 ) );
        return false;
    }

    var id = gridEmpresas.getSelectedId();
    location.href = baseUrl + '/empresa/registro/geral/id/' + id;
    return true;
 
}

var gridEmpresas;
function initGridEmpresas()
{
    if ( !$( '#gridEmpresas' ).length )
        return false;
    
    header = "#," + t( 'Código da Empresa', 339 ) + ',' + t( 'Naran Empreza', 304 ) + ',' + t( "Naran Diretor/Na'in", 313 );
    
    gridEmpresas = new dhtmlXGridObject( 'gridEmpresas' );
    gridEmpresas.setHeader( header );
    gridEmpresas.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter" );
    gridEmpresas.setInitWidths( "50,*,350,200" );
    gridEmpresas.setColAlign( "center,left,left,left" );
    gridEmpresas.setColTypes( "ro,ro,ro,ro" );
    gridEmpresas.setColSorting( "str,str,str,str" );
    gridEmpresas.setSkin( config.grid );
    gridEmpresas.enablePaging( true, 30, 10, 'divPagEmpresas', true, 'divPagEmpresas' );
    gridEmpresas.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridEmpresas.init();
    
    return true;
}

function saveGeral( form )
{
    
    if( $('#official_registration').val() == 'S' ){
        
        if( empty( $('#number_mj').val() ) && empty( $('#number_mtci').val() ) ){
            
            msgAlerta( t( 'Preencha Numeru Rejistu(MTCI) ou Numeru Rejistu(MJ) e suas datas', 356 ) );
            return false;
            
        }
        
        //number mj/data mj OU number mtci/data mcti devera ser obrigatorio
        if( !empty( $('#number_mj').val() ) && empty( $('#date_mj').val() ) )
        {
            msgAlerta( t( 'Preencha a data MJ', 357 ) );
            return false;
        }
        
        if(  !empty( $('#number_mtci').val() ) && empty( $('#date_mcti').val() ) )
        {
            msgAlerta( t( 'Preencha a data MTCI', 358 ) );
            return false;
        }
        
    }
    
    var obj = {
        callback: function( response )
        {
            
            if ( !response.error )
                location.href = baseUrl + '/empresa/registro/contato/id/'+$("#id_enterprise").val();
        }
    };
    
    return submitAjax( form, obj );
}

function setRequired( value ){
    
    if( value == 'S' ){
        msgAlerta( t( 'Preencha Numeru Rejistu(MTCI) ou Numeru Rejistu(MJ) e suas datas', 356 ) );
        return false;                
    }
    
    return true;
    
}

function saveContato( form )
{
    var obj = {
        callback: function( response )
        {
            if ( !response.error ){
                location.href = baseUrl + '/empresa/registro/clientes/id/'+$("#id_enterprise").val();
            }
        }
    };
    
    return submitAjax( form, obj );
}

function saveVolume( form )
{
    var obj = {
        callback: function( response )
        {
            if ( !response.error ){
                location.href = baseUrl + '/empresa/registro/tipo/id/' + $("#id_enterprise").val();
            }
        }
    };
    
    return submitAjax( form, obj );
}

function saveAsset( form )
{
    var obj = {
        callback: function( response )
        {
            if ( !response.error ){
                
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		loadGridAsset();
		$( '#form-empresas-asset' )[0].reset()
            }
        }
    };
    
    return submitAjax( form, obj );
}

function savePreviousContract( form )
{
    var obj = {
        callback: function( response )
        {
            if ( !response.error ){
                
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		loadGridPreviousContract();
		$( '#form-empresas-previous-contract' )[0].reset()
            }
        }
    };
    
    return submitAjax( form, obj );
}

function saveTipo( form )
{
    $( "#num_district" ).attr("disabled",false);
    $( "#num_year" ).attr( "disabled",false );
    
    var obj = {
        callback: function( response )
        {
            
            id = response.id;
            
            if ( !response.error ){
                location.href = baseUrl + '/empresa/registro/endereco/id/'+id;
            }
        },
	validate: function()
	{	   
            
	    if ( $( '#sub-sector input' ).filter( function(){return $( this ).attr( 'checked' );} ).length < 1 ) {
		
		msgAlerta( t( 'Selecione algum Sub Sector', 354 ) );
		return false;
	    }
            
	    if ( $( '#distritu-operasi input' ).filter( function(){return $( this ).attr( 'checked' );} ).length < 1 ) {
		
		msgAlerta( t( 'Selecione algum Distritu Operasi', 352 ) );
		return false;
	    } 
	    
	    return true;
	}
    };
    
    return submitAjax( form, obj );
}

function calculaTotalTrabalhador()
{
    
    var staff_woman = $( '#staff_woman' ).val();
    var staff_man = $( '#staff_man' ).val();
    
    staff_woman = empty( staff_woman ) ? 0 : staff_woman;
    staff_man = empty( staff_man ) ? 0 : staff_man;
    
    $( '#staff_woman' ).val( staff_woman );
    $( '#staff_man' ).val( staff_man );
    
    var staff_total = parseInt( staff_woman ) + parseInt( staff_man );
    $( '#staff_total' ).val(  staff_total );
    
    switch ( true ) {
	case staff_total == 1:
	    size_business = 'MIKRO(Traballador 1)';
	    break;
	case staff_total >= 2 && staff_total <= 10:
	    size_business = 'KIIK(Traballador 2 - 10)';
	    break;
	case staff_total >= 11 && staff_total <= 50:
	    size_business = 'MEDIO(Traballador 11-50)';
	    break;
	default:
	    size_business = "BO'OT (+51)";
    }
    
    $( '#size_business' ).val( size_business );
    
    return true;
}

function tipoVolume( tipo ){
    
    //if mes
    if( tipo == "F" ){
        $('#sales_monthly').removeAttr('readonly');
        $('#sales_annual').attr('readonly',true);
        $('#sales_annual').val(0);
    }else if( tipo == "T" ){
        $('#sales_annual').removeAttr('readonly');
        $('#sales_monthly').attr('readonly',true);
        $('#sales_monthly').val(0);
    }else{
        $('#sales_annual').attr('readonly',true);
        $('#sales_monthly').attr('readonly',true);
        
        $('#sales_annual').val(0);
        $('#sales_monthly').val(0);
    }
    
}

var gridClientes;
function initGridClientes()
{
    if ( !$( '#gridClientes' ).length )
	return false;
    
    header = '#,#master_checkbox' +
	     ',' + t( 'Nome', 10 ) + 
	     ',' + t( 'Sobrenome', 57 ) + 
	     ',' + t( 'Numero cliente', 225 ) +
	     ',' + t( 'Sexo', 69 );
    
    gridClientes = new dhtmlXGridObject( 'gridClientes' );
    gridClientes.setHeader( header );
    gridClientes.attachHeader( "#rspan,#rspan,#text_filter,#text_filter,#text_filter,#text_filter" );
    gridClientes.setInitWidths( "50,50,*,250,200,100" );
    gridClientes.setColAlign( "center,center,left,left,left,left" );
    gridClientes.setColTypes( "ro,ch,ro,ro,ro,ro" );
    gridClientes.setColSorting( "str,str,str,str,str,str" );
    gridClientes.setSkin( config.grid );
    gridClientes.enablePaging( true, 30, 10, 'divPagClientes', true, 'divPagClientes' );
    gridClientes.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,#cspan,{#stat_count}" );
    gridClientes.init();
    
    return true;
}

function buscarClientes()
{
    $.ajax({
	type: 'POST',
	data: {
	    name: $( '#cli_name' ).val(),
	    num: $( '#cli_num' ).val()
	},
	dataType: 'json',
	url: baseUrl + '/empresa/registro/buscaclientes/',
	beforeSend: function()
	{
	    loading( true );
	    gridClientes.clearAll();
	},
	complete: function()
	{
	    loading( false );
	},
	success: function ( response )
	{
            
	    gridClientes.parse( response, 'json' );
            
            //if( $( '#id_enterprise' ).val() )
                //$("#add-clientes").removeClass("none");
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao buscar clientes', 322 ) );
	}
    });
    
    return false;
}

var gridClientesEmpresa;
function initGridClientesEmpresa()
{
    if ( !$( '#gridClientesEmpresa' ).length )
	return false;
    
    header = '#,#master_checkbox' +
	     ',' + t( 'Nome Sobrenome', 57 ) + 
	     ',' + t( 'Numero participante', 225 ) +
	     ',' + t( 'Sexo', 69 );
    
    gridClientesEmpresa = new dhtmlXGridObject( 'gridClientesEmpresa' );
    gridClientesEmpresa.setHeader( header );
    gridClientesEmpresa.attachHeader( "#rspan,#rspan,#text_filter,#text_filter,#text_filter" );
    gridClientesEmpresa.setInitWidths( "50,50,*,200,100" );
    gridClientesEmpresa.setColAlign( "center,center,left,left,left" );
    gridClientesEmpresa.setColTypes( "ro,ch,ro,ro,ro" );
    gridClientesEmpresa.setColSorting( "str,str,str,str,str" );
    gridClientesEmpresa.setSkin( config.grid );
    gridClientesEmpresa.enablePaging( true, 30, 10, 'divPagClientesEmpresa', true, 'divPagClientesEmpresa' );
    gridClientesEmpresa.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,{#stat_count}" );
    gridClientesEmpresa.init();
    
    return true;
}

function loadClientesEmpresa()
{
    loading( true );
    gridClientesEmpresa.clearAll();
    gridClientesEmpresa.load( baseUrl + '/empresa/registro/listclientes/id/' + $( '#id_enterprise' ).val(), function(){loading( false )}, 'json' );
}

var gridVolumeVendas;
function initGridVolumeVendas()
{
    if ( !$( '#gridVolumeVendas' ).length )
	return false;
    
    header = '#' +
	     ',' + t( 'Valor Fulan', 345 ) + 
	     ',' + t( 'Valor Tinan', 346 ) +
	     ',' + t( 'Data Rijistu', 347 );
    
    gridVolumeVendas = new dhtmlXGridObject( 'gridVolumeVendas' );
    gridVolumeVendas.setHeader( header );
    gridVolumeVendas.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter" );
    gridVolumeVendas.setInitWidths( "50,273,273,273" );
    gridVolumeVendas.setColAlign( "center,left,left,left" );
    gridVolumeVendas.setColTypes( "ro,ro,ro,ro" );
    gridVolumeVendas.setColSorting( "str,str,str,str" );
    gridVolumeVendas.setSkin( config.grid );
    gridVolumeVendas.enablePaging( true, 30, 10, 'divPagVolumeVendas', true, 'divPagVolumeVendas' );
    gridVolumeVendas.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridVolumeVendas.init();
    
    return true;
}

var gridAssets;
function initGridAsset()
{
    if ( !$( '#gridAsset' ).length )
	return false;
    
    header = '#' +
	     ',' + t( 'Equipamento', 596 ) + 
	     ',' + t( 'Quantidade', 413 ) +
	     ',' + t( 'Descrição', 13 ) +
	     ',';
    
    gridAssets = new dhtmlXGridObject( 'gridAsset' );
    gridAssets.setHeader( header );
    gridAssets.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter,#cspan" );
    gridAssets.setInitWidths( "50,273,100,*,25" );
    gridAssets.setColAlign( "center,left,center,left,centr" );
    gridAssets.setColTypes( "ro,ro,ro,ro,deleteAsset" );
    gridAssets.setColSorting( "str,str,str,str,str" );
    gridAssets.setSkin( config.grid );
    gridAssets.enablePaging( true, 30, 10, 'divPagAsset', true, 'divPagAsset' );
    gridAssets.attachFooter( t( 'Total', 19 ) + ",#cspan,{#stat_total},#cspan,{#stat_count}" );
    gridAssets.attachEvent( 'onRowDblClicked', editItemAsset );
    gridAssets.init();
    
    return true;
}

function editItemAsset( id )
{
    $.ajax({
	type: 'GET',
	dataType: 'json',
	url: baseUrl + '/empresa/registro/getasset/id/' + id,
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
	    $( '#form-empresas-asset' ).populate( response );
	    $( '#asset_name' ).focus();
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao efetuar operação.', 25 ) );
	}
    });
}

function loadGridAsset()
{  
    gridAssets.clearAll();
    gridAssets.load( baseUrl + '/empresa/registro/listasset/id/' + $( '#id_enterprise' ).val(), function(){loading( false )}, 'json' );
}

function loadGridPreviousContract()
{  
    gridPreviousContract.clearAll();
    gridPreviousContract.load( baseUrl + '/empresa/registro/listpreviouscontract/id/' + $( '#id_enterprise' ).val(), function(){loading( false )}, 'json' );
}

var gridPreviousContract;
function initGridPreviousContract()
{
    if ( !$( '#gridPreviousContract' ).length )
	return false;
    
    header = '#' +
	     ',' + t( 'Tipo de contrato', 603 ) + 
	     ',' + t( 'Cliente', 255 ) +
	     ',' + t( 'Data inicial', 174 ) +
	     ',' + t( 'Data final', 550 ) +
	     ',' + t( 'Total contrato', 605 ) +
	     ',';
    
    gridPreviousContract = new dhtmlXGridObject( 'gridPreviousContract' );
    gridPreviousContract.setHeader( header );
    gridPreviousContract.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#cspan" );
    gridPreviousContract.setInitWidths( "50,180,*,100,100,150,25" );
    gridPreviousContract.setColAlign( "center,left,left,center,center,center,center" );
    gridPreviousContract.setColTypes( "ro,ro,ro,ro,ro,ro,deletePreviousContract" );
    gridPreviousContract.setColSorting( "str,str,str,str,str,str,str" );
    gridPreviousContract.setSkin( config.grid );
    gridPreviousContract.enablePaging( true, 30, 10, 'divPagPreviousContract', true, 'divPagPreviousContract' );
    gridPreviousContract.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,#cspan,{#stat_count},#cspan" );
    gridPreviousContract.attachEvent( 'onRowDblClicked', editPreviousContract );
    gridPreviousContract.init();
    
    return true;
}

function editPreviousContract( id )
{
    $.ajax({
	type: 'GET',
	dataType: 'json',
	url: baseUrl + '/empresa/registro/getpreviouscontract/id/' + id,
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
	    $( '#form-empresas-previous-contract' ).populate( response );
	    $( '#contract_type' ).focus();
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao efetuar operação.', 25 ) );
	}
    });
}

function loadVolumeVendas()
{
    
    gridVolumeVendas.clearAll();
    gridVolumeVendas.load( baseUrl + '/empresa/registro/listvolumevendas/id/' + $( '#id_enterprise' ).val(), function(){loading( false )}, 'json' );
}

/**
 * 
 */
function addClientes()
{
    clientes = gridClientes.getCheckedRows(1);
    iade_client = $('#iade_client').val();
    
    if( $("#iade_client").val() == "S" ){
    
        if ( empty( clientes ) && !gridClientesEmpresa.getRowsNum() ) {

            msgAlerta( t( 'Selecione os clientes para inserir na empresa', 326 ) );
            return false;
        }
    
        clientesEmpresa = gridClientesEmpresa.getAllRowIds( ',' );
        clientesEmpresa = empty( clientesEmpresa ) ? [] : clientesEmpresa.split( ',' );

        data = [];
        for ( i in clientes ) {
            if ( $.inArray( clientes[i], clientesEmpresa ) < 0 )
                data.push( clientes[i] );
        }

        if ( empty( data ) && !gridClientesEmpresa.getRowsNum() ) {

            msgAlerta( t( 'Todos clientes selecionados já estão na empresa', 327 ) );
            return false;
        }
    
    }
    
    if ( 'L' == iade_client && gridClientesEmpresa.getAllRowIds( ',' ).length ) {
	
	msgAlerta( t( 'Todos os clientes precisam ser removidos da empresa', 999 ) );
	return false;
    }
    
    id_enterprise = $( '#id_enterprise' ).val();
    
    $.ajax({
	type: 'POST',
	data: {
	    id_enterprise: id_enterprise,
	    clientes: clientes,
            iade_client: iade_client
	},
	dataType: 'json',
	url: baseUrl + '/empresa/registro/saveclientes/',
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
		
		msg = empty( response.msg ) ? t( 'Erro ao cadastrar clientes', 329 ) : response.msg;
		msgErro( msg );
		
	    } else {
		
		gridClientes.uncheckAll();
		loadClientesEmpresa();
                //location.href = baseUrl + '/empresa/registro/volume/id/' + $("#id_enterprise").val();
	    }
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao cadastrar clientes.', 329 ) );
	}
    });
    
    return true;
}

function avancaClientes()
{
    var form = '#form-empresa-clientes';
    if( !validaForm( form ) ) {
	
	msgErro( t( 'Verifique os campos do formulário.', 206 ) );
	return false;
    }
    
    aInserir = parseInt( gridClientes.getCheckedRows(1).length );
    inseridos = parseInt( gridClientesEmpresa.getRowsNum() );
    
    if ( 'S' == $( '#iade_client' ).val() && ( aInserir + inseridos ) < 1 ) {
	
	msgErro( t( 'Nenhum participante foi inserido.', 233 ) );
	return false;
    }
    
    //addClientes();
    location.href = baseUrl + '/empresa/registro/volume/id/' + $("#id_enterprise").val();
    
    return true;
}

function removeClientes()
{
    clientesEmpresa = gridClientesEmpresa.getCheckedRows(1);
    if ( empty( clientesEmpresa ) ) {
	
	msgAlerta( t( 'Selecione os clientes para remover', 340 ) );
	return false;
    }
    
    if ( !confirm( t( 'Deseja realmente remover estes cliente?', 341 ) ) )
	return false;
    
    $.ajax({
	type: 'POST',
	data: {
	    id_enterprise: $( '#id_enterprise' ).val(),
	    clientes: clientesEmpresa
	},
	dataType: 'json',
	url: baseUrl + '/empresa/registro/removeclientes/',
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
		msgErro( t( 'Erro ao remover clientes', 342 ) );
	    else {
		gridClientesEmpresa.clearAll();
		loadClientesEmpresa();
	    }
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao remover clientes', 342 ) );
	}
    });
    
    return true;
}

function setNumDistrict( district )
{
    
    $('#num_district').val( district );
    
}

function saveEndereco( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error ){
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
                location.href = baseUrl + '/empresa/registro/endereco/id/' + response.id;
            }
            else
                msgErro( t( 'Erro ao efetuar operação', 25 ) );
	}
    };
    
    return submitAjax( form, obj );
}

function excluiEndereco( endereco, link )
{
    if ( !confirm( t( 'Deseja remover este item?', 93 ) ) )
	return false;
    
    $.ajax({
	type: 'POST',
	data: endereco,
	dataType: 'json',
	url: baseUrl + '/empresa/registro/removerendereco/',
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

function buscaSubSector( units )
{
    $( '#sub-sector' ).empty();
    
    var sector = $( '#fk_id_sector' ).val();
    if ( empty( sector ) )
	return false;
    
    $.ajax({
	type: 'POST',
	data: {id: sector},
	dataType: 'json',
	url: baseUrl + '/empresa/registro/subsector/',
	success: function ( response )
	{
	    for ( i in response ) {
		
		var li = $( '<li />' );
		var id = 'sub-sector_' + response[i].id_subsector;
		
		var input = $( '<input />' );
		input.attr( 'type', 'checkbox' )
		     .attr( 'name', 'sub-sector[]' )
		     .attr( 'id', id )
		     .val( response[i].id_subsector );
		     
		var label = $( '<label />' );
		label.attr( 'for', id ).html( response[i].name_subsector ).prepend( input );
		
		if ( units && $.inArray( response[i].id_subsector, units ) > -1 )
		    input.attr( 'checked', true );
		
		li.append( label );
		
		$( '#sub-sector' ).append( li );
	    }
	},
	error: function ()
	{
	    msgAlerta( t( 'Erro ao buscar sub-sector', 353 ) );
	    $( '#sub-sector' ).empty();
	}
    });
    
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

function goToEmpresa( path )
{
    var id = null;
    if ( $( '#fk_id_enterprise' ).length > 0 )
	id = $( '#fk_id_enterprise' ).val();
    else
	id = $( '#id_enterprise' ).val();
    
    var url = baseUrl + '/empresa/registro/' + path + '/id/' + id;
    location.href = url;
}

function deleteAsset( id )
{
    if ( !confirm( t( 'Tem certeza que deseja apagar esse equipamento?', 601 ) ) )
	return false;
    
    $.ajax({
	type: 'GET',
	dataType: 'json',
	url: baseUrl + '/empresa/registro/deleteasset/id/' + id,
	success: function ( response )
	{
	    if (  response.status ) {
		
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		loadGridAsset();
	    } else {
		msgAlerta( t( 'Erro ao efetuar operação', 25 ) );
	    }
		
	},
	error: function ()
	{
	    msgAlerta( t( 'Erro ao efetuar operação', 25 ) );
	}
    });
    
    return true;
}

function deletePreviousContract( id )
{
    if ( !confirm( t( 'Tem certeza que deseja apagar esse contrato?', 609 ) ) )
	return false;
    
    $.ajax({
	type: 'GET',
	dataType: 'json',
	url: baseUrl + '/empresa/registro/deletepreviouscontract/id/' + id,
	success: function ( response )
	{
	    if (  response.status ) {
		
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		loadGridPreviousContract();
	    } else {
		msgAlerta( t( 'Erro ao efetuar operação', 25 ) );
	    }
		
	},
	error: function ()
	{
	    msgAlerta( t( 'Erro ao efetuar operação', 25 ) );
	}
    });
    
    return true;
}