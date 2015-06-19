<?php global $smof_data; get_header (); ?>


<div class="videos mas-videos"><!-- Videos mas populares -->
<div class="titulos-h1">
<h2><span class="icono-h2"></span><?php _de('Videos porno más populares',2); ?></h2>
</div>
<div class="caja">
<?php $args = array( 'numberposts' => 8, 'orderby' => 'rand' );
	$rand_posts = get_posts( $args );
	foreach( $rand_posts as $post ) : ?>
 <?php get_template_part('inc/video' ); ?>
<?php endforeach; ?>
<?php wp_reset_postdata();?>
 </div>
  <div class="ads-home">


<div class="caja-banner">
<!-- <img src="http://i.imgur.com/lGordb2.png" title="banner" />-->
<?php if($smof_data['home_ads'] != "") { echo $smof_data['home_ads']; } ?>
 </div>
</div>
</div><!-- Videos mas populares -->


<div class="videos" id="nuevos"><!-- videos nuevos -->
<div class="titulos-h1">
<h2><span class="icono-h2"></span><?php _de('Videos porno gratis más nuevos',3); ?></h2>
</div>
<?php

    if ( have_posts() ) : while ( have_posts() ) : the_post();

?>
<?php get_template_part('inc/video' ); ?>
<?php endwhile; else:  ?>

<h1>No Videos Found!</h1>
<?php endif; ?>
<div class="paginador">
<?php if (function_exists("pagination")) {
pagination($additional_loop->max_num_pages);
} ?>
</div>
<div class="clear"></div>
</div>
<?php get_footer (); ?>
