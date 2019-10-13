<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Helpers;

class Controller extends BaseController
{
    public function ekar(Request $request)
    {
        // putting validation for the safe side
        $this->validate($request, [
            'event' => 'required',
            'event.type' => 'required',
            'event.channel' => 'required'
        ]);

        error_log(json_encode($request->all()));

        // Normalizing payLoad
        $payload = $request->get('event');

        if ($payload['type'] == "app_mention") {
            $text = $payload['text'];
            $keyword = "solve";

            if (strpos($text, $keyword) !== false) {
                // Remove string before the number.
                $text = substr($text, strpos($text, $keyword));
                // get integer value of number from the string
                $num = Helpers::getNumberFromString($text);

                if ($num > 0 && $num < 1000) {
                    $sum = Helpers::euler($num);
                    // Time to Send Response
                    Helpers::sendCurlToSlack([
                        "text" => "Sir! Your sum is " . $sum . " Thank you!",
                        "channel" => $payload['channel']
                    ]);
                } else {
                    Helpers::sendCurlToSlack([
                        "text" => "Sir! Your number should be greater than 0 and less than 1000, Thank you!",
                        "channel" => $payload['channel']
                    ]);
                }
            }
        }

        exit;
    }
}
