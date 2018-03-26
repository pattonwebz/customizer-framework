# PattonWebz Customizer Framework
A starter template for use with the WordPress Theme Customizer. At the current time it is more of a template and somewhat of a WIP. In it's present state it is probably better to modify the class directly for your own use than to extend it.

Primarily this is a clean base class to start with a customizer implementation within a WordPress theme. It is built so it can either be modified directly or extended by a theme.

You need to define all of your own settings, sections, panels and controls in exactly the same way that you would do inside other functions. This class doesn't have helper methods to make adding those any easier than the default WP methods.

Some Features:

* Contains separate methods for adding panels, sections, settings and controls.
* Has an example 'help section' (based on Justin Tadlock's Customizer Upsell Section so be used as an 'upsell section'). Has a Title, a button with link and a description text location. It also has a slide animation that fits with customizer styles.
* Has a method with filter for holding default values for use with settings.

Limitations:

* At the current time the package must be inside `/path/to/theme/inc/customizer/` directory.

## Extending the class

The class is setup in a way that it can easily be extended.

The first step is to create a class which extends the base class and place it somewhere that it can easily be accessed and access the package base class files. in these examples I assume it is located at `/path/to/theme/inc/` but you could place it elsewhere.

The 'class-themename-customizer.php' file shows an example of doing that. The class definition looks like this:

```php
<?php
final class Themename_Customizer extends PattonWebz_Customizer {

}
```
Require the base class and the theme customizer class like so:

``` php
// Register the theme customizer settings.
require_once trailingslashit( get_template_directory() ) . 'inc/customizer/class-pattonwebz-customizer.php';
require_once trailingslashit( get_template_directory() ) . 'inc/class-themename-customizer.php';

$prefix_customizer_class = Themename_Customizer::get_instance();
```

Follow the instructions contained in the `NOTE:` docblocks in that file for help with setup.

## Modifying the class directly

Include the base class file and instantiate the class. You can do this inside your theme setup function or functions.php file.

```php
// require the main customizer class file.
require_once wp_add_trailing_slash( get_template_directory() ) . 'inc/customizer/class-pattonwebz-customizer.php';
// get an instance of the class to instantiate it.
$prefix_customizer_class = PattonWebz_Customizer::get_instance();
```

Add your sections, panels, controls and settings to the appropriate methods where the comments indicate. You should also make sure any text-domains are updated to match your theme slug.

You can optionally update the name of the main class to match your theme.

## Using the settings_defaults() method

A method that returns an array through a filter is present in the class. It can be used as a helper function to use within your settings to hold all the default values in one place. It is a static method and can be called without the class being instantiated.

The filter is named `pattonwebz_customize_filter_setting_defaults`. Add default values to it as a $key => $value pair.

# Licence Information
This package is licensed under GNU GPLv3 or later licence.

Help Section contained in the package is based on and inspired by Justin Tadlock's Customizer Upsell Section.
