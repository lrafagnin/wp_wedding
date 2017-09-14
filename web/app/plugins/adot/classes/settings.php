<?php

class ADotSettings {

    protected function __construct() {
        $plugin_file = 'adot/adot.php';
        add_action('admin_init', array($this, 'action_admin_init'));
        add_action('admin_menu', array($this, 'action_admin_menu'));
        register_activation_hook(__FILE__, array($this, 'action_activate' ));
        add_filter("plugin_action_links_{$plugin_file}", array($this,'plugin_action_links'), 10, 4);
    }

    public function action_activate() {
        add_option('adot_settings_token', '');
        add_option('adot_settings_greeting', true);
        add_option('adot_settings_shortcut', true);
        add_option('adot_settings_banner', true);
        add_option('adot_settings_url', '');
        add_option('adot_settings_icon', 1);
    }

    public function action_admin_menu() {
        add_options_page('aDot Settings', 'aDot Settings', 'manage_options', 'adot_admin_options_page', array($this, 'admin_options_page'));
    }

    public function admin_options_page() {
        include(dirname( __FILE__ ) . "/../view/options.php");
    }

    public function plugin_action_links($links) {
		$links[] = sprintf(
			'<a href="%s">%s</a>',
			admin_url('options-general.php?page=adot_admin_options_page'),
            'Settings'
		);
        return $links;
	}

    public function action_admin_init() {
        add_settings_section("adot-settings-section", "All Settings", null, "adot-settings-options");
        $this->register_setting("token", "API token");
        $this->register_setting("url", "Complaint site url");
        $this->register_setting("icon", "Icon");
        $this->register_setting("greeting", "Speak greeting");
        $this->register_setting("shortcut", "Use shortcut");
        $this->register_setting("banner", "Display banner");
    }

    private function register_setting($name, $title) {
        add_settings_field("adot_settings_${name}", "${title}", array($this, "display_element_${name}"), "adot-settings-options", "adot-settings-section");
        register_setting("adot-settings-section", "adot_settings_${name}");
    }

    public function display_element_token() {
        ?><input type="text" name="adot_settings_token" id="adot_settings_token" value="<?php echo get_option('adot_settings_token'); ?>" size="50" /><?php
    }

    public function display_element_url() {
        ?><input type="text" name="adot_settings_url" id="adot_settings_url" value="<?php echo get_option('adot_settings_url'); ?>" size="50" /><?php
    }

    public function display_element_icon() {
        $value = get_option('adot_settings_icon');
        for ($i=1; $i<=8; $i++) {
            echo '<input type="radio" name="adot_settings_icon" id="adot_settings_icon_'.$i.'" value="'.$i.'" '.checked($i, $value, false).' />';
            echo '<img src="'.sprintf(ADotShortcode::URL_IMAGE, $i).'">';
            if ($i==4) echo '<br>';
        }
    }

    public function display_element_greeting() {
        ?><input type="checkbox" name="adot_settings_greeting" id="adot_settings_greeting" value="true" <?php checked('true', get_option('adot_settings_greeting'), true)?> /><?php
    }

    public function display_element_shortcut() {
        ?><input type="checkbox" name="adot_settings_shortcut" id="adot_settings_shortcut" value="true" <?php checked('true', get_option('adot_settings_shortcut'), true)?> /><?php
    }

    public function display_element_banner() {
        ?><input type="checkbox" name="adot_settings_banner" id="adot_settings_banner" value="true" <?php checked('true', get_option('adot_settings_banner'), true)?> /><?php
    }

    public static function init() {
		static $instance = null;
		if (!$instance) {
			$instance = new ADotSettings;
		}
		return $instance;
	}

}

ADotSettings::init();
