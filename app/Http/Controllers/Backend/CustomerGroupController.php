<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CustomerGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'rules' => 'required|array',
        ]);
        // Process the rules into an associative array
        $keys = $request->input('rules.key');
        $values = $request->input('rules.value');

        $rules = [];
        foreach ($keys as $index => $key) {
            $rules[$key] = $values[$index];
        }
        $data['rules'] = json_encode($rules);
        CustomerGroup::create($data);

        return redirect()->route('customer-groups.index')
            ->with('success', 'Customer group created successfully.');
    }

    public function show(CustomerGroup $customerGroup)
    {
        return view('customer_groups.show', compact('customerGroup'));
    }

    public function edit($group)
    {
        $group = CustomerGroup::find($group);

        return view('backend.customer_groups.edit', compact('group'));
    }

    public function update(Request $request, CustomerGroup $customerGroup)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'rules' => 'required|array',
        ]);
        // Process the rules into an associative array
        $keys = $request->input('rules.key');
        $values = $request->input('rules.value');

        $rules = [];
        foreach ($keys as $index => $key) {
            $rules[$key] = $values[$index];
        }
        $data['rules'] = json_encode($rules);
        // dd($data);
        // dd($customerGroup);
        $customerGroup->update($data);

        return redirect()->route('customer-groups.index')
            ->with('success', 'Customer group updated successfully.');
    }

    public function destroy(CustomerGroup $customerGroup)
    {
        $customerGroup->delete();

        return redirect()->route('customer-groups.index')
            ->with('success', 'Customer group deleted successfully.');
    }

    public function assignCustomer($id)
    {
        // Find the customer group by ID
        $customerGroup = CustomerGroup::find($id);

        // Get all users who are not already assigned to the customer group
        $users = User::whereDoesntHave('customerGroups', function ($query) use ($id) {
            $query->where('customer_group_id', $id);
        })->get();

        return view('backend.customer_groups.customer', compact('customerGroup', 'users'));
    }

    public function storeAssignedCustomers(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'customers' => 'required|array',
            'customers.*' => 'exists:users,id', // Ensure each customer ID exists in the users table
        ]);
        // Find the customer group by ID
        $customerGroup = CustomerGroup::findOrFail($id);

        // Attach the selected customers to the customer group
        $customerGroup->customers()->attach($request->input('customers'));

        // Redirect back with a success message
        return redirect()->route('customer-groups.assign', $id)->with('success', 'Customers assigned successfully.');
    }

    public function detachCustomer(CustomerGroup $group, User $user)
    {

        DB::table('assign_customer_to_groups')->where('customer_id', $user->id)->delete();

        return redirect()->route('customer-groups.assign', $group->id)->with('success', 'Customers assigned successfully.');
    }

    public function ActiveCustomerGroup($id)
    {
        CustomerGroup::where('id', '=', $id)->update(['status' => 1]);

        return redirect()->back()->with('success', 'CustomerGroup activated successfully.');
    }

    /**
     * Deactivate the specified CustomerGroup.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function InactiveCustomerGroup($id)
    {
        CustomerGroup::where('id', '=', $id)->update(['status' => 0]);

        return redirect()->back()->with('success', 'CustomerGroup deactivated successfully.');
    }
}
