@extends('admin.layouts.app')
@section('content')
<div class="col-8 offset-3 mt-5">
  <div class="col-md-9">
    <div class="card">
      <div class="card-header p-2">
        <legend class="text-center">Change Password</legend>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="active tab-pane" id="activity">

            {{-- alert start --}}
            @if (Session::has('fail'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get('fail')}}
              <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            @if (Session::has('updateSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get('updateSuccess')}}
              <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            {{-- alert end --}}

            <form class="form-horizontal" method="post"  action="{{route('admin#changePassword')}}">
              @csrf
              <div class="form-group row">
                <label for="inputName" class="col-sm-4 col-form-label">Old Password</label>
                <div class="col-sm-8">
                  <input type="password" name="oldPassword"  class="form-control"  placeholder="Enter Your Old Password" >
                @error('oldPassword')
                  <div class="text-danger">{{$message}}</div>
                @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail"  class="col-sm-4 col-form-label">New Password</label>
                <div class="col-sm-8">
                  <input type="password" name="newPassword" class="form-control"  placeholder="Enter Your New Password" >
                  @error('newPassword')
                  <div class="text-danger">{{$message}}</div>
                @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail"  class="col-sm-4 col-form-label">Confirm Password</label>
                <div class="col-sm-8">
                  <input type="password" name="confirmPassword" class="form-control"  placeholder="Enter Your Confirm Password">
                  @error('confirmPassword')
                  <div class="text-danger">{{$message}}</div>
                @enderror
                </div>
              </div>
              

              
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <button type="submit" class="btn bg-dark text-white">changePassword</button>
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

    
