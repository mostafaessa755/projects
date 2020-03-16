<?php
session_start();
if(!isset($_SESSION['uname'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>chat</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
      .uname{color:blue;}
      .touser{color:red;}
      .content{text-align:center;height:625px}
      .logout{text-align:right;height:6%}
      #msg_chat{height:70%;overflow:scroll;}
      #form{height:24%;}
    </style>
</head>
<body>
    <div class = "container">
      <div class = "content">
      <div class = "logout">
        <a href="logout.php" class = "btn btn-warning ">logout</a>
      </div>  
        <div id = "msg_chat">

        </div>
        <form action="action.php" method="POST" id = "form">
            <input type = "text" id = "touser" placeholder = "send to ?" class = "form-control">
            <textarea id = "msg" placeholder = "write your message !!"class = "form-control"></textarea>
            <input type = "submit"class = "btn btn-primary form-control">
        </form>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(document).on("submit","#form",function(e){
                e.preventDefault();
                if($("#touser").val() != "" && $("#touser").val() != "<?php echo $_SESSION['uname'];?>" && $("#msg").val() != ""){
                var uname  = "<?php echo $_SESSION['uname'];?>",
                    touser = $("#touser").val(),
                    msg    = $("#msg").val();
                $.ajax({
                    url:"action.php",
                    method:"POST",
                    data:{action:"insert",uname:uname,touser:touser,msg:msg},
                    success:function(data){
                        recev_data();
                    }
                });
                $("#msg").val('');
                }
            });

            setInterval(function(){
                if($("#touser").val() != "" && $("#touser").val() != "<?php echo $_SESSION['uname'];?>"){
                    recev_data();
                }
            }, 2000);

            function recev_data(){
                var uname  = "<?php echo $_SESSION['uname'];?>",
                touser = $("#touser").val();
                $.ajax({
                    method: "POST",
                    url: "action.php",
                    data:{action:"recev",uname:uname,touser:touser},
                    success: function (data) {
                        $("#msg_chat").html(data);
                    }
                });               
            }
        });
    </script>
</body>
</html>