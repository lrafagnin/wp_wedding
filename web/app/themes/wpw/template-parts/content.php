<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wpw
 */

?>

<article id="<?php echo get_post_field('post_name', get_post()) ?>" <?php
post_class(get_post_meta(get_the_ID(), 'cssClass', true));
if ($thumb = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full')):
?>style="background-image: url('<?php echo $thumb['0'] ?>');"<?php endif; ?>>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading"><?php
					if (is_single()) :
						echo get_the_title();
					else:
						echo '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . get_the_title() . '</a>';
					endif;
					?></h2>
				<?php if ($subheader = get_post_meta(get_the_ID(), 'subheader', true)): ?>
					<h3 class="section-subheading text-muted"><?php echo $subheader; ?></h3>
				<?php endif; ?>
			</div>
		</div>
		<?php the_content(); ?>
	</div>
</article>
