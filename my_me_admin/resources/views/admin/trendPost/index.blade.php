@extends('admin.layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Order Table</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Image</th>
              <th>View Count</th>
           
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            <tr>
              <td>{{$item['post_id']}}</td>
              <td>{{$item['title']}}</td>
              <td><img class="rounded" width="100px" height="100px" 
                @if ($item['image'] == null)
                src="{{asset('defaultImage/Screenshot (176).png')}}"
                @else
                src="{{asset('postImage/'.$item['image'])}}"
                @endif
                ></td>
              
              <td class=""><i class="fa-regular fa-eye mr-2"></i>{{$item['post_count']}}</td>
              
              <td>
                <button class="btn btn-sm bg-dark text-white">
                  <a href="{{route('admin#trendPostDetail',$item['post_id'])}}"> <i class="fas fa-edit"></i> </a>
                </button>
              
              </td>
            </tr>
            @endforeach
           
          </tbody>
        </table>

        {{-- <div class="d-flex justify-content-center">
          {{$data->links()}}
        </div> --}}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection