<?php 
$db  = new crud();
$cat = new categories($db->dbconn());
$row = $cat->getCatById($_GET['id']);
if(isset($_POST['update'])){
$cat->updateCatData($_POST['cat_name'],$_POST['cat_id']);
header('location:admin.php?categories');

}
?>
<form action = "" method = "POST" enctype = "multipart/form-data">
<h2 style="margin-top: 20px"> Update Categories</h2>

  <table class = "table table-hover" style="margin-top:20px">
    <tr>
      <td>
        <label>Categorie Name:</label>
      </td>
      <td>
        <input type = "text" name = "cat_name" class = "form-control" value = "<?php echo $row['cat_name']?>"/>
      </td>
      <td rowspan = "3">
        <div style="width: 200px;height:200px;margin:auto;">
        <?php           
          if(file_exists("img/{$row['cat_id']}.jpg"))
          {
            $img = "<img src =\" img/{$row['cat_id']}.jpg\" width = '200px' height = '200px'/>";
          }else{
            $img = "no img";
          }
          echo $img;
        ?>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <label>Categorie Image:</label>
      </td>
      <td>
        <input type = "file" name = "cat_img" MAX_FILE_SIZE = "30000"/>
      </td>
    </tr>
    <tr>
      <td colspan = "2">
        <center>
          <input type="hidden" name="cat_id" value="<?php echo $row['cat_id']?>"/>
          <input type = "submit" name = "update" class = "btn btn-primary" value = "Add"/>
        <center/>
      </td>
    </tr>
  </table>
</form>