<?php 
try{
$host = "mysql:host=localhost;dbname=testchat";
$user = "root";
$pass = "";
$db = new PDO($host,$user,$pass);
}catch(PDOException $ex){
    echo $ex->getMessage();
}