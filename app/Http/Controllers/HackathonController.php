<?php

namespace App\Http\Controllers;

use App\Models\Hackathon;
use App\Http\Requests\StoreHackathonRequest;
use App\Http\Requests\UpdateHackathonRequest;
use App\Models\Rule;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HackathonController extends Controller
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
            'place' => 'required|string',
            'rules' => 'required|array',
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
            if($theme){
            $theme->hackathon()->associate($hackathon);
            $theme->save();
        }
        foreach ($request->rules as $name) {
            $rule = Rule::where('name',$name)->first();
            $rule->hackathon()->attach($rule->id);
            // return "Scascasc";
            $rule->save();
            return $rule();
        }
        
    }
        return response()->json([
            'created' => $hackathon,
        ], 201);
    }
    public function update(Request $request)
    {
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

        DB::table('hackathon')
            ->where('id', $request->id)
            ->update(['place' => $request->place, 'date' => now()]);


        $hackathon = Hackathon::where('id', $request->id)->first();

        
            DB::table('rules_hackathon')
                ->where('hackathon_id', $request->id)
                ->delete();
        $rules = $request->rules;
        foreach ($rules as $name) {
            $rule = Rule::where('name', $name)->first();

            $hackathon->rules()->attach($rule)->save();


            
        }
        return $this->response($request->all());
    }
}
