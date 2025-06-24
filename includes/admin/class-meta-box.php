<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Hide_Title_Meta_Box {

    public function register() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_box' ) );
    }

    public function add_meta_boxes() {
        add_meta_box(
            'hide_title_meta_box',
            __( 'Hide Title', 'hide-title-post-page' ),
            array( $this, 'render_meta_box' ),
            array( 'post', 'page' ),
            'side',
            'default'
        );
    }

    public function render_meta_box( $post ) {
        $hide_title = get_post_meta( $post->ID, 'hide_title', true );
        wp_nonce_field( 'hide_title_nonce_action', 'hide_title_nonce' );
        ?>
        <label for="hide_title">
            <input type="checkbox" name="hide_title" id="hide_title" value="1" <?php checked( 1, $hide_title, true ); ?>>
            <?php esc_html_e( 'Hide the title tag on this post or page', 'hide-title-post-page' ); ?>
        </label>
        <?php
    }

    public function save_meta_box( $post_id ) {
        if ( ! isset( $_POST['hide_title_nonce'] ) || ! wp_verify_nonce( $_POST['hide_title_nonce'], 'hide_title_nonce_action' ) ) {
            return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( isset( $_POST['hide_title'] ) ) {
            update_post_meta( $post_id, 'hide_title', 1 );
        } else {
            delete_post_meta( $post_id, 'hide_title' );
        }
    }
}
