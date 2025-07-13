<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main controller for the Hide Title Post Page plugin.
 */
class Hide_Title_Plugin {
    private $meta_box;
    private $title_filter;

    /**
     * Instantiate dependencies.
     */
    public function __construct() {
        require_once HTPP_PATH . 'includes/admin/class-meta-box.php';
        require_once HTPP_PATH . 'includes/class-title-filter.php';
        $this->meta_box    = new Hide_Title_Meta_Box();
        $this->title_filter = new Hide_Title_Filter();
    }

    /**
     * Register hooks for the plugin.
     *
     * @return void
     */
    public function run() {
        $this->meta_box->register();
        $this->title_filter->register();
    }
}
