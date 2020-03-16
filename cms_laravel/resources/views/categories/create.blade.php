@extends('layouts.app')
@section('contentLoad')
    <div class="card">
        <div class="card card-header">
            <div class="row">
                <div class="col-md-6">
                <h4>{{isset($category) ? 'Update ': 'Add '}}Category</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{route('categories.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card card-body">
            <form action="{{isset($category)?
            route('categories.update',$category->id) :
            route('categories.store')}}" method="POST">
                @csrf
                @if(isset($category))
                @method('PUT')
                @endif
                <div class="form-group">
                    <label for="category">Category Name:</label>
                    <input type="text"
                           class="form-control  @error('name') is-invalid @enderror"
                           placeholder="Enter Category Name"
                           name="name"
                           value="{{isset($category)? $category->name :''}}">
                           @error('name')
                                <div class="alert alert-warning">{{$message}}</div>
                           @enderror
                  </div>
                <button type="submit" class="btn btn-primary">{{isset($category)?'Update':'Create'}}</button>
            </form>
        </div>
    </div>
@endsection
