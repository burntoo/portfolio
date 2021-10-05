<?php
namespace Portfolio\App\Api;

class Curl
{
    function get_file_contents($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        if (isset($_SERVER["HTTP_USER_AGENT"]))
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
        $result = curl_exec($ch);
        curl_close($ch);
        
        return $result;
    }
}