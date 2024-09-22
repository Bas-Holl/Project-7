<!-- de navigatie -->
<?php include('../algemeen/header.php');
?>
<link rel="stylesheet" href="../../css/headerfooter.css">

<br />
<div class="container">
    <!-- de 2 knoppen boven aan de website -->
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <form method="POST" action="klanttoevoegen.php">
                <button class="btn btn-warning " type="submit">Aanpassen</button>
            </form>
        </div>
        <div class="col-md-auto">
            <form method="POST" action="klantdownload.php">
                <button class="btn btn-warning " type="submit">Download</button>
            </form>
        </div>
    </div>
    <div class="row" style="text-align: center; padding-bottom: 20px; padding-top: 15px;">
        <div class="col justify-content-evently fw-bold">
            <h2>Klanten overzicht:</h2>
        </div> 
    </div>
    <!-- Tabel -->
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Gebruikers niveau</th>
                <th>Email</th>
                <th>Telefoon</th>
                <th>Adres</th>
                <th>Postcode</th>
                <th>Plaats</th>
                <th>verwijder</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $userlevel = "Foutief nummer";

            $db = new PDO("mysql:host=localhost;dbname=project-7", "root", "");
            $query = $db->prepare("SELECT * FROM users");
            $query->execute();

            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                //zorgt voor de user level een woord is en geen cijver
                switch ($result['userlevel']) {
                    case 2:
                        $userlevel = "Gast";
                        break;
                    case 4:
                        $userlevel = "Bediening";
                        break;
                    case 5:
                        $userlevel = "Admin";
                        break;
                    default:
                        $userlevel = "Foutief nummer";
                        break;
                }
                $id = $result['id'];
                echo "<tr>
                    <td>" . $result['firstname'] . "</td>
                    <td>" . $result['lastname'] . "</td>
                    <td>" . $userlevel . "</td>
                    <td>" . $result['email'] . "</td>
                    <td>" . $result['phone'] . "</td>
                    <td>" . $result['address'] . "</td>
                    <td>" . $result['zipcode'] . "</td>
                    <td>" . $result['city'] . "</td>
                    <td><br><a href='?verwijder=$id'>❌</a></td>
                </tr>";
                //voor de verwijder knop
                if (isset($_GET["verwijder"])) {

                    $stop = $_GET["verwijder"];

                    $delete = $db->prepare("DELETE FROM `users` WHERE id = :stop");
                    // $delete->bindParam();
                    $delete->execute(['stop' => $stop]);
                }
            }
            ?>

        </tbody>
        <tfoot>
            <tr>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Gebruikers niveau</th>
                <th>Email</th>
                <th>Telefoon</th>
                <th>Adres</th>
                <th>Postcode</th>
                <th>Plaats</th>
                <th>verwijder</th>
            </tr>
        </tfoot>
    </table>
</div>


</footer>
<!-- Footer -->
<?php include('../algemeen/footer.php'); ?>

</html>