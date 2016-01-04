/**
 * 
 */
$(document).ready(
    function()
    {
        $( '#novo' ).click(
	    function()
	    {
		location.href = baseUrl + '/me/snapshot/information';
	    }
	);
	    
	$( '#editar' ).click( editItem );
	
	if ( $( '.table_tabs_menu li a.selected' ).length ) {
	    
	    offetScroll = $( '.table_tabs_menu li a.selected' ).parent().position().left + 100;
	    $( '.table_tabs_menu' ).scrollingCarousel( { looped: false, scrollerOffset: offetScroll } );
	}
	
	$( '.float' ).autoNumeric( "init", {vMax: '1000', mDec: '2', wEmpty: 'zero', lZero: 'deny'});
    }
);

function editItem()
{
     if ( !gridSnapshot.getSelectedId() ) {
        msgAlerta( t( 'Selecione o item para edição', 20 ) );
        return false;
    }

    var id = gridSnapshot.getSelectedId();
    location.href = baseUrl + '/me/snapshot/information/id/' + id;
    return true;
 
}

var gridSnapshot;
function initGridSnapshot()
{
    if ( !$( '#gridSnapshot' ).length )
        return false;
    
    header = "#," + t( 'Distrito', 96 ) + ',' + t( 'Sub distrito', 98 )
	    + ',' + t( 'Suku', 100 ) + ',' + t( 'Road Location', 626 ) + ',' + t( 'Code', 628 )+ ',' + t( 'Reference', 621 );
    
    gridSnapshot = new dhtmlXGridObject( 'gridSnapshot' );
    gridSnapshot.setHeader( header );
    gridSnapshot.attachHeader( "#rspan,#select_filter,#select_filter,#select_filter,#text_filter,#text_filter,#text_filter" );
    gridSnapshot.setInitWidths( "30,150,180,150,180,80,120" );
    gridSnapshot.setColAlign( "center,left,left,left,left,left,left" );
    gridSnapshot.setColTypes( "ro,ro,ro,ro,ro,ro,ro" );
    gridSnapshot.setColSorting( "str,str,str,str,str,str,str" );
    gridSnapshot.setSkin( config.grid );
    gridSnapshot.enablePaging( true, 30, 10, 'divPagSnapshot', true, 'divPagSnapshot' );
    gridSnapshot.attachFooter( t( 'Total', 19 ) + ",#cspan,#cspan,#cspan,#cspan,#cspan,{#stat_count}" );
    gridSnapshot.init();
    
    return true;
}

function saveInformation( form )
{   
    var obj = {
        callback: function( response )
        {
            if ( !response.error )
                location.href = baseUrl + '/me/snapshot/document/id/' + response.id;
        }
    };
    
    return submitAjax( form, obj );
}

function saveSocio( form )
{   
    var obj = {
        callback: function( response )
        {
            if ( !response.error )
                location.href = baseUrl + '/me/snapshot/accessmarket/id/' + response.id;
        }
    };
    
    return submitAjax( form, obj );
}

function saveMarket( form )
{   
    road = $( 'input.road:checked' );
    if ( !road.length ) {
	
	 scrollTo( $( 'input.road' ) );
	 msgAlerta( t( 'Selecione uma das formas de acesso a estrada', 649 ) );
	 return false;
    }
    
    if ( !$( '#access-market tr' ).length ) {
	
	 scrollTo( $( '#access-market' ) );
	 msgAlerta( t( 'Adicione uma forma de acesso aos mercados', 650 ) );
	 return false;
    }
    
    var obj = {
        callback: function( response )
        {
            if ( !response.error )
                location.href = baseUrl + '/me/snapshot/accesseducation/id/' + response.id;
        }
    };
    
    return submitAjax( form, obj );
}

function saveOverall( form )
{   
    var obj = {
        callback: function( response )
        {
            if ( !response.error )
                location.href = baseUrl + '/me/snapshot/market/id/' + response.id;
        }
    };
    
    return submitAjax( form, obj );
}


function saveEducation( form )
{   
    var obj = {
        callback: function( response )
        {
            if ( !response.error )
                location.href = baseUrl + '/me/snapshot/accesshealth/id/' + response.id;
        }
    };
    
    return submitAjax( form, obj );
}

