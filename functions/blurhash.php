<?php

function blurhash($image_path){
    $file  = $image_path;
    $image = imagecreatefromstring(file_get_contents($file));
    $width = imagesx($image);
    $height = imagesy($image);
    
    $max_width = 50;
    if( $width > $max_width ) { 
        $image = imagescale($image, $max_width);
        $width = imagesx($image);
        $height = imagesy($image);
    }
    
    $pixels = [];
    for ($y = 0; $y < $height; ++$y) {
        $row = [];
        for ($x = 0; $x < $width; ++$x) {
            $index = imagecolorat($image, $x, $y);
            $colors = imagecolorsforindex($image, $index);
    
            $row[] = [$colors['red'], $colors['green'], $colors['blue']];
        }
        $pixels[] = $row;
    }
    
    $components_x = 4;
    $components_y = 3;
    $blurhash = Blurhash::encode($pixels, $components_x, $components_y);
    
    return $blurhash;
}