<?php
if ( ! defined( 'ABSPATH' ) ) exit;
define('IMAGEN_DE_LA_CATEGORIA', get_template_directory_uri()."/css/imagenes/favicon.png");
add_action('admin_init', 'imagen_init');
function imagen_init() {
    $disabled_taxonomies = array('nav_menu', 'link_category', 'category', 'post_tag', 'post_format');
	$listar_taxonomies = get_taxonomies();
	if (is_array($listar_taxonomies)) {
	
	    foreach ($listar_taxonomies as $listar_taxonomies) {
			if (in_array($listar_taxonomies, $disabled_taxonomies))
				continue;
	        add_action($listar_taxonomies.'_add_form_fields', 'xd_add_texonomy_field');
			add_action($listar_taxonomies.'_edit_form_fields', 'xd_edit_texonomy_field');
			add_filter( 'manage_edit-' . $listar_taxonomies . '_columns', 'columna_en_taxonomy' );
			add_filter( 'manage_' . $listar_taxonomies . '_custom_column', 'xd_taxonomy_column', 10, 3 );
	    }
	}
}

function agrega_style() {
	echo '<style type="text/css" media="screen">
		th.column-thumb {width:60px;}
		.form-field img.taxonomy-image {border:1px solid #eee;max-width:300px;max-height:300px;}
		.inline-edit-row fieldset .thumb label span.title {width:48px;height:48px;border:1px solid #eee;display:inline-block;}
		.column-thumb span {width:48px;height:48px;border:1px solid #eee;display:inline-block;}
		.inline-edit-row fieldset .thumb img,.column-thumb img {width:48px;height:48px;}
	</style>';
}

function xd_add_texonomy_field() {
	if (get_bloginfo('version') >= 3.5)
		wp_enqueue_media();
	else {
		wp_enqueue_style('thickbox');
		wp_enqueue_script('thickbox');
	}
	
	echo '<div class="form-field">
		<label for="taxonomy_image">Imagen</label>
		<input type="text" name="taxonomy_image" id="taxonomy_image" value="" />
		<br/>
		<button class="xd_upload_image_button button">Subir/Agregar imagen</button>
	</div>'.xd_script();
}
function xd_edit_texonomy_field($taxonomy) {
	if (get_bloginfo('version') >= 3.5)
		wp_enqueue_media();
	else {
		wp_enqueue_style('thickbox');
		wp_enqueue_script('thickbox');
	}
	
	if (xd_taxonomy_image_url( $taxonomy->term_id, NULL, TRUE ) == IMAGEN_DE_LA_CATEGORIA) 
		$image_text = "";
	else
		$image_text = xd_taxonomy_image_url( $taxonomy->term_id, NULL, TRUE );
	echo '<tr class="form-field">
		<th scope="row" valign="top"><label for="taxonomy_image">' . __('Image') . '</label></th>
		<td><img class="taxonomy-image" src="' . xd_taxonomy_image_url( $taxonomy->term_id, NULL, TRUE ) . '"/><br/><input type="text" name="taxonomy_image" id="taxonomy_image" value="'.$image_text.'" /><br />
		<button class="xd_upload_image_button button">Subir/Agregar imagen</button>
		<button class="xd_remove_image_button button">Quitar imagen</button>
		</td>
	</tr>'.xd_script();
}
function xd_script() {
	return '<script type="text/javascript">
	    jQuery(document).ready(function($) {
			var wordpress_ver = "'.get_bloginfo("version").'", upload_button;
			$(".xd_upload_image_button").click(function(event) {
				upload_button = $(this);
				var frame;
				if (wordpress_ver >= "3.5") {
					event.preventDefault();
					if (frame) {
						frame.open();
						return;
					}
					frame = wp.media();
					frame.on( "select", function() {
						// Grab the selected attachment.
						var attachment = frame.state().get("selection").first();
						frame.close();
						if (upload_button.parent().prev().children().hasClass("tax_list")) {
							upload_button.parent().prev().children().val(attachment.attributes.url);
							upload_button.parent().prev().prev().children().attr("src", attachment.attributes.url);
						}
						else
							$("#taxonomy_image").val(attachment.attributes.url);
					});
					frame.open();
				}
				else {
					tb_show("", "media-upload.php?type=image&amp;TB_iframe=true");
					return false;
				}
			});
			
			$(".xd_remove_image_button").click(function() {
				$("#taxonomy_image").val("");
				$(this).parent().siblings(".title").children("img").attr("src","' . IMAGEN_DE_LA_CATEGORIA . '");
				$(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
				return false;
			});
			
			if (wordpress_ver < "3.5") {
				window.send_to_editor = function(html) {
					imgurl = $("img",html).attr("src");
					if (upload_button.parent().prev().children().hasClass("tax_list")) {
						upload_button.parent().prev().children().val(imgurl);
						upload_button.parent().prev().prev().children().attr("src", imgurl);
					}
					else
						$("#taxonomy_image").val(imgurl);
					tb_remove();
				}
			}
			
			$(".editinline").live("click", function(){  
			    var tax_id = $(this).parents("tr").attr("id").substr(4);
			    var thumb = $("#tag-"+tax_id+" .thumb img").attr("src");
				if (thumb != "' . IMAGEN_DE_LA_CATEGORIA . '") {
					$(".inline-edit-col :input[name=\'taxonomy_image\']").val(thumb);
				} else {
					$(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
				}
				$(".inline-edit-col .title img").attr("src",thumb);
			    return false;  
			});  
	    });
	</script>';
}
if($smof_data['idioma']) {

    $lang_url = TEMPLATEPATH . '/idiomas/'.$smof_data['idioma'].'.php';
    if(file_exists($lang_url)) { include($lang_url); }
  
} else {
  function _l() {}
}


//funcion de traducion
function _d($text, $key) {//only return the text. good for use in php code
    return show_language_text($text, $key);
}
function _de($text, $key) {//only for echoing out the text
    echo show_language_text($text, $key);
}
function show_language_text($text, $key) {
    if(_l($key)) {
        return _l($key);
    } else {
        return $text;
    }
}

add_action('edit_term','xd_save_taxonomy_image');
add_action('create_term','xd_save_taxonomy_image');
function xd_save_taxonomy_image($term_id) {
    if(isset($_POST['taxonomy_image']))
        update_option('xd_taxonomy_image'.$term_id, $_POST['taxonomy_image']);
}

function xd_get_attachment_id_by_url($image_src) {
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid = '$image_src'";
    $id = $wpdb->get_var($query);
    return (!empty($id)) ? $id : NULL;
}
function xd_taxonomy_image_url($term_id = NULL, $size = NULL, $return_placeholder = FALSE) {
	if (!$term_id) {
		if (is_category())
			$term_id = get_query_var('cat');
		elseif (is_tax()) {
			$current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			$term_id = $current_term->term_id;
		}
	}
	
    $taxonomy_image_url = get_option('xd_taxonomy_image'.$term_id);
    if(!empty($taxonomy_image_url)) {
	    $attachment_id = xd_get_attachment_id_by_url($taxonomy_image_url);
	    if(!empty($attachment_id)) {
	    	if (empty($size))
	    		$size = 'foto-modelos';
	    	$taxonomy_image_url = wp_get_attachment_image_src($attachment_id, $size);
		    $taxonomy_image_url = $taxonomy_image_url[0];
	    }
	}

    if ($return_placeholder)
		return ($taxonomy_image_url != '') ? $taxonomy_image_url : IMAGEN_DE_LA_CATEGORIA;
	else
		return $taxonomy_image_url;
}

function editar_box($column_name, $screen, $name) {
	if ($column_name == 'thumb') 
		echo '<fieldset>
		<div class="thumb inline-edit-col">
			<label>
				<span class="title"><img src="" alt="Thumbnail"/></span>
				<span class="input-text-wrap"><input type="text" name="taxonomy_image" value="" class="tax_list" /></span>
				<span class="input-text-wrap">
					<button class="xd_upload_image_button button">Subir/Agregar imagen</button>
					<button class="xd_remove_image_button button">Quitar imagen</button>
				</span>
			</label>
		</div>
	</fieldset>';
}
function columna_en_taxonomy( $columns ) {
	$new_columns = array();
	$new_columns['cb'] = $columns['cb'];
	$new_columns['thumb'] = __('Imagen');

	unset( $columns['cb'] );

	return array_merge( $new_columns, $columns );
}
function xd_taxonomy_column( $columns, $column, $id ) {
	if ( $column == 'thumb' )
		$columns = '<span><img src="' . xd_taxonomy_image_url($id, NULL, TRUE) . '" alt="Thumbnail" class="wp-post-image" /></span>';
	
	return $columns;
}

function xd_change_insert_button_text($safe_text, $text) {
    return str_replace("Insert into Post", "Use this image", $text);
}

if ( strpos( $_SERVER['SCRIPT_NAME'], 'edit-tags.php' ) > 0 ) {
	add_action( 'admin_head', 'agrega_style' );
	add_action('quick_edit_custom_box', 'editar_box', 10, 3);
	add_filter("attribute_escape", "xd_change_insert_button_text", 10, 2);
}
