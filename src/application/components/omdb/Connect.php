<?php

namespace application\components\omdb;

class Connect
{
    private $apiKey = "c4281cad";
    private $url = "http://www.omdbapi.com/";

    public function requestData($page = 1, $search = null)
    {
        $searchString = '';
        if ($search !== null) {
            $searchString = "&s=" . urlencode($search);
        }

        $omdbRequest = curl_init();
        curl_setopt_array($omdbRequest, [
            CURLOPT_URL => $this->url . '?apikey=' . $this->apiKey . '&page=' . $page . $searchString,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => true
        ]);

        $jsonText = curl_exec($omdbRequest);
        curl_close($omdbRequest);

        $jsonArray = json_decode($jsonText, true);

        return $jsonArray;
    }
}
