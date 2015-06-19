<?php
/*-----------------------------------------*/
/*Template Name: Pornstars
/* Description: Muestra Todas las pornstar de tu sitio
/* author: Ivan Mercedes | Ivancitoxd 
/*-----------------------------------------*/
?>
<?php get_header(); ?>

  <div class="lista-modelos">
          <h2>Pornostars</h2>
         
<?php  

$categorias = get_terms( 'pornstars' ); 
foreach($categorias as $chicas) {
	echo ' <div class="video" id="model-<?php the_ID(); ?>" style="position:relative;">';
   echo '<li>';
     echo '<a href="' . get_term_link( $chicas ) . '" title="' . sprintf( __( "View all %s" ), $chicas->name ) . ' videos" ' . '>';
     echo '<div class="imagen">';
     $imagen = xd_taxonomy_image_url($chicas->term_id);
     if ($imagen) {echo '<img src="' .xd_taxonomy_image_url($chicas->term_id) . '"/>';
 }else {
 	  echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/css/imagenes/sin-imagen.png" alt="'. get_the_title() .'"  />';
 }
 echo '</div>';
 echo '<div class="titulo">' . $chicas->name.'</div>';
 echo '<div class="fa fa-desktop cantidad"> ' . $chicas->count.'</div>';
 echo '</a>';
 echo '</li>'.PHP_EOL;
 echo '</div>';
	}
?>
        </div>
    <?php get_footer(); ?>  
