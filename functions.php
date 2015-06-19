<?php
/* IMPORTANTE: no modifique ninguna linea el theme podria dejar de funcionar correctamente */
global $smof_data; 
if ( ! defined( 'ABSPATH' ) ) exit;
require_once ('admin/index.php'); // 
include_once ('inc/ic.php');

/*-----------------------------------------*/
/* Oculta la barra del admin
/*-----------------------------------------*/
show_admin_bar(false);
/*-----------------------------------------*/
/* Menu cabecera
/*-----------------------------------------*/
register_nav_menus( array(
    'menu-cabecera' => __( 'Menu principal' ),
) );
register_sidebar( array(
'name' => 'Footer Menu',
'id' => 'footer-menu',
'description' => '',
'before_widget' => '<div id="footer-m" class="menu-f">',
'after_widget' => '</div>',
'before_title' => '<h3 class="titulo-w">',
'after_title' => '</h3>',
) );
/*-----------------------------------------*/
if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' ); 
    add_image_size( 'video', 240, 180, true );
    add_image_size( 'foto', 175, 240, true );
}
function menu(){

$defaults = array(
	'theme_location'  => 'menu-cabecera',
	'menu'            => '',
	'container'       => 'div',
	'container_class' => 'cssmenu',
	'container_id'    => '',
	'menu_class'      => 'lista',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);

 echo wp_nav_menu( $defaults );

}

/*-----------------------------------------*/
/* Paginador
/*-----------------------------------------*/
function pagination($pages = '', $range = 5){
     $showitems = ($range * 2)+1;
      global $paged;
    if(empty($paged)) $paged = 1;
    if($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages){
        $pages = 1;
         }
     }
     if(1 != $pages){
         //echo "<span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

        for ($i=1; $i <= $pages; $i++){
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";

     }
}
/*-----------------------------------------*/
/* Modelos 
/*-----------------------------------------*/
function crear_pornstar_taxonomies(){
    register_taxonomy(
        'pornstars', array( 'post' ),
        array(
            'hierarchical'=> true,
            'label' => 'Pornstars',
            'singular_label' => 'Category',
            'rewrite' => true     
        )
    );    
}
add_action( 'init', 'crear_pornstar_taxonomies', 0);
/*-----------------------------------------*/
/* Funcion para los view.
/*-----------------------------------------*/
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 ";
    }
    return $count. _d(' Visitas',10);
}
function views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 ";
    }
    return $count.' ';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function posts_column_views($defaults){
    $defaults['post_views'] = __('View');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
    if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}
/*-----------------------------------------*/
/* Tiempo del post en el sitio
/*-----------------------------------------*/
function time_ago( $type = 'post' ) {
    $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
    return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');
}

function votos_index($id, $tag='', $tagf='', $nov=0) {
        $return='';
  $return.= $tag.'
            
<li class="votos_index"><i class="fa fa-heart"></i>

  <strong>'.cn_theme_rating_porc($id).'</strong></li>
  '.$tagf;
  
  return $return;
 }

