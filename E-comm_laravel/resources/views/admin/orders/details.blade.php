@extends('admin.layouts.master')
@section('page')
Orders
@endsection
@section('content')
<div class="row">
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Order Details</h4>
            <p class="category">Order details</p>
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->date}}</td>
                        <td>{{$order->address}}</td>
                        <td>
                            @if($order->status)
                                <span class="label label-success">Confirmed</span>
                            @else
                                <span class="label label-warning">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($order->status)
                                {{link_to_route('order.pending','',$order->id,['class'=>'btn btn-sm btn-success ti-close','title'=>'pending'])}}
                            @else
                                {{link_to_route('order.confirm','',$order->id,['class'=>'btn btn-sm btn-success ti-check','title'=>'confirmed'])}}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card">
        <div class="header">
            <h4 class="title">User Details</h4>
            <p class="category">User Details</p>
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <td>{{$order->user->id}}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{$order->user->name}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$order->user->email}}</td>
                </tr>
                <tr>
                    <th>Registered At</th>
                    <td>{{$order->user->created_at->diffForHumans()}}</td>
                </tr>

                </thead>
            </table>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Product Details</h4>
            <p class="category">Product Details</p>
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table table-striped">
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                </tr>
                <tr>
                    <td>{{$order->id}}</td>
                    <td>
                            <table class="table">
                            @foreach($order->products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                </tr>
                            @endforeach
                            </table>
                    </td>
                    <td>
                            <table class="table">
                            @foreach($order->orderitems as $items)
                                <tr>
                                    <td>{{$items->price}}</td>
                                </tr>
                            @endforeach
                            </table>
                    </td>
                    <td>
                            <table class="table">
                            @foreach($order->orderitems as $items)
                                <tr>
                                    <td>{{$items->quantity}}</td>
                                </tr>
                            @endforeach
                            </table>
                    </td>
                    <td>
                           <table class="table">
                            @foreach($order->products as $product)
                                <tr>
                                    <td><img src="{{url('uploads').'/'.$product->image}}" alt="" style="width: 2em"></td>
                                </tr>
                            @endforeach
                            </table>
                    </td>
                </tr>
            </table>

        </div>
    </div>
    <a href="{{url('admin/orders')}}" class = "btn btn-success">Back To Orders</a>
</div>
</div>
@endsection
