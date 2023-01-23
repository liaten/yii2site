<?php

namespace app\models;

class Curl
{
    public static function executeJSON(string $url) : ?array
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $resultString = curl_exec($ch);
        $result = json_decode($resultString,true);
        curl_close($ch);
        return $result;
    }

    public static function execute(string $url) : ?string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public static function getHTTPCode(string $url) : int
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
        curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);
        $output = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode;
    }

}