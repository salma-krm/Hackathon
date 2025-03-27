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
        //
    }

   
    public function create(Request $request)
    {
        if (!$this->validate($request->code,'number')) {
        
            throw new Exception('invalid code');
        }
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
            return $this->response($memberjery);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => '  team not created',
            ], 500);
        }
    }

  

  
  
}
