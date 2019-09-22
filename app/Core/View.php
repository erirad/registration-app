<?php

namespace App\Core;

class View
{
    public function render($template, $data = [])
    {
        $path = __DIR__;
        $path = str_replace('Core', '', $path);
        include $path . 'Views/includes/header.php';
        include $path . 'Views/clients/' . $template . '.php';
        include $path . 'Views/includes/footer.php';
    }
}
