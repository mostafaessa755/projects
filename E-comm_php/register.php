<?php 
include "templet/front/conn.php";
$msg = "";
$display = "none";

if(isset($_POST['sub'])){
  if(empty($_POST['name'])){
    $msg = "your name is required";
  }
  else if(empty($_POST['uname'])){
    $msg = "your user name is required";
  }
  else if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
    if(empty($_POST['email'])){
      $msg = "your email is required";
    }else{
      $msg = "your email is invalid"; 
    }
  }
  else if(empty($_POST['pass'])){
    $msg = "your password is required";
  }
  else if(empty($_POST['cpass']) || $_POST['cpass'] != $_POST['pass']){
    if(empty($_POST['cpass']))
    {
    $msg = "your confirm password is required";
    }
    else{
    $msg = "your password must be confirm";
    }
  }
  else{
    $sql = "select count(username) as num from users where username = ?";
    $result = $conn->prepare($sql);
    $result->execute(array($_POST['uname']));
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if($row['num'] > 0){
      $msg = "user name already exists";
    }
    else {
      $sql = "insert into users values(null,?,?,?,?,?,null)";
      $result = $conn->prepare($sql);
      $result->execute(array($_POST['name'],$_POST['uname'],$_POST['email'],$_POST['pass'],$_POST['gender']));
      if($conn->errorCode() == 00000){
        session_start();
        $_SESSION['uname'] = $_POST['uname'];
        header("location:index.php");
      }
    }
  }
}
if($msg == ""){
  $display = "none";
}else{
  $display = "block";
  }
?>
<?php include "templet/front/header.php";?>
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
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
    </div>
    <div class="form-group">
      <label for="user name">User Name:</label>
      <input type="text" class="form-control" id="uname" placeholder="Enter user name" name="uname">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="gender">Gender:</label></br>
      <input type="radio" class="form-check-input" id="m" name="gender" value = "m" checked>Male</br>
      <input type="radio" class="form-check-input" id="f" name="gender" value = "f">Female
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pass" placeholder="Enter password" name="pass">
    </div>
    <div class="form-group">
      <label for="cpwd">Confirm Password:</label>
      <input type="password" class="form-control" id="cpass" placeholder="Enter Confirm password" name="cpass">
    </div>
    <button type="submit" class="btn btn-primary" style = "width:100%;" name = "sub">Submit</button>
  </form>
</div>
</div>
<?php include "templet/front/footer.php";?>