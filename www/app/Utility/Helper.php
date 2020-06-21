<?php

namespace App\Utility;

/**
 * Helper
 *
 * @author Aleksandr Volmanov <ssashavol7@gmail.com>
 * @since 0.0.1
 */
class Helper {

    /**
     * Generate String
     * @param  int $file recource
     * @return string return 
     */
    static public function generateRandomStringForUrl(int $length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}