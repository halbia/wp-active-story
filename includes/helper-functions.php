<?php

defined( 'ABSPATH' ) || exit;

class WP_Active_Helper{

    public static function get_svg_content($path, $echo = false)
    {
        if (empty($path)) {
            return;
        }

        if (!$echo) {
            return file_get_contents($path);
        }

        echo file_get_contents($path);
    }

}