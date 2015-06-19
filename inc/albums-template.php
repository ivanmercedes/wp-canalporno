<?php
global $xh_tube; 
if ( ! defined( 'ABSPATH' ) ) exit;
/*********************************************/
/* Template Name: Albums 
/* Description: Muestra todos los albums.
/* author: Ivan Mercedes | Ivancitoxd 
/*********************************************/
?>
<?php get_header (); ?>
<!-- fotos -->
<div class="lista-fotos">
<h2>Photo Albums</h2>
<?php $fotos = new WP_Query( array( 'post_type' => 'photos' ) ); ?>
<?php 
   $paged = 1;
   if ( get_query_var('paged') ) $paged = get_query_var('paged');
   if ( get_query_var('page') ) $paged = get_query_var('page');
    $args = array(
 'paged' => $paged,
 'post_type' => 'albums',
 //'meta_key' => 'post_views_count',
 //'orderby' => 'meta_value_num',
			   'order' => 'DESC',				
   );
	$wp_query = new WP_Query($args); 
?>
<?php if ( $wp_query->have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="foto" id="foto-<?php the_ID(); ?>">
<a href="<?php the_permalink();?>"  title="<?php the_title(); ?>">
<div class="imagen" id="<?php the_ID(); ?>">
<?php
if ( has_post_thumbnail() ) {
the_post_thumbnail('foto');
}
 else if ( get_post_meta($post->ID, 'image', true) )
{
 	echo '<img src="' . get_post_meta($post->ID, 'image', true) . '"  />';
 }
else {
	echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/css/imagenes/sin-imagen.png" alt="'. get_the_title() .'"  />';
}
?>
</div>
<span class="titulo"><?php the_title(); ?></span>
<?php if(get_post_meta($post->ID, 'duration', true)) : ?>
<div class="duracion"><span class="icono-duracion"></span>
<span><?php echo get_post_meta($post->ID, 'duration', true);?></span>
</div>
<?php else: ?>
	<?php endif;?>
	<span class="view"><?php echo getPostViews(get_the_ID()); ?></span>
<?php echo votos_index(get_the_ID()); ?>

</a>
</div>
<?php endwhile; else:  ?>

<h1>No Photos Found!</h1>
<?php endif; ?>
<div class="paginador">
<?php if (function_exists("pagination")) {
pagination($additional_loop->max_num_pages);
} ?>
</div>
<div class="clear"></div>
</div>	
<?php get_template_part ('includes/categoria-fotos');?>


<?php get_footer();?>