<?php

if ( ! defined( 'ABSPATH' ) ) exit;
/*-----------------------------------------*/
/* Template Name: Categorias
/* Description: Muestra todas las categorias en una pagina.
/* Author: Ivan Mercedes | Ivancitoxd
/*-----------------------------------------*/
?>
<?php get_header(); ?>
<!-- Categorias -->
  <div class="videos">
 <h2><span class="icono-h2"></span><?php _de('Categorías porno',7); ?></h2>
<div class="cate">
<?php

$categorias = get_terms( 'category' );
 foreach($categorias as $lista) {
   echo '<div class="video">';
     echo '<a href="' . get_term_link( $lista ) . '" title="' . sprintf( __( "View all %s" ), $lista->name ) . ' videos" ' . '>';
      $post_args = array(
  'numberposts' => 1,
  //'orderby' => 'rand', mostra los post en modo aleatorio
  'category' => $lista->term_id
  );
$posts = get_posts($post_args);
 foreach($posts as $post) {
     echo '<div class="imagen">';
  if ( has_post_thumbnail() ) {
   the_post_thumbnail('video');

  }else {
  echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/css/imagenes/sin-imagen.png" alt="'. get_the_title() .'"  />';
}
 echo '</div><div class="cantidad"> ('. $lista->count.')</div>';
 echo '<div class="titulo">' . $lista->name.'</div></a>';
 echo '</div>'.PHP_EOL;
    }

    }


?>
   </div>

</div>
</div>

<?php get_footer(); ?>
