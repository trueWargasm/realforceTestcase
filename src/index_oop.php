<?php

namespace application;

$config = require_once 'config/main.php';

$app = new RestfulApp($config);
$app->run();

/** ABANDONED */
