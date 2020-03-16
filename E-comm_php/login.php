<?php 
include "templet/front/conn.php";
$msg = "";
$display = "";
if(isset($_POST['sub'])){
    if(empty($_POST['uname']))
    {
        $msg = "your user name is required";
    }
    else if(empty($_POST['pass']))
    {
        $msg = "your password is required";
    }
    else
    {
    $sql = "select * from users where username = ? and pass = ?";
    $result = $conn->prepare($sql);
    $result->execute(array($_POST['uname'],$_POST['pass']));
    if($result->rowCount() == 0)
    {
        $msg = "user name or password is not invalid!";
    }
    else if($result->rowCount() == 1)
    {
        $row = $result->fetch();
        session_start();
        $_SESSION['uname'] = $_POST['uname'];
        if($row['isadmin'] == "a")
        {
            header("location:templet/back/admin.php");
        }
        else if($row['isadmin'] == "")
        {
            header("location:index.php");
        }
        
    }

    }

}

if($msg == "")
{
$display = "none";
}else
{
$display = "block";
}
include "templet/front/header.php";

?>
<div class="container" style = "text-align:center;">
  <div style = "width:300px;display:inline-block;text-align:left;padding:50px 0;">
  <h2>Join Us</h2>
  <div id = "msg" style ="color:red;
                          font-size: 14px;
                          font-weight: 600;
                          background-color:#ff00002e;
                          text-align: center;
                          padding: 9px;
                          border-left: 2px solid;
                          display:<?php echo $display;?>;"><?php echo $msg;?></div>
  <form action="" method = "POST">
    <div class="form-group">
      <label for="user name">User Name:</label>
      <input type="text" class="form-control" id="uname" placeholder="Enter user name" name="uname">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pass" placeholder="Enter password" name="pass">
    </div>
    <button type="submit" class="btn btn-primary" style = "width:100%;" name = "sub">Submit</button>
  </form>
</div>
</div>

<?php include "templet/front/footer.php";?>