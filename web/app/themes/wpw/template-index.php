<?php
/**
 * Template Name: Wedding template
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
					'category__in' => array(18, 75, 77)
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
