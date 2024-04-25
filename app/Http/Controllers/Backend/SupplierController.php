<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function ViewSuppiler()
    {
        return view('backend.supplier.view_supplier');
    }
}
