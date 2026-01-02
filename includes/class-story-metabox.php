<?php
defined('ABSPATH') || exit;

class Wp_Active_Story_Metabox{

    private static $instance = null;

    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {

        add_action('add_meta_boxes', array($this, 'add_metaboxes'));
        add_action('save_post_wp_active_story', array($this, 'save_metaboxes'), 10, 2);
        add_action('wp_ajax_wpas_search_related_posts', array($this, 'ajax_search_related_posts'));
    }


    public function add_metaboxes()
    {
        // Main Story Settings
        add_meta_box(
            'wpas_story_settings',
            __('Story Settings', 'wp-active-story'),
            array($this, 'render_story_settings_metabox'),
            'wp_active_story',
            'normal',
            'high'
        );

        // Story Items (Repeatable)
        add_meta_box(
            'wpas_story_items',
            __('Story Items', 'wp-active-story'),
            array($this, 'render_story_items_metabox'),
            'wp_active_story',
            'normal',
            'high'
        );

        // Related Posts
        add_meta_box(
            'wpas_related_posts',
            __('Related Posts', 'wp-active-story'),
            array($this, 'render_related_posts_metabox'),
            'wp_active_story',
            'side',
            'default'
        );

        // User Access Control
        add_meta_box(
            'wpas_user_access',
            __('Access Control', 'wp-active-story'),
            array($this, 'render_user_access_metabox'),
            'wp_active_story',
            'side',
            'default'
        );
    }

    public function render_story_settings_metabox($post)
    {
        wp_nonce_field('wpas_story_settings_nonce', 'wpas_story_settings_nonce');

        // Get existing values
        $short_title = get_post_meta($post->ID, '_story_short_title', true);
        $enable_likes = get_post_meta($post->ID, '_story_enable_likes', true);
        if (empty($enable_likes)) {
            $enable_likes = 'default';
        }

        $visibility = get_post_meta($post->ID, '_story_visibility', true);
        if (empty($visibility)) {
            $visibility = 'all';
        }

        ?>
        <div class="wpas-metabox-container">
            <!-- Short Title -->
            <div class="wpas-field-group">
                <label for="wpas_short_title">
                    <strong><?php _e('Short Title (for bottom of story)', 'wp-active-story'); ?></strong>
                </label>
                <input type="text"
                       id="wpas_short_title"
                       name="wpas_short_title"
                       value="<?php echo esc_attr($short_title); ?>"
                       class="widefat"
                       placeholder="<?php esc_attr_e('Enter short title to display below story', 'wp-active-story'); ?>">
                <p class="description">
                    <?php _e('This title will be displayed at the bottom of the story', 'wp-active-story'); ?>
                </p>
            </div>

            <!-- Enable Likes -->
            <div class="wpas-field-group">
                <label for="wpas_enable_likes">
                    <strong><?php _e('Enable Likes for this story?', 'wp-active-story'); ?></strong>
                </label>
                <select id="wpas_enable_likes" name="wpas_enable_likes" class="widefat">
                    <option value="default" <?php selected($enable_likes, 'default'); ?>>
                        <?php _e('Default (from settings)', 'wp-active-story'); ?>
                    </option>
                    <option value="yes" <?php selected($enable_likes, 'yes'); ?>>
                        <?php _e('Yes', 'wp-active-story'); ?>
                    </option>
                    <option value="no" <?php selected($enable_likes, 'no'); ?>>
                        <?php _e('No', 'wp-active-story'); ?>
                    </option>
                </select>
                <p class="description">
                    <?php _e('Override global like settings for this story', 'wp-active-story'); ?>
                </p>
            </div>

            <!-- Visibility -->
            <div class="wpas-field-group">
                <label for="wpas_visibility">
                    <strong><?php _e('Who can see this story?', 'wp-active-story'); ?></strong>
                </label>
                <select id="wpas_visibility" name="wpas_visibility" class="widefat">
                    <option value="all" <?php selected($visibility, 'all'); ?>>
                        <?php _e('All Users and Visitors', 'wp-active-story'); ?>
                    </option>
                    <option value="logged_in" <?php selected($visibility, 'logged_in'); ?>>
                        <?php _e('Logged-in Users Only', 'wp-active-story'); ?>
                    </option>
                    <option value="users_only" <?php selected($visibility, 'users_only'); ?>>
                        <?php _e('Registered Users Only', 'wp-active-story'); ?>
                    </option>
                </select>
                <p class="description">
                    <?php _e('Control who can view this story', 'wp-active-story'); ?>
                </p>
            </div>
        </div>
        <?php
    }

