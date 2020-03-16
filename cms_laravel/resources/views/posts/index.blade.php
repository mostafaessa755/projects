@extends('layouts.app')
@section('contentLoad')
    <div class="card">
        <div class="card card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>Posts</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{route('posts.create')}}" class="btn btn-primary">Add Post</a>
                </div>
            </div>
        </div>
        <div class="card card-body">
            @if (session()->has('msg'))
                <div class="alert alert-success">{{session()->get('msg')}}</div>
            @endif
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-4">
                                <img src="{{asset('storage/'.$post->image)}}" width="100%" height="100%" alt="">
                                </div>
                                <div class="col-md-4">
                                    <h5>{{$post->title}}</h5>
                                </div>
                                <div class="col-md-4 text-right">
                                    <a href="{{route('posts.show',$post->id)}}"
                                        title="Edit {{$post->id}}"
                                        style="font-size:21px;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{route('posts.edit',$post->id)}}"
                                       title="Edit {{$post->id}}"
                                       style="font-size:21px;">
                                        <i class="fas fa-edit fa-l"></i>
                                    </a>
                                    <form action="{{route('posts.destroy',$post->id)}}"
                                          method="POST"
                                          class=" d-inline-block ">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit"
                                                title="Delete {{$post->id}}"
                                                class="btn btn-warning btn-sm"
                                                value="Delete" />
                                        </form>
                                        <p>{{$post->updated_at->diffForHumans()}}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class=" text-center">no posts added ...! <a href="{{route('posts.create')}}"> add one </a></p>
            @endif
        </div>
    </div>
@endsection
