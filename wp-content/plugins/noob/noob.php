<?php

/*
* Plugin Name:  Noob container block
*/

namespace Noob;

include_once 'includes/NoobObject.php';

add_action( 'init', '\Noob\noob_init' );
function noob_init() {

    register_block_type( __DIR__ . '/build', [
        //'editor_script' => 'editor-script-handle',
        'render_callback' => [NoobObject::class, 'Init' ]
    ]);

	\wp_register_script(
		'swiper-js',
		'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
		[],
		false,
		false
	);
	\wp_register_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
	\wp_register_style( 'custom-swiper-css' , plugin_dir_url( __FILE__ ) . 'style.css' );

}