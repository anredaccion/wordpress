<br><br>
<p class="float-right go-up"><a href="#">Ir arriba</a></p>
<?php if (is_single()): ?>
<div class="addthis_sharing_toolbox bg-light footer"></div>
<?php endif; ?>
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
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
<?php wp_footer(); ?>
<div id="fb-root"></div>
<br><br><br>
<footer class="text-muted">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 col-sm-6">
				<?php dynamic_sidebar( 'footer-1' ); ?>
			</div>
			<div class="col-md-3 col-sm-6">
				<?php dynamic_sidebar( 'footer-2' ); ?>
			</div>
			<div class="col-md-3 col-sm-6">
				<?php dynamic_sidebar( 'footer-3' ); ?>
			</div>
			<div class="col-md-3 col-sm-6">
				<?php dynamic_sidebar( 'footer-4' ); ?>
			</div>
		</div>
	</div>
	<div style="font-size:0.6em; width: 100%; text-align: center">;-)</div>
</footer>
</body>
</html>