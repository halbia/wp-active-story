<?php
defined('ABSPATH') || exit;

class Wp_Active_Story_Post_Type{
    /**
     * Instance
     */
    private static $instance = null;

    /**
     * Post-type slug
     */
    const POST_TYPE = 'wp_active_story';

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

    public function __construct()
    {
        add_action('init', array($this, 'register_post_type'));
        add_action('init', array($this, 'register_taxonomies'));
        add_filter('manage_' . WPAS_POST_TYPE . '_posts_columns', array($this, 'add_custom_columns'));
        add_action('manage_' . WPAS_POST_TYPE . '_posts_custom_column', array($this, 'render_custom_columns'), 10, 2);
        add_filter('post_row_actions', array($this, 'modify_row_actions'), 10, 2);
        add_action('admin_head', array($this, 'hide_view_link'));
        add_filter('enter_title_here', array($this, 'change_title_placeholder'), 10, 2);
        add_action('pre_get_posts', array($this, 'modify_admin_query'));
        add_filter('admin_post_thumbnail_html', array($this,'add_custom_text_below_featured_image'), 10, 2);
    }

    /**
     * Register custom post type
     */
    public function register_post_type()
    {
        $labels = array(
            'name'                  => _x('Stories', 'Post Type General Name', 'wp-active-story'),
            'singular_name'         => _x('Story', 'Post Type Singular Name', 'wp-active-story'),
            'menu_name'             => __('Active Stories', 'wp-active-story'),
            'name_admin_bar'        => __('Story', 'wp-active-story'),
            'archives'              => __('Story Archives', 'wp-active-story'),
            'attributes'            => __('Story Attributes', 'wp-active-story'),
            'parent_item_colon'     => __('Parent Story:', 'wp-active-story'),
            'all_items'             => __('All Stories', 'wp-active-story'),
            'add_new_item'          => __('Add New Story', 'wp-active-story'),
            'add_new'               => __('Add New', 'wp-active-story'),
            'new_item'              => __('New Story', 'wp-active-story'),
            'edit_item'             => __('Edit Story', 'wp-active-story'),
            'update_item'           => __('Update Story', 'wp-active-story'),
            'view_item'             => __('View Story', 'wp-active-story'),
            'view_items'            => __('View Stories', 'wp-active-story'),
            'search_items'          => __('Search Story', 'wp-active-story'),
            'not_found'             => __('Not found', 'wp-active-story'),
            'not_found_in_trash'    => __('Not found in Trash', 'wp-active-story'),
            'featured_image'        => __('Story Image', 'wp-active-story'),
            'set_featured_image'    => __('Set story image', 'wp-active-story'),
            'remove_featured_image' => __('Remove story image', 'wp-active-story'),
            'use_featured_image'    => __('Use as story image', 'wp-active-story'),
            'insert_into_item'      => __('Insert into story', 'wp-active-story'),
            'uploaded_to_this_item' => __('Uploaded to this story', 'wp-active-story'),
            'items_list'            => __('Stories list', 'wp-active-story'),
            'items_list_navigation' => __('Stories list navigation', 'wp-active-story'),
            'filter_items_list'     => __('Filter stories list', 'wp-active-story'),
        );

        $args = array(
            'label'               => __('Story', 'wp-active-story'),
            'description'         => __('Instagram-like stories for WordPress', 'wp-active-story'),
            'labels'              => $labels,
            'supports'            => array('title', 'thumbnail','comments', 'author'),
            'hierarchical'        => false,
            'public'              => false, // بدون آرشیو و صفحه سینگل
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 25,
            'menu_icon'           => 'dashicons-insert',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => false,
            'can_export'          => true,
            'has_archive'         => false, // بدون آرشیو
            'exclude_from_search' => true,
            'publicly_queryable'  => false, // بدون صفحه سینگل در فرانت
            'rewrite'             => false,
            'capability_type'     => 'post',
            'show_in_rest'        => true,
            'rest_base'           => 'active-stories',
            'query_var'           => false,
        );

        register_post_type(WPAS_POST_TYPE, $args);
    }

    /**
     * Register taxonomies for stories
     */
    public function register_taxonomies()
    {
        // Taxonomy for story categories
        $category_labels = array(
            'name'              => _x('Story Categories', 'taxonomy general name', 'wp-active-story'),
            'singular_name'     => _x('Story Category', 'taxonomy singular name', 'wp-active-story'),
            'search_items'      => __('Search Categories', 'wp-active-story'),
            'all_items'         => __('All Categories', 'wp-active-story'),
            'parent_item'       => __('Parent Category', 'wp-active-story'),
            'parent_item_colon' => __('Parent Category:', 'wp-active-story'),
            'edit_item'         => __('Edit Category', 'wp-active-story'),
            'update_item'       => __('Update Category', 'wp-active-story'),
            'add_new_item'      => __('Add New Category', 'wp-active-story'),
            'new_item_name'     => __('New Category Name', 'wp-active-story'),
            'menu_name'         => __('Categories', 'wp-active-story'),
        );

        $category_args = array(
            'hierarchical'      => true,
            'labels'            => $category_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => false,
            'show_in_rest'      => true,
            'public'            => false,
        );

        register_taxonomy('story_category', array(WPAS_POST_TYPE), $category_args);
    }



