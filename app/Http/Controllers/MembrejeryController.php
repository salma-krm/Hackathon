<?php

namespace App\Http\Controllers;

use App\Models\membrejery;
use App\Http\Requests\StoremembrejeryRequest;
use App\Http\Requests\UpdatemembrejeryRequest;
use App\Models\JuryMember;
use Exception;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class MembrejeryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

   
    public function create(Request $request)
    {
        
        if ($this->validate($request->name,'name')) {
            throw new Exception('invalid name');
        }

        $validator = Validator::make($request->all(), [
            'code' => 'required|integer',
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $code = $this->randomcode();
        $memberjery = new JuryMember();
        $memberjery->code = $code;
        $memberjery->place = $request->name;
        $memberjery->save();
        if ($memberjery) {
            return response()->json($memberjery, 201);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => '  membrejery not created',
            ], 500);
        }
    }
    public function update(Request $request, $id)
{
    
    if ($this->validate($request->name,'name')) {
        throw new Exception('invalid name');
    }
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors(),
        ], 422);
    }


    
    $memberjery = JuryMember::find($id);

    if (!$memberjery) {
        return response()->json([
            'status' => 'error',
            'message' => 'Jury member not found',
        ], 404);
    }

    $memberjery->name = $request->name;
    $memberjery->save();  
    


    return response()->json([
        'status' => 'success',
        'message' => 'Jury member updated ',
        'data' => $memberjery,
    ], 200);
}
public function delete($id)
{
   
    $memberjery = JuryMember::find($id);

    if (!$memberjery) {
        return response()->json([
            'status' => 'error',
            'message' => 'Jury member not found',
        ], 404);
    }

  
    $memberjery->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Jury member deleted ',
    ], 200);
}



  

  
  
}
