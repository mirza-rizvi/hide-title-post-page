<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Handles filtering of the post title on the front end.
 */
class Hide_Title_Filter {

    /**
     * Register the title filter with WordPress.
     *
     * @return void
     */
    public function register() {
        add_filter( 'the_title', array( $this, 'filter_title' ), 10, 2 );
    }

    /**
     * Remove the title when requested by post meta.
     *
     * @param string   $title The original post title.
     * @param int|null $id    Optional post ID.
     * @return string Filtered title.
     */
    public function filter_title( $title, $id = null ) {
        if ( is_admin() ) {
            return $title;
        }

        $post_id = $id ? $id : get_the_ID();

        if ( is_singular() ) {
            $hide = get_post_meta( $post_id, 'hide_title', true );
            if ( $hide ) {
                return '';
            }
        }

        return $title;
    }
}
