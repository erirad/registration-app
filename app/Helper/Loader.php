<?php

namespace App\Helper;

use App\Controller\ClientsController;

class Loader
{
    public function start()
    {
        $path = $this->getPath();
        if (isset($path[1]) && !empty($path[1])) {
            $controller = $this->getController($path[1]);
            $method = $this->getMethod($path);
            if (class_exists($controller)) {
                $object = new $controller;
                if (method_exists($object, $method)) {
                    $this->getParams($path, $object, $method);

                } else {
                    echo '405';
                }
            } else {
                echo '404';
            }
        } else {
            $object = new ClientsController();
            $object->lightboard();
        }
    }

    private function getPath()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        } else {
            $path = '/';
        }
        $path = explode('/', $path);
        return $path;
    }

    private function getController($path)
    {
        $controller = strtolower($path);
        $controller = ucfirst($controller);
        $controller = '\App\Controller\\' . $controller . 'Controller';
        return $controller;
    }

    private function getMethod($path)
    {
        if (isset($path[2]) && !empty($path[2])) {
            $findPosition = strpos($path[2], '?');
            if ($findPosition !== false) {
                $path[2] = substr($path[2], 0, $findPosition);
            }
            return $method = $path[2];
        } else {
            return $method = 'lightboard';
        }
    }

    //arba pervadinti arba pakeisti. (LOAD OBJECT)
    private function getParams($path, $object, $method)
    {
        if (isset($path[3]) && !empty($path[3])) {
            $param = $path[3];
            $object->{$method}($param);
        } else {
            $object->{$method}();
        }
    }
}