function saveHealth( form )
{   
    var obj = {
        callback: function( response )
        {
            if ( !response.error )
                location.href = baseUrl + '/me/snapshot/image/id/' + response.id;
        }
    };
    
    return submitAjax( form, obj );
}

function loadImagesSnapshot()
{
    $.ajax({
        type: 'GET',
        url: baseUrl + '/me/snapshot/listimage/id/' + $( '#id_snapshot' ).val(),
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
            $( '#image-container' ).html( response );
	    $( '.product a.fancybox' ).fancybox( {type: 'image'} );
        },
        error: function ( response ) 
        {
            $( '#image-container' ).html( t( 'Erro ao efetuar operação', 25 ) );
        }
    });
}

function addImage()
{
    var fileImages = $( '.file-image' ).length;
    var filesSave = $( 'dl.product' ).length;
    
    if ( ( fileImages + filesSave ) >= 10 ) {
	
	msgAlerta( t( 'Só pode selecionar no máximo 10 imagens', 633 ) );
	return false;
    }
    
    var firstRow = $( '.abas-form .row' ).eq( 0 );
    cloned = firstRow.clone();
    cloned.addClass( 'cloned' ).find( ':input' ).val( '' );
    
    var button = $( '<input />' ).attr( 'type', 'button' )
				 .click( 
				    function()
				    {
					$( this ).closest( '.row' ).remove();
				    }
				);
    
    var buttonRemove = $( '<span />' );
    buttonRemove.addClass( 'button green_button' );
    buttonRemove.append( $( '<span />' ).append( $( '<span />' ).html( t( 'Remover', 214 ) ) ) );
    buttonRemove.append( button );
    
    cloned.find( '.button' ).replaceWith( buttonRemove );
    cloned.insertAfter( firstRow );
}

function uplodaImages( form )
{
    if ( !validaForm( form ) ) {
	
	msgErro( t( 'Verifique os campos do formulário.', 206 ) );
	return false;
    }
    
    if ( $( 'dl.product' ).length >= 10 ) {
	
	msgAlerta( t( 'Só pode selecionar no máximo 10 imagens', 633 ) );
	return false;
    }
	
    /*
    var clone = cloneForm( form );
    
    var newForm = cloneForm( form );
    newForm.removeAttr('onsubmit')
	   .unbind( 'submit' )
	   .submit(
		function( e ) 
		{
		    action = $( this ).attr( 'action' );
		    iframeName = parseId( action );
		    
		    if ( !$( '#' + iframeName ).length ) {
		    
			iframe = $( '<iframe />' );
			iframe.attr( 'id', iframeName )
			    .attr( 'name', iframeName )
			    .hide();

			$( 'body' ).append( iframe );
			
			iframe.load( 
			    function()
			    {  
				loading( false );
				//clone.remove();
				parseUpload( iframe );
			    } 
			);
		    }
		    
		    this.target = iframeName;
		}
	    );
	
    loading( true );
    newForm.submit();
    newForm.remove();
    */
    
    return true;
}

function parseUploadImage( iframe )
{
    iframe = $( iframe );
    var textarea = iframe.contents().find('textarea');
    if ( textarea.length ) {

	var json = eval( '(' + textarea.eq(0).val() + ')' );

	if ( !json.error ) {

	    $( '.row.cloned' ).remove();
	    $( '.row input' ).val( '' );
	    loadImagesSnapshot();

	} else {

	    messages = !empty( json.description ) ? json.description : t( 'Erro ao realizar upload de imagem.', 634 );
	    msgErro( messages );
	}
    }
}

function deleteImage( image )
{
    if ( !confirm( t( 'Deseja remover esta imagem?', 635 ) ) )
	return false;
    
    $.ajax({
        type: 'POST',
        url: baseUrl + '/me/snapshot/removeimage/',
	data: {
	    image: image
	},
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
            if ( response.status )
		loadImagesSnapshot();
	    else
		msgErro( t( 'Erro ao efetuar operação', 25 ) );
        },
        error: function ( response ) 
        {
            msgErro( t( 'Erro ao efetuar operação', 25 ) );
        }
    });
}

function deleteDocument( document )
{
    if ( !confirm( t( 'Deseja remover o documento atual', 636 ) ) )
	return false;
    
    $.ajax({
        type: 'POST',
        url: baseUrl + '/me/snapshot/removedocument/',
	data: {
	    document: document
	},
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
            if ( response.status )
		loadSnapshotDocuments();
	    else
		msgErro( t( 'Erro ao efetuar operação', 25 ) );
        },
        error: function ( response ) 
        {
            msgErro( t( 'Erro ao efetuar operação', 25 ) );
        }
    });
}

