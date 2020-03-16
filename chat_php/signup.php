<?php
session_start();
if(isset($_SESSION['uname'])){
    header("location:index.php");
    exit();
}
if(isset($_POST['submit'])){
    include "db.php";
    //session_start();
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pass  = $_POST['pass'];
    $sql = "insert into users value('null',?,?,?,'null')";
    $exe = $db->prepare($sql);
    $exe->execute(array($uname,$email,$pass));
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SignUp Chat</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        .outer {    display: table;
                    position: absolute;
                    top: 0;
                    left: 0;
                    height: 100%;
                    width: 100%;}
        .middle{    display: table-cell;
                    vertical-align: middle;}
        .inner {    margin-left: auto;
                    margin-right: auto;
                    width: 300px;
                    border: 1px solid #adb5bd;
                    border-radius: 10px;
                    padding: 10px;}
        .head-form{ text-align:center;}
        .form{      margin: 20px 0 20px 0;}
        .btn{       width:100%;}
    </style>
</head>
<body>
    <div class = "outer ">
        <div class = "middle">
            <div class = "inner ">
                <div class = "head-form">
                    <h3>أنضم الينا</h3>
                </div>
                <form action="" method="POST" calss = "form">
                    <div class = "form-group">
                        <input type="text" name = "uname" id = "uname" class = "form-control" placeholder = "أسم المستخدم">
                    </div>
                    <div class = "form-group">
                        <input type="email" name="email" id = "email" class = "form-control"  placeholder = "البريد الاكتروني">
                    </div>
                    <div class = "form-group">
                        <input type="password" name = "pass" id = "pass" class = "form-control"  placeholder = "كلمه المرور">
                    </div>
                    <div class = "form-group">
                        <input type="password" id = "cpass" class = "form-control"  placeholder = " تأكيد كلمه المرور">
                    </div>
                    <div class = "form-group">
                        <button type="submit" name="submit" class = "btn btn-primary">انشاء حساب</button>
                    </div>
                </form>
                <a href = "login.php">تسجيل الدخول !!</a>
            </div>
        </div>
    </div>
</body>
</html>