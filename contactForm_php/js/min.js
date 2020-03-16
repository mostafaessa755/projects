/*global $,alert,console */
$(function(){
    'use strict';

    // ERROR VARIABLE
    var Errors = ["username","mail","cell","msg"];
    var userError = true,
        mailError= true,
        cellError= false,
        msgError = true;
    

    // USER NAME INPUT VALIDATE
    $(".username").blur(function(){
        if($(this).val() == ""){
            Errors["username"] = "Enter the username";
            error_input_action($(this),Errors["username"]);
            userError = true;
        }
        else if($(this).val().length <2 ){
            Errors["username"] = "Are you sure you entered your username correctly?";
            error_input_action($(this),Errors["username"]);
            userError = true;
        }else{
            success_input_action($(this));
            userError = false;
        }
    });



    // E-MAIL INPUT VALIDATE
    $(".mail").blur(function(){
        if($(this).val() == ""){
            Errors["mail"] = "Enter the email address!";
            error_input_action($(this),Errors["mail"]);
            mailError= true;
        }
        else if(isEmail($(this).val()) == false){
            Errors["mail"] = "You must enter a valid email";
            error_input_action($(this),Errors["mail"]);
            mailError= true;
        }
        else{
            success_input_action($(this));
            mailError= false;
        }
    });


    // CELL PHONE INPUT VALIDATE
    $(".cell").blur(function(){
        if($(this).val() != ""){
            if(isNaN($(this).val())){
                Errors["cell"] = "You must enter a valid number";
                error_input_action($(this),Errors["cell"]);
                cellError= true;
            }else if($(this).val().length < 10 || $(this).val().length > 10){
                Errors["cell"] = "You must enter only 10 numbers !";
                error_input_action($(this),Errors["cell"]);
                cellError= true;
            }else{
                success_input_action($(this));
                cellError= false;
            }
        }
    });



    // MESSAGE INPUT VALIDATE
    $(".msg").blur(function(){
        if($(this).val().length < 10){
            Errors["username"] = "Enter at least 10 characters";
            error_input_action($(this));
            msgError = true;
        }else{
            success_input_action($(this));
            msgError = false;
        }
    });
    
    // FUNCTION ACTION ERROR
    function error_input_action(value,err){
        value.css("border","1px solid #F00")
        .parent().find("i").css("color","#F00")
        .end().find(".custm-alert").fadeIn(200)
        .end().find(".asterisx").fadeIn(100)
        .end().find(".custm-alert").html(err);

    }
    // FUNCTION ACTION SUCCESS
    function success_input_action(value){
        value.css("border","1px solid #080")
        .parent().find("i").css("color","#080")
        .end().find(".custm-alert").fadeOut(200)
        .end().find(".asterisx").fadeOut(100);
    }

    // CHECK USER NAME
    function isUsername(value){
        var regex = /^\W$/;
        if(regex.test(value)){
            return true;
        }else{
            return false;
        }
    }

    // CHECK E-MAIL
    function isEmail(value){
        var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(regex.test(value)){
            return true;
        }else{
            return false;
        }
    }


    // PREVENT DEFAULTE SUBMIT
    $(".class-form").submit(function(e){
        if(userError === true || mailError === true || msgError === true){
            e.preventDefault();
            $(".username,.mail,.msg").blur();
        }
    });
});