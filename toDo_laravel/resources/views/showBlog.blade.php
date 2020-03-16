@extends('layouts.app')
@section('title','Blog - '.$blog->id)

@section('content')
<div class="container ">
    <div class="row justify-content-center pt-5 text-center">
        <div class="col-md-8">
            <h2>{{$blog->title}}</h2>
        </div>
    </div>
    <div class="row justify-content-center  text-center">
        <div class="col-md-8">
            <div class="float-right">
                <a href="/" class="btn btn-primary">Back</a>
            </div>
            <div class="card mt-5">
                <div class="card-header">
                    <div class="float-left">Description</div>
                    <div class="float-right">
                        @if($blog->complited)
                        <span class="badge  badge-success">complited</span>
                        @else
                        <span class="badge  badge-warning">pending</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <p class="float-left">{{$blog->description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

