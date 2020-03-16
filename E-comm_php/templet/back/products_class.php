<?php 
class products{
    private $coo;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function showProData(){
        $sql    = "SELECT products.pro_id,products.pro_name,products.pro_price,products.pro_desc,products.pro_qty,categories.cat_name FROM products INNER JOIN categories ON products.cat_id=categories.cat_id";
        $result = $this->conn->prepare($sql);
        $result->execute();
        while($row=$result->fetch()){
          if(is_dir("img/pro_{$row['pro_id']}")){
            $img = "<img src =\" img/pro_{$row['pro_id']}/1.jpg\" width = '100px' height = '100px'/>";
          }else{
            $img = "no image";
          }
            echo <<<show
            <tr>
              <td>{$row['pro_id']}</td>
              <td>{$img}</td>     
              <td>{$row['pro_name']}</td>
              <td>{$row['pro_price']}</td>
              <td>{$row['pro_desc']}</td>
              <td>{$row['pro_qty']}</td>
              <td>{$row['cat_name']}</td>
              <td>
                <a href = "admin.php?products_update&id={$row['pro_id']}">
                  <input type = "submit" class = "btn btn-primary" name = "update" value = "Update"/>
                </a>
                <a href = "admin.php?products_delete&id={$row['pro_id']}">
                  <input type = "submit" class = "btn btn-primary" name = "delete" value = "Delete"/>
                </a>
              </td>
            </tr>
show;
        }
    }

    public function addProData($pro_name,$pro_price,$pro_des,$cat_id,$pro_qty){
        $sql = 'insert into products values(null,?,?,?,?,?)';
        $result = $this->conn->prepare($sql);
        $result->execute(array($pro_name,$pro_price,$pro_des,$cat_id,$pro_qty));
        $lastcatid =  $this->getLastProId();
        $this->uploadfile($lastcatid);
        $this->set_message('added successfully');
      }
  

      public function updateProData($pro_id,$pro_name,$pro_price,$pro_des,$cat_id,$pro_qty){
        $sql = "update products set pro_name = ?,
                                    pro_price=?,
                                    pro_desc=?,
                                    cat_id=?,
                                    pro_qty=?
                                    where pro_id =". $pro_id;
        $result = $this->conn->prepare($sql);
        $result->execute(array($pro_name,$pro_price,$pro_des,$cat_id,$pro_qty));
        $row = $this->getProById($pro_id);
        if(is_dir("img/pro_{$row['pro_id']}")){
          array_map('unlink',glob("img/pro_{$row['pro_id']}/*.*"));
            rmdir("img/pro_$pro_id");
            $this->uploadfile($pro_id);
            $this->set_message('updated successfully');
          }

      }

      public function getProById($pro_id){
        $sql = "select * from products where pro_id = $pro_id";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $row = $result->fetch();
        return $row;
      }

      public function getLastProId(){
        $sql = 'select max(pro_id) as lastid from products';
        $result = $this->conn->prepare($sql);
        $result->execute();
        $lastProId = $result->fetch();
        return $lastProId['lastid'];
      }

      public function uploadfile($ProId){
        if(file_exists($_FILES['pro_img']['tmp_name'][0])){
          if(!is_dir("img/pro_$ProId")){
            mkdir("img/pro_$ProId",0777);
            $rowCount = count($_FILES['pro_img']['tmp_name']);
            for($i = 0;$i<$rowCount;$i++){

              move_uploaded_file($_FILES['pro_img']['tmp_name'][$i],"img/pro_".$ProId."/".($i+1).".jpg");

            }
          }
        }
      }

    public function deleteProData($pro_id){
        $sql = "delete from products where pro_id=$pro_id";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if(is_dir("img/pro_".$pro_id)){
          array_map('unlink',glob("img/pro_$pro_id/*.*"));
          rmdir("img/pro_$pro_id");
        }
        $this->set_message('Deleted successfully');
        return true;
      }



    public function set_message($msg){
        if(!empty($msg)){
          $_SESSION['message'] = $msg;
        }else{
          $msg = '';
        }
      }
    public function pro_display_message(){
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
}
?>