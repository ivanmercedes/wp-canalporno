<?php global $xh_tube; get_header (); ?>

<div class="videos">
<h2><?php single_cat_title(); ?> Recently Added Videos</h2>
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
<!-- recientes -->
<?php get_template_part ('siderbar'); ?>


<?php get_footer();?>