<?php
//session_start();

//create reservation
function createReservation($conn, $userid, $quantity, $date, $starttime)
{
    // calculates the end time
    $endtime = tijdreken($starttime);

    // sql statement
    $sql = "INSERT INTO reservations(userid, quantity, date, starttijd, eindtijd) VALUES(?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../../front-end/reserveren/create.php");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "iisss", $userid, $quantity, $date, $starttime, $endtime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../../front-end/reserveren/overview.php");
    exit();


}

function updateReservation($conn, $quantity, $date, $starttime, $id)
{
    // calculates the end time
    $endtime = tijdreken($starttime);

    // sql statement
    $sql = "UPDATE reservations SET quantity = ?, date = ?, starttijd = ?, eindtijd = ? WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: update.php?id=$id");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "isssi", $quantity, $date, $starttime, $endtime, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../../front-end/reserveren/overview.php");
    exit();
}

function deleteReservation($conn, $id)
{
    $sql = "DELETE FROM `reservations` WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../../front-end/reserveren/overview.php");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../../front-end/reserveren/overview.php");
    exit();

}


function tijdreken($starttime)
{
    $now = date("H:i:s", strtotime($starttime));
    return date('H:i:s', strtotime($now . ' +2hours'));
}

function calculateRoom($quantity, $date, $conn) {
    $max = 50;

    //haalt het aantal personen op van een reservering en telt het op
    // $result = mysqli_query($conn, "SELECT SUM(quantity) AS quantity FROM `reservations`"); 
    // $row = $result->fetch_array();
    $now = time();
    $result = mysqli_query($conn, "SELECT quantity AS quantity FROM `reservations` WHERE date = '$date'");
    $rows = $result->fetch_all(MYSQLI_ASSOC);

if(!empty($result)){
    $ceil = [];
    foreach ($rows as $row) {
        $ceil[] = (ceil($row['quantity'] / 4) * 4);
    }

    $sumRow = array_sum($ceil);

    $sumQuantity = ceil($quantity / 4) *4;

    $sumAll = $sumRow + $sumQuantity;

    $free = $max - $sumRow;

    if ($quantity <= $free && $sumAll <= $max) {
        return true;
    } else {
        return false;
    }
} else {
    return true;
}

    //$tableids = mysqli_query($conn, "SELECT tables.id, statuses.name FROM `tables` INNER JOIN statuses ON tables.statusid = statuses.id AND name = 'vrij';");

    // $tableidsresult = mysqli_query($conn, "SELECT tables.id FROM `tables` INNER JOIN statuses ON tables.statusid = statuses.id AND name = 'vrij';");
    // while ($tablerow = $tableidsresult->fetch_row()) {
    //     $tablerows[] = $tablerow;
    // }
}

function getReservations($conn){
    $sql = "SELECT * FROM reservations ORDER BY date;";  
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../front-end/reserveren/overview.php?note=data-ophalen-mislukt");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
    mysqli_stmt_close($stmt);
}

function getSelectedReservation($conn, $selectedReservationId){
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
    return $result->fetch_assoc();
}

function StoreMsg(string $type, string $msg)
{
    //Set session
    $_SESSION['Msg'] = $msg;
    $_SESSION['Type'] = $type;
}

function ShowMsg()
{
    //shows message and type to session
    if (isset($_SESSION['Msg'])) : ?>
        <div class="alert <?php echo $_SESSION['Type'] ? $_SESSION['Type'] : "" ?>">
            <?php
            echo $_SESSION['Msg'];
            unset($_SESSION['Msg']);
            unset($_SESSION['Type']);
            ?>
        </div>
    <?php endif;
}

?>