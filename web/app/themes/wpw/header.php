<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpw
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body id="page-top" <?php body_class('index'); ?>>

<div id="page" class="site">
	<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
		<div class="container">
			<div class="navbar-header page-scroll">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-mobile">
					<span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
				</button>
				<div class="nav navbar-lang visible-xs"><?php echo wpw_lang() ?></div>
				<a class="navbar-brand page-scroll" href="#page-top"><?php bloginfo('name'); ?></a>
			</div>

			<div class="collapse navbar-collapse" id="navbar-mobile">
				<?php
				if (has_nav_menu('primary')) :
					wp_nav_menu(['theme_location' => 'primary', 'menu_class' => 'nav navbar-nav navbar-right']);
				endif;
				?>
			</div>
		</div>
	</nav>

	<!-- Header -->
	<header style="background-image: url('<?php header_image(); ?>');">
		<div class="container">
			<?php
				$header = get_content_by_slug('header');
				echo apply_filters('the_content', $header->post_content);
			?>
		</div>
	</header>

	<div id="content" class="site-content">
