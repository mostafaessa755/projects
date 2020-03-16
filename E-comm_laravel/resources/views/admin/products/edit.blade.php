@extends('admin.layouts.master')

@section('page')
  Edit Product
@endsection

@section('content')
<div class = 'row'>
    <div class = 'col-lg-10 col-md-10'>
        <div class = 'card'>
            <div class = 'header'>
                <h4 class = 'title'>Edit Product</h4>
            </div>
            <div class = 'content'>
                @include('admin.layouts.message')
                {!!Form::open(['url' => ['admin/products',$product->id],'files' => 'true','method'=>'PUT'])!!}
                    <div class = 'row'>
                        <div class = 'col-md-12'>
                            <div class = 'form-group {{$errors->has("name")?"has-error":""}}'>
                                {{Form::label('product_name','Product Name:')}}
                                {{Form::text('name',$product->name,['class'=>'form-control border-input'])}}
                                <span>
                                    {{$errors->has('name')?$errors->first('name'):""}}
                                </span>
                            </div>
                            <div class = 'form-group {{$errors->has("price")?"has-error":""}}'>
                                {{Form::label('product_price','Product Price:')}}
                                {{Form::text('price',$product->price,['class' =>'form-control border-input'])}}
                                <span>
                                    {{$errors->has('price')?$errors->first('price'):""}}
                                </span>
                            </div>
                            <div class = 'form-group {{$errors->has("description")?"has-error":""}}'>
                                {{Form::label('product_description','Product Description:')}}
                                {{Form::textarea('description',$product->description,['class' => 'form-control border-input','cols' => '30','rows' => '10'])}}
                                <span>
                                    {{$errors->has('description')?$errors->first('description'):""}}
                                </span>
                            </div>
                            <div class = 'form-group {{$errors->has("image")?"has-error":""}}'>
                                {{Form::label('product_image','Product Image:')}}
                                {{Form::file('image',['class' => 'form-control border-input','id' => 'image'])}}
                                <div id="thumb-output"></div>
                                <span>
                                    {{$errors->has('image')?$errors->first('image'):""}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        {{Form::submit('Update Product',['class' => 'btn btn-info btn-fill btn-wd'])}}
                    </div>
                    <div class = 'clearfix'></div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
@endsection
