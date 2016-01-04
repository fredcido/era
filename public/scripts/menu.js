$.fn.menu = function()
{
    var self = this;
    
    self.find( 'ul > li > a' ).each(
	function()
	{   
	    if ( $( this ).attr( 'href' ) == 'javascript:;' ) {
		
		$( this ).click(
		    function()
		    {
			self.find( 'a.selected_lk' ).removeClass( 'selected_lk' );
			self.find( 'ul.visible' ).removeClass( 'visible' );
			
			$( this ).addClass( 'selected_lk' );
			$( this ).parent().find( '> ul' ).addClass( 'visible' );
		    }
		);
	    }
	}
    );
}