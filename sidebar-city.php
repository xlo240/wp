<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! is_active_sidebar( 'sidebar-city' ) ) {
	return;
}

$xlo_city_arr = get_posts(array( 
	'post_type' => 'xlo_city', 
	'posts_per_page' => 10 ,
	'orderby' => 'name',
	'order' => 'ASC'
));
?>

<div class="widget-area" id="secondary" role="complementary">
	<?php //dynamic_sidebar( 'sidebar-city' ); ?>
	<h3>Города</h3>
	<ul>
	<?php foreach($xlo_city_arr as $xlo_city_item): ?>
	<li><a href="<?=get_permalink($xlo_city_item->ID);?>"><?=$xlo_city_item->post_title;?></a></li>
	<?php endforeach; ?>
	</ul>
</div>