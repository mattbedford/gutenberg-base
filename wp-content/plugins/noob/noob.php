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
        'render_callback' => [NoobObject::class, 'SomeCallable' ]
    ]);
}