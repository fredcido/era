/**
 * 
 */
$(document).ready(
    function()
    {
	$('#form-report').on('reset', 
	    function()
	    {
		setTimeout(getQuestionnaire, 500);
	    }
	);

	$('.btn-report').on('click',
	    function()
	    {
		generateReport();
	    }
	);
    }
);

function editItem()
{
    var id = gridQuestionnaire.getSelectedId();
    pagina = baseUrl + '/relatorio/me/printquestionnaire/id/' + id;
    newWindow( pagina, 'Print Questionnaire' );
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
    gridQuestionnaire.attachEvent( 'onRowDblClicked', editItem );
    gridQuestionnaire.enablePaging( true, 30, 10, 'divPagQuestionnaire', true, 'divPagQuestionnaire' );
    gridQuestionnaire.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,#cspan,#cspan,{#stat_count}" );
    gridQuestionnaire.init();
    
    return true;
}

function listQuestionnaire( form )
{
    var params = $( form ).serialize();
    
    $.ajax({
        type: 'POST',
        url: baseUrl + '/relatorio/me/listquestionnaire/',
        dataType: 'json',
	data: params,
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
            gridQuestionnaire.clearAll();
	    gridQuestionnaire.parse( response, 'json' );
	    scrollTo( $( '#gridQuestionnaire' ) );
        },
        error: function ( response ) 
        {
            msgErro( t( 'Erro ao efetuar operação', 25 ) );
        }
    });
    
    return false;
}

function getQuestionnaire()
{
    idQuest = $( '#fk_id_questionnaire_config' ).val();
    $( '#question-container' ).empty();
    
    if ( empty( idQuest ) )
	return false;
    
    $.ajax({
        type: 'POST',
        url: baseUrl + '/relatorio/me/getquestionnaire/quest/' + idQuest,
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

function generateReport()
{
    idQuest = $( '#fk_id_questionnaire_config' ).val();
    if ( empty(idQuest ) ) {
	
	msgErro( t( 'Selecione o questionario', 684 ) );
	return false;
    }
    
    var form = $('#form-report');
    var clone = cloneForm( form );
    
    var url = baseUrl + '/relatorio/me/reportquestionnaire/';
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