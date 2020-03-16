<?php
if(isset($_POST['action'])){
    include "db.php";
    $uname  = $_POST['uname'];
    $touser = $_POST['touser'];
    if($_POST['action'] == "insert"){
        $msg    = $_POST['msg'];
        $sql = "insert into msg values('null',?,?,?)";
        $exe = $db->prepare($sql);
        $exe->execute(array($uname,$touser,$msg));
    }
    if($_POST['action'] == "recev"){
        $sql = "select msg,uname from msg where uname = ? && touser = ? or uname = ? && touser = ?";
        $exe = $db->prepare($sql);
        $exe->execute(array($uname,$touser,$touser,$uname));
        $res = $exe->fetchAll();
        $count = $exe->rowCount();
        $output = "<table class = 'table'>";
        foreach($res as $row ){
            if($row['uname'] == $uname){
            $output .= "
                        <tr>
                            <td></td>
                            <td></td>
                            <td>".$row['msg']."</td>
                            <td class = 'uname'>".$row['uname']."</td>
                        </tr>"; }
            else{
                $output .= "
                <tr>
                <td class = 'touser'>".$row['uname']."</td>
                <td>".$row['msg']."</td>
                <td></td>
                <td></td>
                </tr>";}
       }
        $output .= "</table>";
        echo $output;
    }
}