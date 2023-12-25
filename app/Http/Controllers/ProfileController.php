<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct admin
    public function index(){
        $id =Auth::user()->id;
        // dd($id);
        $user= User::select('id','name','email','phone','address','gender')->where('id',$id)->first();
        // dd($user->toArray());
        return view('admin.profile.index',compact('user'));
    }


    //update admin.profile
    public function updateAdmin(Request $request){
        // dd($request->all());
        $userData =$this->getUserInfo($request);

        $validator =$this->userValidationCheck($request);

        if($validator->fails()){
            return back()->withErrors($validator)
                         ->withInput();
        }
        // လက်ရှိ id ၀ငိတာကို update 
        User::where('id',Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess' => 'Admin account updated']);
    }
    //get user info function 
    private function getUserInfo($request){
        return[
            'name' =>$request->adminName,
            'email' =>$request->adminEmail,
            'address' =>$request->adminAddress,
            'phone' =>$request->adminPhone,
            'gender' =>$request->adminGender,
            'updated_at' =>Carbon::now(),
        ];
    }
    //validation check
    private function userValidationCheck($request){
         return Validator::make($request->all(),[
            'adminName' =>'required',
            'adminEmail' =>'required',
        ],[
            'adminName.required' =>'require admin feild',
        ]);
    }

}
