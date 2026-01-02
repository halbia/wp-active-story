<?php
/**
 * Main Plugin Class
 */

if (!defined('ABSPATH')) {
    exit;
}

class WP_Active_Story {

    /**
     * Instance
     */
    private static $instance = null;

    /**
     * Get instance
     */
    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct()
    {
        $this->init_hooks();
        $this->includes();
        $this->init_classes();
    }


    /**
     * Include required files
     */
    private function includes()
    {
        require_once WPAS_PLUGIN_INC_DIR . 'class-story-post-type.php';
        require_once WPAS_PLUGIN_INC_DIR . 'class-story-metabox.php';
        require_once WPAS_PLUGIN_INC_DIR . 'class-story-frontend.php';
    }

    private function init_classes() {
        Wp_Active_Story_Post_Type::get_instance();
        Wp_Active_Story_Metabox::get_instance();
        WP_Active_Story_Frontend::get_instance();
    }

    /**
     * Initialize hooks
     */
    private function init_hooks()
    {
        // Register scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    /**
     * Enqueue frontend scripts
     */
    public function enqueue_frontend_scripts()
    {
        // CSS
        wp_enqueue_style('wpas-frontend', WPAS_PLUGIN_URL . 'assets/css/frontend.css', array(), WPAS_VERSION);

        // JavaScript
        wp_enqueue_script('wpas-frontend', WPAS_PLUGIN_URL . 'assets/js/frontend.js', array('jquery'), WPAS_VERSION, true);

        // Localize script for AJAX
        wp_localize_script('wpas-frontend', 'wpas_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('wpas_nonce')
        ));
    }

    /**
     * Enqueue admin scripts
     */
    public function enqueue_admin_scripts($hook)
    {
        global $post_type;

        // Only load on our post-type pages
        if (WPAS_POST_TYPE == $post_type) {
            wp_enqueue_media();

            // CSS
            wp_enqueue_style('wpas-admin', WPAS_PLUGIN_URL . 'assets/css/backend.css', array(), WPAS_VERSION);

            // JavaScript
            wp_enqueue_script('wpas-admin', WPAS_PLUGIN_URL . 'assets/js/backend.js', array('jquery', 'jquery-ui-sortable'), WPAS_VERSION, true);

            wp_localize_script('wpas-admin', 'wpas_metabox', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce('wpas_metabox_nonce'),
                'i18n'     => array(
                    'select_image'   => __('Select Image', 'wp-active-story'),
                    'select_video'   => __('Select Video', 'wp-active-story'),
                    'delete_item'    => __('Delete Item', 'wp-active-story'),
                    'delete_confirm' => __('Are you sure you want to delete this item?', 'wp-active-story'),
                    'media_type_mismatch' => __('Selected media type does not match item type', 'wp-active-story')
                )
            ));
        }
    }

    /**
     * Activation hook
     */
    public static function activate() {
        flush_rewrite_rules();

        // Initialize post type on activation
        if (class_exists('Wp_Active_Story_Post_Type')) {
            $post_type = Wp_Active_Story_Post_Type::get_instance();
            $post_type->register_post_type();
            $post_type->register_taxonomies();
        }
    }

    /**
     * Deactivation hook
     */
    public static function deactivate() {
        flush_rewrite_rules();
    }
}