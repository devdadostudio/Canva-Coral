<?php
defined('ABSPATH') || exit;

add_action('acf/init', 'acf_project_blocks_fields');

function acf_project_blocks_fields()
{
	acf_add_local_field_group([
		'key' => 'group_627bebc49311e',
		'title' => '[Canva Block] Menu',
		'fields' => [
			[
				'key' => 'field_627ce08ee940c',
				'label' => 'Label',
				'name' => 'label',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '50',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			],
			[
				'key' => 'field_627bebdf7652a',
				'label' => 'Menu ID',
				'name' => 'menu_id',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '50',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			],
			[
				'key' => 'field_627bebff7652b',
				'label' => 'UL Css Classes',
				'name' => 'ul_css_classes',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '50',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			],
			[
				'key' => 'field_627bec0d7652c',
				'label' => 'LI Css Classes',
				'name' => 'li_css_classes',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '50',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			],
		],
		'location' => [
			[
				[
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/menu-selector',
				],
			],
		],
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	]);
}
