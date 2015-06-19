<div class="video" id="video-<?php the_ID(); ?>">
<a href="<?php the_permalink();?>"  title="<?php the_title(); ?>">
<div class="imagen" id="<?php the_ID(); ?>">
<?php
if ( has_post_thumbnail() ) {
the_post_thumbnail('video');
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