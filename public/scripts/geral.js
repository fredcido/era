$( document ).ready(
    function()
    {
	// Tooltip
	$( '.tip-form' ).tipTip( { delay: 200, defaultPosition: 'right' } );
	
	// Menu
	$( '#main_menu' ).menu();
	
	// Mascara para data
	$( '.date-mask' ).inputmask( 'd/m/y', { "clearIncomplete": true }  );
	
	// Mascara para hora
	$( '.time-mask' ).inputmask( 'h:s', { "clearIncomplete": true }  );
	
	// Mascara para campos somente numericos
	$( '.text-numeric' ).inputmask( {'mask': '9', 'repeat': 5, 'greedy': false});
        
	// Mascara para campos somente numericos com 4 digitos
	$( '.text-numeric4' ).inputmask( {'mask': '9', 'repeat': 4, 'greedy': false});
	
	// Mascara para dinheiro
	$( '.money' ).maskMoney( { showSymbol: true, thousands:',', decimal:'.' } );
	
	// Fancybox
	$( '.fancybox' ).fancybox();
	
	$( 'input, select' ).each(
	    function( index, element )
	    {
		if ( !$( element ).attr( 'disabled' ) &&
		     $( element ).attr( 'type' ) != 'hidden' ) {
		     $( element ).focus();
		     return false;
		}
	    }
	);

	$('.optional-check').on('change', changeOptionalCheck );
    }
);


function initMasks()
{
    // Mascara para data
    $( '.mask_date' ).inputmask( 'd/m/y', { "clearIncomplete": true }  );
    // Mascara para hora
    $( '.mask_hour' ).inputmask( 'h:s', { "clearIncomplete": true }  );
    // Mascara para data/hora
    $( '.mask_date_hour' ).inputmask( 'd/m/y h:s', { "clearIncomplete": true }  );
    // Mascara para campos somente numericos
    $( '.mask_numeric' ).inputmask( {'mask': '9', 'repeat': 5, 'greedy': false});
    // Mascara para dinheiro
    $( '.mask_money' ).maskMoney( { showSymbol: true, thousands:',', decimal:'.' } );   
}

function changeOptionalCheck()
{
    var field = $(this).parent().find(':input').eq(0);
    
    if ( $( this ).is(':checked' ) ) {
	field.attr('disabled', true).val('').addClass('optional-field');
	
	if ( field.hasClass( 'required') ) {
	    field.addClass('had-required');
	    field.removeClass('required');
	}
	
    } else {
	field.removeAttr('disabled').removeClass('optional-field').focus();
	
	if ( field.hasClass( 'had-required') ) {
	    field.removeClass('had-required');
	    field.addClass('required');
	}
    }
    
    field.trigger('change');
}

var reqAjax = 0;

/**
*
* - Fun&ccedil;&atilde;o para subir div de loading, seja para carregamento da pagina
* - Ou para opera&ccedil;&otilde;es em Ajax
*
* @author Frederico Estrela Ga&iacute;va
* @version 01/10/2009
* @access public
* @param <boolean> show
*/
function loading( show )
{
    if ( show ) {
        
        reqAjax++;
        document.getElementById('loading').style.display = 'block';
        document.getElementById('loading_bkg').style.display = 'block';
    } else {
        
        reqAjax--;
        if ( reqAjax < 1 ) {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('loading_bkg').style.display = 'none';
        }
    }
}

function msgErro( text )
{
    showMsg( text, 'error' );
}

function msgAlerta( text )
{
    showMsg( text, 'alert' );
}

function msgSucesso( text )
{
    showMsg( text, 'confirm' );
}

function showMsg( text, type )
{
    var divContainer = $( '#msgDiv' );
    divContainer.removeClass( 'error' );
    divContainer.removeClass( 'alert' );
    divContainer.removeClass( 'confirm');

    divContainer.addClass( type );

    $( '#msgDivText' ).html( text );

    animateMsg( true );
}

function animateMsg( show )
{
    var nodeTarget = $( '#msgDiv' );
    var nodeBack = $( '#back_msg' );

    if ( show ) {
       nodeBack.fadeIn();
       $( nodeTarget ).fadeIn();
    } else {
       nodeBack.fadeOut();
       $( nodeTarget ).fadeOut();
    }
}

/**
 * Fun&ccedil;&atilde;o para verificar se a vari&aacute;vel e null ou v&aacute;zia.
 *
 * @author http://phpjs.org/functions/empty:392
 * @param  mixed_var
 * @return boolean
 */
