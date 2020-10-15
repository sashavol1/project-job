<?php

namespace App\Utility;

/**
 * Image: Работа с изображениями
 *
 * @author Aleksandr Volmanov <ssashavol7@gmail.com>
 * @since 0.0.1
 */
class Image {

    /**
     * Load Image
     * @param  string $file recource
     * @param  string $dir 
     * @param  string $width
     * @param  string $height
     * @return string return dir
     */
    public function load_resize_image($file, $dir, $width = 200, $height = 200) {

        if (!in_array(pathinfo($file['name'], PATHINFO_EXTENSION), ['jpg', 'gif', 'png', 'jpeg']) && !$file['size'] <= 2171860) {
            Utility\Flash::danger('Формат картинок: jpg, png, gif. Размер до 2 мб. Ширина и высота не меньше 200 пикселей.');
            return false;
        }

        $filename = md5(time() . $file['name']) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $image = null;

        switch(strtolower($file['type']))
        {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file['tmp_name']);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file['tmp_name']);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($file['tmp_name']);
                break;
            default:
                exit('Unsupported type: '.$file['type']);
        }

        // size from
        list($w, $h) = getimagesize($file['tmp_name']);

        if ($w > $h) {
            $new_height =   $height;
            $new_width  =   floor($w * ($new_height / $h));
            $crop_x     =   ceil(($w - $h) / 2);
            $crop_y     =   0;
        } else {
            $new_width  =   $width;
            $new_height =   floor( $h * ( $new_width / $w ));
            $crop_x     =   0;
            $crop_y     =   ceil(($h - $w) / 2);
        }

        // Create new empty image
        $new = imagecreatetruecolor($width, $height);

        // Resize old image into new
        imagecopyresampled($new, $image, 0, 0, $crop_x, $crop_y, $new_width, $new_height, $w, $h);

        // Catch and save the image
        $status = false;
        switch(strtolower($file['type']))
        {
            case 'image/jpeg':
                $status = imagejpeg($new, $dir . $filename, 90);
                break;
            case 'image/png':
                $status = imagepng($new, $dir . $filename, 0);
                break;
            case 'image/gif':
                $status = imagegif($new, $dir . $filename);
                break;
        }

        // Destroy resources
        imagedestroy($image);
        imagedestroy($new);

        return $status ? $filename : false;
    }

}