function uploadDocument( form )
{
    if ( !validaForm( form ) ) {
	
	msgErro( t( 'Verifique os campos do formulário.', 206 ) );
	return false;
    }
    
    //if ( $( '#document-container' ).hasClass( 'has-image' ) && !confirm( t( 'Deseja remover o documento atual?', 636 ) ) )
	//return false;

    return true;
}

function parseUploadDocument( iframe )
{
    iframe = $( iframe );
    var textarea = iframe.contents().find( 'textarea' );
    if ( textarea.length ) {

	var json = eval( '(' + textarea.eq(0).val() + ')' );

	if ( !json.error ) {

	    $( '#document' ).val( '' );
	    loadSnapshotDocuments();

	} else {

	    messages = !empty( json.description ) ? json.description : t( 'Erro ao realizar upload do documento.', 637 );
	    msgErro( messages );
	}
    }
}

function loadSnapshotDocuments()
{
    $.ajax({
        type: 'GET',
        url: baseUrl + '/me/snapshot/listdocuments/id/' + $( '#id_snapshot' ).val(),
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
            $( '#list-document-container' ).html( response );
        },
        error: function () 
        {
            msgErro( t( 'Erro ao efetuar operação', 25 ) );
        }
    });
}

function showDocument( name, path, size )
{
    $( '#document-container .module_bottom' ).empty();

    $( '#hidden-container' ).hide();
    $( '#doc-size' ).html( size );
    $( '#doc-name' ).html( name );

    iframe  = $( '<iframe />' );
    iframe.addClass( 'iframe-document' ).attr( 'src', baseUrl + '/' + path );

    $( '#document-container .module_bottom' ).append( iframe );
    $( '#document-container' ).show();
    scrollTo( iframe );
}

/*
function removeDocument()
{
    if ( !confirm( t( 'Deseja realmente remover o documento ?', 639 ) ) )
	return false;
    
    $.ajax({
        type: 'POST',
        url: baseUrl + '/me/snapshot/removedocument/',
	data: {
	    id: $( '#id_snapshot' ).val()
	},
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
            if ( response.status ) {
		
		$( '#document-container' ).hide().removeClass( 'has-image' );
		$( '#doc-size' ).html( '' );
		$( '#hidden-container' ).show();
		$( '#document-container .module_bottom' ).empty();
		
	    } else {
		msgErro( t( 'Erro ao remover documento', 640 ) );
	    }
        },
        error: function ( response ) 
        {
            msgErro( t( 'Erro ao remover documento', 640 ) );
        }
    });
}
*/

function configAccess()
{
    /*
    $( '.table-rankings a' ).hover(
	function()
	{
	    $( this ).removeClass( 'no-color' );
	},
	function()
	{
	    if ( !$( this ).hasClass( 'fixed-ranking' ) )
		$( this ).addClass( 'no-color' );
	}
    );
	
    $( '.table-rankings a' ).click(
	function()
	{
	    value = $( this ).parent().index();
	    value = 3 - parseInt( value );
	    
	    $( this ).closest( 'tr' )
		     .find( 'input' )
		     .val( value );
	    
	    $( this ).closest( 'tr' )
		     .find( 'a' )
		     .removeClass( 'fixed-ranking' )
		     .addClass( 'no-color' );
		     
	    $( this ).addClass( 'fixed-ranking' ).removeClass( 'no-color' );
	    
	    totalIndicator();
	}
    );
    */
	
    loadIndicators();
}

function loadIndicators()
{
    $( '.iframe-report' ).height( $( '.iframe-report' ).contents().outerHeight( true ) + 30 );
    
    $.ajax({
        type: 'POST',
        url: baseUrl + '/me/snapshot/loadindicators/',
	data: {
	    id: $( '#id_snapshot' ).val(),
	    type: $( '#type' ).val()
	},
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
		
		obj = response[i];
		index = 2 - parseInt( obj.value );
		row = parseInt( obj.indicator );
		
		$( '.iframe-report' ).contents().find( 'body' ).find( '.table-rankings tbody tr' )
						.eq( row )
						.find( 'a' )
						.eq( index )
						.removeClass( 'no-color' )
						.addClass( 'fixed-ranking' )
						.closest( 'tr' )
						.find( 'input' )
						.val( obj.value );
	    }
	    
	    totalIndicator();
        },
        error: function ( response ) 
        {
            msgErro( t( 'Erro ao buscar indicatores', 644 ) );
        }
    });
}

