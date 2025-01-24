<?php

namespace App\Http\Controllers;

use App\Models\Award;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index()
    {
        return response()->json(Award::all(), 200);
    }

    public function show($id)
    {
        $award = Award::find($id);

        if (!$award) {
            return response()->json(['error => Award not found'], 404);
        }
        return response()->json($award, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'author_id' => 'required|integer',
            'name' => 'required|string',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
        ]);
    
        $award = Award::create($request->all());
        return response()->json($award, 201);
    }
    

    public function update(Request $request, $id)
    {
        $award = Award::findOrFail($id);
        $award->update($request->all());
        return response()->json($award, 200);
    }

    public function destroy($id)
    {
        Award::destroy($id);
        return response()->json(null, 204);
    }
}
?>