<?php 
try{
$host = "mysql:host=localhost;dbname=7ist";
$user = "root";
$pass = "";
$conn = new PDO($host,$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PODException $ex){
   echo $ex->getMessage();
}
?>