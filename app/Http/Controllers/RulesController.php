<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RulesController extends Controller
{
    public function index() {
        $rules = Rule::get();

        foreach ($rules as $rule) {
            return response()->json([
                'rule ' => $rule->name,
            ], 200);
        }
    }

    public function create(Request $request)
    {
        try {
            if (!$this->validate($request->name, 'name')) {
                throw new Exception('Invalid name');
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required', 'string', 'max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            $rule = Rule::create([
                'name' => $request->name,
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $rule,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $updated = DB::table('rules')
            ->where('id', $request->id)
            ->update(['name' => $request->name]);

        if ($updated) {
            return response()->json([
                'status' => 'success',
                'message' => 'Rule updated successfully',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'No changes made',
        ]);
    }

    public function delete(Request $request)
    {
        $deleted = DB::table('rules')->where('id', $request->id)->delete();

        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Rule deleted successfully',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Rule not found',
        ]);
    }
}
