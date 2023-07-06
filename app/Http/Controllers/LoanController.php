<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanResource;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LoanResource::collection(Loan::all());
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
            'student_id' => 'required',
            'laptop_id' => 'required',
            'loan_date' => 'required',
            'loan_expiration_date' => 'required'
        ]);

        $loan = Loan::firstOrCreate(['student_id' => $request->student_id, 'laptop_id' => $request->laptop_id, 'loan_date' => $request->loan_date, 'loan_expiration_date' => $request->loan_expiration_date]);

        return new LoanResource($loan);
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'student_id' => 'required',
            'laptop_id' => 'required',
            'loan_date' => 'required',
            'loan_expiration_date' => 'required'
        ]);

        $loan->update($request->all());

        return new LoanResource($loan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        // Try and delete a loan
        try {
            // finds the first result or throws an NotFoundException
            $loanTobeDeleted = Loan::where('id', '=', $loan->id)->firstOrFail();
            $loanTobeDeleted->delete();
        } catch (\Exception $e) {
            return response()->json("Record not found");
        }

        return response()->json(["Record deleted"]);
    }
}
