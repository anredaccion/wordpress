<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	<div class="input-group input-group-sm">
		<input type="search" class="form-control" placeholder="Buscar..." aria-label="Buscar..." value="<?php echo get_search_query() ?>" name="s" />
		<div class="input-group-append">
			<button class="btn" type="submit"><i class="fa fa-search"></i></button>
		</div>
	</div>
</form>