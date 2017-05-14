<?php

function twentythirteen_setup() {
	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'twentythirteen_setup' );

//get post-thumbnail url for different purposes
if ( !function_exists( 'get_the_post_thumbnail_uri') ) {
    function get_the_post_thumbnail_uri($raw)
    {
        //get the string from after the src="
        $raw = substr($raw, (strpos($raw, 'src="') + 5)); 

        //find the first " that closes the src-attr
        return substr($raw, 0, strpos($raw, '"'));
    }
}

//Title shizzle
function lr_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'lr' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'lr_wp_title', 10, 2 );

add_filter('show_admin_bar', '__return_false');