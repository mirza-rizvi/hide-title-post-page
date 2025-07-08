# Developer Guide

This document describes the structure of the plugin and the main classes and functions that make it work.

## Plugin Bootstrap

`hide-title-post-page.php` is the main plugin file. It defines constants for the plugin path and URL, loads the main class, and registers the `htpp_run_plugin` function on the `plugins_loaded` hook.

````php
// hide-title-post-page.php
require_once HTPP_PATH . 'includes/class-hide-title-plugin.php';

function htpp_run_plugin() {
    $plugin = new Hide_Title_Plugin();
    $plugin->run();
}
add_action( 'plugins_loaded', 'htpp_run_plugin' );
````

## `Hide_Title_Plugin`

Located in `includes/class-hide-title-plugin.php`, this class orchestrates the plugin by registering the meta box and filtering titles on the front end.

### Key Methods

- `__construct()` – Loads the `Hide_Title_Meta_Box` class.
- `run()` – Hooks the meta box into WordPress and adds a filter to modify the post title output.
- `filter_title( $title, $id = null )` – Checks the post meta and returns an empty string if the title should be hidden.

````php
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
````

## `Hide_Title_Meta_Box`

Defined in `includes/admin/class-meta-box.php`, this class is responsible for rendering and saving the meta box.

### Hooks

- `add_meta_boxes` – Registers the meta box for posts and pages.
- `save_post` – Saves the state of the checkbox to post meta.

### Usage

1. When editing a post or page, the meta box labeled **Hide Title** appears in the sidebar.
2. Checking the box stores a `hide_title` value of `1` in the post's metadata.
3. The `Hide_Title_Plugin::filter_title` method checks this value and removes the title from the front end when set.

## Example Scenario

To hide the title on a specific page:

1. Activate the plugin.
2. Navigate to **Pages > Add New** (or edit an existing page).
3. In the **Hide Title** box, tick the checkbox and publish/update the page.
4. View the page on the front end—the title will no longer be displayed.
