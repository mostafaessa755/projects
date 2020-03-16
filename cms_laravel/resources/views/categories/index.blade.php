@extends('layouts.app')
@section('contentLoad')
    <div class="card">
        <div class="card card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>Categories</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{route('categories.create')}}" class="btn btn-primary">Add Category</a>
                </div>
            </div>
        </div>
        <div class="card card-body">
            @if (session()->has('msg'))
                <div class="alert alert-success">{{session()->get('msg')}}</div>
            @endif
            @if ($categorys->count() > 0)
                @foreach ($categorys as $category)
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>{{$category->name}}</h5>
                                    <p>{{$category->updated_at->diffForHumans()}}</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('categories.edit',$category->id)}}"
                                       title="Edit {{$category->id}}"
                                       style="font-size:21px;">
                                        <i class="fas fa-edit fa-l"></i>
                                    </a>
                                    <form action="{{route('categories.destroy',$category->id)}}"
                                          method="POST"
                                          class=" d-inline-block ">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit"
                                                title="Delete {{$category->id}}"
                                                class="btn btn-warning btn-sm"
                                                value="Delete" />
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class=" text-center">no categories added ...! <a href="{{route('categories.create')}}"> add one </a></p>
            @endif
        </div>
    </div>
@endsection
