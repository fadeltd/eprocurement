<?php
function generateKey($len = 5) {
   define('KEY_CHARS', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
    $k = str_repeat('.', $len);
    while ($len--) {
        $k[$len] = substr(KEY_CHARS, mt_rand(0, strlen(KEY_CHARS) - 1), 1);
    }
    return $k;
}

function upload_cv($cv){
    $file = $cv['name'];
    $a = pathinfo($file);
    $basename = $a['basename'];
    $filename = generateKey(10);
    $extension = $a['extension'];
    $path = 'assets/docs/cv/';
    $dest = $path . $basename;
    $name = '';
    if (file_exists($dest)) {
        $b = count(glob($path . $filename . '*.' . $extension)) + 1;
        for ($i = 1; $i < $b; $i++) {
            if (!file_exists($path . $filename . $i . '.' . $extension)) {
                $name = $filename . $i . '.' . $extension;
                move_uploaded_file($_FILES['file']['tmp_name'], $path . $filename . $i . '.' . $extension);
            }
        }
    } else {
        $name = $filename . '.' . $extension;
        move_uploaded_file($cv['tmp_name'], $path . $filename . '.' . $extension);
    }
    return $name;
}

function upload_avatar($image) {
    $file = $image['name'];
    $a = pathinfo($file);
    $basename = $a['basename'];
    $filename = generateKey(10);
    $extension = $a['extension'];
    $path = 'assets/images/member/';
    $dest = $path . $basename;
    $name = '';
    if (file_exists($dest)) {
        $b = count(glob($path . $filename . '*.' . $extension)) + 1;
        for ($i = 1; $i < $b; $i++) {
            if (!file_exists($path . $filename . $i . '.' . $extension)) {
                $name = $filename . $i . '.' . $extension;
                move_uploaded_file($_FILES['file']['tmp_name'], $path . $filename . $i . '.' . $extension);
            }
        }
    } else {
        $name = $filename . '.' . $extension;
        move_uploaded_file($image['tmp_name'], $path . $filename . '.' . $extension);
    }
    return $name;
}
?>