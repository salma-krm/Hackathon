<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function response($message = "succ", $code = 200, $data = null, $error = null)
    {
        return response()->json([
            'message' => $message,
            'code' => $code,
            'donnee' => $data,
            'error' => $error,

        ]);
    }
    public function validate($data, $type)
    {
        switch ($type) {
            case 'text':

                return preg_match("/[A-Za-z]\d/", $data);
            case 'name':

                return preg_match("/^[a-zA-Z\s]+$/", $data);

            case 'email':

                return filter_var($data, FILTER_VALIDATE_EMAIL) !== false;

            case 'password':
     
                return (strlen($data) >= 8 && preg_match("/[A-Za-z]/", $data) && preg_match("/[\d]/", $data));

            case 'number':
                return preg_match("/^\d+$/", $data);

            default:
                return false;
        }
    }
}
