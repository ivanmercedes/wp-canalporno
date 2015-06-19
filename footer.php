<?php global $smof_data;?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery.cookie.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/script.js"></script>



<?php if($smof_data['codigo_analytics'] != "") { echo $smof_data['codigo_analytics']; } ?>
</div>
<div class="contenedor">
<div class="ads-pie">
 <?php if($smof_data['footer_ads'] != "") { echo $smof_data['footer_ads']; } ?>



</div> 
</div>

<div class="caja_footer" id="footer">


<div class="footer-box">

<div id="footer-menu">
<?php
if(is_active_sidebar('footer-menu')){
dynamic_sidebar('footer-menu');
}
?>
</div>
<p class="cop">
    &copy; <?php echo(date("Y")) ?> <?php bloginfo('name');?> - <?php _de('Todos los derechos reservados.',15); ?>
</p>
<p class="edad"><?php _de('Tienes que tener mas de 18 años para poder visitarlo. Todas las modelos de esta web son mayores de edad.',16); ?></p>

</div>

</div>
<?php wp_footer(); ?>
</body>
</html>