<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        echo 'done';
    }


    public function create()
    {
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->get();
        $brand = DB::table('brands')->get();
        return view('admin.product.create', compact('category', 'subcategories', 'brand'));
    }

    // Sub-category collect by AJAX request
    public function getSubcat($category_id)
    {
        $cat = DB::table('subcategories')->where('category_id', $category_id)->get();
        return json_encode($cat);
    }
}
