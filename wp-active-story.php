<?php
/**
 * Plugin Name: WP Active Story
 * Plugin URI: https://example.com/wp-active-story
 * Description: افزونه استوری اختصاصی برای وردپرس
 * Version: 1.0.0
 * Author: Ali Emadzadeh
 * License: GPL v2 or later
 * Text Domain: wp-active-story
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

// تعریف ثابت‌های افزونه
define('WPAS_VERSION', '1.0.0');
define('WPAS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WPAS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WPAS_PLUGIN_INC_DIR', plugin_dir_path(__FILE__) . 'includes/');
define('WPAS_POST_TYPE', 'wp_active_story');

// بارگذاری فایل‌های اصلی
require_once WPAS_PLUGIN_INC_DIR . 'class-wp-active-story.php';
require_once WPAS_PLUGIN_INC_DIR . 'class-story-post-type.php';
require_once WPAS_PLUGIN_INC_DIR . 'class-story-metabox.php';
require_once WPAS_PLUGIN_INC_DIR . 'class-story-frontend.php';

// راه‌اندازی افزونه
WP_Active_Story::get_instance();

// فعال‌سازی افزونه
register_activation_hook(__FILE__, function() {
    WP_Active_Story::activate();
});

// غیرفعال‌سازی افزونه
register_deactivation_hook(__FILE__, function() {
    WP_Active_Story::deactivate();
});