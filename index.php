<?php
/*
Plugin Name: KD Custom Post type
Plugin URI: http://bgwebagency.com
Version: 1.0
Author: Kiran Dash
Plugin URI: http://bgwebagency.com
*/

class KD_Movies_Post_Type {
	
	public function __construct(){
		$this->register_post_type();
	}
	
	public function register_post_type(){
		$args = array(
			// for admin options
			'labels' => array(
				'name' => 'Movies',
				'singular_name' => 'Movie',
				'add_new' => 'Add New Movie',
				'edit_item' => 'Edit Item',
				'new_item' => 'Add New Item',
				'view_item' => 'View Movie',
				'search_items' => 'Search Movies',
				'not_found' => 'No Movies Found',
				'not_found_in_trash' => 'No Movies Found in Trash'
			),
			// variable to query movies
			'query_var' => 'movies',
			// url structure
			'rewrite' => array(
				'slug' => 'movies/',
			),
			'public' => true
		);
		register_post_type('kd_movie', $args);
	}
}

add_action('init', function(){
	new KD_Movies_Post_Type();
});
?>