    public function render_story_items_metabox($post)
    {
        $story_items = get_post_meta($post->ID, '_story_items', true);
        $story_items = is_array($story_items) ? $story_items : array();

        // اگر آیتمی وجود ندارد، یک آیتم خالی نمایش دهید
        if (empty($story_items)) {
            $story_items[] = array(
                'type'      => 'image',
                'media_id'  => '',
                'media_url' => '',
                'title'     => '',
                'duration'  => 5 // 5 seconds default
            );
        }

        ?>
        <div class="wpas-story-items-container" id="wpas-story-items-container">
            <?php foreach ($story_items as $index => $item): ?>
                <?php $this->render_story_item_template($index, $item); ?>
            <?php endforeach; ?>
        </div>

        <!-- Add New Item Button -->
        <div class="wpas-add-item-container">
            <button type="button"
                    class="button button-primary wpas-add-item"
                    data-template="<?php echo esc_attr(count($story_items)); ?>">
                <?php WP_Active_Helper::get_svg_content(WPAS_PLUGIN_IMAGE_PATH . 'icons/add.svg', true) ?>
                <?php _e('Add New Item', 'wp-active-story'); ?>
            </button>
        </div>

        <!-- Hidden Template for new items -->
        <div id="wpas-story-item-template" style="display: none;">
            <?php $this->render_story_item_template('__INDEX__', array(
                'type'      => 'image',
                'media_id'  => '',
                'media_url' => '',
                'title'     => '',
                'duration'  => 5 // 5 seconds default
            )); ?>
        </div>
        <?php
    }