function saveIndicator( form )
{   
    var valid = true;
    $( '.table-rankings tbody tr' ).each(
	function()
	{
	    if ( !$( this ).find( 'a.fixed-ranking' ).length ) {
		
		valid = false;
		return false;
	    }
	}
    );
	
    if ( !valid ) {

	msgAlerta( t( 'Tem que avaliar todos os critérios', 642 ) );
	return false;
    }
    
    var obj = {
        callback: function( response )
        {
	    if ( !response.error ) {
		
		msgSucesso( t( 'Indicadores salvos com sucesso', 643 ) );
	    }
        }
    };
    
    return submitAjax( form, obj );
}

function totalIndicator()
{
    var total = 0;
    var cont = 0;
    $( '.iframe-report' ).contents().find( 'body' ).find( '.table-rankings tbody tr input' ).each(
	function()
	{
	    total += parseInt( $(this).val() );
	    cont++;
	}
    );
	
    score = ( total * 100 ) / ( cont * 2 );
	
    $( '.iframe-report' ).contents().find( 'body' ).find( '#total' ).val( total );
    $( '.iframe-report' ).contents().find( 'body' ).find( '#score' ).val( score.toFixed( 0 ) );
}

var villages = null;
function addVillage()
{
    if ( empty( $( '#fk_id_add_suku' ).val() ) ) {
	
	msgAlerta( t( 'Selecione o Suku primeiro', 999 ) );
	return false;
    }
    
    if ( empty( villages ) )
	searchVillageSuku();
    else
	addRowVillage();
}

var villageData = null;
function searchVillageSuku()
{
    $.ajax({
        type: 'GET',
        url: baseUrl + '/me/snapshot/searchvillages/id/' + $( '#fk_id_add_suku' ).val(),
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
            var combo = $( '<select />' );
	    combo.attr( 'name', 'village_combo[]' )
		  .addClass( 'required tip-error' )
		  .attr( 'msgError', t( 'Preencha este campo', 999 ) )
		  .change(
		    function()
		    {
			val = $( this ).val();
			if ( empty( val ) )
			    return false;
			
			obj = eval( '(' + val + ')' );
			$( this ).closest( 'td' ).find( 'input' ).val( obj.id_village );
			$( this ).closest( 'tr' ).find( 'td:eq(1) input' ).val( obj.village_code );
		    }
		  );
	    
	    var option = $( '<option />' ).val( '' ).html( t( 'Selecione', 85 ) );
	    combo.append( option );
	    
	    for ( i in response ) {
		
		option = $( '<option />' );
		option.val( response[i].id )
		      .html( response[i].label );
		      
		combo.append( option );
	    }
	    
	    villages = combo;
	    if ( empty( villageData ) )
		addRowVillage();
	    else
		addRowsDataVillage();
	    
	    $( '#fk_id_add_suku' ).data( 'prev', $( '#fk_id_add_suku' ).val() );
	    $( '#fk_id_add_suku' ).change
	    (
		function()
		{
		    if ( $( '#villages tbody tr' ).length ) {
			
			var obj = $( this );
			obj.val( obj.data( 'prev' ) );
			obj.data( 'prev', obj.val() );
		    }
		}
	    );
        },
        error: function ( response ) 
        {
            msgErro( t( 'Erro ao buscar as aldeias', 999 ) );
        }
    });
}

function addRowsDataVillage()
{
    for ( i in villageData ) {
	
	row = villageData[i];
	addRowVillage( row );
    }
}

