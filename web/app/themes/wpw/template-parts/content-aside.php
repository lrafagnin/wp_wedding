<?php
/**
 * Template part for aside content
 *
 * @package wpw
 */

$classes = get_post_meta(get_the_ID(), 'cssClass', true);
?>

<section id="<?php echo get_post_field('post_name', get_post()) ?>" <?php post_class($classes); ?>>
	<?php echo get_the_content(); ?>
</section>
