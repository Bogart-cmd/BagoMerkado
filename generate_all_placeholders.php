<?php

function createMountainPlaceholder($path, $filename, $width, $height, $bgColor, $fgColor) {
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    $im = imagecreatetruecolor($width, $height);
    $bg = imagecolorallocate($im, ...$bgColor);
    imagefill($im, 0, 0, $bg);

    $fg = imagecolorallocate($im, ...$fgColor);

    // Draw sun (circle)
    $sunX = intval($width * 0.8);
    $sunY = intval($height * 0.25);
    $sunRadius = intval($height * 0.1);
    imagefilledellipse($im, $sunX, $sunY, $sunRadius * 2, $sunRadius * 2, $fg);

    // Draw mountains (polygons)
    $mountain1 = [
        intval($width * 0.1), intval($height * 0.9),
        intval($width * 0.3), intval($height * 0.5),
        intval($width * 0.5), intval($height * 0.9),
    ];
    $mountain2 = [
        intval($width * 0.4), intval($height * 0.9),
        intval($width * 0.6), intval($height * 0.6),
        intval($width * 0.8), intval($height * 0.9),
    ];
    imagefilledpolygon($im, $mountain1, 3, $fg);
    imagefilledpolygon($im, $mountain2, 3, $fg);

    // Optional: Draw outlines for mountains in a darker color
    $darkFg = imagecolorallocate($im, max(0, $fgColor[0] - 50), max(0, $fgColor[1] - 50), max(0, $fgColor[2] - 50));
    imagepolygon($im, $mountain1, 3, $darkFg);
    imagepolygon($im, $mountain2, 3, $darkFg);

    // Decide format from filename extension
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    $fullPath = $path . '/' . $filename;

    if ($extension === 'png') {
        imagepng($im, $fullPath);
    } elseif ($extension === 'jpg' || $extension === 'jpeg') {
        imagejpeg($im, $fullPath);
    } else {
        // default to PNG
        imagepng($im, $fullPath);
    }

    imagedestroy($im);

    echo "Created placeholder: $fullPath\n";
}

// Paths
$storagePath = __DIR__ . '/storage/app/public';
$assetsPath = __DIR__ . '/public/assets/images';

// Images exactly as your app requests
$storageImages = [
    'tshirts_en.jpg',
    'smartphones_en.jpg',
    'fashion_en.jpg',
    'electronics_en.jpg',
];

$assetsImages = [
    'homesale-banner.png',
    'choose-icon1.png',
    'choose-icon2.png',
    'choose-icon3.png',
    'choose-icon4.png',
    'footer-logo.png',
    'footerbotom-line.png',
    'choose-bg.jpg',
];

// Colors
$bgColorStorage = [100, 100, 255]; // blue-ish background for storage images
$fgColorStorage = [255, 255, 255]; // white foreground

$bgColorAssets = [200, 200, 200]; // gray background for assets images
$fgColorAssets = [100, 100, 100]; // dark gray foreground

// Create storage placeholders
foreach ($storageImages as $img) {
    createMountainPlaceholder($storagePath, $img, 800, 600, $bgColorStorage, $fgColorStorage);
}

// Create assets placeholders
foreach ($assetsImages as $img) {
    createMountainPlaceholder($assetsPath, $img, 400, 300, $bgColorAssets, $fgColorAssets);
}
