<?php
include "conn.php";
$sql = "select * from members order by member_id desc";
$exe = $conn->prepare($sql);
$exe->execute();
$result = $exe->fetchAll();
$count = $exe->rowCount();
$output = '
        <div class = "table-responsive">
           <table class = "table table-bordered table-striped" style = "text-align: center;">
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
                  <td colspan="4">No Data Found</td>
                </tr>';
}
$output .= '</table></div>';
echo $output;