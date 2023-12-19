<?php

namespace App\Http\Controllers;

use App\Models\Emply;
use Illuminate\Http\Request;

class EmplyController extends Controller
{
    public function index()
    {
        return Emply::all();
    }

    public function store(Request $request)
    {
        $emply = Emply::create($request->all());
        return response()->json($emply, 201);
    }

    public function show($id)
    {
        return Emply::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $emply = Emply::findOrFail($id);
        $emply->update($request->all());
        return response()->json($emply, 200);
    }

    public function destroy($id)
    {
        Emply::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
