<?php
/**
** activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

/**Se débarasser des prefixs "categorie" et "archive" dans les titres des Custom Posts**/
add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '', false );

        }

    elseif (is_tag()) {

			$title = single_tag_title('', false);

		}

    elseif ( is_post_type_archive() ) {
		/* translators: Post type archive title. 1: Post type name */
			$title = post_type_archive_title( '', false );
	}
        
    return $title;

});

/** Changer les titres des customs posts **/
function template_fix_title($title, $id = null) {
    if ( is_archive($id) && get_post_type($id) == 'property' ) {
        return 'acheter';
    }

    elseif ( is_archive($id) && get_post_type($id) == 'rental' ) {
        return 'louer';
    }

    return $title;
}
add_filter( 'get_the_archive_title', 'template_fix_title', 10, 2 );


/**URL logo login vers le site*/
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Chalets & Caviar';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

/**charger feuille de style perso pour page login**/
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

/** changer slug pour EPL**/

define('EPL_PROPERTY_SLUG', 'acheter');

define('EPL_RENTAL_SLUG', 'louer');

/** Filtre pour customiser le widget de recherche EPL **/

function my_custom_label_property_price_from() {
	$label = 'Prix minimum';
	return $label;
}
add_filter( 'epl_search_widget_label_property_price_from' , 'my_custom_label_property_price_from' );

function my_custom_label_property_price_to() {
	$label = 'Prix maximum';
	return $label;
}
add_filter( 'epl_search_widget_label_property_price_to' , 'my_custom_label_property_price_to' );

function my_custom_label_property_bedrooms_min() {
	$label = 'Nombre de chambre minimum';
	return $label;
}
add_filter( 'epl_search_widget_label_property_bedrooms_min' , 'my_custom_label_property_bedrooms_min' );

function my_custom_any_label_price_from() {
	$label = '1000€';
	return $label;
}
add_filter( 'epl_search_widget_option_label_price_from' , 'my_custom_any_label_price_from' );

function my_custom_any_label_price_to() {
	$label = '10.000.000€';
	return $label;
}
add_filter( 'epl_search_widget_option_label_price_to' , 'my_custom_any_label_price_to' );

function my_custom_label_bedrooms_min() {
	$label = '1';
	return $label;
}
add_filter( 'epl_search_widget_option_label_bedrooms_min' , 'my_custom_label_bedrooms_min' );


function my_custom_range_beds() {
	$range = array(
		'1'		=>	'1',
		'2'		=>	'2',
		'3'		=>	'3',
		'4'		=>	'4',
		'5'		=>	'5',
		'6'		=>	'6',
		'7'		=>	'7',
		'8'		=>	'8',
		'9'		=>	'9',
		'10'		=>	'10',
		'11'		=>	'11',
	);
	return $range;
}
add_filter( 'epl_listing_search_bed_select_min' , 'my_custom_range_beds' );