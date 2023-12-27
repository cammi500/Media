<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $category =category::get();
        return view('admin.category.index',compact('category'));
    }

    public function createCategory(Request $request){
        // dd($request->all());
        $validator= $this->categoryValidationCheck($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $data =$this->getCategoryData($request);
        Category::create($data);
        return back();
        }
        //delete
        public function deleteCategory($id){
            Category::where('category_id',$id)->delete();
            return redirect()->route('admin#category');
        }
        //search category
        public function searchCategory(Request $request){
            // dd($request->all());
            $category =Category::where('title','like','%'.$request->categorySearchKey.'%')
                                    ->OrWhere('description','like','%'.$request->categorySearchKey.'%')            
                                    ->get();
            return view('admin.category.index',compact('category'));
        }
        //edit
        public function editCategory($id){
            $categoryUpdate =Category::where('category_id',$id)->first();
            $category =Category::get();
            return view('admin.category.edit',compact('categoryUpdate','category'));
        }
        //update category
        public function updateCategory($id,Request $request){
            $validator =$this->categoryValidationCheck($request);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $updateData = $this->getUpdateData($request);
            Category::where('category_id',$id)->update($updateData);
            return redirect()->route('admin#category');

        }


    //validation check
    private function categoryValidationCheck($request){
        $validationRules = [
            'categoryName' =>'required',
            'categoryDescription'=>'required',
        ];
        return Validator::make($request->all(),$validationRules);
    }    

    //get updated category data
    private function getUpdateData($request){
        return
        [
            'title' => $request->categoryName,
                'description' => $request->categoryDescription,
                'updated_at' => Carbon::now()
        ];
    }
    //get category data
    private function getCategoryData($request){
        return
            [
                'title' => $request->categoryName,
                'description' => $request->categoryDescription,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        
    }
}
