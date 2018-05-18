(function($) {
	$( document ).ready( function() {
		$('.carousel-item img').each( function() {
			$( '<img />' ).attr( "src", $(this).prop('currentSrc') );
		});
	});
})( jQuery );