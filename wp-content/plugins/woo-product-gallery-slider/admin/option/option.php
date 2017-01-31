<?php

return array(
	'title' => __('Woocommerce Product Gallery Slider Option Panel', 'wpgs'),
	'logo' => 'logo-256x256.png',
	'menus' => array(
		array(
			'title' => __('WPGS Controls', 'wpgs'),
			'name' => 'wpgs_menu',
			'icon' => 'font-awesome:fa-magic',
			'controls' => array(
				array(
					'type' => 'notebox',
					'name' => 'wpgs_nb_1',
					'label' => __(' ', 'wpgs'),
					'description' => __('<p style="font-size:17px">The premium version of this plugin is available on Codecayon</p><br /><a class="button button-primary" href="http://codecanyon.net/item/twist-product-gallery-slidercarousel-plugin-for-woocommerce/14849108?ref=NiloySarker">Buy Now</a>', 'wpgs'),
					'status' => 'normal',
				),
				array(
					'type' => 'section',
					'title' => __('', 'wpgs'),
					'fields' => array(
						
						
						
						array(
							'type' => 'radiobutton',
							'name' => 'wpgs_nav',
							'label' => __('Navigation ', 'wpgs'),
							'description' => __('Defalut : Yes', 'wpgs'),
							
							'items' => array(								
								array(
									'value' => 'true',
									'label' => __('Yes', 'wpgs'),
								),
								array(
									'value' => 'false',
									'label' => __('No', 'wpgs'),
								),
							),
							'default' => array(
								'true',
							),
						),
						array(
							'type' => 'color',
							'name' => 'wpgs_nav_cl',
							'label' => __('Navigation Button Background Color', 'wpgs'),
							'description' => __(' ', 'wpgs'),
							'default' => '#ff6b00',
						),
						array(
							'type' => 'color',
							'name' => 'wpgs_nav_ico_cl',
							'label' => __('Navigation Icon Color', 'wpgs'),
							'description' => __(' ', 'wpgs'),
							'default' => '#fff',
						),
						array(
							'type' => 'radiobutton',
							'name' => 'wpgs_autoplay',
							'label' => __('AutoPlay ', 'wpgs'),
							'description' => __('Defalut : No', 'wpgs'),
							
							'items' => array(								
								array(
									'value' => 'true',
									'label' => __('Yes', 'wpgs'),
								),
								array(
									'value' => 'false',
									'label' => __('No', 'wpgs'),
								),
							),
							'default' => array(
								'false',
							),
						),
						
						array(
							'type' => 'textbox',
							'name' => 'wpgs_thumbanils',
							'label' => __('Thumbnails To Show', 'wpgs'),
							'description' => __('', 'wpgs'),
							'default' => '4',
							'validation' => 'numeric',
						),
						
						array(
							'type' => 'textbox',
							'name' => 'wpgs_thum_margin',
							'label' => __('Space Beetween Thumbnails', 'wpgs'),
							'description' => __('', 'wpgs'),
							'default' => '10',
							'validation' => 'numeric',
						),
						
						array(
							'type' => 'slider',
							'name' => 'wpgs_stagepadding',
							'label' => __('Thubnails Half Effect for First and Last Item', 'wpgs'),
							'description' => __('Add the % too Display', 'wpgs'),
							'default' => '10',
							'min' => '10',
							'max' => '90'
 							
						),
						
						
					),
				),
				array(
					'type' => 'notebox',
					'name' => 'wpgs_nb_2',
					'label' => __(' ', 'wpgs'),
					'description' => __('<p style="font-size:17px">The premium version of this plugin is available on Codecayon</p><br /><a class="button button-primary" href="http://codecanyon.net/item/twist-product-gallery-slidercarousel-plugin-for-woocommerce/14849108?ref=NiloySarker">Buy Now</a>', 'wpgs'),
					'status' => 'normal',
				),
			),
		)

	)
);

/**
 *EOF
 */