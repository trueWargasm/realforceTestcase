<?php

namespace application\components\responce;

class JsonResponce
{
    public function __construct()
    {
        $this->cors();
    }

    public function unauthorized()
    {
        http_response_code(401);
        $this->send([
            'success' => false,
            'code' => 401,
            'message' => 'Unauthorized Request',
            'data' => ''
        ]);
    }

    public function send(array $responce)
    {
        header('Content-Type: application/json; charset=utf-8');

        $responceJson = json_encode($responce, JSON_FORCE_OBJECT);
        print($responceJson);
    }

    function cors()
    {

        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }
    }

    function success(array $data)
    {
        http_response_code(200);
        $this->send([
            'success' => true,
            'code' => 200,
            'message' => '',
            'data' => $data
        ]);
    }
}
