<?php
/**
 * Plugin Name: Hide Title Post Page
 * Description: Allows authors to hide the title tag on single pages and posts via the edit post screen.
 * Version: 1.0
 * Author: Mirza Rizvi Amin
 */

class Hide_Title_Plugin {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_hide_title_meta_box'));
        add_filter('the_title', array($this, 'hide_title'), 10, 2);
    }

    public function add_meta_boxes() {
        add_meta_box(
            'hide_title_meta_box',
            'Hide Title',
            array($this, 'hide_title_meta_box_callback'),
            'post',
            'side',
            'default'
        );
        add_meta_box(
            'hide_title_meta_box',
            'Hide Title',
            array($this, 'hide_title_meta_box_callback'),
            'page',
            'side',
            'default'
        );
    }

    public function hide_title_meta_box_callback($post) {
        $hide_title = get_post_meta($post->ID, 'hide_title', true);
        ?>
        <label for="hide_title">
            <input type="checkbox" name="hide_title" id="hide_title" value="1" <?php checked(1, $hide_title, true); ?>>
            Hide the title tag on this post or page
        </label>
        <?php
    }

    public function save_hide_title_meta_box($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        if (isset($_POST['hide_title'])) {
            update_post_meta($post_id, 'hide_title', 1);
        } else {
            delete_post_meta($post_id, 'hide_title');
        }
    }

    public function hide_title($title, $id = null) {
        if (is_single() || is_page()) {
            $hide_title = get_post_meta(get_the_ID(), 'hide_title', true);
            if ($hide_title) {
                return '';
            }
        }
        return $title;
    }
}

$hide_title_plugin = new Hide_Title_Plugin();