function empty ( mixed_var ) {
    // !No description available for empty. @php.js developers: Please update the function summary text file.
    //
    // version: 911.1619
    // discuss at: http://phpjs.org/functions/empty    // +   original by: Philippe Baumann
    // +      input by: Onno Marsman
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: LH
    // +   improved by: Onno Marsman    // +   improved by: Francesco
    // +   improved by: Marc Jansen
    // +   input by: Stoyan Kyosev (http://www.svest.org/)
    // *     example 1: empty(null);
    // *     returns 1: true    // *     example 2: empty(undefined);
    // *     returns 2: true
    // *     example 3: empty([]);
    // *     returns 3: true
    // *     example 4: empty({});    // *     returns 4: true
    // *     example 5: empty({'aFunc' : function () { alert('humpty'); } });
    // *     returns 5: false

    var key;
    if ( ( mixed_var === '') ||
         ( mixed_var === 0 ) ||
		 ( mixed_var == '' ) ||
         ( mixed_var === '0' ) ||
		 ( mixed_var === 'null' ) ||
         ( mixed_var == 'NULL'  ) ||
		 ( mixed_var == null  ) ||
		 ( mixed_var === false  ) ||
		 ( mixed_var == 'undefined'  ) ||
		 ( mixed_var == undefined  ) ||
         ( mixed_var === 'undefined' )
    ){
        return true;
    }

    if ( typeof mixed_var == 'object' ) {

        for ( key in mixed_var ) {
		    return false;
        }
        return true;
    }
    return false;
}


function newWindow( pagina, title, largura, altura )
{
   var config;
   var titleWindow = title || '';
   
   if ( largura && altura ) {

        var esquerda = (screen.width - largura)/2;
        var topo = (screen.height - altura)/2;

        config = 'toolbar=no,location=no,fullscreen=yes,status=no,menubar=no,scrollbars=yes,resizable=no,height=' +
                altura + ', width=' + largura + ', top=' + topo + ', left=' + esquerda;

        window.open( pagina, titleWindow , config);
   } else {
       window.open( pagina, titleWindow);
   }
}

function truncate( str, size )
{
    size = size || 25;
    
    if ( str.length > size )
	str = str.substr(0, size) + '...';

    return str;
}


function toCamelCase( str )
{
    return str.replace(/(\-[a-z])/g, function($1){return $1.toUpperCase().replace('-','');});
}

function go( url )
{
    location.href = baseUrl + url;
}

/**
 * 
 * @param form
 * @return
 */
function submitAjax ( form, obj )
{
    var pars = $(form).serialize();
    
    if( !validaForm( form ) ) {
	
	msgErro( t( 'Verifique os campos do formulário.', 206 ) );
	return false;
    }
    
    if ( obj.validate && !obj.validate() )
	return false;
		
    $.ajax({
	type: 'POST',
	data: pars,
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
	    if ( obj && obj.callback )
		execFunction( obj.callback, response );

	    if ( response.error ) {
		
		var msg = response.msg ? response.msg : t( 'Erro ao efetuar operação', 25 );
		msgErro( msg );

		if ( response.errors )
		    showErrorsForm( form, response.errors );
	    }
	},
	error: function ()
	{
	    msgErro( t( 'Erro ao efetuar operação', 25 ) );
	}
    });

    return false;
}

function showErrorsForm( form, errors )
{
    $( form ).find( '.input-error' ).removeClass( 'input-error' );
    $( form ).find( '.system.negative' ).remove();
    
    for ( id in errors ) {
	
	var ele = $( '#' + id );
	
	var span = $( '<span class="system negative"></span>' );
	span.html( errors[id] );

	ele.closest( '.inputs' ).append( span );
	ele.closest( '.input_wrapper' ).addClass( 'input-error' );
    }
}

function validaForm( form )
{
    var valid = true;
    var primeiroElemento = null;
    
    $( form ).find( '.input-error' ).removeClass( 'input-error' );
    $( form ).find( '.has-error' ).removeClass( 'has-error' );
    $( form ).find( '.system.negative' ).remove();
        
    $( form ).find( '.required' ).each(
	function()
	{
	    if ( $( this ).val() == '' ) {
		
		valid = false;
		
		if ( empty( $( this ).attr( 'msgError' ) ) )
		    return true;
		
		if ( $( this ).hasClass( 'tip-error' ) ) {
		    
		    $( this ).addClass( 'has-error' )
			     .attr( 'title', $( this ).attr( 'msgError' ) );
			     
		    if ( !primeiroElemento )
			primeiroElemento = $( this );
		    
		} else {
		    var span = $( '<span class="system negative"></span>' );
		    span.html( $( this ).attr( 'msgError' ) );

		    $( this ).closest( '.inputs' ).append( span );
		}
		
		 $( this ).closest( '.input_wrapper' ).addClass( 'input-error' );
		
		return true;
	    }
	}
    );
	
    if ( !valid ) {
	
	$( form ).find( '.has-error' ).tipTip( { delay: 200, defaultPosition: 'right', activation: 'focus', customClass: 'tip-error' } );
	
	if ( primeiroElemento )
	    primeiroElemento.focus();
    }
	
    return valid;
}