function addRowVillage( row )
{
    var tr = $( '<tr />' );
    var span = $( '<span />' ).addClass( 'input_wrapper short_input' );
    
    var hidden = $( '<input />' ).attr( 'type', 'hidden' ).attr( 'name', 'village_id[]' );
    var villageCode = $( '<input />' ).attr( 'name', 'village_code[]' )
				  .attr( 'type', 'text' )
				  .addClass( 'text required tip-error' )
				  .attr( 'readOnly', true );
    
    var total = $( '<input />' ).attr( 'name', 'village_total[]' )
			    .attr( 'type', 'text' )
			    .addClass( 'text required tip-error text-numeric' )
			    .attr( 'msgError', t( 'Preencha este campo', 999 ) );
			    
    var women = total.clone();
    var men = total.clone();
    var hh  = total.clone();
    
    women.attr( 'name', 'village_women[]' );
    men.attr( 'name', 'village_men[]' );
    hh.attr( 'name', 'village_hh[]' );
    
    villageClone = villages.clone( true );
    tr.append( $( '<td />' ).append( hidden ).append( span.clone().removeClass( 'short_input' ).append( villageClone ) ) );
    tr.append( $( '<td />' ).append( span.clone().append( villageCode ) ) );
    tr.append( $( '<td />' ).append( span.clone().append( total ) ) );
    tr.append( $( '<td />' ).append( span.clone().append( women ) ) );
    tr.append( $( '<td />' ).append( span.clone().append( men ) ) );
    tr.append( $( '<td />' ).append( span.clone().append( hh ) ) );
    
    if ( !empty( row ) ) {
	
	villageClone.val( row.combo );
	hidden.val( row.id );
	villageCode.val( row.code );
	total.val( row.total );
	women.val( row.women );
	men.val( row.men );
	hh.val( row.hh );
    }
    
    spanButton = $( '<span />' ).addClass( 'button green_button' )
				.append( $( '<span />' ).append( $( '<span />' ).html( 'REMOVE' ) ) )
				.append( 
				    $( '<input />' ).attr( 'type', 'button' )
						    .click( 
							function()
							{
							    if ( !confirm( t( 'Deseja remover este item', 93 ) ) )
								return false;
							    
							    $( this ).closest( 'tr' ).remove();
							}
						    )
				);
				    
    tr.append( $( '<td />' ).append( spanButton ) );
    
    $( '#villages tbody' ).append( tr );
    
    $( '.text-numeric' ).inputmask( {'mask': '9', 'repeat': 5, 'greedy': false});
}

