<?php
include("includes/functions.php");

$image = $_FILES['image'] ?? null;
$imagePath = '';
$imageSize = filesize($imagePath);
$user = [
    'image' => ''
];

if (!is_dir(__DIR__.'/public/images')) {
    mkdir(__DIR__.'/public/images');
}

if ($image && $image['tmp_name']) {
    if ($user['image']) {
        unlink(__DIR__.'/public/'.$user['image']);
    }
    
    $imagePath = 'images/' . randomString(8) . '/' . $image['name'];
    // $imageType = finfo_file($imageInfo, $imagePath);
    mkdir(dirname(__DIR__.'/public/'.$imagePath));
    move_uploaded_file($image['tmp_name'], __DIR__.'/public/'.$imagePath);
    
}

if (!$email) {
    $errors[] = 'Email is required';
}

if (!$name) {
    $errors[] = 'Name is required';
}
