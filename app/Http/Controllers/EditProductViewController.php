<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditProductViewController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editProductView($id)
    {
        $categories = DB::table('categories')->get(); 
        $product = DB::table('products')->where('id_product', '=', $id)->first();
        return view('editProductView', compact('product', 'categories'));
    }

    public function editProduct($id, Request $request)
    {
        DB::table('products')->where('id_product', '=', $id)->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'id_category' => $request->id_category,
            'description' => $request->description
        ]);
        if(isset($request->image)){
            $img = $request->file('img');
            $typeImg = $img->extension();

            $uniqName = Str::random();
            $nameImg = $uniqName.'.'.$typeImg;
            $pathFolder = 'assets/img/';

            $img->move(public_path($pathFolder), $nameImg);

            DB::table('product')->where('id_product', '=', $id)->update([
                'image'=>$pathFolder . $nameImg
            ]);
        }
        
        return redirect()->back()->with('message', 'Product editing successfully');
    }
}
