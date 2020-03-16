<?php 
include 'categories_class.php';

if(isset($_SESSION['uname']) && !empty($_SESSION['uname'])){
include 'header.php';
include 'products_class.php';
?>
<div class = "container">
<?php
if(isset($_GET['categories'])){
    include 'categories.php';
}
else if(isset($_GET['categories_add'])){
    include 'categories_add.php';
}
else if(isset($_GET['categories_update']) && isset($_GET['id'])){
    include "categories_update.php";
}
else if(isset($_GET['categories_delete'])){
    
    $db  = new crud();
    $cat = new categories($db->dbconn());
    $cat->deletecatdata($_GET['id']);
    include 'categories.php';
}
else if(isset($_GET['products'])){
    include 'products.php';
}
else if(isset($_GET['products_add'])){
    include 'products_add.php';
}
else if(isset($_GET['products_update'])){
    include 'products_update.php';
}
else if(isset($_GET['products_delete'])){
    
    $db  = new crud();
    $pro = new products($db->dbconn());
    $pro->deleteProData($_GET['id']);
    include 'products.php';
}
?>
</div>
<?php include 'footer.php';}else{
    header("Location:../../login.php");
}?>
