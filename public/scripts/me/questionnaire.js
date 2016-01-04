/**
 * 
 */
$(document).ready(
    function()
    {
        $( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/me/questionnaire/form';
	    }
	);
	    
	$( '#editar' ).click( editItem );
	
	configMultiples();
    }
);

function editItem()
{
     if ( !gridQuestionnaire.getSelectedId() ) {
        msgAlerta( t( 'Selecione o item para edição', 20 ) );
        return false;
    }

    var id = gridQuestionnaire.getSelectedId();
    location.href = baseUrl + '/me/questionnaire/form/id/' + id;
    return true;
 
}

var gridQuestionnaire;
function initGridQuestionnaire()
{
    if ( !$( '#gridQuestionnaire' ).length )
        return false;
    
    header = "#," + t( 'Identificador', 685 ) + ',' + t( 'Titulo', 670 ) + ',' + t( 'Distrito', 96 ) + ',' + t( 'Sub distrito', 98 )
	    + ',' + t( 'Suku', 100 ) + ',' + t( 'Road Location', 626 );
    
    gridQuestionnaire = new dhtmlXGridObject( 'gridQuestionnaire' );
    gridQuestionnaire.setHeader( header );
    gridQuestionnaire.attachHeader( "#rspan,#text_filter,#select_filter,#select_filter,#select_filter,#select_filter,#text_filter" );
    gridQuestionnaire.setInitWidths( "30,150,150,180,150,180,80" );
    gridQuestionnaire.setColAlign( "center,left,left,left,left,left,left" );
    gridQuestionnaire.setColTypes( "ro,ro,ro,ro,ro,ro,ro" );
    gridQuestionnaire.setColSorting( "str,str,str,str,str,str,str" );
    gridQuestionnaire.setSkin( config.grid );
    gridQuestionnaire.enablePaging( true, 30, 10, 'divPagQuestionnaire', true, 'divPagQuestionnaire' );
    gridQuestionnaire.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,#cspan,#cspan,{#stat_count}" );
    gridQuestionnaire.init();
    
    return true;
}

function save( form )
{   
    var obj = {
        callback: function( response )
        {
            if ( !response.error )
                msgSucesso( t( 'Operação realizada com sucesso', 46 ) );
        },
	validate: function()
	{
	    var valid = true;
	    $( '.list-option.is-required' ).each(
		function()
		{
		    inputs = $( this ).find( 'input:checked' );
		    if ( !inputs.length ) {
			
			$( this ).closest( '.input_wrapper' ).addClass( 'input-error' );
			valid = false;
			
		    } else
			$( this ).closest( '.input_wrapper' ).removeClass( 'input-error' );
		}
	    );
	    
	    if ( !valid )
		msgErro( t( 'Verifique os campos do formulário.', 206 ) );
	    
	    return valid;
	}
    };
    
    return submitAjax( form, obj );
}

function getQuestionnaire()
{
    idQuest = $( '#fk_id_questionnaire_config' ).val();
    $( '#question-container' ).empty();
    
    if ( empty( idQuest ) )
	return false;
    
    id = $( '#id_questionnaire' ).val();
    
    $.ajax({
        type: 'POST',
        url: baseUrl + '/me/questionnaire/getquestionnaire/quest/' + idQuest + '/id/' + id,
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
            $( '#question-container' ).html( response );
	    initMasks();
        },
        error: function ( response ) 
        {
            msgErro( t( 'Erro ao efetuar operação', 25 ) );
        }
    });
}

function configMultiples()
{
    $( '.list-option input' ).live( 'change',
	function()
	{
	    var max = $( this ).closest( '.list-option' ).data( 'max' );
	    checked = $( this ).closest( '.list-option' ).find( 'input:checked' );
	    
	    if ( checked.length > parseInt( max ) )
		$( this ).attr( 'checked', false );
	}
    );
}