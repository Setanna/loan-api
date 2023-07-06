<?php

namespace App\Http\Controllers;

use App\Http\Resources\MouseResource;
use App\Models\Mouse;
use Illuminate\Http\Request;

class MouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MouseResource::collection(Mouse::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mouse_type' => 'required'
        ]);

        $mouse = Mouse::firstOrCreate(['mouse_type' => $request->mouse_type]);

        return new MouseResource($mouse);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mouse $mouse)
    {
        return new MouseResource($mouse);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mouse $mouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mouse $mouse)
    {
        $request->validate([
            'mouse_type' => 'required'
        ]);

        $mouse->update($request->all());

        return new MouseResource($mouse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mouse $mouse)
    {
        // Try and delete a mouse
        try {
            // finds the first result or throws an NotFoundException
            $mouseTobeDeleted = Mouse::where('id', '=', $mouse->id)->firstOrFail();
            $mouseTobeDeleted->delete();
        } catch (\Exception $e) {
            return response()->json("Record not found");
        }

        return response()->json(["Record deleted"]);
    }
}
