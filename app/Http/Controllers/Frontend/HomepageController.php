<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Product;
use App\Model\Admin\Category;
use DB;

class HomepageController extends Controller
{
    public function homedata(Request $request)
    {
        $data = array();

        $categories = Category::all(); 

        if($cat_id = $request->input('cat_id')){

            $category = Category::findOrFail($cat_id);
                
            $products = DB::table('product')->join('subcategory','subcategory.id','=','product.subcategory_id')
                        ->join('category', 'category.id','=','subcategory.category_id')
                        ->where('category.id','=', $category->id)
                        ->select('product.name','product.id', 'product.price', 'product.image')
                        ->get();
            
            $data[$category->name] = $products;            
            
            
        } else {

            foreach ($categories as $key => $category) {
                
                $products = DB::table('product')->join('subcategory','subcategory.id','=','product.subcategory_id')
                            ->join('category', 'category.id','=','subcategory.category_id')
                            ->where('category.id','=', $category->id)
                            ->select('product.name','product.id', 'product.price', 'product.image','subcategory.category_id')
                            ->limit(5)
                            ->get();
                if($products)
                {
                    $data[$category->name] = $products;
                }            
            }
        }
        
        return response()->json(['product' => $data, 'category' => $categories]);


    }

    public function detailProduct($id)
    {
        $product = Product::findorFail($id);
        return response()->json(['data' => $product]);
    }
   
}
