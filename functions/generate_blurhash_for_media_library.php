<?php

function generate_blurhash_for_media_library(){
    $query_images_args = array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'post_status'    => 'inherit',
        'posts_per_page' => - 1,
    );
    
    $query_images = new WP_Query( $query_images_args );
    
    foreach ( $query_images->posts as $image ) {
        update_post_meta( $image->ID, '_blurhash', blurhash(get_attached_file($image->ID)) );
    }
}