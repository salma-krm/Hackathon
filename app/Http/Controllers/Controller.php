<?php

namespace App\Http\Controllers;

use App\Models\JuryMember;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function response( $data = null, $error = null)
    {
        $message = "succ"; $code = 200;
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

                (preg_match("/^[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/", $data));
                  

            case 'password':
     
                return (strlen($data) >= 8 && preg_match("/[A-Za-z]/", $data) && preg_match("/[\d]/", $data));

            case 'number':
                return preg_match("/^\d+$/", $data);

            default:
                return false;
        }
    }
    public function randomcode()
    {
        do {
            $accountNumber = str_pad(rand(0, 999999999999), 10, '0', STR_PAD_LEFT);
            $number = JuryMember::where('code', $accountNumber)->exists();
        } while ($number);

        return $accountNumber;
    }
}
