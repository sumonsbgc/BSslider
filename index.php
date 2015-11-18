<?php 

/*
Plugin Name: Bootstrap Slider
Plugin URI: http://sumonsdesign.com/BSslider
Description: The plugin is dynamic version of Bootsrap slider..
Version: 1.0
Author: Sumon
Author URI:http://sumonsdesign.com
*/

if(!defined('ABSPATH')){
	exit;
}


require_once(plugin_dir_path(__FILE__).'/inc/custom-metabox.php');
require_once(plugin_dir_path(__FILE__).'/inc/bsoptions.php');
require_once(plugin_dir_path(__FILE__).'/inc/postregister.php');

function scriptFile(){
	 wp_register_style( 'bootstrap', plugins_url('/css/bootstrap.min.css', __FILE__) );
	 wp_enqueue_style('bootstrap');
	 wp_register_script( 'bootstrapJs', plugins_url('/js/bootstrap.min.js', __FILE__), array('jquery') );
	 wp_register_script( 'customJs', plugins_url('/js/custom.js', __FILE__), array('jquery') );
	 wp_enqueue_script('bootstrapJs');
	 wp_enqueue_script('customJs');
}
add_action('wp_enqueue_scripts','scriptFile');



function sliderShortcode(){
	$optionValue = (array)get_option('carouselOptions');
	$indicator = $optionValue['bs_carousel_indicator'];
	$interval = $optionValue['bs_carousel_interval'];
	$pause = $optionValue['bs_pause'];
	$id = $optionValue['bs_carousel_id'];
	extract(shortcode_atts(array(
		'count'=>-1,
		'id'=>'carousel-example-generic'
	), $atts,'slider'));





?>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('.carousel').carousel({
	        interval:<?php echo $interval; ?>,
	        pause:<?php echo $pause; ?>
	    });
	</script>
	<style type="text/css">
		.carousel-caption>h2{
			font-size: ;
			font-weight: ;
			color:red !important;
		}
		.carousel-caption>p{
			font-size: ;
			font-weight: ;
			font-family: ;
			font-style: ;
			color:;
			text-transform: ;
		}
	</style>




<?php





	$q = new WP_Query(
		array(
			'posts_per_page' =>$count,
			'post_type' => 'slider'
		)
	);

$list='<div id="'.$id.'" class="carousel slide" data-ride="carousel">';
	if( TRUE == $indicator){		
		 	$list.='<ol class="carousel-indicators">';
		 	$i = 0;
			while( $i<($q->post_count) ){
			    $list.='<li data-target="#'.$id.'" data-slide-to="'.$i.'"></li>';
		  		$i++;
		  	}
		  	$list.='</ol>';	  	
	  	}

  $list .='<div class="carousel-inner">';
  while($q->have_posts()): $q->the_post();
			$idd = get_the_id();
			$post_thumbnail = get_the_post_thumbnail($idd,'sliderThumb');
			$list .= 
					'<div class="item">
    					'.$post_thumbnail.'
      					<div class="carousel-caption">
        					<h2>'.get_the_title().'</h2>
        					<p>'.get_the_excerpt().'</p>
      					</div>
    				</div>';
		endwhile;	
	$list .= '</div>';
	$list.='
	  <a class="left carousel-control" href="#'.$id.'" role="button" data-slide="prev">
	    <span class="top glyphicon glyphicon-chevron-left"></span>
	  </a>
	  <a class="right carousel-control" href="#'.$id.'" role="button" data-slide="next">
	    <span class="top glyphicon glyphicon-chevron-right"></span>
	  </a>
	</div>';


	wp_reset_query();
	return $list;


}
add_shortcode('slider','sliderShortcode');