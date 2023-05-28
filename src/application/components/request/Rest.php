<?php

namespace application\components\request;

class Rest
{

    private $method;
    private $endpoint;
    private $params;
    private $apiToken;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];

        $uri_parts = explode('?', $_SERVER['REQUEST_URI']);

        if (!empty($_SERVER['HTTP_API_TOKEN'])) {
            $this->apiToken = $_SERVER['HTTP_API_TOKEN'];
        } else {
            $this->apiToken = null;
        }

        list($this->endpoint, $params) = [
            $uri_parts[0], //uri itsel
            empty($uri_parts[1]) ? null : $uri_parts[1] //url parametrs
        ];

        if ($params !== null) {
            $params = explode("&", $params);
            foreach ($params as $str) {
                list($name, $val) = explode('=', $str);
                $this->params[$name] = urldecode($val);
            }
        } else {
            $this->params = [];
        }
    }

    public function getQueryParams(): array
    {
        return $this->params;
    }

    public function getRequestMethod(): string
    {
        return $this->method;
    }

    public function getQueryParam(string $name, $default = null)
    {
        if (array_key_exists($name, $this->params)) {
            return $this->params[$name];
        } else {
            return $default;
        }
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function getAuthKey()
    {
        return $this->apiToken;
    }
}
