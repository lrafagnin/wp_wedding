<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wpw
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			$myposts = get_posts(array(
					'posts_per_page' => -1,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'category__not_in' => array(38, 40, 42)
			));
			foreach ($myposts as $post) : setup_postdata($post);
				get_template_part('template-parts/content', get_post_format());
			endforeach;
			wp_reset_postdata();
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
