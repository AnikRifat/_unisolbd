<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solutions = Solution::latest()->get();
        return view('backend.solution.solution', compact('solutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.solution.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:solutions,title',
            'name' => 'required|unique:solutions,name',
            'short_description' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $data = [
            'title' => $request->title,
            'name' => $request->name,
            'slug' => str()->slug($request->title),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'status' => $request->status ?? 1,
            'created_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ];

        if ($request->file('image')) {
            $data['image'] = uploadAndResizeImage($request->file('image'), 'upload/solutions', 1260, 500);
        }

        Solution::create($data);

        return redirect()->route('solution.index')->with('success', 'Solution created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solution = Solution::findOrFail($id);
        return view('backend.solution.create', compact('solution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:solutions,title,'.$id,
            'name' => 'required|unique:solutions,name,'.$id,
            'short_description' => 'required',
            'description' => 'required',
            'image' => 'image',
        ]);

        $solution = Solution::findOrFail($id);

        $data = [
            'title' => $request->title,
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'status' => $request->status ?? 1,
            'updated_by' => Auth::id(),
            'updated_at' => Carbon::now(),
        ];

        if ($request->file('image')) {
            @unlink(public_path($solution->image));
            $data['image'] = uploadAndResizeImage($request->file('image'), 'upload/solutions', 1260, 500);
        }


        $solution->update($data);

        return redirect()->route('solution.index')->with('success', 'Solution updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solution = Solution::findOrFail($id);
        @unlink(public_path($solution->image));
        $solution->delete();

        return redirect()->route('solution.index')->with('success', 'Solution deleted successfully.');
    }

    /**
     * Activate the specified solution.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ActiveSolution($id)
    {
        Solution::where('id', '=', $id)->update(['status' => 1]);

        return redirect()->back()->with('success', 'Solution activated successfully.');
    }

    /**
     * Deactivate the specified solution.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function InactiveSolution($id)
    {
        Solution::where('id', '=', $id)->update(['status' => 0]);

        return redirect()->back()->with('success', 'Solution deactivated successfully.');
    }
}