function cn_theme_rating_porc($id) {
		$positive=0; $negative=0;
		$positive=get_post_meta($id, 'cnrating_type1', true);
		$negative=get_post_meta($id, 'cnrating_type2', true);
		$total=$positive+$negative;
		$multiple=$positive*100;
		if($total==''){
			return '0%';
		}else{
			return round($multiple/$total).'%';
		}
	}
	
	function cn_theme_rating_voto_total($id) {
		$positive=0; $negative=0;
		$positive=get_post_meta($id, 'cnrating_type1', true);
		$negative=get_post_meta($id, 'cnrating_type2', true);
		$total=$positive+$negative;
		
		return $total;
	}

	function cn_theme_rating_scripts_init() {
        if(is_single()){
            $path_to_theme = get_template_directory_uri();
            $myvars = array( 
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'loading' => __('Loading...', CN_THEMENAME),	
                'cnthemeratingnonce' => wp_create_nonce( 'cn-theme-rating-nonce' )
            );
            wp_enqueue_script( 'cn-rating', $path_to_theme.'/js/votos.js',array('jquery'));
            wp_localize_script( 'cn-rating', 'CRating', $myvars );
        }
    }
	
	if ( !is_admin() ) {
	  add_action('wp_print_scripts', 'cn_theme_rating_scripts_init');
	}
	
	// Guarda las ips
	
	function cn_rating_save_ip($id,$tipo,$ip=NULL){
		if($tipo==1){
			$table='cnrating_ips';
			$data = get_post_meta($id, $table, true);
	
			if(empty($data)){
				add_post_meta(intval($id), $table, md5($ip).'+'); 
			}else{
				$ips_array = explode("+", $data);
				if ( !in_array(md5($ip), $ips_array ) ) {
					update_post_meta(intval($id), $table, $data.md5($ip).'+');			
				}
			}
        	setcookie("cnratingip_$id", $ip, time()+3600*24*100, COOKIEPATH, COOKIE_DOMAIN, false);
		}
	}

	function cn_rating_ajax(){

		$nonce = $_POST['nonce'];
 
	    if ( ! wp_verify_nonce( $nonce, 'cn-theme-rating-nonce' ) )
    	    die ( 'Die!');
	
	
		if($_POST['action'] == 'cn_rating_action') {
			
			$id=intval($_POST['id']);
			$vote=intval($_POST['type']);
			$table_ips='cnrating_ips';
			$table_votes='cnrating_type'.$vote;			
			$total=get_post_meta($id, $table_votes, true);
			$data = get_post_meta($id, $table_ips, true);
				
			if ($data=='') {
				add_post_meta($id, $table_votes, 1); 
				cn_rating_save_ip($id,1,filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP));
				echo cn_theme_rating($id,'','');
			}else{
				$ips_array = @explode("+", $data);
				if ( !in_array(md5($_SERVER['REMOTE_ADDR']), $ips_array ) and empty($_COOKIE["cnratingip_".$id.""])) {
					update_post_meta($id, $table_votes, get_post_meta($id, $table_votes, true)+1); 
					cn_rating_save_ip($id,1,filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP));
					echo cn_theme_rating($id,'','');
				}else{
					echo cn_theme_rating($id,'','', 1);
				}
			}
			
			
		}
		exit;
	}
		
	function cn_theme_rating($id, $tag='<div class="btcj" id="cn_theme_rating">', $tagf='</div>', $nov=0) {
        $return='';
		$return.= $tag.'
            <div class="btn">
			<div class="cn-btn">
				<a href="#" class="fa-thumbs-o-up b v" data-type="1" data-id="'.$id.'"></a>
                <span class="por">'.cn_theme_rating_porc($id).'</span>
                
				<a href="#" class="fa-thumbs-o-down b r" data-type="2" data-id="'.$id.'"></a>
			</div>';
		if($nov==1){
			$return.='<span id="txt"><strong>'.__('You can not vote again', CN_THEMENAME).'</strong></span>';
		}else{
			if(cn_theme_rating_voto_total($id)>1 or cn_theme_rating_voto_total($id)==0){$s=_d('votos',14);}else{$s=_d('votos', 14);}
			$return.='<span id="txt"><strong>'.cn_theme_rating_voto_total($id).'</strong> '.$s.'</span>';			
		}
		$return.='</div>'.$tagf;
		
		return $return;
	}

/*-----------------------------------------*/
/*  CustomField 
/*-----------------------------------------*/
$prefix = 'awpt_';
$meta_boxes = array();
$meta_boxes = array(
array(
    'id' => 'metabox-post',
    'title' => 'Campos Videos',
    'pages' => array('post'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
        'name' => 'Duration:',
        'desc' => 'Escribre aqui la duracion del video',
        'id' => 'duration',
        'type' => 'text',
        'std' => ''
        ),
         array(
        'name' => 'Descripcion:',
        'desc' => 'Escribre aqui la descripcion del video',
        'id' => $prefix .'desc',
        'type' => 'textarea',
        'std' => ''
        ),
       )
    )
);


    foreach ($meta_boxes as $meta_box) {
    $my_box = new My_meta_box($meta_box);
}    
class My_meta_box {
 
    protected $_meta_box;
 
    // create meta box based on given data
    function __construct($meta_box) {
        $this->_meta_box = $meta_box;
        add_action('admin_menu', array(&$this, 'add'));
 
        add_action('save_post', array(&$this, 'save'));
    }
 
    /// Add meta box for multiple post types
    function add() {
        $this->_meta_box['context'] = empty($this->_meta_box['context']) ? 'normal' : $this->_meta_box['context'];
        $this->_meta_box['priority'] = empty($this->_meta_box['priority']) ? 'high' : $this->_meta_box['priority'];
        foreach ($this->_meta_box['pages'] as $page) {
            add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
        }
    }
 
