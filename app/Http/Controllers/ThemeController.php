<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Exception;
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
        try {
            if (!$this->validate($request->name, 'name')) {
                throw new Exception('Invalid name');
            }
            if (!$this->validate($request->description, 'text')) {
                throw new Exception('Invalid description');
            }

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

            return response()->json($theme, 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
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

        $updated = DB::table('themes')
            ->where('id', $request->id)
            ->update(['name' => $request->name, 'description' => $request->description]);

        if ($updated) {
            return response()->json([
                'status' => 'success',
                'message' => 'Theme updated successfully',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'No changes or theme not found',
        ], 404);
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
                'message' => 'Theme not found',
            ], 404);
        }

        if ($theme->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Theme deleted successfully',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to delete theme',
        ], 500);
    }
}
