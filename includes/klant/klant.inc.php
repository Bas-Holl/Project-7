<?php
$header = false;

try{
    $db = new PDO ("mysql:host=localhost;dbname=project-7","root","");
    $query = $db->prepare("SELECT * FROM users");
    $query->execute();
    $result = $query->fetchAll (PDO::FETCH_ASSOC);

    //haalt uit forum klanttoeveng.php

    if(isset($_POST['verander'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $userlevel = $_POST['userlevel'];   
        $email = $_POST['email'];   
        $phone = $_POST['phone'];  
        $address = $_POST['address'];   
        $zipcode = $_POST['zipcode'];  
        $city = $_POST['city'];     
        $id = $_POST['id'];
        $query = $db->prepare("UPDATE users SET 
            firstname=:firstname, 
            lastname=:lastname, 
            userlevel=:userlevel, 
            email=:email, 
            phone=:phone,
            address=:address,
            zipcode=:zipcode,
            city=:city 
        WHERE id=:id");

        //"query execute" executeerd de query

        $query->execute([
            "firstname"=>$firstname,
            "lastname"=>$lastname,
            "userlevel"=>$userlevel,
            "email"=>$email,
            "phone"=>$phone,
            "address"=>$address,
            "zipcode"=>$zipcode,
            "city"=>$city,
            "id"=>$id
        ]);
        $header = true;
    }

} catch (PDOException $e){
    die ("Error!: ".$e->getMessage());
}
if($header){
    $header=false;
    header('Location: http://localhost/project7/front-end/klant/klanttoevoegen.php');
}
?>