    private function render_story_item_template($index, $item)
    {
        $item = wp_parse_args($item, array(
            'type'      => 'image',
            'media_id'  => '',
            'media_url' => '',
            'title'     => '',
            'duration'  => 5, // seconds
            'link'      => '',
            'link_text' => ''
        ));

        $has_media = !empty($item['media_url']);
        ?>
        <div class="wpas-story-item" data-index="<?php echo esc_attr($index); ?>">
            <div class="wpas-item-header">
                <div class="wpas-item-controls">
                    <!-- Drag Handle -->
                    <span class="wpas-drag-handle" title="<?php esc_attr_e('Drag to reorder', 'wp-active-story'); ?>">
                        <?php WP_Active_Helper::get_svg_content(WPAS_PLUGIN_IMAGE_PATH . 'icons/drag.svg', true) ?>
                    </span>

                    <!-- Item Title -->
                    <input type="text"
                           class="wpas-item-title-input"
                           name="wpas_story_items[<?php echo esc_attr($index); ?>][title]"
                           value="<?php echo esc_attr($item['title']); ?>"
                           placeholder="<?php esc_attr_e('Item Title', 'wp-active-story'); ?>">
                </div>

                <div class="wpas-item-actions">
                    <!-- Collapse/Expand Button -->
                    <button type="button" class="button wpas-toggle-collapse"
                            title="<?php esc_attr_e('Collapse/Expand', 'wp-active-story'); ?>">
                        <?php WP_Active_Helper::get_svg_content(WPAS_PLUGIN_IMAGE_PATH . 'icons/arrow-up.svg', true) ?>
                    </button>

                    <!-- Duplicate Button -->
                    <button type="button" class="button wpas-duplicate-item"
                            title="<?php esc_attr_e('Duplicate', 'wp-active-story'); ?>">
                        <?php WP_Active_Helper::get_svg_content(WPAS_PLUGIN_IMAGE_PATH . 'icons/copy.svg', true) ?>
                    </button>

                    <!-- Delete Button -->
                    <button type="button" class="button wpas-delete-item"
                            title="<?php esc_attr_e('Delete', 'wp-active-story'); ?>">
                        <?php WP_Active_Helper::get_svg_content(WPAS_PLUGIN_IMAGE_PATH . 'icons/close.svg', true) ?>
                    </button>
                </div>
            </div>

            <div class="wpas-item-content">
                <!-- Media Selection -->
                <div class="wpas-media-selector">
                    <!-- Type and Duration in same row -->
                    <div class="wpas-type-duration-row">
                        <!-- Type Selection -->
                        <div class="wpas-field-group">
                            <label><?php _e('Item Type:', 'wp-active-story'); ?></label>
                            <select name="wpas_story_items[<?php echo esc_attr($index); ?>][type]"
                                    class="wpas-item-type">
                                <option value="image" <?php selected($item['type'], 'image'); ?>>
                                    <?php _e('Image', 'wp-active-story'); ?>
                                </option>
                                <option value="video" <?php selected($item['type'], 'video'); ?>>
                                    <?php _e('Video', 'wp-active-story'); ?>
                                </option>
                            </select>
                        </div>

                        <!-- Duration (in seconds) -->
                        <div class="wpas-field-group">
                            <label for="wpas_duration_<?php echo esc_attr($index); ?>">
                                <?php _e('Duration (seconds):', 'wp-active-story'); ?>
                            </label>
                            <input type="number"
                                   id="wpas_duration_<?php echo esc_attr($index); ?>"
                                   name="wpas_story_items[<?php echo esc_attr($index); ?>][duration]"
                                   value="<?php echo esc_attr($item['duration']); ?>"
                                   min="1"
                                   max="30"
                                   step="1"
                                   class="wpas-duration-input">
                            <span class="wpas-duration-display">
                        </span>
                        </div>
                    </div>

                    <!-- Media Upload -->
                    <div class="wpas-media-upload">
                        <div class="wpas-media-preview <?php echo $has_media ? 'has-media' : ''; ?>">
                            <?php if ($item['type'] === 'image'): ?>
                                <img src="<?php echo esc_url($item['media_url']); ?>"
                                     alt="<?php echo esc_attr($item['title']); ?>">
                            <?php else: ?>
                                <video controls>
                                    <source src="<?php echo esc_url($item['media_url']); ?>" type="video/mp4">
                                </video>
                            <?php endif; ?>
                            <div class="wpas-media-placeholder">
                                <?php WP_Active_Helper::get_svg_content(WPAS_PLUGIN_IMAGE_PATH . 'icons/add.svg', true) ?>
                                <span class="wpas-media-text">
                                    <?php echo $item['type'] === 'image' ? __('Add Image', 'wp-active-story') : __('Add Video', 'wp-active-story'); ?>
                                </span>
                            </div>
                        </div>

                        <input type="hidden"
                               class="wpas-media-id"
                               name="wpas_story_items[<?php echo esc_attr($index); ?>][media_id]"
                               value="<?php echo esc_attr($item['media_id']); ?>">
                        <input type="hidden"
                               class="wpas-media-url"
                               name="wpas_story_items[<?php echo esc_attr($index); ?>][media_url]"
                               value="<?php echo esc_url($item['media_url']); ?>">

                        <button type="button" class="button wpas-select-media">
                            <?php echo $has_media ? __('Change Media', 'wp-active-story') : __('Select Media', 'wp-active-story'); ?>
                        </button>
                    </div>

                    <!-- Link (Optional) -->
                    <div class="wpas-field-group">
                        <label><?php _e('Link URL (optional):', 'wp-active-story'); ?></label>
                        <input type="url"
                               name="wpas_story_items[<?php echo esc_attr($index); ?>][link]"
                               value="<?php echo esc_url($item['link']); ?>"
                               class="widefat"
                               placeholder="https://example.com">
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function render_related_posts_metabox($post)
    {
        $related_posts = get_post_meta($post->ID, '_story_related_posts', true);
        $related_posts = is_array($related_posts) ? $related_posts : array();

        ?>
        <div class="wpas-metabox-container wpas-related-posts-container">
            <p class="description">
                <?php _e('Select posts, products, or projects to attach to this story', 'wp-active-story'); ?>
            </p>

            <!-- Ajax Search -->
            <div class="wpas-related-posts-search">
                <input type="text"
                       class="wpas-search-input widefat"
                       placeholder="<?php esc_attr_e('Search posts...', 'wp-active-story'); ?>">
            </div>

            <!-- Search Results -->
            <div class="wpas-search-results">
                <div class="wpas-search-results-inner"></div>
            </div>

            <!-- Current Related Posts -->
            <div class="wpas-related-posts-list" id="wpas-related-posts-list">
                <?php foreach ($related_posts as $post_id):
                    $related_post = get_post($post_id);
                    if (!$related_post)
                        continue;
                    $post_type_obj = get_post_type_object($related_post->post_type);
                    ?>
                    <div class="wpas-related-post-item" data-post-id="<?php echo esc_attr($post_id); ?>">
                        <input type="hidden"
                               name="wpas_related_posts[]"
                               value="<?php echo esc_attr($post_id); ?>">

                        <div class="wpas-related-post-content">
                            <strong><?php echo esc_html(get_the_title($post_id)); ?></strong>
                            <span class="wpas-post-type">(<?php echo $post_type_obj ? esc_html($post_type_obj->labels->singular_name) : ''; ?>)</span>
                        </div>

                        <button type="button" class="button-link wpas-remove-related-post">
                            <span class="dashicons dashicons-no-alt"></span>
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }

    public function ajax_search_related_posts()
    {
        check_ajax_referer('wpas_metabox_nonce', 'nonce');

        $search = sanitize_text_field($_POST['search'] ?? '');
        $results = array();

        if (empty($search)) {
            wp_send_json_error('Search term is empty');
        }

        // Get all public post types except our story type
        $post_types = get_post_types(array('public' => true), 'objects');
        unset($post_types['wp_active_story']);

        $args = array(
            's'              => $search,
            'post_type'      => array_keys($post_types),
            'posts_per_page' => 10,
            'post_status'    => 'publish'
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $post_type_obj = get_post_type_object(get_post_type());

                $results[] = array(
                    'id'         => get_the_ID(),
                    'title'      => get_the_title(),
                    'type'       => get_post_type(),
                    'type_label' => $post_type_obj ? $post_type_obj->labels->singular_name : get_post_type()
                );
            }
            wp_reset_postdata();
        }

        wp_send_json_success($results);
    }

