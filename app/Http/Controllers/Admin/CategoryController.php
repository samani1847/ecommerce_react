<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use Rest, Validator;

class CategoryController extends Controller
{
    public function data(Request $request)
    {
        $all = Category::all();
        return response()->json(['data'=>$all]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->fieldRules());
        
         if ($validator->fails()) {
             
             return Rest::error('Invalid Parameters');
         }
 
         try{
             $category = Category::findOrFail($id);
             $category->update(['name' => $request->name, 'status' => $request->status]);    
             return Rest::success('Category updated successfully', Category::all());
 
         }catch(Exception $e){
             return Rest::error('Error saving category');
         }
 
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), $this->fieldRules());
        
         if ($validator->fails()) {
             
             return Rest::error('Invalid Parameters');
         }
 
         try{
             Category::create(['name' => $request->name, 'status' => $request->status]);    
             return Rest::success('Category updated successfully', Category::all());
 
         }catch(Exception $e){
             return Rest::error('Error saving category');
         }    
    }

    public function deleteData($id){
        
        try{
            $category = Category::findOrFail($id);
            $category->delete();

            return Rest::success('Category is deleted', Category::all());

        } catch(Exception $e){
           
            return Rest::error('Error deleting data');

        }
    }

  public function get($id){
       
        try{
            $category = Category::findOrFail($id);
            return Rest::success('success', $category);

        } catch(Exception $e){
           
            return Rest::error('Error saving data');

        }
    }


    private function fieldRules(){
        return [
            'name' => 'required'
        ];
    }
  
}
