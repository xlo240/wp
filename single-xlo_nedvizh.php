<?php
get_header();
?>
<?php 
the_post();

get_template_part( 'loop-templates/content', 'single' );
$xlo_city_arr = get_posts(array(
		'post_type' => 'xlo_city',
		'include'   => array(get_field('id_city', get_the_ID()))
	)
);
?>
<ul>
	<li>Площадь: <?= get_post_meta(get_the_ID(), 'plosh', true); ?> кв. м</li>
	<li>Жилая площадь: <?= get_post_meta(get_the_ID(), 'zhil_plosh', true); ?> кв. м.</li>
	<li>Стоимость: <?= get_post_meta(get_the_ID(), 'stoimost', true); ?> руб.</li>
	<li>Этаж: <?= get_post_meta(get_the_ID(), 'floor', true); ?></li>
	<li>Адрес: <?= get_post_meta(get_the_ID(), 'adress', true); ?></li>
	<li>Адрес: <?= get_field('adress', get_the_ID()); ?> get_field</li>
	<li><?= get_post_meta(get_the_ID(), 'adress', true); ?></li>
	<li><?=get_field('id_city', get_the_ID());?></li>
</ul>
<?php
$terms = get_the_terms(get_the_ID(), 'nedv_type');
foreach ($terms as $term) {
	echo '<span class="'.$term->slug.'">Тип недвижимости: '.$term->name.'</span><br>';
}
?>
<?php 
foreach($xlo_city_arr as $xlo_city_item):
?>
<p>Город: <?= $xlo_city_item -> post_title; ?></p>
<?php endforeach; ?>
<?php get_footer(); ?>