    /**
     * Add custom columns to admin list
     */
    public function add_custom_columns($columns)
    {
        $new_columns = array();

        // Add thumbnail column at the beginning
        $new_columns['cb'] = $columns['cb'];
        $new_columns['thumbnail'] = __('Thumbnail', 'wp-active-story');

        foreach ($columns as $key => $value) {
            $new_columns[$key] = $value;

            if ($key === 'title') {
                $new_columns['story_items'] = __('Items', 'wp-active-story');
                $new_columns['story_type'] = __('Type', 'wp-active-story');
                $new_columns['story_likes'] = __('Likes', 'wp-active-story');
                $new_columns['story_views'] = __('Views', 'wp-active-story');
                $new_columns['story_status'] = __('Status', 'wp-active-story');
            }
        }

        // Remove date column
        unset($new_columns['date']);

        return $new_columns;
    }

    /**
     * Render custom columns content
     */
    public function render_custom_columns($column, $post_id)
    {
        switch ($column) {
            case 'thumbnail':
                $thumbnail = get_the_post_thumbnail($post_id, array(50, 50));
                if ($thumbnail) {
                    echo '<div class="wpas-thumbnail">' . $thumbnail . '</div>';
                } else {
                    echo '<div class="wpas-no-thumbnail" style="width: 50px; height: 50px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; color: #999; font-size: 10px;">' . __('No Image', 'wp-active-story') . '</div>';
                }
                break;

            case 'story_items':
                $items = get_post_meta($post_id, '_story_items', true);
                $count = is_array($items) ? count($items) : 0;
                echo '<span class="wpas-item-count">' . $count . ' ' . _n('item', 'items', $count, 'wp-active-story') . '</span>';
                break;

            case 'story_type':
                $items = get_post_meta($post_id, '_story_items', true);
                if (is_array($items) && !empty($items)) {
                    $types = array();
                    foreach ($items as $item) {
                        if (isset($item['type'])) {
                            $types[] = $item['type'];
                        }
                    }
                    $types = array_unique($types);
                    echo implode(', ', array_map('ucfirst', $types));
                } else {
                    echo '<span class="wpas-no-items">' . __('No items', 'wp-active-story') . '</span>';
                }
                break;

            case 'story_likes':
                $likes = get_post_meta($post_id, '_story_likes_count', true);
                echo '<span class="wpas-likes-count">' . intval($likes) . '</span>';
                break;

            case 'story_views':
                $views = get_post_meta($post_id, '_story_views', true);
                echo '<span class="wpas-views-count">' . intval($views) . '</span>';
                break;

            case 'story_status':
                $expiry_date = get_post_meta($post_id, '_story_expiry_date', true);
                $current_time = current_time('timestamp');

                if ($expiry_date && $expiry_date < $current_time) {
                    echo '<span class="wpas-status expired">' . __('Expired', 'wp-active-story') . '</span>';
                } else {
                    $status = get_post_status($post_id);
                    $status_labels = array(
                        'publish' => __('Active', 'wp-active-story'),
                        'draft'   => __('Draft', 'wp-active-story'),
                        'pending' => __('Pending', 'wp-active-story'),
                    );

                    $label = isset($status_labels[$status]) ? $status_labels[$status] : $status;
                    echo '<span class="wpas-status ' . esc_attr($status) . '">' . esc_html($label) . '</span>';
                }
                break;
        }
    }

    /**
     * Modify row actions (remove view action)
     */
    public function modify_row_actions($actions, $post)
    {
        if (WPAS_POST_TYPE === $post->post_type) {
            // حذف لینک View
            unset($actions['view']);

            // اضافه کردن لینک پیش‌نمایش
            if ('publish' === $post->post_status) {
                $preview_url = add_query_arg(array(
                    'wpas_preview' => 'true',
                    'story_id'     => $post->ID,
                    'nonce'        => wp_create_nonce('wpas_preview_' . $post->ID)
                ), home_url());

                $actions['preview'] = sprintf(
                    '<a href="%s" target="_blank" rel="noopener noreferrer">%s</a>',
                    esc_url($preview_url),
                    __('Preview', 'wp-active-story')
                );
            }
        }

        return $actions;
    }

    /**
     * Hide view link from admin bar
     */
    public function hide_view_link()
    {
        global $post;

        if (WPAS_POST_TYPE === get_post_type($post)) {
            echo '<style>
                #wp-admin-bar-view { display: none !important; }
                .edit-post-fullscreen-mode-close.has-icon {
                    display: none !important;
                }
            </style>';
        }
    }

    /**
     * Change title placeholder text
     */
    public function change_title_placeholder($title, $post)
    {
        if (WPAS_POST_TYPE === $post->post_type) {
            return __('Enter story title here', 'wp-active-story');
        }
        return $title;
    }

    /**
     * Modify admin query to hide from frontend
     */
    public function modify_admin_query($query)
    {
        if (!is_admin() && $query->is_main_query()) {
            // حذف از جستجو
            if ($query->is_search()) {
                $post_types = $query->get('post_type');
                if (is_array($post_types)) {
                    $key = array_search(WPAS_POST_TYPE, $post_types);
                    if (false !== $key) {
                        unset($post_types[$key]);
                        $query->set('post_type', $post_types);
                    }
                } elseif (WPAS_POST_TYPE === $post_types) {
                    $query->set('post_type', 'post');
                }
            }

            // حذف از صفحات آرشیو
            if ($query->is_archive() && $query->get('post_type') === WPAS_POST_TYPE) {
                $query->set_404();
                status_header(404);
            }
        }
    }

    /**
     * Adding guiding text under featured image in edit post-screen
     */
    public function add_custom_text_below_featured_image($content, $post_id) {
        $custom_text = '<p style="margin-top: 10px; color: #666; font-size: 13px; font-style: italic;">';
        $custom_text .= __('Index image size: 300 × 300 pixels','wp-active-story');
        $custom_text .= '</p>';

        $post_type = get_post_type($post_id);
        if ($post_type === WPAS_POST_TYPE) {
            $content .= $custom_text;
        }

        return $content;
    }

}