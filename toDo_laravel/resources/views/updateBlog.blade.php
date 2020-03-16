@extends('layouts.app')
@section('title','Update Blog')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-4 pt-3">
            <div class="float-right ">
                <a href="/" class="btn btn-primary">Back</a>
            </div>
            <div class="card d-inline-block mt-4">
                <div class="card-header">
                    <h2>Update Blog</h2>
                </div>
                <div class="card-body">
                <form action="/update/{{$blog->id}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input  name="title"
                                    type="text"
                                    placeholder="enter title"
                                    value="{{$blog->title}}"
                                    class="form-control @error('title') is-invalide @enderror">
                            @error('title')
                            <div class="alert alert-warning" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Description">Description:</label>
                            <textarea name="desc"
                                        placeholder="enter description"
                                        cols="30"
                                        rows="5"
                        class="form-control @error('desc') is-invalide @enderror">{{$blog->description}}</textarea>
                            @error('desc')
                            <div class="alert alert-warning" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <button type="submit"  class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
