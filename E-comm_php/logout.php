<?php 
include_once "templet/back/adminconn.php";
unset($_SESSION['uname']);
$db = new crud;
$conn = $db->dbconn();
function carunset($conn){
    foreach($_SESSION as $key=>$val){
            if(substr($key,0,8)== "product_"){
                $pro_len = strlen($key);
                $pro_id=substr($key,8,$pro_len);
                unset($_SESSION['product_'.$pro_id]);

            }
        
    }
}
carunset($conn);
header("location:index.php");?>