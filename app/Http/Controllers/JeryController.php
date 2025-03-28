<?php

namespace App\Http\Controllers;

use App\Models\Jery;
use App\Http\Requests\StoreJeryRequest;
use App\Http\Requests\UpdateJeryRequest;
use App\Models\Jury;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JeryController extends Controller
{
   
    public function index()
    {
        $membres = Jury::get();

        foreach ($membres as $membre) {
            return response()->json([
                ' name ' => $membre->name,
            
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
                'name' => 'required', 'string', 'max:255'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            $rule = Jury::create([
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

    
}
