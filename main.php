<?php
/**
 * Template name: Main TPL
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php //get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div... -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'loop-templates/content', get_post_format() );
						?>

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

		<!-- Do the right sidebar check -->
		<?php //get_template_part( 'global-templates/right-sidebar-check' ); ?>
		
	</div><!-- .row -->
	
</div><!-- Container end -->
<div class="container">
	<div class="row">
		<div class="col-sm-6"><?php get_sidebar('nedvizh'); ?></div>
		<div class="col-sm-6"><?php get_sidebar('city'); ?></div>
	</div>
	<div class="row">
		<div class="col-sm-12"><?php get_sidebar('form'); ?></div>
	</div>
</div>
</div><!-- Wrapper end -->

<?php get_footer(); ?>
