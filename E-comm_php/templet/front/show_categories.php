<?php 
include 'conn.php';
$result = $conn->prepare('select * from categories');
$result->execute();
//$output = '';
while($row = $result->fetch()){
$output=<<<CA
<!-- shop -->
<div class="col-md-4 col-xs-6">
	<div class="shop">
		<div class="shop-img">
			<img src="templet/back/img/{$row['cat_id']}.jpg" alt="">
		</div>
		<div class="shop-body">
			<h3>{$row['cat_name']}<br>Collection</h3>
			<a href="pro_cat.php?id={$row['cat_id']}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>
<!-- /shop -->
CA;
echo $output;
}

