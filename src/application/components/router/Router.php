<?php

namespace application\components\router;

use application\base\BaseObject;

class Router extends BaseObject
{
    public $routes;

    public function __construct()
    {
        return;
    }

    public function route($requestMethod, $endpoint)
    {
        echo $requestMethod . " " . $endpoint;
    }
}
