# PattonWebz Customizer Framework
A starter template for use with the WordPress Theme Customizer.

Primarily this is a clean base class to start with a customizer implementation within a WordPress theme and is still a work in progress.

In it's present state it is probably better to modify the class directly for your own use than to extend it.

Some Features:

* Contains separate methods for adding panels, sections, settings and controls.
* Has an example 'help section' based on Justin Tadlock's TRT-Customizer-Pro Section (can be used as a 'pro' or 'upsell' section). Has these customization options:
  * Title
  * Button with Link
  * Description Text
* Shows example of a static method, with a filter, for holding default values for use with settings inside and outside of the customizer class.

Limitations:

* At the current time the package must be inside `/path/to/theme/inc/customizer/` directory. This is due to a hardcoded include uri for stylesheets and scripts. TODO: Fix this to be dynamic.

## Extending the class

The class is setup in a way that it can easily be extended.

The first step is to create a class which extends the base class and place it somewhere that it (and the base PattonWebz_Customize class file) can accessed. In these examples I assume it is located at `/path/to/theme/inc/` but you could place it elsewhere.

The file at `examples/class-themename-customizer.php` shows an example of an extension class. You should replace 'Themename' in the class definition and 'themename' in the filename with your own prefix:

Require the base class and the theme customizer class files then get an instance of the extended class like so:

``` php
// Register the theme customizer settings.
require_once trailingslashit( get_template_directory() ) . 'inc/customizer/class-pattonwebz-customizer.php';
require_once trailingslashit( get_template_directory() ) . 'inc/class-themename-customizer.php';

$prefix_customizer_class = new Themename_Customizer();
```

Follow the instructions contained in the `NOTE:` docblocks in that file for help with where to add your customizer options.

## Modifying the class directly

Include the base class file and instantiate the class. You can do this inside your theme setup function or functions.php file.

```php
// require the main customizer class file.
require_once wp_add_trailing_slash( get_template_directory() ) . 'inc/customizer/class-pattonwebz-customizer.php';
// get an instance of the class to instantiate it.
$prefix_customizer_class = new PattonWebz_Customizer();
```

Add your sections, panels, controls and settings to the appropriate methods where the comments indicate. You should also make sure any text-domains are updated to match your theme slug.

You can optionally update the name of the main class to match your theme.

## Using the settings_defaults() method

A method that returns an array through a filter is present in the class. It can be used as a helper function to use within your settings to hold all the default values in one place. It is a static method and can be called without the class being instantiated.

When extending the base class it is best to completely override this method and use it's code as a base template for your own method.

The filter in the base class is named `pattonwebz_customize_filter_setting_defaults`. You can add default values to it as a `$key => $value` pair.

```php
function prefix_settings_defaults( $defaults = array() ) {

	// some settings to add to the array.
	$add_to_defaults = array(
		'a_new_setting'       => 'default-setting-value',
		'an_existing_setting' => 'update-existing-default-value',
	);

	// merge our additional array to the existing default array.
	$defaults = array_merge( $defaults, $add_to_defaults );

	// example of creating or updating a single existing setting default value.
	$defaults['an_existing_setting'] = 'another-updated-value';

	return $defaults;
}
add_filter( 'pattonwebz_customize_filter_setting_defaults', 'prefix_settings_defaults' );
```

# Licence Information
This package is licensed under GNU GPLv2 or later licence.

Help Section contained in the package is based on and inspired by Justin Tadlock's Customizer Upsell Section - https://github.com/justintadlock/trt-customizer-pro - GPLv2 licence.
