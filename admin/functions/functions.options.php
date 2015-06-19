<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
			$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");

		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');
		foreach ($of_pages_obj as $of_page) {
			$of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");

		//Testing
		$of_options_select 	= array("one","two","three","four","five");
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");

		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		(
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			),
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();

		if ( is_dir($alt_stylesheet_path) )
		{
			if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) )
			{
				while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false )
				{
					if(stristr($alt_stylesheet_file, ".css") !== false)
					{
						$alt_stylesheets[] = $alt_stylesheet_file;
					}
				}
			}
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();

		if ( is_dir($bg_images_path) ) {
			if ($bg_images_dir = opendir($bg_images_path) ) {
				while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
					if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
						$bg_images[] = $bg_images_url . $bg_images_file;
					}
				}
			}
		}


		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center");

		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post");

		$web_safe_fonts = array(
			'Georgia, serif' => 'Georgia, serif',
			'"Palatino Linotype", "Book Antiqua", Palatino, serif' => 'Palatino Linotype, Book Antiqua, Palatino, serif',
			'"Times New Roman", Times, serif' => 'Times New Roman, Times, serif',
			'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
			'Impact, Charcoal, sans-serif' => 'Impact, Charcoal, sans-serif',
			'"Lucida Sans Unicode", "Lucida Grande", sans-serif' => 'Lucida Sans Unicode, Lucida Grande, sans-serif',
			'Tahoma, Geneva, sans-serif' => 'Tahoma, Geneva, sans-serif',
			'"Trebuchet MS", Helvetica, sans-serif' => 'Trebuchet MS, Helvetica, sans-serif',
			'Verdana, Geneva, sans-serif' => 'Verdana, Geneva, sans-serif',
			'"Courier New", Courier, monospace' => 'Courier New, Courier, monospace',
			'"Lucida Console", Monaco, monospace' => 'Lucida Console, Monaco, monospace',
		);

		

		
/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();
//$prefix = 'us_'


$of_options[] = array( 	"name" 		=> "Opciones Generales",
						"type" 		=> "heading"
				);


        
$of_options[] = array( "name" => "Logo Imagen",
	"desc" => "Maximum recommended size is 180x38px",
	"id" => "logo_subido",
	"std" => "",
	"type" => "upload"
);

$of_options[] = array( 	"name" 		=> "Favicon",
	"desc" => "Subir favicon de tu web aqui tipos recomendados (ICO/PNG/GIF )",
	"id" => "favicon_subido",
	"std" => "",
	"type" => "upload");

// $of_options[] = array( "name" => "Related Posts",
// 	"desc" => "Show  list of posts with same tags at single post page",
// 	"id" => "post_related_posts",
// 	"std" => 1,
// 	"type" => "switch");
//$of_options[] = array( "name" => "Custom fields name",
//	"desc" => "Nombre de campo de imagens (opcional)",
//	"id" => "nombre",
//	"std" => "",
//	"type" => "text"
//);
$of_options[] = array( "name" => "Idioma",
	"desc" => "Seleciona el idioma en que se mostrara tu sitio.",
	"id" => "idioma",
	"std" => "Espanol",
	"type" => "select",
	"options" => array(
		'en' => 'Ingles',
		'es' => 'Espanol',
		
	));


$of_options[] = array( "name" => "Mostra/Ocultar Banner sobre videos",
	"desc" => "Seleciona Aqui para activar o desativar el banner.",
	"id" => "mostrar_bv",
	"std" => "Mostrar",
	"type" => "select",
	"options" => array(
		'mostrar' => 'Mostrar',
		'ocultar' => 'Ocultar',
		
	));
$of_options[] = array( 	"name" 		=> "Publicidad",
						"type" 		=> "heading"
				);

$of_options[] = array( "name" => "Google Analytics Code",
	"desc" => "Pega el codigo d trackinng de tu Google Analytics.",
	"id" => "codigo_analytics",
	"std" => "",
	"type" => "textarea");


$of_options[] = array( "name" => "Banner sobre  video",
	"desc" => "Maximo 1 banner para este campo, Tamaño recomendado (tamaño recomendado 300x250)",
	"id" => "banner_svideo",
	"std" => "",
	"type" => "textarea");

$of_options[] = array( "name" => "Banner del home",
	"desc" => "Tamaño recomendado (tamaño recomendado 300x250)",
	"id" => "home_ads",
	"std" => "",
	"type" => "textarea");

$of_options[] = array( "name" => "Banner pagina del video",
	"desc" => "Maximo 2 banner para este campo, Tamaño recomendado (tamaño recomendado 300x250)",
	"id" => "video_ads",
	"std" => "",
	"type" => "textarea");

$of_options[] = array( "name" => "Banner pie pagina",
	"desc" => "Multiples banner en pie de pagina (tamaño recomendado 300x250)",
	"id" => "footer_ads",
	"std" => "",
	"type" => "textarea");


/*--------------------------------------------------------------------------*/

	}//End function: of_options()
}//End chack if function exists: of_options()
?>