/**
 * 
 * @param fnName
 * @param params
 */
function execFunction( fnName, params )
{
    // Se existir o callback
    if ( typeof fnName == 'function' ) {
    	
	return fnName( params );
    	
    } else if ( typeof fnName == 'string' ) {

	var fn = window[fnName];

	if ( typeof fn == 'function' )
	    return fn( params );
	else
	    return false;
    
    }

    return false;
}

/*
 * Funcao para mudar de aba
 * 
 */
mostrarAba = function( id )
{

    $( '.abas-form' ).hide();    
    $( '.forms #'+id ).show();
    
    $( '.table_tabs li a' ).each(function(index) {
        
        if( $(this).attr('id') == id )
            $(this).addClass( 'selected' );
        else
            $(this).removeClass( 'selected' );
        
    });
    
}

function carregaCombo( url, id, callback )
{
    var combo = $( '#' + id );
    
    $.ajax({
	type: 'GET',
	url: baseUrl + url,
	dataType: 'json',
	beforeSend: function () 
	{
	    combo.attr( 'disabled', true );
	    combo.html( '<option>' + t( 'Carregando', 207 ) + '...</option>' );
	    loading( true );
	},
	complete: function()
	{
	    loading( false );  
	},
	success: function ( response ) 
	{
	    combo.empty();
			
	    if ( response ) {
				
		var option = $( '<option />' );
		option.val( '' );
		option.html( t( 'Selecione', 85 ) );
		combo.append( option );
				
		for ( i in response ) {
		    
		    option = $( '<option />' );
		    option.val( response[i].id );
		    option.html( response[i].name );

		    combo.append( option );
		}
				
		combo.attr( 'disabled', false );
		combo.focus();
		
		if ( callback )
		    callback();
	
	    } else combo.attr( 'disabled', true );
	},
	error: function () 
	{
	    combo.html( '<option value="">' + t( 'Ocorreu um erro', 151 ) + '</option>' );
	}
    });
    
    return true;
}

function toFloat( num )
{
    num = num.toString().replace(/[^0-9.]/g, '');
    return parseFloat( num );   
}

function submitPopup( form )
{
    if( !validaForm( form ) ) {
	
	msgErro( t( 'Verifique os campos do formulário.', 206 ) );
	return false;
    }
    
    var newForm = cloneForm( form );
    newForm.removeAttr('onsubmit')
	   .unbind( 'submit' )
	   .submit(
		function( e ) 
		{
		    action = $( this ).attr( 'action' );
		    popupName = parseId( action );
		    newPopUp( '', popupName, 800, 600, 'yes' );
		    this.target = popupName;
		}
	    );
	
    newForm.submit();
    newForm.remove();
    
    return false;
}

function cloneForm( form )
{
    var newForm = $( form ).clone();
    newForm.hide();
    $( 'body' ).append( newForm );
    
    $( form ).find( 'select' ).each( 
	function( index, node )
	{
	    newForm.find( 'select' ).eq( index ).val( $(node).val() );
	}
    );
	
    return newForm;
}


function newPopUp( mypage, myname, w, h, scrollbar ) 
{
    var winl = ( screen.width  - w ) / 2;
    var wint = ( screen.height - h ) / 2;
    winprop = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scrollbar;
    win = window.open( mypage, myname, winprop );
    if ( parseInt( navigator.appVersion ) >= 4 )
	win.window.focus();
    
    return win;
}

function parseId( id )
{
    return id.replace( /[^0-9a-z]/gi, '' ).toLowerCase();
}

function relatorioIframe( form )
{
    if( !validaForm( form ) ) {
	
	msgErro( t( 'Verifique os campos do formulário.', 206 ) );
	return false;
    }
    
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
			    .addClass( 'iframe-report' );

			$( '#content .inner .section .section_content_inner' ).append( iframe );
			
			iframe.load( 
			    function()
			    {  
				loading( false );
				iframe.height( iframe.contents().outerHeight( true ) );
			    } 
			);
		    }
		    
		    this.target = iframeName;
		}
	    );
	
    loading( true );
    newForm.submit();
    newForm.remove();
    
    return false;
}

function printIframeReport()
{
    var iframe = $( '#content .inner .section .section_content_inner .iframe-report' );
    if ( !iframe.length )
	return false;
    
    iframe.get(0).contentWindow.print();
    return true;
}

function scrollTo( seletor, time )
{
    if ( !$( seletor ).length )
	return false;
    
    time = time || 1000;
    
    $( 'html, body' ).animate({ scrollTop : $( seletor ).offset().top - 20 }, time );
}

$.fn.isEqual = function($otherSet) {
    if (this === $otherSet) return true;
    if (this.length != $otherSet.length) return false;
    var ret = true;
    this.each(function(idx) { 
	if (this !== $otherSet[idx]) {
	    ret = false;
	    return false;
	}
    });
    return ret;
};