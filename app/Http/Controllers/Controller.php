<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Helpers;

class Controller extends BaseController
{
    public function ekar(Request $request)
    {
        error_log(json_encode($request->all()));
        return response()->json(['challenge' => $request->get('challenge')]);
    }
}
