<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! is_active_sidebar( 'sidebar-nedvizh' ) ) {
	return;
}
?>

<div class="widget-area" id="secondary2" role="complementary">
	<?php //dynamic_sidebar( 'sidebar-nedvizh' ); ?>
<?php 
$nedvizh_arr = get_posts(array(
	'post_type' => 'xlo_nedvizh', 
	'posts_per_page' => 10,
	'orderby' => 'date'
));
?>
<h3>Недвижимость</h3>
<ul>
<?php foreach($nedvizh_arr as $nedvizh_item): 
$plosh = get_field_object('plosh', $nedvizh_item->ID);
$zhil_plosh = get_field_object('zhil_plosh', $nedvizh_item->ID);
$stoimost = get_field_object('stoimost', $nedvizh_item->ID);
$adress = get_field_object('adress', $nedvizh_item->ID);
$floor = get_field_object('floor', $nedvizh_item->ID);
?>
<li><a href="<?=get_permalink($nedvizh_item->ID); ?>"><?=$nedvizh_item->post_title; ?></a>
	<ul>
		<!--<li>Площадь: <?=get_field('plosh', $nedvizh_item->ID); ?></li>
		<li>Жилая площадь: <?=get_field('zhil_plosh', $nedvizh_item->ID); ?></li>
		<li>Цена: <?=get_field('stoimost', $nedvizh_item->ID); ?></li>
		<li>Адрес: <?=get_field('adress', $nedvizh_item->ID); ?></li>
		<li>Этаж: <?=get_field('floor', $nedvizh_item->ID); ?></li>
		-->
		<!-- второй вариант вывода с именами полей -->
		<li><?=$plosh['label'] ?>: <?=$plosh['value'] ?></li>
		<li><?=$zhil_plosh['label'] ?>: <?=$zhil_plosh['value'] ?></li>
		<li><?=$stoimost['label'] ?>: <?=$stoimost['value'] ?></li>
		<li><?=$adress['label'] ?>: <?=$adress['value'] ?></li>
		<li><?=$floor['label'] ?>: <?=$floor['value'] ?></li>
		<?php
		$terms = get_the_terms($nedvizh_item->ID, 'nedv_type');
		foreach($terms as $term){
		?>
		<li>Тип недвижимости: <?=$term->name;?></li>
		<?php } ?>
	</ul>
</li>
<?php endforeach; ?>
</ul>
</div>