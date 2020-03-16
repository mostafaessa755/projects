@extends('admin.layouts.master')

@section('page')
User_Details
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
                    <th>Order_ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    
                </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>
                            @foreach($order->products as $item)
                              <li>{{$item->name}}</li>
                            @endforeach
                        </td>
                        <td>
                            @foreach($order->orderitems as $item)
                              <li>{{$item->quantity}}</li>
                            @endforeach
                        </td>
                        <td>
                            @foreach($order->products as $item)
                              <li>{{$item->price}}</li>
                            @endforeach
                        </td>
                        <td>
                            {{$order->date}}  
                        </td>
                        <td>
                            @if($order->status)
                                <span class="label label-success">Confirmed</span>
                            @else
                                <span class="label label-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- <div class="col-md-6">
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
                    <td>2</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>ahmed</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>ahmed@gmail.com</td>
                </tr>
                <tr>
                    <th>Registered At</th>
                    <td>---</td>
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
                    <td>--</td>
                    <td>
                    
                            <table class="table">
                                <tr>
                                    <td>---</td>
                                </tr>
                            </table>
                     
                    </td>

                    <td>
                        
                            <table class="table">
                                <tr>
                                    <td>--</td>
                                </tr>
                            </table>
                        
                    </td>
                    <td>
                        
                            <table class="table">
                                <tr>
                                    <td>--</td>
                                </tr>
                            </table>

                    </td>
                    <td>
                        
                            <table class="table">
                                <tr>
                                    <td><img src="" alt="" style="width: 2em"></td>
                                </tr>
                            </table>
                    
                    </td>
                </tr>

            </table>

        </div>
    </div>
</div> -->
</div>
@endsection