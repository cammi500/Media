@extends('admin.layouts.app')
@section('content')
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('post#Create')}}" enctype="multipart/form-data"> 
                @csrf
                <div class="form-group">
                    <label>Post name</label>
                    <input type="text" name="postName" value="{{old('postName')}}" class="form-control" placeholder="Enter post name">
                    @error('postName')
                    <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Post Author</label>
                  <input type="text"name="postAuthor" value="{{old('postAuthor')}}" class="form-control" placeholder="Enter post author">{{old('postName')}}
                  @error('postAuthor')
                  <div class="text-danger">{{$message}}</div>
                @enderror
              </div>
                <div class="form-group">
                    <label>Discription</label>
                    <textarea type="text" name="postDescription" cols="10" rows="10" class="form-control" placeholder="Enter discription"></textarea>
                    @error('postDescription')
                    <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Image</label>
                  <input type="file" value="{{old('postImage')}}" name="postImage"  class="form-control" >
                  @error('postImage')
                  <div class="text-danger">{{$message}}</div>
                @enderror
              </div>
              <div class="form-group">
                <label>Category Name</label>
               <select name="postCategory" id="" class="form-control">
                <option value="">Choose Category..</option>
               @foreach ($category as $c)
                 <option value="{{$c['category_id']}}">{{$c['title']}}</option>"
               @endforeach
               </select>
                @error('postDescription')
                <div class="text-danger">{{$message}}</div>
              @enderror
            </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
<div class="col-7">
      @if (Session::has('deleteSuccess'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{Session::get('deleteSuccess')}}
        <button type="button" class="close" data-dismiss="alert">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Post Table</h3>
        <div class="card-tools">
          <form  action="">
            @csrf
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="postSearchKey" class="form-control float-right" placeholder="Search">
            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </form>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>Post ID</th>
              <th>Name</th>
              <th>Author</th>
              <th>Description</th>
              <th>Image</th>
              <th></th>
            
            </tr>
          </thead>
          <tbody>
            @foreach ($post as $item)
            <tr>
                <td>{{$item['post_id']}}</td>
                <td>{{$item['title']}}</td>
                <td>{{$item['author']}}</</td>
                <td>{{$item['description']}}</td>
                <td><img class="rounded" width="100px" height="100px" 
                  @if ($item['image'] == null)
                  src="{{asset('defaultImage/Screenshot (176).png')}}"
                  @else
                  src="{{asset('postImage/'.$item['image'])}}"
                  @endif
                  ></td>
                <td>
                 <a href="{{route('post#Edit',$item['post_id'])}}">
                  <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                </a>
                {{-- {{route('post#delete',$item['post_id'])}} --}}
                    <a href="{{route('post#Delete',$item['post_id'])}}">
                      <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                    </a>
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