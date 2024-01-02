<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
    //simple delete
    // public function deletePost($id){
    //     Post::where('post_id',$id)->delete();
    //     return redirect()->route('admin#post');
    // }
    public function deletePost($id){
        $postData = Post::where('post_id',$id)->first();
        $dbImageName =$postData['image'];

        Post::where('post_id',$id)->delete();

        if(File::exists(public_path().'/postImage/'.$dbImageName)){
            File::delete(public_path().'/postImage/'.$dbImageName);
        }
        return back();
    }
    
    //edit 
    public function editPost($id){
        $postDetail =Post::where('post_id',$id)->first();
        $category =Category::get();
        $post =Post::get();
        return view('admin.post.update',compact('postDetail','category','post'));

    }
   //update 
   public function updatePost($id,Request $request){
    // dd($request->all());
    $validator =$this->postValidationCheck($request);

    if($validator->fails()){
        return back()->withErrors($validator)->withInput();
    }
    $data =$this->requestUpdatePostData($request);
    // dd($data);
    // if photo shi
    if(isset($request->postImage)){
       $this->storeDataUpdateImage($id,$request,$data);
    }else{
        Post::where('post_id',$id)->update($data);
    }
    return back();
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
    //post update data
    private function requestUpdatePostData($request,){
        return  [
            'title' =>$request->postName,
            'author' => $request->postAuthor,
            'description'=>$request->postDescription,
            'category_id'=>$request->postCategory,
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
    //store function
    private function storeDataUpdateImage($id,$request,$data){
         //get from client
         $file = $request->file('postImage');
         $fileName =uniqid().'_'.$file->getClientOriginalName();
         //new array//put new image into data array
         $data['image'] =$fileName;
         //get image name for db
         $postData =Post::where('post_id',$id)->first();
         $dbImageName = $postData['image'];
         //delete old  image public folder
         if(File::exists(public_path().'/postImage/'.$dbImageName)){
             File::delete(public_path().'/postImage/'.$dbImageName);
         }
         //store new image under public folder
         $file->move(public_path().'/postImage',$fileName);
         //update new image under public folder
         Post::where('post_id',$id)->update($data);
    }
}
