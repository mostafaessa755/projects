<?php 
if(isset($_POST['add'])){
  $db  = new crud;
  $cat = new categories($db->dbconn());
  $cat-> addcatdata($_POST['cat_name']);
  header('location:admin.php?categories');
}
?>
<form action = "" method = "POST" enctype = "multipart/form-data">
<h2 style="margin-top: 20px"> Add Categories</h2>

  <table class = "table table-hover" style="margin-top: 20px">
    <tr>
      <td>
        <label>Categorie Name:</label>
      </td>
      <td>
        <input type = "text" name = "cat_name" class = "form-control"/>
      </td>
      <td rowspan = "3">
        <div style = "width: 200px;height: 200px;margin: auto;">Add Your Img : )</div>
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
          <input type = "submit" name = "add" class = "btn btn-primary" value = "Add"/>
        <center/>
      </td>
    </tr>
  </table>
</form>