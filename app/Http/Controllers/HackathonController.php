<?php

namespace App\Http\Controllers;

use App\Models\Hackathon;
use App\Models\Rule;
use App\Models\Theme;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HackathonController extends Controller
{
    public function index()
    
    {

        $hackathons = Hackathon::get();

        foreach ($hackathons as $hack) {
            return response()->json([
                'place' => $hack->place,
                'Theme ' => $hack->theme,
                'rule ' => $hack->rules,

            ], 200);
        }
    }

    public function create(Request $request)
    {
        try {
            if (!$this->validate($request->place, 'text')) {
                throw new Exception('invalid place');
            }

            $validator = Validator::make($request->all(), [
                'place' => 'required|string',
                'rules' => 'required|array',
                'themes' => 'required|array',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            $hackathon = new Hackathon();
            $hackathon->date = now();
            $hackathon->place = $request->place;
            $hackathon->save();

            foreach ($request->themes as $name) {
                $theme = Theme::where('name', $name)->first();
                if ($theme) {
                    $theme->hackathon()->associate($hackathon);
                    $theme->save();
                }
            }

            foreach ($request->rules as $name) {
                $rule = Rule::where('name', $name)->first();
                if ($rule) {
                    $hackathon->rules()->attach($rule->id);
                }
            }

            return response()->json([
                'created' => $hackathon,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            if ($this->validate($request->place, 'text')) {
                
            } else {
                throw new Exception('Invalid place');
            }

            $validator = Validator::make($request->all(), [
                'place' => 'required|string',
                'id' => 'required|integer',
                'rules' => 'required|array',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            $hackathon = Hackathon::where('id', $request->id)->first();

            if (!$hackathon) {
                throw new Exception('Hackathon not found');
            }

            DB::table('hackathon')
                ->where('id', $request->id)
                ->update(['place' => $request->place, 'date' => now()]);

            DB::table('rules_hackathon')
                ->where('hackathon_id', $request->id)
                ->delete();

            foreach ($request->rules as $name) {
                $rule = Rule::where('name', $name)->first();

                if ($rule) {
                    $hackathon->rules()->attach($rule);
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Hackathon updated successfully',
                'hackathon' => $hackathon,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
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

        DB::table('rules_hackathon')->where('hackathon_id', $request->id)->delete();

        $hackathon = Hackathon::find($request->id);

        if (!$hackathon) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hackathon not found.',
            ], 404);
        }

        if ($hackathon->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Hackathon deleted successfully',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Hackathon not deleted',
        ], 500);
    }
}
