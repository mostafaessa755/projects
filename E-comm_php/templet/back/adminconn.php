<?php
class crud
{
   private $dsn  = 'mysql:host=localhost;dbname=electro';
   private $user = 'root';
   private $pass = '';
   public $conn;
   public function dbconn(){
       $this->conn = null;
       try{
       $this->conn = new PDO($this->dsn,$this->user,$this->pass);
       $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       }catch(PDOException $ex){
           echo "error conniction".$ex->getMessage();
       }
       return $this->conn;
   }   
}
session_start();