function addAccessMarket( row )
{
    var options = ['<1h', '1-2h', '>2h','N/A'];
    var index = $( 'tbody#access-market tr' ).length < 1 ? 0 : $( 'tbody#access-market tr' ).length / 2;
    
    var trWet = $( '<tr />' );
    var trDry = $( '<tr />' );
    
    var tdLocation = $( '<td />' );
    var span = $( '<span />' ).addClass( 'input_wrapper medium_input' );
    
    var marketLocation = $( '<input />' ).attr( 'name', 'market_location[' + index + ']' )
				.attr( 'type', 'text' )
				.attr( 'msgError', t( 'Preencha este campo', 648 ) )
				.addClass( 'text required tip-error' );
				
    if ( !empty( row ) && !empty( row.place ) )
	marketLocation.val( row.place );

    tdLocation.attr( 'rowspan' , 2 );
    tdLocation.append( span.clone().append( marketLocation ) );
    
    var tdDaysWeek = $( '<td />' );
    var daysWeek = $( '<input />' ).attr( 'name', 'days_week[' + index + ']' )
				.attr( 'type', 'text' )
				.attr( 'msgError', t( 'Preencha este campo', 648 ) )
				.addClass( 'text required tip-error' );
				
    if ( !empty( row ) && !empty( row.days_week ) )
	daysWeek.val( row.days_week );
				
    tdDaysWeek.attr( 'rowspan',  2 );
    tdDaysWeek.append( span.clone().append( daysWeek ) );
    
    var tdWetSeason = $( '<td />' );
    var selectWetSeasonWalk = $( '<select />' ).attr( 'name', 'wet_season_walk[' + index + ']' )
						.addClass( 'text required tip-error' );
						
    for( i in options )
	selectWetSeasonWalk.append( $( '<option />' ).val( options[i] ).html( options[i] ) );
    
    if ( !empty( row ) && !empty( row.wet_season_walk ) )
	selectWetSeasonWalk.val( row.wet_season_walk );
    
    tdWetSeason.append( selectWetSeasonWalk );
    
    var tdDrySeason = $( '<td />' );
    var selectDrySeasonWalk = $( '<select />' ).attr( 'name', 'dry_season_walk[' + index + ']' )
						.addClass( 'text required tip-error' );
						
    for( i in options )
	selectDrySeasonWalk.append( $( '<option />' ).val( options[i] ).html( options[i] ) );
    
    if ( !empty( row ) && !empty( row.dry_season_walk ) )
	selectDrySeasonWalk.val( row.dry_season_walk );
    
    tdDrySeason.append( selectDrySeasonWalk );
    
    var tdTransport = $( '<td />' );
    tdTransport.html( 'Walk' );
    
    var tdTravelCost = $( '<td />' );
    var travelCost = $( '<input />' ).attr( 'name', 'travel_cost_walk[' + index + ']' )
				.attr( 'type', 'text' )
				.attr( 'msgError', t( 'Preencha este campo', 648 ) )
				.addClass( 'text required tip-error float' );
				
    if ( !empty( row ) && !empty( row.travel_cost_walk ) )
	travelCost.val( row.travel_cost_walk );
    
    tdTravelCost.append( span.clone().append( travelCost ) );	
    
    trWet.append( tdLocation )
	.append( tdDaysWeek )
	.append( tdWetSeason )
	.append( tdDrySeason )
	.append( tdTransport )
	.append( tdTravelCost );
	
    var tdWetSeasonMotor = $( '<td />' );
    var selectWetSeasonMotor = $( '<select />' ).attr( 'name', 'wet_season_motor[' + index + ']' )
						.addClass( 'text required tip-error' );
						
    for( i in options )
	selectWetSeasonMotor.append( $( '<option />' ).val( options[i] ).html( options[i] ) );
    
    if ( !empty( row ) && !empty( row.wet_season_motor ) )
	selectWetSeasonMotor.val( row.wet_season_motor );
    
    tdWetSeasonMotor.append( selectWetSeasonMotor );
    
    var tdDrySeasonMotor = $( '<td />' );
    var selectDrySeasonMotor = $( '<select />' ).attr( 'name', 'dry_season_motor[' + index + ']' )
						.addClass( 'text required tip-error' );
						
    for( i in options )
	selectDrySeasonMotor.append( $( '<option />' ).val( options[i] ).html( options[i] ) );
    
    if ( !empty( row ) && !empty( row.dry_season_motor ) )
	selectDrySeasonMotor.val( row.dry_season_motor );
    
    tdDrySeasonMotor.append( selectDrySeasonMotor );
    
    var tdTransportMotor = $( '<td />' );
    tdTransportMotor.html( 'Motor' );
    
    var tdTravelCostMotor = $( '<td />' );
    var travelCostMotor = $( '<input />' ).attr( 'name', 'travel_cost_motor[' + index + ']' )
				.attr( 'type', 'text' )
				.attr( 'msgError', t( 'Preencha este campo', 648 ) )
				.addClass( 'text required tip-error float' );
				
    if ( !empty( row ) && !empty( row.travel_cost_motor ) )
	travelCostMotor.val( row.travel_cost_motor );
				
    tdTravelCostMotor.append( span.clone().append( travelCostMotor ) );
				
    trDry.append( tdWetSeasonMotor )
	.append( tdDrySeasonMotor )
	.append( tdTransportMotor )
	.append( tdTravelCostMotor );
	
    spanButton = $( '<span />' ).addClass( 'button green_button' )
			.append( $( '<span />' ).append( $( '<span />' ).html( 'REMOVE' ) ) )
			.append( 
			    $( '<input />' ).attr( 'type', 'button' )
					    .click( 
						function()
						{
						    if ( !confirm( t( 'Deseja remover este item', 93 ) ) )
							return false;

						    var tr = $( this ).closest( 'tr' );
						    tr.next().remove();
						    tr.remove();
						}
					    )
			);
			    
    var tdDelete = $( '<td />' );
    tdDelete.attr( 'rowspan' , 2 );
    tdDelete.append( spanButton );
    
    trWet.append( tdDelete );
    
    $( 'tbody#access-market' ).append( trWet ).append( trDry );
    
    $( '.float' ).autoNumeric( "init", {vMax: '1000', mDec: '2', wEmpty: 'zero', lZero: 'deny'});
}

function printAccessIndicator()
{
    $( '#print-button' ).hide();
    
    setTimeout(
	function()
	{
	    $( '#print-button' ).show();
	}
	,
	2000
    );
	
    $( 'div.forms' ).printElement();
}