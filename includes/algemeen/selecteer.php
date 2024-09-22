<?php 
    $db = new PDO ("mysql:host=localhost;dbname=project-7","root","");
    $id =$_GET['id'];
    $tablename = $_GET['tablename'];
    $query = $db->prepare("SELECT * FROM $tablename WHERE id=$id");
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($result);
?>