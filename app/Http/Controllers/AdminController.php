<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::get();
        $categories = DB::table('categories')->get();
        return view('admin', compact('product', 'categories'));
    }

    public function addProduct(Request $request) {
        DB::table('products')->insert([
            'name' => $request->nameProduct,
            'price' => $request->costProduct,
            'description' => $request->description,
            'id_category' => $request->id_category,
            'img' => $request->imgProduct,
        ]);

        return redirect()->back()->with('messageAddProduct', 'Product added successfully');
    }

    public function dellProduct(Request $request){
        DB::table('products')->where('id_product','=',$request->id_product)->delete();
        return redirect()->back()->with('messageDellProduct','Product deleted succesfuly');
    }


    public function addCategory(Request $request){
        DB::table('categories')->insert(['name'=>$request->nameCategory]);
        return redirect()->back()->with('messageAddCategory','Category added succesfuly');
    }

    public function dellCategory(Request $request){
        DB::table('categories')->where('id_category','=',$request->id_category)->delete();
        return redirect()->back()->with('messageDellCategory','Category deleted succesfuly');
    }
}
