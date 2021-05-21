# WPFile

2 Utility classes to get file urls and paths, with versioning

# Installation

```
composer require jesspinkman/wpfile
```

# Use

three main functions:

```
getUrl()
getPath()
getVersion() // file modification time

```

## For themes

No need to set the root folder of your theme, use it right away:


```php
use WPFile\ThemeFile;

// load a js script
add_action('wp_enqueue_scripts', 'load_script');

function load_script() {
  $file = new ThemeFile('assets/js/my-script.js');
  \wp_register_script(
      'my-script',          // script handle name
      $file->getURL(),      // file url (eg: https://my-website.com/.../.../my-theme/assets/js/my-scripts.js)
      [],                   // empty dependencies 
      $file->getVersion()   // file modification timestamp (eg: 1621496690)
  );
  // generated url https://my-website.com/.../.../my-plugin/assets/js/my-scripts.js?ver=1621496690
}
```

## For Plugins

in your plugin root file, set the root path

```php

<?php

/**
 *plugin name: your-plugin
 * ...
 */

use WPFile\PluginFile;

require __DIR__ . '/vendor/autoload.php';

PluginFile::setRoot(__FILE__); // or set another root folder
```

then anywhere in your plugin:

```php

use WPFile\PluginFile;

// load a js script
add_action('wp_enqueue_scripts', 'load_script');

function load_script() {
  $file = new WPFile('assets/js/my-script.js');
  \wp_register_script(
      'my-script',          // script handle name
      $file->getURL(),      // file url (eg: https://my-website.com/.../.../my-plugin/assets/js/my-scripts.js)
      [],                   // empty dependencies 
      $file->getVersion()   // file modification timestamp (eg: 1621496690)
  );
  // generated url https://my-website.com/.../.../my-plugin/assets/js/my-scripts.js?ver=1621496690
}


// load a specific php template if page is product archive page
add_filter('template_include', 'hook_template');

function hook_template(string $template) {
    if (\is_post_type_archive('products')) {
    $template = new PluginFile('templates/products/archive.php');
        return $template->getPath(); //file path (example: /var/www/html/.../.../my-plugin/templates/products/archive.php)
    } else {
        return $template;
    }
}

```



