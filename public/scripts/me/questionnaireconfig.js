/**
 * 
 */
$(document).ready(
    function()
    {
        $( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/me/questionnaireconfig/form';
	    }
	);
	    
	$( '#editar' ).click( editItem );
	initChangeValidateOption();
    }
);

function editItem()
{
     if ( !gridQuestionnaireConfig.getSelectedId() ) {
        msgAlerta( t( 'Selecione o item para edição', 20 ) );
        return false;
    }

    var id = gridQuestionnaireConfig.getSelectedId();
    location.href = baseUrl + '/me/questionnaireconfig/form/id/' + id;
    return true;
 
}

var gridQuestionnaireConfig;
function initGridQuestionnaireConfig()
{
    if ( !$( '#gridQuestionnaireConfig' ).length )
        return false;
    
    header = "#," + t( 'Título', 670 );
    
    gridQuestionnaireConfig = new dhtmlXGridObject( 'gridQuestionnaireConfig' );
    gridQuestionnaireConfig.setHeader( header );
    gridQuestionnaireConfig.attachHeader( "#rspan,#text_filter" );
    gridQuestionnaireConfig.setInitWidths( "30,*" );
    gridQuestionnaireConfig.setColAlign( "center,left" );
    gridQuestionnaireConfig.setColTypes( "ro,ro" );
    gridQuestionnaireConfig.setColSorting( "str,str" );
    gridQuestionnaireConfig.setSkin( config.grid );
    gridQuestionnaireConfig.enablePaging( true, 30, 10, 'divPagQuestionnaireConfig', true, 'divPagQuestionnaireConfig' );
    gridQuestionnaireConfig.attachFooter( t( 'Total', 19 ) + ",{#stat_count}" );
    gridQuestionnaireConfig.init();
    
    return true;
}

function save( form )
{   
    if ( !$( '#question-container .modules' ).length ) {
	
	msgErro( t( 'Tem que inserir ao menos uma pergunta', 679 ) );
	return false;
    }
    
    var valid = true;
    $( '#question-container .modules .table-option' ).each(
	function()
	{
	    if ( !$( this ).find( 'tbody tr' ).length ) {
		
		valid = false;
		return false;
	    }
	}
    );
	
    if ( !valid ) {
	
	msgErro( t( 'Tem que inserir ao menos uma opção para as perguntas', 680 ) );
	return false;
    }
    
    var obj = {
        callback: function( response )
        {
            if ( !response.error ) {
		msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
		
		location.href = baseUrl + '/me/questionnaireconfig/form/id/' + response.id;
	    }
        }
    };
    
    return submitAjax( form, obj );
}


function addQuestionText( id )
{
    id = id || 0;
    $.ajax({
        type: 'POST',
        url: baseUrl + '/me/questionnaireconfig/questiontext/id/' + id,
        dataType: 'text',
	async: false,
        beforeSend: function () 
        {
            loading( true );
        },
	complete: function()
	{
	    loading( false );
	},
        success: function ( response ) 
        {
            $( '#question-container' ).append( response );
	    
	    hideShowModules();
	    
	    scrollTo( $( '#question-container .modules:last' ) );
        },
        error: function ( response ) 
        {
            msgErro( t( 'Erro ao efetuar operação', 25 ) );
        }
    });
}

function addQuestionOption( id )
{
    id = id || 0;
    
    $.ajax({
        type: 'POST',
        url: baseUrl + '/me/questionnaireconfig/questionoption/id/' + id,
        dataType: 'text',
	async: false,
        beforeSend: function () 
        {
            loading( true );
        },
	complete: function()
	{
	    loading( false );
	},
        success: function ( response ) 
        {
	    $( '#question-container' ).append( response );
	    $( '.text-numeric4' ).inputmask( {'mask': '9', 'repeat': 4, 'greedy': false});
	    
	    modules = $( '#question-container .modules:last' );
	    
	    if ( id ) {
		
		handleMultiples( modules.find( '.handle-multiples' ) );
		loadOptionsQuestion( modules, id );
	    }
	    
	    hideShowModules();
        },
        error: function ( response ) 
        {
            msgErro( t( 'Erro ao efetuar operação', 25 ) );
        }
    });
}

function loadOptionsQuestion( response, id )
{
    $.ajax({
        type: 'POST',
        url: baseUrl + '/me/questionnaireconfig/loadoptions/id/' + id,
        dataType: 'text',
	async: false,
        beforeSend: function () 
        {
            loading( true );
        },
	complete: function()
	{
	    loading( false );
	},
        success: function ( content ) 
        {
            $( response ).find( 'table tbody' ).html( content );
        },
        error: function ( response ) 
        {
            msgErro( t( 'Erro ao efetuar operação', 25 ) );
        }
    });
}

