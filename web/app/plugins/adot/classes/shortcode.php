<?php
class ADotShortcode {

    const URL_SCRIPT = 'https://a.digiprodiy.com/BriskCoder/Pub/Media/js/%s.js';
    const URL_IMAGE = 'https://adotpro.com/BriskCoder/Pub/Media/img/adot-seal-%s.png';

    protected function __construct() {
        $plugin_file = 'adot/adot.php';
        add_action('init', array($this, 'action_init'));
        add_action('wp_enqueue_scripts', array($this, 'action_register_scripts'));
    }

    public function action_init() {
        add_shortcode('adot-seal', array($this, 'shortcode_adot_seal'));
        add_filter('widget_text', 'do_shortcode');
    }

    public function shortcode_adot_seal($atts, $content = null) {
        extract(shortcode_atts(array(
            'token' => get_option('adot_settings_token'),
            'greeting' => get_option('adot_settings_greeting'),
            'shortcut' => get_option('adot_settings_shortcut'),
            'banner' => get_option('adot_settings_banner'),
            'url' => get_option('adot_settings_url'),
            'icon' => get_option('adot_settings_icon'),
        ), $atts));

        wp_enqueue_script('adot-reader', sprintf($this::URL_SCRIPT, "Reader"), array('jquery'), '1.0.0', true);
        wp_enqueue_script('adot-seal', sprintf($this::URL_SCRIPT, "Seal"), array('jquery', 'adot-reader'), '1.0.0', true);

        $divName = 'div_'.wp_generate_password(10, false, false);
        wp_add_inline_script('adot-seal', 'var _adot = {token:"'.$token.'"'.
            ',greeting:'.var_export($greeting,true).',shortcut:'.var_export($shortcut,true).
            ',banner:'.var_export($banner,true).',sealDiv:"#'.$divName.'"'.
            ',adaUrl:"'.$url.'",adaIconSrc:"'.sprintf($this::URL_IMAGE, $icon).'"};',
            'before');

        return "<div id='${divName}'>${content}</div>";
    }

    public function action_register_scripts() {
        //wp_register_script('adot-script-reader', plugins_url('/assets/js/reader.js', __FILE__), array('jquery'), '1.0.0', 'all');
        //wp_register_script('adot-script-seal', plugins_url('/assets/js/seal.js', __FILE__), array('jquery', 'adot-script-reader'), '1.0.0', 'all');
    }

    public static function init() {
		static $instance = null;
		if (!$instance) {
			$instance = new ADotShortcode;
		}
		return $instance;
	}

}

ADotShortcode::init();
