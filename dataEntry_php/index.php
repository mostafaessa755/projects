<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
      .header{
          padding:20px 0 20px 150px;
      }
      .searsh{
          display:block;
          text-align:center;
      }
      .searsh_input{
          width:70%;
      }
      .searsh_btn{
          width:30%;
      }
      .searsh_btn input{
          width:100%;
      }
      .searsh_input,.searsh_btn{
          float:left;
      }
      .add_btn{
          float:right;
      }
    </style>
</head>
<body>
    <div class = "container">
      <div class = 'header'>
        <h2>Dinamically Add-Remove-Input Fields In PHP-AJAX</h2>
      </div>

      <div class = 'row justify-content-center'> 
      <div class = 'col-md-6 '>
        <div class = 'searsh_input'>
          <input type = 'text' id = 'searsh_input' class = 'form-control'/>
        </div>
        <div class = 'searsh_btn'>
          <input type = 'button' id = 'searsh_btn' class = 'btn btn-primary' value = 'Searsh'>
        </div>
      </div>
      </div>

      <div class = 'add_btn'>
        <button type = "button" id = "fetch" class = "btn btn-success">Fetch All</button>
        <button type = "button" name = "add" id = "add" class = "btn btn-info">Add</button>
      </div>
        <br/>
        <br/>

        <div id = "result"></div>
    </div>
</body>
</html>
<div id = "dynamic_field_modal" class = "modal fad" role = "dialog">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <form id = "add_name" method = "POST">
                <div class = "modal-header">
                    <h4 class = "modal-title">Add Details</h4>
                    <button type = "button" class = "close" data-dismiss = "modal">&times;</button>
                </div>
                <div class = "modal-body">
                    <div class = "form-group">
                        <input type = "text" id = "name" name = "name" class = "form-control" placeholder = "enter your name">
                    </div>
                    <div class = "table-responsive">
                        <table class = "table" id = "dynamic_field">

                        </table>
                    </div>
                </div>
                <div class = "modal-footer">
                    <input type = "hidden" name = "hidden_id" id = "hidden_id"/>
                    <input type = "hidden" name = "action" id = "action" value = "insert"/>
                    <input type = "submit" name = "submit" id = "submit" class = "btn btn-info" value = "submit"/>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    var count = 1;
    load_data();
    $("#searsh_btn").click(function(){
        var searsh = $("#searsh_input").val();
        if(searsh != ""){
            $.ajax({
                type: "POST",
                url: "select.php",
                data:{data:searsh,action:'searsh'},
                success: function (response) {
                    $("#result").html(response);
                }
            });
        }
    });
    $("#fetch").click(function(){
        load_data();
    });
    function load_data(){
        $.ajax({
        url:"fetch.php",
        type:"POST",
        success:function(data){
            $("#result").html(data);
        }
        });
    }
    function add_dynamic_input_field(count){
        var button="";
        if(count>1){
            button = '<button type = "button" name = "remove" id = "'+count+'" class = "btn btn-danger btn-xs remove"> X </button>';
        }else{
            button = '<button type = "button" name = "add_more" id = "add_more" class = "btn btn-success btn-xs"> + </button>';
        }
        var output = '<tr id = "row'+count+'">';
        output += '<td><input type = "text" name = "programming_languages[]" placeholder = "add programming languages" class = "form-control name_list"/></td>';
        output += '<td>'+button+'</td></tr>';
        $("#dynamic_field").append(output);
    }
    $("#add").click(function(){
        $("#searsh_input").val('');
        $("#dynamic_field").html('');
        add_dynamic_input_field(1);
        $(".modal-title").text('Add Details');
        $("#action").val('insert');
        $("#submit").val('submit');
        $("#add_name")[0].reset();
        $("#dynamic_field_modal").modal("show");
    });
    $(document).on("click","#add_more",function(){
        count = count+1;
        add_dynamic_input_field(count);
    });
    $(document).on("click",".remove",function(){
        $row_id = $(this).attr("id");
        $("#row"+$row_id).remove();
    });
    $("#add_name").on("submit",function(e){
        e.preventDefault();
        if($("#name").val() == ""){
            alert("enter your name");
            return false;
        }
        var total_language = 0;
        $(".name_list").each(function(){
            if($(this).val() != ""){
                total_language = total_language+1;
            }
        });
        if(total_language>0){
            var form_data = $(this).serialize();
            var action = $("#action").val();
            $.ajax({
                url:"action.php",
                type:"POST",
                data:form_data,
                success:function(){
                    if(action == "insert"){
                        alert("data inserted")
                    }
                    if(action == "edit"){
                        alert("data edited")
                    }
                    add_dynamic_input_field(1);
                    load_data();
                    $("#add_name")[0].reset();
                    $("#dynamic_field_modal").modal("hide")

                }
            });
        }
    });
    $(document).on('click','.edit',function(){
        $("#searsh_input").val("");
        var id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "select.php",
            data:{id:id},
            dataType: "JSON",
            success: function (data) {
                $('#name').val(data.name);
                $('#dynamic_field').html(data.programming_languages);
                $("#action").val('edit');
                $('.modal-title').text('Edit Details');
                $('#hidden_id').val(id);
                $("#dynamic_field_modal").modal("show");
            }
        });
    });
    $(document).on('click','.delet',function()
    {
        $("#searsh_input").val("");
        var id_remove = $(this).attr('id');
        if(confirm('do you want to remove it!?'))
        {
        $.ajax({
            type: "POST",
            url: "action.php",
            data:{id_remove:id_remove},
            success: function () {
                load_data();
            }
        });
        }

    });

});
</script>