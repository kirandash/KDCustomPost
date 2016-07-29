<?php
add_shortcode('kd_movies',function(){
	
	$loop = new WP_Query(
		array(
			'post_type' => 'kd_movie',
			'orderby' => 'title'
		)
	); 
	
	if($loop->have_posts()) {
		$output = '<ul class="kd_movie_list">';
		while($loop->have_posts()) {
			$loop->the_post();
			$meta = get_post_meta(get_the_id(),'');
			//print_r($meta);
			
			$output .= '<li>
							<a href="'.get_the_permalink().'">
								'.get_the_title().' | '.
								$meta['kd_movie_length'][0].'
							</a>
							<div>'.get_the_excerpt().'</div>
						</li>
						';
		}
	}else {
		$output = 'No movies added';
	}
	
	return $output;
	
});
?>