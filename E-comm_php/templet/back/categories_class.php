<?php
include 'adminconn.php';
class categories
{
    private $conn;
    public function __construct($db){
        $this->conn = $db;
    }
    
    public function showcatdata(){
        $sql    = "select * from categories";
        $result = $this->conn->prepare($sql);
        $result->execute();
        while($row=$result->fetch()){
          if(file_exists("img/{$row['cat_id']}.jpg")){
            $img = "<img src =\" img/{$row['cat_id']}.jpg\" width = '100px' height = '100px'/>";
          }else{
            $img = "no img";
          }
            echo <<<show
            <tr>
              <td>{$row['cat_id']}</td>
              <td>{$img}</td>     
              <td>{$row['cat_name']}</td>
              <td>
                <a href = "admin.php?categories_update&id={$row['cat_id']}">
                  <input type = "submit" class = "btn btn-primary" name = "update" value = "Update"/>
                </a>
                <a href = "admin.php?categories_delete&id={$row['cat_id']}">
                  <input type = "submit" class = "btn btn-primary" name = "delete" value = "Delete"/>
                </a>
              </td>
            </tr>
show;
        } 
    }
    public function deletecatdata($cat_id){
      $sql = "delete from categories where cat_id=$cat_id";
      $result = $this->conn->prepare($sql);
      $result->execute();
      if(file_exists("img/".$cat_id.".jpg")){
        unlink("img/".$cat_id.".jpg");
      }
      $this->set_message('Deleted successfully');
      return true;
    }
    public function addcatdata($catname){
      $sql = 'insert into categories(cat_name)values(?)';
      $result = $this->conn->prepare($sql);
      $result->execute(array($catname));
      $lastcatid =  $this->getlastcatid();
      $this->uploadfile($lastcatid);
      $this->set_message('added successfully');
    }

    public function updateCatData($catName,$catId){
      $sql = "update categories set cat_name = ? where cat_id =". $catId;
      $result = $this->conn->prepare($sql);
      $result->execute(array($catName));
      unlink('img/'.$_GET['id'].'.jpg');
      $this->uploadfile($_GET['id']);
      $this->set_message('updated successfully');
    }

    public function getCatById($cat_id){
      $sql = "select * from categories where cat_id = $cat_id";
      $result = $this->conn->prepare($sql);
      $result->execute();
      $row = $result->fetch();
      return $row;
    }

    public function getlastcatid(){
      $sql = 'select max(cat_id) as lastid from categories';
      $result = $this->conn->prepare($sql);
      $result->execute();
      $lastcatid = $result->fetch();
      return $lastcatid['lastid'];
    }
    public function uploadfile($catid){
      if($_FILES['cat_img']['tmp_name'] != "none"){
        move_uploaded_file($_FILES['cat_img']['tmp_name'],"img/".$catid.".jpg");
      }
    }
    public function set_message($msg){
      if(!empty($msg)){
        $_SESSION['message'] = $msg;
      }else{
        $msg = '';
      }
    }
    public function display_message(){
      if(isset($_SESSION['message'])){
      echo <<<message
            <div class="alert alert-success alert-dismissible"style="margin-bottom: 20px">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              {$_SESSION['message']}
            </div>
message;
        unset($_SESSION['message']);
      }
    }
    public function getCatNameCatId(){
      $sql = 'select cat_id,cat_name from categories';
      $result = $this->conn->prepare($sql);
      $result->execute();

      while($row = $result->fetch()){
        echo <<<selected
        <option value = "{$row['cat_id']}">{$row['cat_name']}</option>
selected;
      }
    }
}