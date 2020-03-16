@extends('layouts.app')
@section('contentLoad')
    <div class="card">
        <div class="card card-header">
            <div class="row">
                <div class="col-md-6">
                <h4>Add post</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{route('posts.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card card-body">
            <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="post Title">Title:</label>
                    <input type="text"
                           class="form-control  @error('title') is-invalid @enderror"
                           placeholder="Enter post Title"
                           name="title">
                           @error('title')
                                <div class="alert alert-warning">{{$message}}</div>
                           @enderror
                  </div>
                  <div class="form-group">
                    <label for="post Description">Description:</label>
                    <textarea class="form-control  @error('description') is-invalid @enderror"
                              placeholder="Enter post Description"
                              name="description"></textarea>
                              @error('description')
                                <div class="alert alert-warning">{{$message}}</div>
                              @enderror
                  </div>
                  <div class="form-group">
                    <label for="post content">Content:</label>
                    <textarea class="form-control  @error('content') is-invalid @enderror"
                              placeholder="Enter post Content"
                              name="content"></textarea>
                              @error('content')
                                    <div class="alert alert-warning">{{$message}}</div>
                              @enderror
                  </div>
                  <div class="form-group">
                    <label for="post Image">Image:</label>
                    <input type="file"
                           class="form-control  @error('image') is-invalid @enderror"
                           placeholder="Enter post Image"
                           name="image">
                           @error('image')
                                <div class="alert alert-warning">{{$message}}</div>
                           @enderror
                  </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