    public function render_user_access_metabox($post)
    {
        $allowed_roles = get_post_meta($post->ID, '_story_allowed_roles', true);
        $allowed_roles = is_array($allowed_roles) ? $allowed_roles : array();

        // Get all WordPress roles
        $wp_roles = wp_roles()->roles;

        ?>
        <div class="wpas-metabox-container">
            <p class="description">
                <?php _e('Select user roles that can view this story', 'wp-active-story'); ?>
            </p>

            <div class="wpas-roles-list">
                <?php foreach ($wp_roles as $role_id => $role_info):
                    $checked = in_array($role_id, $allowed_roles) ? 'checked' : '';
                    ?>
                    <div class="wpas-role-item">
                        <label>
                            <input type="checkbox"
                                   name="wpas_allowed_roles[]"
                                   value="<?php echo esc_attr($role_id); ?>"
                                <?php echo $checked; ?>>
                            <?php echo esc_html($role_info['name']); ?>
                        </label>
                    </div>
                <?php endforeach; ?>

                <!-- Always include administrator -->
                <input type="hidden" name="wpas_allowed_roles[]" value="administrator">

                <!-- Visitors checkbox -->
                <div class="wpas-role-item">
                    <label>
                        <input type="checkbox"
                               name="wpas_allowed_visitors"
                               value="1"
                            <?php checked(get_post_meta($post->ID, '_story_allow_visitors', true), '1'); ?>>
                        <?php _e('Allow Visitors (non-logged in users)', 'wp-active-story'); ?>
                    </label>
                </div>
            </div>
        </div>
        <?php
    }

