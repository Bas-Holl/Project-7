<?php
include '../../includes/reserveren/function.inc.php';
include '../../includes/algemeen/dbh.inc.php';
include '../algemeen/header.php';

$selectedReservationId = $_POST['id'];
$reservation = getSelectedReservation($conn, $selectedReservationId);


if (!isset($_SESSION["userlevel"]))
{
    header("Location: overview.php");
} else if ($_SESSION["userlevel"] >= 4)     
{
    true;
} else if ($_SESSION["userid"] !== $reservation['userid'])
{
    header("Location: overview.php");
}
?>

<?php ShowMsg(); ?>
<div class="container">
    <form class="row m-5" method="post"  action="../../includes/reserveren/reserveren.inc.php">
        <div class="col-md-4 offset-md-4 border">
            <div class="mt-3 text-center text-decoration-underline">
                <h1>Updaten</h1>
            </div>
            <div>
                <input class="hidden" name="reservationId" hidden value="<?php echo $selectedReservationId?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Personen</label>
                <input class="input" type="number" name="quantity" value="<?php echo $reservation['quantity']?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Datum</label>
                <input class="input" type="date" min="now" name="date" value="<?php echo $reservation['date'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Starttijd</label>
                <input class="input" type="time" min="17:00" max="21:00" name="starttime" value="<?php echo $reservation['starttijd'] ?>" required>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn-submit" name="update"></input>
            </div>
        </div>
    </form>
    <div class="text-center">
        <a href="overview.php">Terug</input>
    </div>
</div>
<?php include '../algemeen/footer.php'; ?>