(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

(function($) {
	$('article .fb-video iframe').attr('src', $('article .fb-video iframe').attr('src').replace(/width=(\d+)/g, 'width=' + $('article').width() ) )
})( jQuery );