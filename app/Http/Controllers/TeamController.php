<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator ;

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
     
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
    
      $theme = new Team;
      $theme->name= $request->name;
      $theme->save();
    
        if($theme){
            return response()->json([
            'message' => 'success',
            'data' => $theme,
        ], 201);
    

}}
public function update(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => ['required'],
       
    ]);
    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors(),
        ], 422);
    }
    $updated = DB::table('team')->where('id', $request->id)->update(['name' => $request->name]);
    if ($updated) {
        return $this->response($request->all());
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'No changes  Team  ',
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

    $theme = team::find($request->id);

   
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
