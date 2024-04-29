<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {

        // return view('manage.products.index', compact("products","product_categories"));
        return view('manage.products.index');
    }
}
