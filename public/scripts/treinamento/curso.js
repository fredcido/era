$( document ).ready(
    function()
    {
	$( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/treinamento/curso/cadastro';
	    }
	);
	    
	$('#editar').click(editItem);
	
	$('#add-unit').on('click', addUnit);
	$('#remove-unit').on('click', removeUnit);
    }
);
    
function editItem()
{
    if ( !grid.getSelectedId() ) {
	msgAlerta( 'Selecione o item para edição.' );
	return false;
    }

    var id = grid.getSelectedId();
    location.href = baseUrl + '/treinamento/curso/editar/id/' + id;
    return true;
}
    
var grid;
function initGrid()
{
    if ( !$( '#gridCurso' ).length )
	return false;
    
    grid = new dhtmlXGridObject( 'gridCurso' );
    grid.setHeader( "#," + t( 'Curso', 692 ) + "," + t( 'Acrônimo', 693 ) + "," + t( 'Acreditado', 707 ) );
    grid.attachHeader( "#rspan,#text_filter,#text_filter,#text_filter" );
    grid.setInitWidths( "50,*,200,100" );
    grid.setColAlign( "center,left,left,left" );
    grid.setColTypes( "ro,ro,ro,ro" );
    grid.setColSorting( "str,str,str,str" );
    grid.setSkin( config.grid );
    grid.enablePaging( true, 30, 10, 'divPagCurso', true, 'divPagCurso' );
    grid.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    grid.init();
    
    return true;
}

var gridAvailableUnit;
function initGridAvailableUnit()
{
    if ( !$( '#gridAvailableUnit' ).length )
	return false;
    
    var header = '#,#master_checkbox' + ',' + t( 'Cod.', 999 ) + ',' + t( 'Nome', 10 );
    
    gridAvailableUnit = new dhtmlXGridObject( 'gridAvailableUnit' );
    gridAvailableUnit.setHeader( header );
    gridAvailableUnit.attachHeader( "#rspan,#rspan,#text_filter,#text_filter" );
    gridAvailableUnit.setInitWidths( "50,50,100,*" );
    gridAvailableUnit.setColAlign( "center,center,left,left" );
    gridAvailableUnit.setColTypes( "ro,ch,ro,ro" );
    gridAvailableUnit.setColSorting( "str,str,str,str" );
    gridAvailableUnit.setSkin( config.grid );
    gridAvailableUnit.enablePaging( true, 30, 10, 'divPagAvailableUnit', true, 'divPagAvailableUnit' );
    gridAvailableUnit.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridAvailableUnit.init();
    
    return true;
}

var gridUnitCourse;
function initGridUnitCourse()
{
    if ( !$( '#gridUnitCourse' ).length )
	return false;
    
    var header = '#,#master_checkbox' + ',' + t( 'Cod.', 999 ) + ',' + t( 'Nome', 10 );
    
    gridUnitCourse = new dhtmlXGridObject( 'gridUnitCourse' );
    gridUnitCourse.setHeader( header );
    gridUnitCourse.attachHeader( "#rspan,#rspan,#text_filter,#text_filter" );
    gridUnitCourse.setInitWidths( "50,50,100,*" );
    gridUnitCourse.setColAlign( "center,center,left,left" );
    gridUnitCourse.setColTypes( "ro,ch,ro,ro" );
    gridUnitCourse.setColSorting( "str,str,str,str" );
    gridUnitCourse.setSkin( config.grid );
    gridUnitCourse.enablePaging( true, 30, 10, 'divPagUnitCourse', true, 'divPagUnitCourse' );
    gridUnitCourse.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,{#stat_count}" );
    gridUnitCourse.init();
    
    return true;
}

function addUnit()
{
    var unitCompetency = gridAvailableUnit.getCheckedRows(1);
    if ( empty( unitCompetency ) ) {
	
	msgAlerta( t( 'Selecione as unidades de competência.', 698 ) );
	return false;
    }
    
    unitInCourse = gridUnitCourse.getAllRowIds( ',' );
    unitInCourse = empty( unitInCourse ) ? [] : unitInCourse.split( ',' );
    
    var data = [];
    for ( i in unitCompetency ) {
	if ( $.inArray( unitCompetency[i], unitInCourse ) < 0 )
	    data.push( unitCompetency[i] );
    }
    
    if ( empty( data ) ) {
	
	msgAlerta( t( 'Todas as unidades selecionadas já estão no curso.', 699 ) );
	return false;
    }
    
    $.ajax({
	type: 'POST',
	data: {
	    id: $( '#id_course' ).val(),
	    competencies: data
	},
	dataType: 'json',
	url: baseUrl + '/treinamento/curso/savecompetency/',
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
		
		msg = empty( response.msg ) ? t( 'Erro ao cadastrar unidades de competência', 700 ) : response.msg;
		msgErro( msg );
		
	    } else {
		
		msgSucesso(t( 'Unidades de competência salvas com sucesso', 701 ));
		gridAvailableUnit.uncheckAll();
		
		loadUnitInCourse();
	    }
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao cadastrar unidades de competência', 700 ) );
	}
    });
    
    return true;
}

function loadUnitInCourse()
{
    loading( true );
    gridUnitCourse.clearAll();
    gridUnitCourse.load( baseUrl + '/treinamento/curso/listunitcompetency/id/' + $( '#id_course' ).val(), function(){loading( false )}, 'json' );
}

function removeUnit()
{
    unitInCourse = gridUnitCourse.getCheckedRows(1);
    if ( empty( unitInCourse ) ) {
	
	msgAlerta( t( 'Selecione as unidades para remover', 702 ) );
	return false;
    }
    
    if ( !confirm( t( 'Deseja realmente remover estas unidades?', 703 ) ) )
	return false;
    
    $.ajax({
	type: 'POST',
	data: {
	    id: $( '#id_course' ).val(),
	    units: unitInCourse
	},
	dataType: 'json',
	url: baseUrl + '/treinamento/curso/removeunit/',
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
		msgErro( t( 'Erro ao remover unidades', 704 ) );
	    else {
		
		msgSucesso(t( 'Unidades de competência removidas com sucesso', 705 ));
		gridUnitCourse.clearAll();
		loadUnitInCourse();
	    }
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao remover unidades', 704 ) );
	}
    });
    
    return true;
}

function save( form )
{
    var obj = {
	callback: function( response )
	{
	    if ( !response.error )
		location.href = baseUrl + '/treinamento/curso/editar/id/' + response.id;
	}
    };
    
    return submitAjax( form, obj );
}