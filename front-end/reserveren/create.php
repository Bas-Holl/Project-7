<?php
include '../../includes/reserveren/function.inc.php';
include '../../includes/algemeen/dbh.inc.php';
?>

<?php include '../algemeen/header.php'; ?>
<?php //$_SESSION['userid'] = 1 ?>    
<?php 
// print_r($_SESSION);
?>
<?php ShowMsg(); ?>
<div class="container">
    <form class="row m-5" method="post" action="../../includes/reserveren/reserveren.inc.php">
        <div class="col-md-4 offset-md-4">
            <div class="mt-3 text-center text-decoration-underline">
                <h1>Reserveren</h1>
            </div>
            <div class="mb-3">
                <label class="form-label">Personen</label>
                <input class="input" type="number" name="quantity" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Datum</label>
                <input class="input" type="date" min="now" name="date" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Starttijd</label>
                <input class="input" type="time" min="17:00" max="21:00" name="starttime" required>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn-submit" name="submit"></input>
            </div>
        </div>
    </form>
    <div class="text-center">
        <a href="overview.php">Terug</input>
    </div>
</div>
<?php include '../algemeen/footer.php'; ?>