@extends('layouts.app')
@section('title','Blogs')
@section('content')
<div class="container ">
    <div class="row text-center">
        <div class="col-md-12">
            <div class="title">
                <h1>Blogs</h1>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
                @if (session()->has('done'))
                    <div class="alert alert-success ">{{session()->get('done')}}</div>
                @endif
        </div>
        <div class="col-md-2">
            <a href="/create" class="btn btn-primary">Add New Blog</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">
                    DataBase Blog
                </div>
                <div class="card-body">
                        <ul class="list-group">
                            @forelse ($blogs as $blog)
                            <li class="list-group-item">
                                <div class="float-left">
                                    {{$blog->title}}
                                </div>
                                <div class="float-right">
                                    @if (!$blog->complited)
                                    <a href="/complited/{{$blog->id}}"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="pending"><i class="far fa-square"></i></a>
                                    @else
                                    <a href="/complited/{{$blog->id}}"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="complited"><i class="far fa-check-square"></i></a>
                                    @endif
                                    <a href="/show/{{$blog->id}}"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Show"><i class="fas fa-eye"></i></a>
                                    <a href="/update/{{$blog->id}}"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Edite"><i class="fas fa-edit"></i></a>
                                    <a href="/delete/{{$blog->id}}"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Delete"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </li>
                            @empty
                            <p class="text-center"> Blog is empty !.. Add one</p>
                            @endforelse
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
