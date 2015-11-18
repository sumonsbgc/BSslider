<?php  
////////////////////////
/*
	it is register post type for bootsrap slider.
*/
///////////////////////

function postTyperegister(){
	$labels = array(
				'name'=> __('BSslider'),
				'singular_name'=> __('BSslider'),
				'add_new'=> __('Add New'),
				'add_new_item'=> __('Add New BSslider'),
				'edit_item'=> __('Edit BSslider'),
				'new_item'=> __('New BSslider'),
				'all_item'=> __('update BSslider'),
				'view_item'=> __('View BSslider'),
				'search_term'=> __('Search BSslider'),
				'not_found'=> __('Sorry! There is nothing what you are searching'),
				'menu_name'=> __('BSslider'),
			);

	$args = array(
				'labels'=>$labels,
				'public'=>TRUE,
				'exclude_from_search'=>true,
				'publicly_queryable'=>TRUE,
				'show_ui'=>TRUE,
				'show_in_menu'=>TRUE,
				'query_var'=>TRUE,
				'rewrite'=>array('slug' => 'sliders'),
				'capability_type'=>'page',
				'has_archive'=>false,
				'supports'=>array('title','editor','author','thumbnail','excerpt','comments')
			);

	register_post_type('slider',$args);
}
add_action('init','postTyperegister');


?>