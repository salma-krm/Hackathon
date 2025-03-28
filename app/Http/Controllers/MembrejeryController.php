<?php

namespace App\Http\Controllers;

use App\Models\Jury;
use App\Models\JuryMember;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MembrejeryController extends Controller
{
    public function index()
    {
        $membres = JuryMember::get();

        foreach ($membres as $membre) {
            return response()->json([
                ' membre name ' => $membre->name,
                'code ' => $membre->code,
            ], 200);
        }
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'code' => 'required|integer',
                'name' => 'required|string',
                'jury' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            $code = $this->randomcode(); 
            
            $memberjery = new JuryMember();
            $memberjery->code = $code;
            $memberjery->name = $request->name;  
            $memberjery->save();

            $jury = Jury::where('name', $request->jury)->first();

            if ($jury) {
                $juryMemberCount = $jury->members()->count();

                if ($juryMemberCount < 3) {
                    $memberjery->jury()->associate($jury);
                    $memberjery->save();
                } else {
                    throw new Exception(' jury a  max number of members.');
                }
            } else {
                throw new Exception('Jury not found.');
            }

            return response()->json($memberjery, 201);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'jury' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            $jury = Jury::where('name', $request->jury)->first();

            if ($jury) {
                $juryMemberCount = $jury->members()->count();

                if ($juryMemberCount < 3) {
                    $memberjery = JuryMember::find($id);

                    if (!$memberjery) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Jury member not found',
                        ], 404);
                    }

                    $memberjery->name = $request->name;
                    $memberjery->jury()->associate($jury);
                    $memberjery->save();

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Jury member updated',
                        'data' => $memberjery,
                    ], 200);
                } else {
                    throw new Exception('jury a max number of members');
                }
            } else {
                throw new Exception('Jury not found.');
            }

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
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
                'message' => 'Jury member deleted',
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
