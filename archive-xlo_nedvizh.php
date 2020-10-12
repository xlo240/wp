<?php
/**
 * Template name: Недвижимость TPL
 */
get_header();
?>

<?php 

$args = array( 'post_type' => 'xlo_nedvizh', 'posts_per_page' => 10 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
  <?php echo '<div class="entry-content">';
  //the_content();//вывод контента
  echo '</div>';
endwhile;

get_footer();
?>