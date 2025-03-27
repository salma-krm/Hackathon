<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Http\Requests\StoreThemeRequest;
use App\Http\Requests\UpdateThemeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ThemeController extends Controller
{

    public function index()
    {
        $themes = theme::get();

        foreach ($themes as $theme) {
            return response()->json([
                ' theme name ' => $theme->name,
                'description ' => $theme->description,
            ], 200);
        }
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
        $theme->name = $request->name;
        $theme->description = $request->description;
        $theme->save();

        return response()->json([
            'message' => 'success',
            'data' => $theme,
        ], 201);
    }




    public function update(Request $request)
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
        $updated = DB::table('theme')->where('id', $request->id)->update(['name' => $request->name, 'description' => $request->description]);
        if ($updated) {

            return $this->response($request->all());
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No changes  theme not fund ',
            ]);
        }
    }
    public function delete(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $theme = Theme::find($request->id);


        if (!$theme) {
            return response()->json([
                'status' => 'error',
                'message' => 'Theme not found.',
            ], 404);
        }
        if ($theme->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Theme deleted successfull',
            ], 200);
        }


        return response()->json([
            'status' => 'error',
            'message' => '  theme not deleted',
        ], 500);
    }
}
