<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function ViewSuppiler()
    {
        return view('backend.supplier.view_supplier');
    }
}
