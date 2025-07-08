<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main controller for the Hide Title Post Page plugin.
 */
class Hide_Title_Plugin {
    private $meta_box;

    /**
     * Instantiate dependencies.
     */
    public function __construct() {
        require_once HTPP_PATH . 'includes/admin/class-meta-box.php';
        $this->meta_box = new Hide_Title_Meta_Box();
    }

    /**
     * Register hooks for the plugin.
     *
     * @return void
     */
    public function run() {
        $this->meta_box->register();
        add_filter( 'the_title', array( $this, 'filter_title' ), 10, 2 );
    }

    /**
     * Remove the title on the front end when requested.
     *
     * @param string $title The original post title.
     * @param int|null $id  Optional post ID.
     * @return string The filtered title.
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
