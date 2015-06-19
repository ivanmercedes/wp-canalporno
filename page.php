<?php get_header (); ?>

<?php 
    
    if ( have_posts() ) : while ( have_posts() ) : the_post(); 
    
?>
<div class="videos"><!-- Videos mas populares -->
<div class="titulos-h1">
<h2><?php the_title(); ?></h2>
</div>
<div class="pagina" style="width:100%">
<?php the_content(); ?>


 </div>

<!-- <div class="ads-home">
<!-- publicidad video 
<img src="http://i.imgur.com/lGordb2.png" title="banner" />
</div> -->

</div>

<?php endwhile; else:  ?>

<h1>No Videos Found!</h1>
<?php endif; ?>

<div class="clear"></div>



















<?php get_footer (); ?>