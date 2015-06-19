<?php global $smof_data; get_header (); ?>
<?php setPostViews(get_the_ID()); ?>
<?php

    if ( have_posts() ) : while ( have_posts() ) : the_post();

?>
<div class="videos">
<div class="titulos-h1">
<h2><span class="icono-h2"></span><?php the_title(); ?></h2>
<?php $bor = _d('Borrar',12); wp_borrar_post_link($bor, '<p>', '</p>'); ?>
</div>
<div class="caja">
<?php //the_content(); ?>

<div class="fotorama" data-width="860px" data-height="560px" data-nav="thumbs">
 <?php $args = array(
   'post_type' => 'attachment',
   'numberposts' => -1,
   'post_status' => null,
   'post_parent' => $post->ID
  );
$attachments = get_posts( $args );
     if ( $attachments ) {

        foreach ( $attachments as $attachment ) {
        $thumb = wp_get_attachment_image( $attachment->ID, 'medium' );
        $url = wp_get_attachment_image_src( $attachment->ID, 'full' );
           
           echo '<a href="'.$url[0].'">'.$thumb.'</a>';
          
          }
     }
?>
</div>

                        
<?php echo cn_theme_rating($post->ID); ?>
    <div class="sociales">
                        <a target="_blank" title="Facebook" href="http://facebook.com/share.php?u=<?php the_permalink() ?>" class="btn-facebook"> <span class="ico-fb fa fa-facebook"></span> Facebook</a>
                                                <a target="_blank" title="Twitter" href="http://twitter.com/share?url=<?php the_permalink() ?>" class="btn-twitter"> <span class="ico-tw fa fa-twitter"></span> Twitter</a>
                        <div class="clear"></div>
                        <div class="data"><strong><?php _de('Visto:',5);?></strong> <small><?php echo views(get_the_ID()); ?></small> &nbsp;&nbsp; <strong><?php _de('Añadido:',6);?></strong> <small><?php echo get_post_time('d-m-Y'); ?></small></div>
                    </div>
   
  <div class="descricion">
    <?php $dc = get_post_meta($post->ID, 'awpt_desc' );
       if ($dc) {echo '<p>'.get_post_meta($post->ID, "awpt_desc", true).'</p>';}else {} ?>
       </div>
 </div>

<div class="ads-video">
    <!-- publicidad video -->
<?php if($smof_data['video_ads'] != "") { echo $smof_data['video_ads']; } ?>
        
</div>

</div>
<?php get_template_part('inc/relacionado-album'); ?>



<?php endwhile; else:  ?>

<h1>No Videos Found!</h1>
<?php endif; ?>

<div class="clear"></div>

<?php get_footer (); ?>
