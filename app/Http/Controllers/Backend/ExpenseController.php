<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::get();

        return view('backend.expense.expense', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'date' => 'required',
            'purpose' => 'required',
            'amount' => 'required',
        ]);
        $expenseData = [
            'date' => $request->date,
            'purpose' => $request->purpose,
            'amount' => $request->amount,
            'created_by' => Auth::guard('admin')->user()->id,
            'created_at' => Carbon::now(),
        ]; // Added a semicolon here to end the array definition

        if ($request->file('receipt')) {
            $expenseData['receipt'] = uploadAndResizeImage($request->file('receipt'), 'upload/expense', 300, 300); // Fixed the function parameters
        }

        Expense::insert($expenseData);

        return redirect()->back()->with(notification('Expense Added Successfully', 'success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'purpose' => 'required',
            'amount' => 'required',
        ]);
        $expenseData = [
            'date' => $request->date,
            'purpose' => $request->purpose,
            'amount' => $request->amount,
            'updated_by' => Auth::guard('admin')->user()->id,
            'updated_at' => Carbon::now(),
        ]; // Added a semicolon here to end the array definition

        $expense = Expense::findOrFail($id);
        if ($request->file('receipt')) {
            @unlink(public_path($expense->receipt));
            $expenseData['receipt'] = uploadAndResizeImage($request->file('receipt'), 'upload/expense', 400, 400); // Fixed the function parameters
        }
        Expense::findOrFail($id)->update($expenseData);

        return redirect()->back()->with(notification('Expense Updated Successfully', 'success'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
