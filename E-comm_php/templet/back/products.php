<?php
$db  = new crud();
$pro = new products($db->dbconn());

?>
    <h2 style="margin-top: 20px">Products</h2>
    <a href = "admin.php?products_add">
      <input type = "submit" class = "btn btn-primary" style="margin-bottom: 20px" name = "add" value = "Add"/>
    </a>
    <?php
     echo $pro->pro_display_message();
     ?>
    <table class="table  table-hover">
    <thead>
        <tr>
            <th>#ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Discription</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
$pro->showProData(); 
?>

    </tbody>
</table>