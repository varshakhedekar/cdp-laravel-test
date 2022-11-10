<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function productsView()
    { 
        $data = DB::table('products')->paginate(5);
        return view('customers.products', compact('data'));
    }

    function fetchProductsData(Request $request)
    {
     if($request->ajax())
     {
      $data = DB::table('products')->paginate(5);
      return view('customers.products_pagination', compact('data'))->render();
     }
    }
    
}
