<?php
$db  = new crud();
$cat = new categories($db->dbconn());
?>
    <h2 style="margin-top: 20px">Categories</h2>
    <a href = "admin.php?categories_add">
      <input type = "submit" class = "btn btn-primary" style="margin-bottom: 20px" name = "add" value = "Add"/>
    </a>
    <?php echo $cat->display_message();?>
    <table class="table  table-hover">
    <thead>
        <tr>
            <th>#ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
$cat->showcatdata(); 
?>

    </tbody>
</table>