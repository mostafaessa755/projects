<?php
include 'conn.php';
if(isset($_POST['id'])){
    $sql = 'select * from members where member_id = '.$_POST['id'];
    $exe = $conn->prepare($sql);
    $exe->execute();
    $name = '';
    $programming_languages = '';
    while($row = $exe->fetch())
    {
        $name = $row['name'];
        $array_languages = explode(',',$row['languag']);
        $count = 1;
        foreach($array_languages as $language)
        {
            $button = '';
            if($count > 1)
            {
                $button = '<button type = "button" name = "remove" id = "'.$count.'" class = "btn btn-danger btn-xs remove"> X </button>';
            }else{
                $button = '<button type = "button" name = "add_more" id = "add_more" class = "btn btn-success btn-xs"> + </button>';
            }
            $programming_languages .= '<tr id = "row'.$count.'">
                                          <td>
                                            <input type = "text" name = "programming_languages[]" placeholder = "add programming languages" class = "form-control name_list" value ="'.$language.'"/>
                                          </td>
                                          <td>
                                            '.$button.'
                                          </td>';
                                          $count++;
        }
      
    }
    $output = array('name'=>$name,'programming_languages'=>$programming_languages);
    echo json_encode($output);
  
}
if( isset($_POST['action']) &&  isset($_POST['data']) && $_POST['action'] == 'searsh' && $_POST['data'] != ''){
    $value = $_POST['data'];
    try{
    $sql = "select * from members where name like '". $value ."%'";
    $exe = $conn->prepare($sql);
    $exe->execute();
    $result = $exe->fetchAll();
    $count = $exe->rowCount();
    }catch(PDOException $ex){
        echo $ex->getMessage();
    }
    $output = '
            <div class = "table-responsive">
               <table class = "table table-bordered table-striped">
                   <tr>
                     <th>Name</th>
                     <th>Programes Languag</th>
                     <th>Edit</th>
                     <th>Delete</th>
                   </tr>';
    if($count > 0){
        foreach($result as $row){
            $output .= '
                        <tr>
                          <td>'.$row['name'].'</td>
                          <td>'.$row['languag'].'</td>
                          <td>
                            <button type = "button" name = "edit" id = "'.$row['member_id'].'" class = "btn btn-warning btn-xs edit">Edit</button>
                          </td>
                          <td>
                            <button type = "button" name = "delet" id = "'.$row['member_id'].'" class = "btn btn-danger btn-xs delet">Delete</button>
                          </td>
                        </tr>';
        }
    
    }else{
        $output .= '
                    <tr>
                      <td>No Data Found</td>
                    </tr>';
    }
    $output .= '</table></div>';
    echo $output;

}