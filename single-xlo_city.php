<?php
get_header();
the_post();
get_template_part( 'loop-templates/content', 'single' );
$nedv_arr = get_posts(array(
	'post_type'      => 'xlo_nedvizh', 
	'posts_per_page' => -1,
	'meta_key'       => 'id_city',
	'orderby'		 => 'meta_value',
	'order'			 => 'DESC', 
	'meta_query'     => array(
		array(
			'key'   => 'id_city',
			'value'	=> get_the_ID(),
			'compare' 	=> '='
		)
	)
));
?>
<h2>Недвижимость в городе <? the_title(); ?></h2>
<ul>
<?php 
foreach($nedv_arr as $nedv_item){
?>
<li><a href="<?=get_permalink($nedv_item->ID); ?>"><?=$nedv_item->post_title;?></a></li>
<?php } ?>
</ul>
<?php
get_footer();
?>