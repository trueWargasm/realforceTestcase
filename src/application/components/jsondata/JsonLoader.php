<?php

namespace application\components\jsondata;

class JsonLoader
{
    public static function loadData($directory)
    {
        $fileBody = file_get_contents($directory . "/data.json");
        $dataArray = json_decode($fileBody, true);

        return $dataArray;
    }
}
