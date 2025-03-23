<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Http\Requests\StoreThemeRequest;
use App\Http\Requests\UpdateThemeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator ;


class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

   
    public function create(Request $request)
    {
        // if (!$this->validate($request->name,'name')) {
        //     return $this->response(null, null, "error", 202);
        // }
        // if (!$this->validate($request->description, 'text')) {
        //     return $this->response(null, null, "error", 422);
        // }
        $validator =Validator::make($request->all(),[

            'name'=>['required'],
            'description'=>['required'],
        ]);
        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        // return ["message"=>$request->all()];
        $theme = Theme::create([$request->name,$request->description]);
        return $this->response('succ',201,$theme);

    }


   
}
