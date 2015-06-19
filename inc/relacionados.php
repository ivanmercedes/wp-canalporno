<div class="relacionados">
<h2><span class="icono-h2"></span><?php _de('Vídeos porno similares',4); ?></h2>
<?php
  $args = array( 'numberposts' => 12, 'orderby' => 'rand' );
	$rand_posts = get_posts( $args );
	foreach( $rand_posts as $post ) : ?>
 <?php get_template_part('inc/video' ); ?>
<?php endforeach; ?>
<?php wp_reset_postdata();?>
</div>
<div class="clear"></div>

 