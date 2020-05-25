<?php

namespace App\Presenter;

use App\Core;

/**
 * Wigdet Presenter:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.6
 */
class Widget extends Core\Presenter {

    /**
     * FieldInput
     * @access public
     * @return string
     * @since 1.0.6
     */
    public function fieldInput(string $field = '') {
        return [
            "name" => $this->data->forename . " " . $this->data->surname
        ];
    }

}
