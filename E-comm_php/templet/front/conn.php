<?php 
try{
$dsn = 'mysql:host=localhost;dbname=electro';
$user = 'root';
$pass = '';
$conn = new PDO($dsn,$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $ex){
    echo $ex->getMessage();
}
