<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Hackathon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class TeamController extends Controller
{
    

    public function index()
    {
        $themes = Team::get();

        foreach ($themes as $theme) {
            return response()->json([
                ' theme name ' => $theme->name,

            ], 200);
        }
    }


    public function create(Request $request)
    {
        Gate::allows('isParticipant');
        
        if(!parent::validate($request->name,'text')){

         throw new Exception("validation not authorize ");
        }


        $validator = Validator::make($request->all(), [
            'name' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $hackathon = Hackathon::where('name', $request->hackathon)->first();
        $user = JWTAuth::parseToken()->authenticate();

        if ($hackathon) {
            $hackathon->hackathon()->associate($hackathon);
            $hackathon->save();
        }
        if ($user) {
            $user->user()->associate($hackathon);
            $hackathon->save();
        }
        $team = new Team;
        $team->name = $request->name;
        $team->save();
        if ($team) {
            return $this->response($team);
        }
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],

        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $team =team::where('id', $request->id)->first();
        if($team){
            $team->name = $request->name;
            $team->save();
        }
      
        if ($team) {
            return $this->response($team);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No change Team  ',
            ],500);
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

        $team = team::find($request->id);


        if (!$team) {
            return response()->json([
                'status' => 'error',
                'message' => 'Theme not found.',
            ], 404);
        }
        if ($team->delete()) {
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
