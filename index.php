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
		$this->taxonomies();
		$this->metaboxes();
	}
	
	public function register_post_type(){
		$args = array(
			// for admin options
			'labels' => array(
				'name' => 'Movies',
				'singular_name' => 'Movie',
				'add_new' => 'Add New Movie',
				'edit_item' => 'Edit Movie',
				'new_item' => 'Add New Movie',
				'view_item' => 'View Movie',
				'search_items' => 'Search Movies',
				'not_found' => 'No Movies Found',
				'not_found_in_trash' => 'No Movies Found in Trash'
			),
			// variable to query movies
			'query_var' => 'movies',
			// url structure
			'rewrite' => array(
				'slug' => 'movies',
			),
			// makes the custom post type visible in backend
			'public' => true,
			// menu position 1 to 100
			'menu_position' => 5,
			// menu icon in wp-admin folder
			'menu_icon' => admin_url().'images/media-button-video.gif',
			'supports' => array(
							'title', 
							'excerpt',
							'thumbnail', 
							//'custom-fields'
						)
		);
		register_post_type('kd_movie', $args);
	}
	
	public function taxonomies(){
		
		$taxonomies = array();
		
		$taxonomies['genre'] = array(
			// for admin options
			'labels' => array(
				'name' => 'Genre',
				'singular_name' => 'Genre',
				'add_new' => 'Add New Genre',
				'edit_item' => 'Edit Genre',
				'update_item' => 'Update Genre',
				'add_new_item' => 'Add New Genre',
				'all_items' => 'All Genres',
				'search_items' => 'Search Genre',
				'popular_items' => 'Popular Genres',
				'separate_items_with_comments' => 'Separate genres with commas',
				'add_or_remove_items' => 'Add or remove genres',
				'choose_from_most_used' => 'Choose from most used genres'
			),
			// variable to query movies
			'query_var' => 'movie_genre',
			// url structure
			'rewrite' => array(
				'slug' => 'movies/genre'
			),
			// set hierarchy so that taxonomy can have parent
			'hierarchical' => true
		);	
		
		$taxonomies['studio'] = array(
			// for admin options
			'labels' => array(
				'name' => 'Studio',
				'singular_name' => 'Studio',
				'add_new' => 'Add New Studio',
				'edit_item' => 'Edit Studio',
				'update_item' => 'Update Studio',
				'add_new_item' => 'Add New Studio',
				'all_items' => 'All Studio',
				'search_items' => 'Search Studio',
				'popular_items' => 'Popular Studio',
				'separate_items_with_comments' => 'Separate Studio with commas',
				'add_or_remove_items' => 'Add or remove Studio',
				'choose_from_most_used' => 'Choose from most used Studio'
			),
			// variable to query movies
			'query_var' => 'movie_studio',
			// url structure
			'rewrite' => array(
				'slug' => 'movies/studio'
			),
			// set hierarchy so that taxonomy can have parent
			'hierarchical' => true
		);	
				
		$this->register_all_taxonomies($taxonomies);
	}
	
	public function register_all_taxonomies($taxonomies){
		// register_taxonomy('movie_genre', array('kd_movie'), $args); - For single taxonomy
		foreach($taxonomies as $name=>$arr) {
			register_taxonomy($name, array('kd_movie'), $arr);
		}
	}
	
	public function metaboxes(){
		// Add metaboxes as an alternate to custom field
		add_action('add_meta_boxes', function(){
			// css id, title, cb func, page, priority, cb func arguments
			add_meta_box('kd_movie_length', 'Movie Length', 'movie_length', 'kd_movie');
		});
		
		function movie_length($post){
			$length = get_post_meta($post->ID,'kd_movie_length', true);
			?>
            <p>
            	<label for="kd_movie_length"> Length: </label>
                <input type="text" class="widefat" name="kd_movie_length" id="kd_movie_length" value="<?php echo esc_attr($length); ?>">
            </p>
            <?php
		}
		
		add_action('save_post', function($id){
			if(isset($_POST['kd_movie_length'])){
				update_post_meta(
					$id,
					'kd_movie_length',
					strip_tags($_POST['kd_movie_length'])
				);
			}
		});
	}
	
}

add_action('init', function(){
	new KD_Movies_Post_Type();
});

?>