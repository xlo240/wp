<?php
/**
 * Template name: Города TPL
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 
get_header();
?>

<?php 

$args = array( 'post_type' => 'xlo_city', 'posts_per_page' => 10 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
  <?php echo '<div class="entry-content">';
  //the_content();//вывод контента
  echo '</div>';
endwhile;
echo "<hr>";
$xlo_city_arr = get_posts($args);
foreach($xlo_city_arr as $xlo_city_item){
	echo $xlo_city_item->ID.' <a href="'.get_permalink($xlo_city_item->ID).'">'.$xlo_city_item->post_title.'</a><br>';
}
get_footer();
?>