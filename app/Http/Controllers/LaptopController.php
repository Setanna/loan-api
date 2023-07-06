<?php

namespace App\Http\Controllers;

use App\Http\Resources\LaptopResource;
use App\Models\Laptop;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LaptopResource::collection(Laptop::all());
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
            'manifacturer' => 'required',
            'model' => 'required',
            'mouse_id' => 'required'
        ]);

        $laptop = Laptop::firstOrCreate(['model' => $request->model, 'manifacturer' => $request->manifacturer, 'mouse_id' => $request->mouse_id]);

        return new LaptopResource($laptop);
    }

    /**
     * Display the specified resource.
     */
    public function show(Laptop $laptop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laptop $laptop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laptop $laptop)
    {
        $request->validate([
            'manifacturer' => 'required',
            'model' => 'required',
            'mouse_id' => 'required'
        ]);

        $laptop->update($request->all());

        return new LaptopResource($laptop);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laptop $laptop)
    {
        // Try and delete a laptop
        try {
            // finds the first result or throws an NotFoundException
            $laptopTobeDeleted = Laptop::where('id', '=', $laptop->id)->firstOrFail();
            $laptopTobeDeleted->delete();
        } catch (\Exception $e) {
            return response()->json("Record not found");
        }

        return response()->json(["Record deleted"]);
    }
}
