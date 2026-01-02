<?php
// جلوگیری از دسترسی مستقیم
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// حذف options
delete_option('wpas_settings');
delete_option('wpas_version');

// حذف custom post type posts
$stories = get_posts(array(
    'post_type'   => 'wp_active_story',
    'numberposts' => -1,
    'post_status' => 'any'
));

foreach ($stories as $story) {
    wp_delete_post($story->ID, true);
}

// حذف جداول سفارشی (اگر وجود دارند)
global $wpdb;
$tables = array(
    $wpdb->prefix . 'active_story_likes',
    $wpdb->prefix . 'active_story_views'
);

foreach ($tables as $table) {
    $wpdb->query("DROP TABLE IF EXISTS $table");
}

// پاکسازی cache
wp_cache_flush();
