<?php
/**
 * Plugin Name: Hide Title Post Page
 * Description: Allows authors to hide the title tag on single pages and posts via the edit post screen.
 * Version: 1.0
 * Author: Mirza Rizvi Amin
 */

// Add a checkbox to the edit post screen for hiding the title tag
function hide_title_meta_box() {
    add_meta_box(
        'hide_title_meta_box',
        'Hide Title',
        'hide_title_meta_box_callback',
        'post',
        'side',
        'default'
    );
    add_meta_box(
        'hide_title_meta_box',
        'Hide Title',
        'hide_title_meta_box_callback',
        'page',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'hide_title_meta_box');

// Display the checkbox in the meta box
function hide_title_meta_box_callback($post) {
    $hide_title = get_post_meta($post->ID, 'hide_title', true);
    ?>
    <label for="hide_title">
        <input type="checkbox" name="hide_title" id="hide_title" value="1" <?php checked(1, $hide_title, true); ?>>
        Hide the title tag on this post or page
    </label>
    <?php
}

// Save the checkbox value when the post or page is saved
function save_hide_title_meta_box($post_id) {
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
add_action('save_post', 'save_hide_title_meta_box');

// Remove the title tag if it is hidden
function hide_title($title, $id = null) {
    if (is_single() || is_page()) {
        $hide_title = get_post_meta(get_the_ID(), 'hide_title', true);
        if ($hide_title) {
            return '';
        }
    }
    return $title;
}
add_filter('the_title', 'hide_title', 10, 2);
