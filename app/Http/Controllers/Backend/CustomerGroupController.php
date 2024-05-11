<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CustomerGroup;
use Illuminate\Http\Request;

class CustomerGroupController extends Controller
{

    public function index()
    {
        $customerGroups = CustomerGroup::all();
        return view('backend.customer_groups.index', compact('customerGroups'));
    }


    public function create()
    {
        return view('customer_groups.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rules' => 'required|array',
            'status' => 'required|integer',
        ]);

        CustomerGroup::create($request->all());

        return redirect()->route('customer-groups.index')
                         ->with('success', 'Customer group created successfully.');
    }


    public function show(CustomerGroup $customerGroup)
    {
        return view('customer_groups.show', compact('customerGroup'));
    }


    public function edit(CustomerGroup $customerGroup)
    {
        return view('customer_groups.edit', compact('customerGroup'));
    }


    public function update(Request $request, CustomerGroup $customerGroup)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rules' => 'required|array',
            'status' => 'required|integer',
        ]);

        $customerGroup->update($request->all());

        return redirect()->route('customer-groups.index')
                         ->with('success', 'Customer group updated successfully.');
    }


    public function destroy(CustomerGroup $customerGroup)
    {
        $customerGroup->delete();

        return redirect()->route('customer-groups.index')
                         ->with('success', 'Customer group deleted successfully.');
    }
}
