<?php

namespace App\Core;

use App\Core\View;

class Controller
{
    protected $view;
    protected $msg;

    public function __construct()
    {
        $this->view = new View();
        $this->msg = new \Plasticbrain\FlashMessages\FlashMessages();
    }

    public function validator($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $data) || preg_match('~[0-9]+~', $data)) {
            return false;
        }
        return $data;
    }

    public function redirect($path)
    {
        header("Location: " . DOMAIN . $path);
        die();
    }
}
