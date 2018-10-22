(function($) {
	$( document ).ready( function() {
		$('.overlay').click(function(e) {
			$('.navbar-primary').removeClass('active');
			$('.overlay').fadeOut();
		});

		if ( $( "#hero-news" ).length ) {
			$( ".carousel-item" ).hammer()
				.on("swipeleft", function () { $( "#hero-news" ).carousel('next') } )
				.on("swiperight", function () { $( "#hero-news" ).carousel('prev') } 
			);
		}

		$(".video").click(function () {
			var theModal = $(this).data("target"),
			videoSRC = $(this).attr("data-video");
			$(theModal + ' iframe').attr('src', videoSRC);
		});

		$('#videoModal').on('show.bs.modal', function (e) {
			$('.overlay').fadeIn();
		});

		$('#videoModal').on('hide.bs.modal', function (e) {
			$('.overlay').fadeOut();
		});

		$('#videoModal').on('hidden.bs.modal', function (e) {
			$('#videoModal').find('iframe').attr('src', '');
		});

		$(window).resize(function() {
			$('#videoModal').modal('handleUpdate');
			handleNavbarUpdate();
			handleAddthisUpdate();
		});

		$('#videoModal').modal('handleUpdate');
		handleNavbarUpdate();
		handleAddthisUpdate();

		$('.gallery-item a').fancybox({
			overlay: {
				closeClick: true,
				showEarly: true
			},
			arrows: true
		});
	});

	$('.comment-form-content').on("input", function(){
		var maxlength = $(this).attr("maxlength");
		var currentLength = $(this).val().length;

		if( currentLength <= maxlength ){
			$('.content-remaining').html(maxlength - currentLength + '/' + maxlength);
		}
	});

	function handleNavbarUpdate() {
		if ($('.navbar.fixed-top').width() < 576) {
			$('.navbar.fixed-top').removeClass('fixed-top').addClass('fixed-bottom');
		}
		
		if ($('.navbar.fixed-bottom').width() >= 576) {
			$('.navbar.fixed-bottom').removeClass('fixed-bottom').addClass('fixed-top');
		}
	}

	function handleAddthisUpdate() {
		if ($('.navbar').width() < 576) {
			$('.addthis_toolbox').removeClass('addthis_16x16_style').addClass('addthis_32x32_style');
			$('.comments-counter').addClass('mobile');
		} else {
			$('.addthis_toolbox').removeClass('addthis_32x32_style').addClass('addthis_16x16_style');
			$('.comments-counter').removeClass('mobile');
		}
	}
})( jQuery );