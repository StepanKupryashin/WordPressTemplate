<?php

add_action('wp_enqueue_scripts', 'my_wp_head_css' ); // хук автоматом сработает во время wp_head
function my_wp_head_css() {
    wp_enqueue_style( 'my_head_style', get_template_directory_uri() .'/style.css', array(),'1.2' );
}



?>