<?php 
include "conn.php";
if(isset($_POST['action'])){
        $programming_languages = implode(",",$_POST['programming_languages']);
        $data = array(':name'=>$_POST['name'],':programming_languages'=>$programming_languages);
        $sql = '';
        if($_POST['action'] == 'insert')
        {
            $sql = 'insert into members(name,languag) values(:name,:programming_languages)';
            $result = $conn->prepare($sql);
            $result->execute($data);
            
        }
        if($_POST['action'] == 'edit')
        {
            $sql = 'update members set name = :name,languag = :programming_languages  where member_id ='.$_POST['hidden_id'];
            $result = $conn->prepare($sql);
            $result->execute($data);
        }
}
if(isset($_POST['id_remove']))
{
    $sql = 'delete from members where member_id ='.$_POST['id_remove'];
    $result = $conn->prepare($sql);
    $result->execute();
}