<?php include 'conn.php';
$result = $conn->prepare('select * from products order by pro_id desc');
$result->execute();
$output = '';
while($row = $result->fetch()){
$result2 = $conn->prepare("select cat_name from categories where cat_id = ?");
$result2->execute(array($row['cat_id']));
foreach($result2->fetch() as $val){
$cat_name = $val;
}

$output .= '
<!-- product -->
<div class="product">
	<div class="product-img">
		<img src="templet/back/img/pro_'.$row['pro_id'].'/1.jpg" alt="">
	</div>
	<div class="product-body">
		<p class="product-category">'.$cat_name.'</p>
		<h3 class="product-name"><a href="product.php?id='.$row['pro_id'].'">'.$row['pro_name'].'</a></h3>
		<h4 class="product-price">$'.$row['pro_price'].'<del class="product-old-price">$990.00</del></h4>
		<div class="product-rating">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
		</div>
		<div class="product-btns">
			<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
			<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
			<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
		</div>
	</div>
	<div class="add-to-cart">
	<a href="templet/front/cart.php?pro_add='.$row['pro_id'].'">
		<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
	</a>
	</div>
</div>
<!-- /product -->';
}
echo $output;