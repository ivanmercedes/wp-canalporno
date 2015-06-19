<?php global $smof_data;
function minify_output($html) {
    $search_for = array(
        '/\>[^\S ]+/s',  
        '/[^\S ]+\</s',  
        '/(\s)+/s'       
    );
    $replace_it = array(
        '>',
        '<',
        '\\1'
    );
    $html = preg_replace($search_for, $replace_it, $html);
    return $html;
}
ob_start("minify_output");
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php if (is_home () ) {
bloginfo('name'); echo " | ";  bloginfo('description');
}elseif (is_attachment() ) {
echo get_the_title($post -> post_parent).' &raquo; '; wp_title('', true);
}elseif (is_category() ) {
single_cat_title(); echo " Videos"; echo " | ";  bloginfo('name');
}elseif (is_single() || is_page() ){
single_post_title(); echo " | ";  bloginfo('name');
}elseif (is_search() ) {
echo 'Search result '.esc_html($s).''; echo " | ";  bloginfo('name');
} else {
wp_title('',true);  echo " | "; bloginfo('name');
}?>
</title>
    
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="RATING" content="RTA-5042-1996-1400-1577-RTA" />
<link rel="shortcut icon" href="<?php if ($smof_data['favicon_subido']) { echo $smof_data['favicon_subido']; ?><?php } else { ?><?php echo get_template_directory_uri(); ?>/css/imagenes/favicon.png<?php } ?>" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/css/estilo.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/css/galleria.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/css/font/font-awesome/css/font-awesome.min.css">

<?php wp_head(); ?>
</head>
<body>
<div class="cabecera">
 <div class="caja-header">
 <h1 class="logo">
 <a href="<?php bloginfo('url');?>" title="<?php bloginfo('title');?>"><?php if ($smof_data['logo_subido']) { ?>
 <img src="<?php echo $smof_data['logo_subido']; ?>"/>
	<?php } else { ?><?php bloginfo('name');?><?php } ?></a>
 </h1>
<div class="buscador-header">
<form method="get" action="<?php bloginfo('url'); ?>/"  id="search_form">
  <input type="text" name="s" maxlength="100"  onfocus="javascript: if(this.value == '<?php _de('Buscar...',1); ?>') this.value = '';" onblur="javascript: if(this.value == '') { this.value = '<?php _de('Buscar...',1); ?>';}" value="<?php _de('Buscar...',1); ?>" id="searchInput" class="cj-buscador">
  <input class="boton-buscador" type="submit" value=""  id="boton-buscar" />
					</form>
</div>



  </div>
   <?php menu(); ?>
 </div>

<?php //if( is_single() && in_category('Ass') ) {?>

 <?php //}?>

 <div class="contenedor">
