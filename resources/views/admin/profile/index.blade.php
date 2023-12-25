{{-- 
@extends('admin.layouts.app')
@section('content')
<form action="" method="post">
    @csrf
    <div class="row">
        <div class="col-2">Name</div>
    <div class="col-5">
        <input type="text" class=" form-control mt-2" placeholder="Enter name">
    </div>
    </div>
    <div class="row">
        <div class="col-2">Email</div>
    <div class="col-5">
        <input type="email" class=" form-control mt-2" placeholder="Enter email">
    </div>
    </div>
    <div class="row">
        <div class="col-2">Phone</div>
    <div class="col-5">
        <input type="" class=" form-control mt-2" placeholder="Enter Phone">
    </div>
    </div>
    <div class="row">
        <div class="col-2">Address</div>
    <div class="col-5">
        <textarea cols="30 " rows="10" class=" form-control mt-2" placeholder="Enter address"></textarea>
    </div>
    </div>
    <div class="mt-3" style="margin-left: 250px">
    <button class="btn bg-dark text-white" type="submit">Update</button>
    </div>
</form>
<a href="http://" style="margin-left: 360px" >Change Pasword</a>
@endsection --}}

@extends('admin.layouts.app')
@section('content')
<div class="col-8 offset-3 mt-5">
  <div class="col-md-9">
    <div class="card">
      <div class="card-header p-2">
        <legend class="text-center">User Profile</legend>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <form class="form-horizontal">
              <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputName" placeholder="Name">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                </div>
              </div>
              
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <a href="">Change Password</a>
                </div>
              </div>
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <button type="submit" class="btn bg-dark text-white">Submit</button>
                </div>
              </div>
            </form>
            
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

    
