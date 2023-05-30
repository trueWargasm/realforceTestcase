<?php
require_once    'application/components/request/Rest.php';
require_once    'application/components/responce/JsonResponce.php';
require_once    'application/components/omdb/Connect.php';
require_once    'application/components/omdb/Formatter.php';
require_once    'application/components/jsondata/JsonLoader.php';


use application\components\request\Rest as Request;
use application\components\responce\JsonResponce as Responce;
use application\components\omdb\Connect as OmdbConnect;
use application\components\omdb\Formatter;
use application\components\jsondata\JsonLoader;

$validApiKey = date("Ymd");

$pageSize = 10;
$workDirectory = dirname(__FILE__);

$request = new Request();
$responce = new Responce();

$apiKey = $request->getAuthKey();

if ($apiKey !== $validApiKey) {
    $responce->unauthorized();
    exit();
}

$omdbConnect = new OmdbConnect();
$ombdData = $omdbConnect->requestData(
    $request->getQueryParam('page', 1),
    $request->getQueryParam('search', null),
);

$responceData = [];

if ($ombdData["Response"] === "True") {
    if (isset($ombdData["Search"])) {
        foreach ($ombdData["Search"] as $row) {
            $responceData[] = Formatter::prepareOmdbListItem($row);
        }
    } else {
        $responceData[] = Formatter::prepareOmdbSingle($row);
    }
}

$jsonData = JsonLoader::loadData($workDirectory);


foreach ($jsonData["drivers"] as $row) {
    if ($request->getQueryParam('search', false) && strpos(
        serialize($row),
        $request->getQueryParam('search', null),
    ) === false) continue; //search string not found, skip
    $responceData[] = Formatter::prepareJsonListItem($row);
}

$responce->success([$responceData]);
exit();