function addOption( button )
{
    var tbody = $( button ).closest( 'table' ).find( 'tbody' );
    var order = $( button ).closest( '.modules' ).find( '.order' ).val();
    
    $.ajax({
        type: 'POST',
        url: baseUrl + '/me/questionnaireconfig/option/order/' + order,
        dataType: 'text',
        beforeSend: function () 
        {
            loading( true );
        },
	complete: function()
	{
	    loading( false );
	},
        success: function ( response ) 
        {
            $( tbody ).append( response );
        },
        error: function ( response ) 
        {
            msgErro( t( 'Erro ao efetuar operação', 25 ) );
        }
    });
}

function rebuildOrder()
{
    $( '#question-container .modules' ).each(
	function( index, element )
	{
	    index++;
	    $( this ).find( 'h5 span' ).html( index );
	    $( this ).find( '.order' ).val( index );
	    
	    $( this ).find( '.table-option :input' ).each(
		function( i, input )
		{
		    $( input ).attr( 'name', $( input ).attr( 'name' ).replace( /[0-9]+/g, index ) );
		}
	    );
	}
    );
}

function removeQuestion( link )
{
    if ( !confirm( t( 'Deseja remover esta pergunta', 681 ) ) )
	return false;
    
    $( link ).closest( '.modules' ).remove();
    rebuildOrder();
}

function removeOption( btn )
{
    if ( !confirm( t( 'Deseja remover esta opção', 682 ) ) )
	return false;
    
    $( btn ).closest( 'tr' ).remove();
}

function initDragDrop()
{
    return false;
    $( "#question-container" ).sortable(
	{
	    items: '.modules',
	    stop: rebuildOrder
	}
    );
}

function handleMultiples( combo )
{
    var value = $( combo ).val();
    var choices = $( combo ).closest( '.modules' ).find( '.choices ');
    
    if ( 1 == value ) {
	
	choices.removeAttr( 'readonly' );
    } else {
	
	choices.val( 1 ).attr( 'readonly', true );
    }
    
    choices.focus();
}

function initChangeValidateOption()
{
    $( '#question-container .modules .table-option :input' ).live( 'change',
	function()
	{
	    indexTd = $( this ).closest( 'td' ).index();
	    table = $( this ).closest( 'table' ).find( 'tbody' );
	    tester = $( this );
	    
	    table.find( 'tr' ).each(
		function( index, tr )
		{
		    inputs = $( tr ).find( 'td' ).eq( indexTd ).find( ':input' );
		    inputs.each(
			function( index, input )
			{
			    if ( $( input ).isEqual( tester ) )
				return true;
			    
			    if ( $( input ).val() == $( tester ).val() ) {
				
				$( tester ).val( '' ).focus();
				msgErro( t( 'Valor já definido', 683) );
				return false;
			    }
			}
		    );
		}
	    );
	}
    );
}

function loadQuestions()
{
    id = $( '#id_questionnaire_config' ).val();
    
    $.ajax({
        type: 'POST',
        url: baseUrl + '/me/questionnaireconfig/listquestion/id/' + id,
        dataType: 'json',
        beforeSend: function () 
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
		q = response[i];
		
		if ( q.type == 'T' )
		    addQuestionText( q.id );
		else
		    addQuestionOption( q.id );
	    }
        },
        error: function ( response ) 
        {
            msgErro( t( 'Erro ao efetuar operação', 25 ) );
        }
    });
}

function upModule( link )
{
    module = $( link ).closest( '.modules' );
    
    if ( module.prev().length ) {
	
	module.insertBefore( module.prev() );
	blinkModule( module );
    }
    
    hideShowModules();
}

function downModule( link )
{
    module = $( link ).closest( '.modules' );
    
    if ( module.next().length ) {
	
	module.insertAfter( module.next() );
	blinkModule( module );
    }
    
    hideShowModules();
}

function blinkModule( module )
{
  for ( i=0; i<2; i++ ) {
    $( module ).fadeTo('fast', 0.5).fadeTo('fast', 1.0);
  }
}

function hideShowModules()
{
    $( '#question-container .modules' ).each(
	function()
	{
	    hideShowUpDown( $( this ) );
	}
    );
}

function hideShowUpDown( module )
{
    if ( module.next().length )
	$( module ).find( '.down_module' ).show();
    else
	$( module ).find( '.down_module' ).hide();
    
    if ( module.prev().length )
	$( module ).find( '.up_module' ).show();
    else
	$( module ).find( '.up_module' ).hide();
    
    rebuildOrder();
}