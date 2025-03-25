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
 
    $validator = Validator::make($request->all(), [
        'name' => ['required'],
        'description' => ['required'],
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors(),
        ], 422);
    }

  $theme = new Theme;
  $theme->name= $request->name;
  $theme->description= $request->description;
  $theme->save();

    return response()->json([
        'message' => 'success',
        'data' => $theme,
    ], 201);
}



   
}