    public function save_metaboxes($post_id, $post)
    {
        // Check nonce
        if (!isset($_POST['wpas_story_settings_nonce']) ||
            !wp_verify_nonce($_POST['wpas_story_settings_nonce'], 'wpas_story_settings_nonce')) {
            return;
        }

        // Check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check permissions
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Save Short Title
        if (isset($_POST['wpas_short_title'])) {
            update_post_meta($post_id, '_story_short_title', sanitize_text_field($_POST['wpas_short_title']));
        }

        // Save Enable Likes
        if (isset($_POST['wpas_enable_likes'])) {
            update_post_meta($post_id, '_story_enable_likes', sanitize_text_field($_POST['wpas_enable_likes']));
        }

        // Save Visibility
        if (isset($_POST['wpas_visibility'])) {
            update_post_meta($post_id, '_story_visibility', sanitize_text_field($_POST['wpas_visibility']));
        }

        // Save Story Items
        if (isset($_POST['wpas_story_items']) && is_array($_POST['wpas_story_items'])) {
            $story_items = array();
            $item_index = 0;

            foreach ($_POST['wpas_story_items'] as $item_data) {
                // Skip empty items
                if (empty($item_data['media_url'])) {
                    continue;
                }

                $duration_seconds = floatval($item_data['duration']);

                $story_items[$item_index] = array(
                    'type'      => sanitize_text_field($item_data['type']),
                    'media_id'  => intval($item_data['media_id']),
                    'media_url' => esc_url_raw($item_data['media_url']),
                    'title'     => sanitize_text_field($item_data['title']),
                    'duration'  => $duration_seconds,
                    'link'      => esc_url_raw($item_data['link']),
                    'order'     => $item_index
                );

                $item_index++;
            }

            update_post_meta($post_id, '_story_items', $story_items);
        } else {
            delete_post_meta($post_id, '_story_items');
        }


        // Save Related Posts
        if (isset($_POST['wpas_related_posts']) && is_array($_POST['wpas_related_posts'])) {
            $related_posts = array_map('intval', $_POST['wpas_related_posts']);
            update_post_meta($post_id, '_story_related_posts', $related_posts);
        } else {
            delete_post_meta($post_id, '_story_related_posts');
        }


        // Save Allowed Roles
        if (isset($_POST['wpas_allowed_roles']) && is_array($_POST['wpas_allowed_roles'])) {
            $allowed_roles = array_map('sanitize_text_field', $_POST['wpas_allowed_roles']);

            // Always include administrator
            if (!in_array('administrator', $allowed_roles)) {
                $allowed_roles[] = 'administrator';
            }

            update_post_meta($post_id, '_story_allowed_roles', $allowed_roles);
        } else {
            // Default to all roles
            $all_roles = array_keys(wp_roles()->roles);
            update_post_meta($post_id, '_story_allowed_roles', $all_roles);
        }


        // Save Visitors Access
        $allow_visitors = isset($_POST['wpas_allowed_visitors']) ? '1' : '0';
        update_post_meta($post_id, '_story_allow_visitors', $allow_visitors);


        // Save Story duration
        $total_duration = 0;
        foreach ($story_items as $item) {
            $duration_seconds = isset($item['duration']) ? floatval($item['duration']) : 5;
            $total_duration += $duration_seconds;
        }
        update_post_meta($post_id, '_story_total_duration', $total_duration);

    }
}
