
@extends('admin.layouts.app')
@section('content')

<div class="col-12">
   {{-- alert start --}}
   @if (Session::has('deleteSuccess'))
   <div class="alert alert-success alert-dismissible fade show" role="alert">
       {{Session::get('deleteSuccess')}}
     <button type="button" class="close" data-dismiss="alert">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   @endif
   {{-- alert end --}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin List Page</h3>

        <div class="card-tools">
          <form method="post" action="{{ route('admin#listSearch')}}">
            @csrf
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="adminSearchKey" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>User ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone number</th>
              <th>Address</th>
              <th>Gender</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ( $adminList as $item)
            <tr>
              <td>{{$item['id']}}</td>
              <td>{{$item['name']}}</td>
              <td>{{$item['email']}}</td>
              <td>{{$item['phone']}}</td>
              <td>{{$item['address']}}</td>
              <td>{{$item['gender']}}</td>
              <td>
                {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
              @if (auth()->user()->id != $item['id'])
            <a @if(count($adminList)== 1)
                @else
            href="{{route('admin#listDelete',$item['id'])}}" @endif>
            <button class="btn btn-sm bg-danger text-white">
              <i class="fa fa-trash-alt"></i>
            </button>
            </a>
                
              @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection