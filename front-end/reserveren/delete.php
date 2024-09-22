<?php
include '../../includes/reserveren/function.inc.php';
include '../../includes/algemeen/dbh.inc.php';

$selectedReservationId = $_GET['id'];


?>

<?php include '../algemeen/header.php'; ?>
<?php ShowMsg(); ?>
<div class="container">
    <form class="row m-5" method="POST" action="../../includes/reserveren/reserveren.inc.php">
        <div class="col-md-4 offset-md-4 row">
            <div class="mb-3 col-12">
                <input class="hidden" name="id" value="<?php echo $selectedReservationId ?>" hidden></input>
            </div>
            <div class="mb-3 col">
                <input type="submit" class="btn-del" name="submit"></input>
            </div>
            <div class="mb-3 col    ">
                <a class="btn-submit" href="overview.php" name="Annuleer">Annuleer  </a>
            </div>
        </div>
    </form>
</div>
<?php include '../algemeen/footer.php'; ?>