<?php
/**
 * TODO: Add comment id anchor
 */

if (post_password_required()) {
  return;
}
?>

<section id="comments" class="comments">
	<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="commentform" class="comment-form" novalidate>
		<div class="form-row">
			<div class="col">
				<div class="form-group">
					<textarea class="form-control comment-form-content w-100" id="comment" name="comment" rows="4" maxlength="1000" aria-required="true" required="required"></textarea>
					<div class="content-remaining">1000/1000</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col">
				<div class="form-group">
					<small class="form-text text-muted">
						Los comentarios publicados y las posibles consecuencias derivadas son de exclusiva responsabilidad de sus autores.
						Está prohibido la publicación de comentarios discriminatorios, difamatorios, calumniosos, injuriosos o amenazantes. 
						Está prohibida la publicación de datos personales o de contacto propios o de terceros, con o sin autorización.
						Está prohibida la utilización de los comentarios con fines de promoción comercial o la realización de cualquier acto lucrativo a través de los mismos.
						Sin perjuicio de lo indicado ANRed se reserva el derecho a publicar o remover los comentarios más allá de lo establecido por estas condiciones sin que se pueda considerar un aval de lo publicado o un acto de censura.
						Enviar un comentario implica la aceptación de estas condiciones.
					</small>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-md-5 col-sm-12">
				<div class="form-group">
					<input type="email" class="form-control comment-form-email" id="email" name="email" aria-describedby="emailHelp" placeholder="<?php echo __( 'Email' ) ?>" aria-required="true" required="required">
					<small id="emailHelp" class="form-text text-muted"><?php echo __( 'Your email address will not be published.' ) ?></small>
				</div>
			</div>
			<div class="col-md-5 col-sm-12">
				<div class="form-group">
					<input type="text" class="form-control comment-form-author" id="author" name="author" placeholder="<?php echo __( 'Name' ) ?>" aria-required="true" required="required">
				</div>
			</div>
			<div class="col-md-2 col-sm-12">
				<input name="submit" type="submit" id="submit" class="submit btn w-100" value="Enviar">
			</div>
		</div>
	<?php echo get_comment_id_fields() ?>
	</form>
<?php

//Get only the approved comments 
$args = array(
	'post_id' => get_the_ID(),
    'status' => 'approve'
);
 
// The comment Query
$comments_query = new WP_Comment_Query;
$comments = $comments_query->query( $args );

?>
<?php if ( $comments ): ?>
	<ol class='comments-list'>
	<?php foreach ( $comments as $comment ): ?>
		<li class='comment'>
			<header><?php echo $comment->comment_author ?> · <small><?php echo $comment->comment_date ?></small></header>
			<div class="content"><?php echo $comment->comment_content ?></div>
		</li>
	<?php endforeach; ?>
	</ol>
<?php endif; ?>
</section>