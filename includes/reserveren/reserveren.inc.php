<?php
session_start();
include '../../includes/reserveren/function.inc.php';
include '../../includes/algemeen/dbh.inc.php';

//create
if(isset($_POST["submit"]))
{
    //POST data omzetten in var
    $userid = $_SESSION['userid'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $starttime = $_POST['starttime'];

    //Variables valideren
    if($quantity <= 3){
        StoreMsg('alert-danger', 'Moet voor 4 of meer reserveren');
        header("location: ../../front-end/reserveren/create.php?note=Te weinig personen");
        exit();
    }         

    //kijk of er nog ruimte is die dag
    if (calculateRoom($quantity, $date, $conn) != true){
        StoreMsg('alert-danger', 'Geen ruimte meer');
        header("Location: ../../front-end/reserveren/create.php?note=Geen ruimte meer");
        exit();
    }

    //roept de function createReservation
    createReservation($conn, $userid, $quantity, $date, $starttime);
}
//update
else if (isset($_POST['update'])) 
{
    //POST data omzetten in variable
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $starttime = $_POST['starttime'];
    $id = $_POST['reservationId'];

    //roept de function updateReservation
    updateReservation($conn, $quantity, $date, $starttime, $id);
}
//delete
else if (isset($_POST['delete'])) {
    if (!$_SESSION['userlevel'] >= 4){
        StoreMsg('alert-danger', 'U heeft hier geen recht op');
        header("location: ../../front-end/reserveren/overview.php");
    }
    //zet de POST['id'] om in een variable $id
    $id = $_POST['id'];

    //roept de function deleteReservation
    deleteReservation($conn, $id);
} else {
    StoreMsg('alert-danger', 'Geen Submit');
    header("location: ../../front-end/reserveren/create.php?note=Geen submit");
}
?>