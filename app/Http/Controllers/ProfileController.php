<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

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

        //change password get
        public function directChangePassword(){
            return view('admin.profile.changePassword');
        }

        //change password post
        public function changePassword(Request $request){
            // dd($request->all());
            $validator =$this->changePasswordValidationCheck($request);

            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            //database out same old with
                $dbData =User::where('id',Auth::user()->id)->first();
                $hashUserPassword =Hash::make($request->newPassword);
            
                //under array db update 
                $updateData =[
                    'password' =>$hashUserPassword,
                    'updated_at'=>Carbon::now()
                ];

                    if(Hash::check($request->oldPassword,$dbData->password)){
                        User::where('id',Auth::user()->id)->update($updateData);
                        return redirect()->route('dashboard');
                    }else{
                        return back()->with(['fail'=>'oldPassword does not match!']);
                    }
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
    
    //validation check user
    private function userValidationCheck($request){
         return Validator::make($request->all(),[
            'adminName' =>'required',
            'adminEmail' =>'required',
        ],[
            'adminName.required' =>'require admin feild',
        ]);
    }
        //validation check change password
        private function changePasswordValidationCheck($request){
            $validationRules = [
                'oldPassword'=>'required',
                'newPassword'=>'required|min:6|max:15',
                'confirmPassword'=>'required|same:newPassword|min:6|max:15',
            ];
            $validationMessages = [
                'confirmPassword.same'=> 'New password  and confirm password must be same'
            ];
            return Validator::make($request->all(),$validationRules,$validationMessages);
        }
}
