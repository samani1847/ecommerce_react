<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\SubSubcategory;
use App\Model\Admin\Category;
use Rest, Validator;

class SubcategoryController extends Controller
{
    public function data(Request $request)
    {
        $all = Subcategory::all();
        return response()->json(['data'=>$all]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->fieldRules());
        
         if ($validator->fails()) {
             
             return Rest::error('Invalid Parameters');
         }
 
         try{
             $Subcategory = Subcategory::findOrFail($id);
             $Subcategory->update(['name' => $request->name, 'status' => $request->status]);    
             return Rest::success('Subcategory updated successfully', Subcategory::all());
 
         }catch(Exception $e){
             return Rest::error('Error saving Subcategory');
         }
 
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), $this->fieldRules());
        
         if ($validator->fails()) {
             
             return Rest::error('Invalid Parameters');
         }
 
         try{
             Subcategory::create(['name' => $request->name, 'status' => $request->status]);    
             return Rest::success('Subcategory updated successfully', Subcategory::all());
 
         }catch(Exception $e){
             return Rest::error('Error saving Subcategory');
         }    
    }

    public function deleteData($id){
        
        try{
            $Subcategory = Subcategory::findOrFail($id);
            $Subcategory->delete();

            return Rest::success('Subcategory is deleted', Subcategory::all());

        } catch(Exception $e){
           
            return Rest::error('Error deleting data');

        }
    }

  public function get($id){
       
        try{
            $Subcategory = Subcategory::findOrFail($id);
            return Rest::success('success', $Subcategory);

        } catch(Exception $e){
           
            return Rest::error('Error saving data');

        }
    }

    public function getListCategory(){

        try{
            $category = Category::all();

        } catch(Exception $e){

            return Rest::error('error Getting Data');
        }
    }


    private function fieldRules(){
        return [
            'name' => 'required'
        ];
    }
}
