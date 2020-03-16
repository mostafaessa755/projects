<?php include_once 'templet/front/header.php';?>
<div class="container" style="margin-top: 20px;margin-bottom: 40px">
  <h2>Shopping Cart</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Sub Total</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $Data2=cart($conn);
    echo $Data2['output'];?>
    </tbody>
  </table>
</div>
<div class="container" style="margin-top: 20px;margin-bottom:20px;">
  <div class="row">
    <div class="col-md-4">
  <h2>Cart Totals</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Items</th>
        <td><?php echo $Data2['items'];?></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>Shipping And Handling</th>
        <td>Free</td>
      </tr>
      <tr>
        <th>Order Totla</th>
        <td><?php echo $Data2['orders'];?></td>
      </tr>
    </tbody>
  </table>
    </div>
</div>
</div>

<?php include_once 'templet/front/footer.php';?>
