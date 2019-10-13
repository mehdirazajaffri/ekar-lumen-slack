<?php
class Helpers
{
    public static function euler($number)
    {
        $numbers = array_filter(range(1, $number - 1), function ($n) {
            return ($n % 3 == 0) || ($n % 5 == 0);
        });
        $res = array_sum($numbers);

        return $res;
    }

    public static function sendCurlToSlack($response)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://slack.com/api/chat.postMessage",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($response),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer xoxb-793684583653-780912309122-dsHPIYinzkUpNjVStCmKltkP",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public static function getNumberFromString($string)
    {
        $int = intval(preg_replace('/[^0-9]+/', '', $string), 10);
        return $int;
    }
}
