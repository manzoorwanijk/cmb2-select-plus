# CMB2 Field Type: select_plus

## Description

`select_plus` field type for [CMB2](https://github.com/CMB2/CMB2 "Custom Metaboxes and Fields for WordPress 2").

This plugin gives you an additional field type in CMB2: `select_plus`

The field acts much like the default `select` field. However, it adds the support for `optgroup` and saving of values with `multiple` attribute.

## Installation

You can install this field type as you would a WordPress plugin:

1. Download the plugin
2. Place the plugin folder in your `/wp-content/plugins/` directory
3. Activate the plugin in the Plugin dashboard

Alternatively, you can include this field type within your plugin/theme.

## Usage

#### Normal Select Field
```php
// Select Field without optgroup
$cmb->add_field( array(
	'name'		=> 'Normal Select',
	'id'		=> $prefix . 'normal_select',
	'type'		=> 'select_plus',
	'options'	=> array(
		'standard' => 'Option One',
		'custom'   => 'Option Two',
		'none'     => 'Option Three',
	),
) );
```
![Image](screenshot-1.jpg?raw=true)


#### Select Field with optgroup
```php
$cmb->add_field( array(
	'name'		=> 'Select+',
	'desc'		=> 'field description (optional)',
	'id'		=> $prefix . 'smart_select',
	'type'		=> 'select_plus',
	'options'	=> array(
		'Basic'	=> array( // optgroup
			1	=> 'Option One',
			2	=> 'Option Two',
			3	=> 'Option Three',
		),
		'Advanced'	=> array( // optgroup
			4	=> 'Option Four',
			5	=> 'Option Five',
			6	=> 'Option Six',
		),
	),
) );
```
![Image](screenshot-2.jpg?raw=true)

### `multiple` attribute

You can use the `multiple` attribute and the field value will be saved as array
```php
// Select Field without optgroup and with multiple attribute
$cmb->add_field( array(
	'name'		=> 'Normal Select',
	'id'		=> $prefix . 'normal_select_multi',
	'type'		=> 'select_plus',
	'options'	=> array(
		'standard' => 'Option One',
		'custom'   => 'Option Two',
		'none'     => 'Option Three',
	),
	'attributes'	=> array(
		'multiple'	=> 'multiple',
	),
) );
```

```php
// Select Field with optgroup and multiple attribute
$cmb->add_field( array(
	'name'		=> 'Select+',
	'desc'		=> 'field description (optional)',
	'id'		=> $prefix . 'smart_select_multi',
	'type'		=> 'select_plus',
	'options'	=> array(
		'Basic'	=> array( // optgroup
			1	=> 'Option One',
			2	=> 'Option Two',
			3	=> 'Option Three',
		),
		'Advanced'	=> array( // optgroup
			4	=> 'Option Four',
			5	=> 'Option Five',
			6	=> 'Option Six',
		),
	),
	'attributes'	=> array(
		'multiple'	=> 'multiple',
	),
) );
```

## Why `Select_Plus_CMB2_Types` class?
- This enables you to use it flexibly in case you need to just render the field, not the whole row.
- It allows you to override the default args of the field
```php
// field args
$args = array(
    'field_args'    => array(
        'id'        => 'some_id_here',
        'type'      => 'select_plus',
        'options'   => array(
            'standard' => 'Option One',
            'custom'   => 'Option Two',
            'none'     => 'Option Three',
        ),
) );
// create field
$field = new CMB2_Field( $args );

// pass the field to custom class
$types = new Select_Plus_CMB2_Types( $field );

// render the field with new id and name
echo $types->select_plus( array(
    'id'    => 'new_id_0_here',
    'name'  => 'smart[param][value]',
) );
```