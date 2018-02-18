<?php if (is_single()): ?>
<div class="addthis_sharing_toolbox bg-light footer"></div>
<?php endif; ?>
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div class="embed-responsive embed-responsive-16by9">
  					<iframe class="embed-responsive-item" src="" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="overlay"></div>
<footer class="text-muted">
	<div class="container">
	<p class="float-right"><a href="#">Ir arriba</a></p>
	</div>
</footer>
<?php wp_footer(); ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5473d03b29cf0382"></script>
<?php
/*
** FIXME: Incluir código de facebook únicamente cuando haga falta
*/
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php
/*
** FIXME: Incluir código de twitter únicamente cuando haga falta
*/
?>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<br><br><br>
<div style="font-size:0.6em; width: 100%; text-align: center">;-)</div>
</body>
</html>