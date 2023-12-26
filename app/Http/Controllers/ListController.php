<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct admin list
    public function index(){
        $adminList = User::select('id','name','email','phone','address','gender')->get();
        return view('admin.list.index',compact('adminList'));
    }
    //delete admin account
    public function accountDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User Account Deleted']);
    }
    //admin list search or where one or one
    public function adminListSearch(Request $request){
        $adminList =User::where('name','Like','%'.$request->adminSearchKey.'%')
                            ->orWhere('email','Like','%'.$request->adminSearchKey.'%')
                            ->orWhere('phone','Like','%'.$request->adminSearchKey.'%')
                            ->orWhere('address','Like','%'.$request->adminSearchKey.'%')
                            ->orWhere('gender','Like','%'.$request->adminSearchKey.'%')
                             ->get();
        return view('admin.list.index',compact('adminList'));
    }
}
