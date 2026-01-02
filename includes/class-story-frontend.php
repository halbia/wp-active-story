<?php
defined('ABSPATH') || exit;

class WP_Active_Story_Frontend{

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
        // Register shortcode
        add_shortcode('wp_active_story', array($this, 'stories_shortcode'));
    }

    /**
     * Shortcode handler
     */
    public function stories_shortcode($atts)
    {
        $atts = shortcode_atts(array(
            'limit'      => 10,
            'category'   => '',
            'author'     => '',
        ), $atts, 'wp_active_story');

        $args = array(
            'post_type'      => WPAS_POST_TYPE,
            'post_status'    => 'publish',
            'posts_per_page' => intval($atts['limit'])
        );

        if (!empty($atts['category'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'story_category',
                    'field'    => 'slug',
                    'terms'    => explode(',', $atts['category'])
                )
            );
        }

        if (!empty($atts['author'])) {
            $args['author'] = intval($atts['author']);
        }

        $stories = $this->get_active_stories($args);

        if (empty($stories)) {
            return '<p class="wpas-no-stories">' . __('No active stories found.', 'wp-active-story') . '</p>';
        }

        ob_start();
        ?>
        <div class="wpas-stories-container">
            <div class="wpas-stories-slider">
                <?php foreach ($stories as $story): ?>
                    <div class="wpas-story-circle"
                         data-story-id="<?php echo esc_attr($story['id']); ?>"
                         data-items='<?php echo json_encode($story['items']); ?>'
                         data-author="<?php echo esc_attr($story['author']); ?>"
                         data-avatar="<?php echo esc_url($story['author_avatar']); ?>">
                        <img src="<?php echo esc_url($story['thumbnail']); ?>"
                             alt="<?php echo esc_attr($story['title']); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Story Popup -->
        <div class="wpas-story-popup" id="wpas-story-popup">
            <div class="wpas-popup-overlay"></div>
            <div class="wpas-popup-content">
                <div class="wpas-popup-header">
                    <div class="wpas-popup-user">
                        <img src="" alt="" class="wpas-popup-avatar">
                        <span class="wpas-popup-username"></span>
                    </div>
                    <button class="wpas-popup-close">×</button>
                </div>

                <div class="wpas-popup-media">
                    <!-- Media will be loaded here -->
                </div>

                <div class="wpas-popup-navigation">
                    <button class="wpas-popup-prev">‹</button>
                    <button class="wpas-popup-next">›</button>
                </div>

                <div class="wpas-popup-progress">
                    <!-- Progress bars will be added here -->
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Get active stories
     */
    public function get_active_stories($args = array())
    {
        $defaults = array(
            'post_type'      => WPAS_POST_TYPE,
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        );

        $args = wp_parse_args($args, $defaults);
        $query = new WP_Query($args);

        $stories = array();

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $story_id = get_the_ID();

                $stories[] = array(
                    'id'             => $story_id,
                    'title'          => get_the_title(),
                    'thumbnail'      => get_the_post_thumbnail_url($story_id, 'thumbnail') ?: WPAS_PLUGIN_URL . 'assets/images/default-story.jpg',
                    'items'          => get_post_meta($story_id, '_story_items', true) ?: array(),
                    'author'         => get_the_author_meta('display_name'),
                    'author_avatar'  => get_avatar_url(get_the_author_meta('ID'), array('size' => 40))
                );
            }
            wp_reset_postdata();
        }

        return $stories;
    }
}