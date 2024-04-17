<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class ShippingAreaController extends Controller
{
    public function DivisionView()
    {
        $divisions = ShipDivision::orderBy('id', "DESC")->get();
        return view('backend.ship.division.view_division', compact('divisions'));
    }

    public function DivisionStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:ship_divisions,name,except,id'
        ]);
        ShipDivision::insert([
            'name' => $request->name,
            'created_by' => Auth::guard('admin')->id(),
            'created_at' => Carbon::now(),

        ]);

        return redirect()->back()->with(notification('Devision Information Save Successfully', 'success'));
    }
    public function DivisionUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:ship_divisions,name,' . $id
        ]);

        $division = ShipDivision::findOrFail($id);
        $division->update([
            'name' => $request->name,
            'updated_by' => Auth::guard('admin')->id(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with(notification('Devision Information Update Successfully', 'success'));
    }

    public function DivisionDelete($id)
    {

        $division = ShipDivision::findOrFail($id);

        // Delete related districts and states first
        $division->districts()->delete();
        $division->states()->delete();

        // Now delete the division
        $division->delete();
        return redirect()->back()->with(notification('Devision Delete Successfully', 'success'));
    }




    //ship district all function start from here 
    public function DistrictView()
    {
        $divisions = ShipDivision::orderBy('name', "ASC")->get();
        $districts = ShipDistrict::with('division')->orderBy('id', "DESC")->get();
        return view('backend.ship.district.view_district', compact('divisions', 'districts'));
    }

    public function DistrictStore(Request $request)
    {
        $request->validate([
            'division_id' => 'required',
            'name' => 'required|unique:ship_districts,name,NULL,id,division_id,' . $request->division_id

        ]);

        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'name' => $request->name,
            'created_by' => Auth::guard('admin')->id(),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with(notification('District Information Save Successfully', 'success'));
    }


    public function DistrictUpdate(Request $request, $id)
    {
        $request->validate([
            'division_id' => 'required',
            'name' => 'required|unique:ship_districts,name,' . $id
        ]);
        ShipDistrict::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'name' => $request->name,
            'updated_by' => Auth::guard('admin')->id(),
            'updated_at' => Carbon::now(),

        ]);

        return redirect()->back()->with(notification('District Information Update Successfully', 'success'));
    }


    public function DistrictDelete($id)
    {
        $district = ShipDistrict::findOrFail($id);

        // Delete related states first
        $district->states()->delete();

        // Now delete the district
        $district->delete();
        return redirect()->back()->with(notification('District Delete Successfully', 'success'));
    }





    //end 


    //ship district all function start from here 
    public function StateView()
    {
        $divisions = ShipDivision::orderBy('name', "ASC")->get();
        $states = ShipState::with('division', 'district')->orderBy('id', "DESC")->get();
        return view('backend.ship.state.view_state', compact('divisions','states'));
    }
    public function StateStore(Request $request)
    {
      
        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'name' => [
                'required',
                Rule::unique('ship_states')->where(function ($query) use ($request) {
                    return $query->where('division_id', $request->division_id)
                                 ->where('district_id', $request->district_id);
                }),
            ],
        ]);
        
        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'name' => $request->name,
            'created_by' => Auth::guard('admin')->id(),
            'created_at' => Carbon::now(),

        ]);

        return notification('State Save Successfully', 'success');
         
    }

    public function getState()
    {
        $states = ShipState::with('division', 'district')->orderBy('id', "DESC")->get();
        return response()->json($states);
    }
    

    public function StateUpdate(Request $request)
    {

        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'name' => [
                'required',
                Rule::unique('ship_states')->where(function ($query) use ($request) {
                    return $query->where('division_id', $request->division_id)
                                 ->where('district_id', $request->district_id);
                })->ignore($request->id), // $state id should be the ID of the record being updated
            ],
        ]);


        ShipState::findOrFail($request->id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'name' => $request->name,
            'updated_by' => Auth::guard('admin')->id(),
            'updated_at' => Carbon::now(),
        ]);

        return notification('State Update Successfully', 'success');
    }

    public function getDistrict($id)
    {
        $districts = ShipDistrict::where('division_id', $id)->orderBy('name', "ASC")->get();
        return response()->json($districts);
    }

    public function getStateById($id)
    {
        $states = ShipState::where('district_id', $id)->orderBy('name', "ASC")->get();
        return response()->json($states);
    }

   

    public function StateDelete(Request $request)
    {
        ShipState::findOrFail($request->id)->delete();
        return notification('State Successfully Delete', 'success');
    }
}
