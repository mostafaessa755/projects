<?php
    //if come from request
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $user = filter_var(trim($_POST["username"]),FILTER_SANITIZE_STRING); 
        $mail = filter_var(trim($_POST["email"]),FILTER_SANITIZE_EMAIL);
        $cell = filter_var(trim($_POST["cellphone"]),FILTER_SANITIZE_NUMBER_INT); 
        $msg  = filter_var(trim($_POST["message"]),FILTER_SANITIZE_STRING);  

        $formErrors = array();

        if(strlen($user) <= 3 || empty($user)){
            $formErrors[] = '<strong>user name</strong> must be large than <strong>3</strong>';
        }
        if(strlen($msg) <= 10 || empty($msg)){
            $formErrors[] = '<strong>message</strong> must be large than <strong>10</strong>';
        }
        if(empty($formErrors)){
            $to = 'm01158069284@gmail.com';
            $subject = 'Contact Form';
            $headers = 'From:'.$mail .'\r\n';
            mail($to,$subject,$msg,$headers);
        }

    }
?>  
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Contact</title>
        <!-- bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- fontawesome -->
        <link rel="stylesheet" href="css/fontawesome.min.css">
        <link rel="stylesheet" href="css/brands.min.css">
        <link rel="stylesheet" href="css/solid.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:900&display=swap" >        <!-- min style -->
        <link rel="stylesheet" href="css/min.css">

    </head>
    <body>
        <!-- start form -->
        <div class="container">
            <h1 class="text-center">Contact Me</h1>
            <form class="class-form" action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
                <div class="errors">
                    <?php if(isset($formErrors) && !empty($formErrors)) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?php
                            foreach($formErrors as $error)
                            {
                                echo $error . "</br>";
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-groub">
                    <input 
                        type="text" 
                        class="form-control username" 
                        name = "username" 
                        placeholder="User Name"
                        value="<?php if(isset($user)){echo $user;} ?>" />
                    <i class="fa fa-user fa-fw"></i>
                    <span class="asterisx">*</span>
                    <div class="alert alert-danger custm-alert"></div>
                </div>
                <div class="form-groub">
                    <input 
                        type="email" 
                        class="form-control mail" 
                        name = "email" 
                        placeholder="E-mail"
                        value="<?php if(isset($mail)){echo $mail;} ?>" />
                    <i class="fa fa-envelope fa-fw"></i>
                    <span class="asterisx">*</span>
                    <div class="alert alert-danger custm-alert"></div>
                </div>
                <div class="form-groub">
                    <input 
                        type="text" 
                        class="form-control cell" 
                        name = "cellphone" 
                        placeholder="Phone Number"
                        value="<?php if(isset($cell)){echo $cell;} ?>"/>
                    <i class="fa fa-phone-alt fa-fw"></i>
                    <span class = "key">+20</span>
                    <div class="alert alert-danger custm-alert"></div>
                </div>
                <div class="form-groub">
                    <textarea 
                        class="form-control msg" 
                        name="message" 
                        placeholder="Message"><?php if(isset($msg)){echo $msg;} ?></textarea>
                    <span class="asterisx">*</span>
                    <div class="alert alert-danger custm-alert"></div>
                </div>
                <input 
                    type="submit" 
                    class="btn btn-success" 
                    value="send message"/>
                <i class="fa fa-paper-plane fa-fw submit-icon"></i>
            </form>
        </div>
        <!-- end form -->





        <!-- jquery -->
        <script src="js/jquery-3.4.1.js"></script>
        <!-- bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <!-- min -->
        <script src="js/min.js"></script>
    </body>
</html>