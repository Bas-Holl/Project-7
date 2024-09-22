<?php

include '../../includes/reserveren/function.inc.php';
include '../../includes/algemeen/dbh.inc.php';

$selectedReservationId = 3  ;

$sql = "SELECT * FROM `reservations` WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../../front-end/reserveren/create.php");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $selectedReservationId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $result->fetch_assoc();

    print_r($result['id']);

?>