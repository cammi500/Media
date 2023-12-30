<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(){
        $category =Category::get();
        $post = Post::get();
        return view('admin.post.index',compact('category', 'post'));
    }   //4
    public function postCreate(Request $request){
        // dd($request->all());
        $validator =$this->postValidationCheck($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        //if ka photo is add or not
        if(!empty($request->postImage)){
            //image
        $file = $request->file('postImage');
        $fileName =uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/postImage',$fileName);
        //database save
        $data =$this->getPostData($request,$fileName);
        }else{
        //database save no if photo
        $data =$this->getPostData($request,Null);
        }
        Post::create($data);
        return back();
        // dd($data);
    }
    //image function
    private function getPostData($request,$fileName){
        return [
            'title' =>$request->postName,
            'author' => $request->postAuthor,
            'description'=>$request->postDescription,
            'image'=>$fileName,
            'category_id'=>$request->postCategory,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
    }
    //validation check for
    private function postValidationCheck($request){
        return Validator::make($request->all(), [
            'postName' =>'required',
            'postAuthor' =>'required',
            'postDescription'=>'required',
            'postCategory'=>'required',
        ]);

    }
}
