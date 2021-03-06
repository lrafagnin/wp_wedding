<?php
function get_attachment_url_by_slug($slug)
{
	$args = array(
		'post_type' => 'attachment',
		'name' => sanitize_title($slug),
		'posts_per_page' => 1,
		'post_status' => 'inherit',
	);
	$_header = get_posts($args);
	$header = $_header ? array_pop($_header) : null;
	return $header ? wp_get_attachment_url($header->ID) : '';
}

function get_id_by_slug($page_slug, $slug_page_type = 'page')
{
	$args = array(
		'post_type' => $slug_page_type,
		'name' => sanitize_title($page_slug),
		'posts_per_page' => 1,
		'post_status' => 'publish',
	);
	$_header = get_posts($args);
	return $_header ? array_pop($_header)->ID : null;
}

function get_content_by_slug($slug, $type = 'post')
{
	$page_id = get_id_by_slug($slug, $type);
	if ($page_id) {
		$post_id = pll_get_post($page_id);
		return get_post($post_id);
	}
	return null;
}

function filter_content($post)
{
	return apply_filters('the_content', $post->post_content);
}

include_once(ABSPATH . 'wp-admin/includes/plugin.php');

// check if polylang exist & enabled
if (is_plugin_active('polylang/polylang.php')) {
	//plugin is activated
	add_filter('pll_the_languages', 'wpw_lang', 10, 2);
	function wpw_lang($output = '', $args = '')
	{
		$translations = pll_the_languages(array('raw' => 1));

		$current = current($translations);
		foreach ($translations as $key => $value) {
			if ($value['current_lang']) {
				$current = $value;
				break;
			}
		}

		$output = '';
		$output .= '<div class="btn-group dropdown" role="group">
    <button type="button" class="btn btn-lang dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <img src="' . $current['flag'] . '" alt="' . $current['slug'] . '">
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">';
		foreach ($translations as $key => $value) {
			$output .= '<li><a href="' . $value['url'] . '"><img src="' . $value['flag'] . '" alt="' . $value['slug'] . '"> ' . $value['name'] . '</a></li>';
		}
		$output .= '</ul></div>';
		return $output;
	}
}

add_filter('wp_nav_menu_items', 'wpw_menu_item', 10, 2);
function wpw_menu_item($items, $args)
{
	if ($args->theme_location == 'primary') {
		$items = '<li class="hidden"><a href="#page-top"></a></li>' . $items;
		$items .= '<li class="hidden-xs">' . wpw_lang() . '</li>';
	}
	return $items;
}

function wpw_rsvp_form() {
	ob_start();
    get_template_part('template-parts/rsvp_form');
    return ob_get_clean();
}
add_shortcode('rsvp', 'wpw_rsvp_form');

function wpw_register_strings() {
   $form = array(
	   "Your details",
	   "Full name",
	   "Special dietary",
	   "Select events",
	   "Reception & Brunch",
	   "Reception",
	   "Apologies, I will not be able to attend",
       "Add guest",
       "Remove guest",
	   "Guest details",
	   "Guest name",
	   "Your email",
	   "Your phone",
	   "Your message",
	   "Send confirmation",
       "Thank you for confirmation. We are super excited to see you there!",
       "An error occured. Please try again.",
	   "Days", "Hours", "Minutes", "Seconds",
   );
   foreach ($form as $item) {
	   pll_register_string('wpw', $item, 'form', false);
   }
}
add_action('admin_init', 'wpw_register_strings');

function wpw_countdown($attributes = [], $content = null, $tag = '')
{
    $attributes = array_change_key_case((array)$attributes, CASE_LOWER);
	$attributes = shortcode_atts([
	    	'date' => strtotime('+1 day'),
    	], $attributes, $tag);

	ob_start();
    include(locate_template('template-parts/countdown.php'));
	return ob_get_clean();
}
add_shortcode('countdown', 'wpw_countdown');
