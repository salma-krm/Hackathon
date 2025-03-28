<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function create(Request $request)
    {
        try {
            if (!$this->validate($request->value, 'number')) {
                throw new Exception('Invalid number');
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required', 'Float', 'max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            $note = Note::create([
                'name' => $request->value,
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $note,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function getAvgNotes(Request $request) {
 
        $team = $request->team;
        $project_id = $request->project_id;

        $moyenne = note::where('note.team', $team)
                     ->where('note.project_id', $project_id)
                     ->selectRaw('AVG(note.value) as moyenne')
                     ->groupBy('note.project_id') 
                     ->get();
    
        return $this->response()->json($moyenne);
    }
    
}
