<?php

namespace App\Presenter;

use App\Core;

/**
 * Wigdet Presenter:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.0
 */
class Helper extends Core\Presenter {

    /**
     * Decorator pass days
     * @access public
     * @return string
     * @since 1.0.0
     */
    static public function isActual(string $strtime = '', int $day_pass = 7) : bool {
        return !boolval((time() - strtotime($strtime)) > (60*60*24*$day_pass));
    }

}