    // Callback function to show fields in meta box
    function show() {
        global $post;
 
        // Use nonce for verification
        echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
        echo '<table class="form-table">';
 
        foreach ($this->_meta_box['fields'] as $field) {
            // get current post meta data
            $meta = get_post_meta($post->ID, $field['id'], true);
 
            echo '<tr>',
                    '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                    '<td>';
            switch ($field['type']) {
                case 'text':
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                        '<br />', $field['desc'];
                    break;
                case 'textarea':
                    echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="15" style="width:97%;height:100px;">', $meta ? $meta : $field['std'], '</textarea>',
                        '<br />', $field['desc'];
                    break;
                case 'select':
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    foreach ($field['options'] as $option) {
                        echo '<option value="', $option['value'], '"', $meta == $option['value'] ? ' selected="selected"' : '', '>', $option['name'], '</option>';
                    }
                    echo '</select>';
                    break;
                case 'radio':
                    foreach ($field['options'] as $option) {
                        echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                    }
                    break;
                case 'checkbox':
                    echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                    
                    break;
            }
            echo     '<td>',
                '</tr>';
        }
 
        echo '</table>';
    }
 
    // Save data from meta box
    function save($post_id) {
        // verify nonce
        if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
 
        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
 
        // check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
 
        foreach ($this->_meta_box['fields'] as $field) {
            $old = get_post_meta($post_id, $field['id'], true);
            $new = $_POST[$field['id']];
 
            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
    }
}
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}

/*-----------------------------------------*/
/*  Filtro & otros
/*-----------------------------------------*/
remove_action('wp_head','adjacent_posts_rel_link_wp_head');
remove_action( 'wp_head','wp_shortlink_wp_head',10, 0 );
remove_action( 'template_redirect','wp_shortlink_header',11, 0 );
remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'feed_links', 2 ); 
remove_action( 'wp_head', 'rsd_link' ); 
remove_action( 'wp_head', 'wlwmanifest_link' ); 
remove_action( 'wp_head', 'index_rel_link' ); 
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'wp_generator' ); 
add_action( 'wp_ajax_cn_rating_action', 'cn_rating_ajax' );
add_action( 'wp_ajax_nopriv_cn_rating_action', 'cn_rating_ajax');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/*-----------------------------------------*/
/* Funcion para Borrar post desde el Single
/*-----------------------------------------*/
function wp_borrar_post_link($link = 'Borrar', $antes = '', $depues = '')
{
global $post;
if ( $post->post_type == 'page' ) {
if ( !current_user_can( 'edit_page', $post->ID ) )
return;
} else {
if ( !current_user_can( 'edit_post', $post->ID ) )
return;
}
$link = "<a class=\"botonrojo\" href='" . wp_nonce_url( get_bloginfo('url') . "/wp-admin/post.php?action=delete&amp;post=" . $post->ID, 'delete-post_' . $post->ID) . " '>".$link."</a>";
echo $depues . $link . $antes;
}

function fotos() {
    $labels = array(
        'name' => __( 'Albums' ),
        'singular_name' => __( 'Albums' ),
        // 'add_new' => __( 'Añadir Nueva' ),
        // 'add_new_item' => __( 'Añadir nuevo Albums' ),
        // 'edit_item' => __( 'Editar Albums' ),
        // 'new_item' => __( 'Nueva Albums'),
        // 'view_item' => __( 'Ver Albums'),
        // 'search_items' => __( 'Buscar Albums'),
        // 'not_found' =>  __('No se encontró nada'),
        // 'not_found_in_trash' => __('No se encontró nada en la papelera'),
        // 'parent_item_colon' => ''
    );
 
    $album = array(
        'labels' => $labels,
        'taxonomies'=> array( '' ),
        'public' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'public' => true,
        'show_ui'  => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position' => 4,
        'menu_icon'           => get_bloginfo('template_directory'). '/css/imagenes/foto.png',
        'can_export'          => true,
        'has_archive'         => 'albums',
        'exclude_from_search' => false,
        'query_var'           => 'albums',
        'rewrite'             => $rewrite,
        'supports' => array('title','thumbnail','comments','editor')
         
      );

    register_post_type( 'Albums' , $album );
}
add_action('init', 'fotos');

function banner_video($A='<div id="bannervideo" class="bannervideo">', $C='</div>'){
  global $smof_data; 
  if(@$smof_data['mostrar_bv'] == 'Mostrar'){
  $smof_data['banner_svideo'];
  $return='';
  $return.= $A.'<a href="#" class="close"><img src="' .get_bloginfo('template_directory').'/css/imagenes/cerrar.png"/></a>';
  if($smof_data['banner_svideo'] != ""){
  $return.= '<div class="bannervideo300" id="bannervideo300">'.$smof_data['banner_svideo'].'</div>'.$C;
  }else{ 
   $return.= '<div class="bannervideo300" id="bannervideo300"><img src="' .get_bloginfo('template_directory').'/css/imagenes/300x250.png"/></div>'.$C;
  }
 return $return;
   }
}
