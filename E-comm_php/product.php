<?php 
	include 'templet/front/conn.php';
	include 'templet/front/header.php';
	$result=$conn->prepare("select * from products where pro_id=?");
	$result->execute(array($_GET['id']));
	$row = $result->fetch();
?>

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<?php
							 $row_file = scandir("templet/back/img/pro_".$row['pro_id']);
							 foreach($row_file as $val){
								if(strstr($val,".jpg")){
							?>
							<div class="product-preview">
								<img src="templet/back/img/pro_<?php echo $row['pro_id'] ."/".$val;?>" alt="">
							</div>
							 <?php }}?>
							<!-- <div class="product-preview">
								<img src="./img/product03.png" alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product06.png" alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product08.png" alt="">
							</div> -->
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<?php
							 $row_file = scandir("templet/back/img/pro_".$row['pro_id']);
							 foreach($row_file as $val){
								 if(strstr($val,".jpg")){?>
							<div class="product-preview">
								<img src="templet/back/img/pro_<?php echo $row['pro_id'] ."/".$val;?>" alt="">
							</div>
							<?php }}?>
							<!-- <div class="product-preview">
								<img src="./img/product03.png" alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product06.png" alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product08.png" alt="">
							</div> -->
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?php echo $row['pro_name']?></h2>
							<div>
								<h3 class="product-price">$<?php echo $row['pro_price']?></h3>
								<span class="product-available">In Stock</span>
							</div>
							<p><?php echo $row['pro_desc']?></p>
							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div>
					<!-- /Product details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
<?php include 'templet/front/footer.php';?>
