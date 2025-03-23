<?php

namespace App\Http\Controllers;

use App\Models\rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RulesController extends Controller
{

    public function index() {}

    public function create(Request $request)
    {

        if (!$this->validate($request->name, 'name')) {
            return $this->response(null, null, "error", 422);
        }
        $validator = Validator::make($request->all(), [

            'name' => ['required', 'string', 'max:255'],

        ]);
        if ($validator->fails()) {

            return response()->json([
                'errors' => $validator->errors(),

            ], 422);
        }
        $rule = rule::create([
            'name' => $request->name,
        ]);
        return $this->response("succ", 201, $rule);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $updated = DB::table('rules')->where('id', $request->id)->update(['name' => $request->name]);


        if ($updated) {

            return $this->response($request->all());
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No changes were made or rule not found.',
            ]);
        }
    }

    public function delete(Request $request)
    {
        $deleted = DB::table('rules')->where('id', $request->id)->delete();


        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Rule deleted successfully!',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Rule not found or deletion failed.',
            ]);
        }
    }
}
