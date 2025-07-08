# Hide Title Post Page

This repository contains the source code for the **Hide Title Post Page** WordPress plugin. The plugin allows authors to hide the title on individual posts or pages through a simple meta box in the editor.

- **Version:** 1.1
- **License:** GPLv2 or later

## Features

- Adds a "Hide Title" meta box to post and page edit screens.
- Stores a per‑post setting in post meta when the checkbox is selected.
- Filters the post title on the front end so that the tag is removed when the setting is enabled.

## Installation

1. Download or clone this repository into your site's `wp-content/plugins/` directory.
2. Activate the plugin from the **Plugins** screen in the WordPress admin.
3. Edit a post or page and look for the **Hide Title** meta box in the sidebar.
4. Check the box and save the post to hide its title on the front end.

## Usage Example

```php
// The plugin works automatically after activation.
// When the checkbox in the meta box is selected for a post or page,
// the `<h1>` element (or whatever the theme uses for the title) will be removed
// in the post's single view.
```

For more information about the plugin structure and the available classes and functions, see [docs/developer-guide.md](docs/developer-guide.md).

