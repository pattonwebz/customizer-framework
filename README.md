# PattonWebz Customizer Framework
A starter template for use with the WordPress Theme Customizer.

Primarily this is a clean base class to start with a customizer implementation within a WordPress theme and is still a work in progress.

You need to define all of your own settings, sections, panels and controls in exactly the same way that you would do inside other functions. This class doesn't have helper methods to make adding those any easier than the default WP methods.

Some Features:

* Contains separate methods for adding panels, sections, settings and controls.
* Has an example 'help section' based on Justin Tadlock's TRT-Customizer-Pro Section (can be used as a 'pro' or 'upsell' section). Has these customization options:
  * Title
  * Button with Link
  * Description Text
* Has properties to hold passed default values for settings that can be passed from the theme instantiating the extended class.

## Extending the class

The class is setup in a way that it is intended to be extended to use.

The first step is to create a class which extends the base class and place it somewhere that it (and the base PattonWebz_Customize class file) can accessed. In these examples I assume it is located at `/path/to/theme/inc/` but you could place it elsewhere.

The file at `examples/class-themename-customizer.php` shows an example of an extension class. You should replace 'Themename' in the class definition and 'themename' in the filename with your own prefix:

Require the base class and the theme customizer class files then get an instance of the extended class like so:

``` php
// Register the theme customizer settings.
require_once trailingslashit( get_template_directory() ) . 'inc/customizer/class-pattonwebz-customizer.php';
require_once trailingslashit( get_template_directory() ) . 'inc/class-themename-customizer.php';

// pass in the directory of the customizer package, the uri to it and an array of of setting defaults.
$prefix_customizer_class = new Themename_Customizer( $dir, $uri, $defaults );
```

Follow the instructions contained in the `NOTE:` doc blocks in that file for help with where to add your customizer options.

## Using the `settings_defaults` property

A property is used here to hold an array with your settings to be used as default values in the settings.

# Licence Information
This package is licensed under GNU GPLv2 or later licence.

Help Section contained in the package is based on and inspired by Justin Tadlock's Customizer Upsell Section - https://github.com/justintadlock/trt-customizer-pro - GPLv2 licence.
