<?php

namespace application;

use Exception;

class RestfulApp
{
    private $config;
    private $components;
    private $instance = null;

    public function __construct(array $config)
    {
        $this->config = $config;

        //load and create components
        foreach ($config['components'] as $name => $component) {
            $newComponent = new $component['class'];
            foreach ($component as $argument => $value) {
                if ($argument == 'class') continue;
                $newComponent->$argument = $value;
            }
            $this->components[$name] = $newComponent;
        }

        if (!key_exists('request', $this->components)) {
            throw new Exception('No request component described');
        } else {
            //$this->components['request']->process();
        }
    }

    public function run()
    {
        $endpoint = $this->components['request']->getEndpoint();
        $requestMethod = $this->components['request']->getRequestMethod();

        list($responceCode, $responceBody) =
            $this->components['router']->route($requestMethod, $endpoint);

        $this->components['responce']->sendResponce($responceCode, $responceBody);
    }
}
