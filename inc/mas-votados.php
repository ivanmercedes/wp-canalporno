<?php
global $xh_tube;
if ( ! defined( 'ABSPATH' ) ) exit;
/*********************************************/
/* Template Name: Mas votados
/* Description: Muestra los video mas votados.
/* author: Ivan Mercedes | Ivancitoxd
/*********************************************/
 ?>
<?php get_header (); ?>
<div class="videos"><!-- videos -->
<h2><span class="icono-h2"></span><?php _de('Vídeos porno gratis más votados',8);?></h2>
<?php
   $paged = 1;
   if ( get_query_var('paged') ) $paged = get_query_var('paged');
   if ( get_query_var('page') ) $paged = get_query_var('page');
    $args = array(
 'paged' => $paged,
 'meta_key' => 'cnrating_type1',
 'orderby' => 'meta_value_num',
			   'order' => 'DESC',
   );
	$wp_query = new WP_Query($args);
?>
<?php if ( $wp_query ->have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
 <?php get_template_part('inc/video' ); ?>

<?php endwhile; else:  ?>

<h1>No Videos Found!</h1>
<?php endif; ?>
</div>
<div class="paginador">
<?php if (function_exists("pagination")) {
pagination($additional_loop->max_num_pages);
} ?>
</div>
<div class="clear"></div>
</div>
<?php get_footer(); ?>
