<!-- Oproepen van de navigatie -->
<?php include('../algemeen/header.php');
?>
<link rel="stylesheet" href="../../css/headerfooter.css">

    <!-- Oproepen van de Php code -->
<?php
    require_once "../../includes/menu/menu.inc.php";
?>
    <div class= " row justify-content-center">
        <div class="w-50 p-3">
        <div>
        <div class="col-md-12 text-center">
            <form method="POST" action="menu.php">
                <button class="btn btn-warning " type="submit">Menu</button>
            </form>
        </div>

        <h5>Gerecht toevoegen</h5>
            <!-- Formulier voor gerecht -->
            <form method="POST" formaction="../../includes/menu/menu.inc.php">
                <input class="input-group mb-3 input-tv-form" type="text" name="naam" placeholder="Naam"/>
                <input class="input-group mb-3 input-tv-form" type="text" name="beschrijving" placeholder="beschrijving"/>
                <select class="input-group mb-3 input-tv-form" name='menu'>
                <?php
                    foreach($resultmenu as &$datamenu){       
                        $select = $datamenu['name'];
                        $id = $datamenu['id'];
                        ?><option value="<?php  echo $id; ?>"><?php echo $select; ?></option><?php
                    }
                    ?>
                </select>
                <input class="input-group mb-3 submit-tv-form" type="submit" name="gerechtaan" value="Voeg toe"/>
            </form>
        </div>
        <h5>Menu toevoegen</h5>
        <div>
            <!-- Formulier voor menu -->
            <form method="POST" formaction="../../includes/menu/menu.inc.php">
                <input class="input-group mb-3 input-tv-form" type="text" name="naam" placeholder="Naam"/>
                <input class="input-group mb-3 input-tv-form" type="text" name="beschrijving" placeholder="beschrijving"/>
                <input class="input-group mb-3 input-tv-form" type="number" name="prijs" placeholder="prijs"/>
                <input class="input-group mb-3 submit-tv-form" type="submit" name="menuaan" value="Voeg toe"/>
            </form>
        </div>
        <h5>Gerecht aan een menu toevoegen</h5>
        <div>
            <!-- Formulier voor menu -->
            <form method="POST" formaction="../../includes/menu/menu.inc.php">
                <select class="input-group mb-3 input-tv-form" name='menu'>
                <?php
                    foreach($resultmenu as &$datamenu){       
                        $select = $datamenu['name'];
                        $id = $datamenu['id'];
                        ?><option value="<?php  echo $id; ?>"><?php echo $select; ?></option><?php
                    }
                    ?>
                </select>
                <select class="input-group mb-3 input-tv-form" name='gerecht'>
                <?php
                    foreach($result as &$data){       
                        $select = $data['name'];
                        $id = $data['id'];
                        ?><option value="<?php  echo $id; ?>"><?php echo $select; ?></option><?php
                    }
                    ?>
                </select>
                <input class="input-group mb-3 submit-tv-form" type="submit" name="table" value="Voeg toe" onClick="window.location.reload()"/>
            </form>
        </div>
        <h5>Gerecht aanpassen</h5>
        <div>
            <!-- Formulier voor verander -->
            <form method="POST" formaction="../../includes/menu/menu.inc.php">
                <select class="input-group mb-3 input-tv-form" name='id' id="selecteten">
                    <?php
                        foreach($result as &$data){       
                            $select = $data['name'];
                            $id = $data['id'];
                            ?><option value="<?php  echo $id; ?>"><?php echo $select; ?></option><?php
                        }
                    ?>
                </select>
                
                <script>
                    async function naam (){
                        let id = $( "#selecteten option:selected" ).val();
                        let result = await(await fetch(`http://localhost/project7/includes/algemeen/selecteer.php?id=${id}&tablename=dish`)).json();
                        console.log(result);
                        $('#naameten').val(result.name);
                        $('#beschrijfeten').val(result.discription);
                    }
                    $(document).on("change","#selecteten",naam)
                    .change();
                    naam();
                </script>

                <input id='naameten' class="input-group mb-3 input-tv-form" type="text" name="naam" placeholder="Naam"/>
                <input id='beschrijfeten'class="input-group mb-3 input-tv-form" type="text" name="beschrijving" placeholder="beschrijving"/>
                <input class="input-group mb-3 submit-tv-form" type="submit" name="verander" value="Verander"/>
            </form>
        </div>
        <h5>Menu aanpassen</h5>
        <div>
            <!-- Formulier voor verander -->
            <form method="POST" formaction="../../includes/menu/menu.inc.php">
                <select class="input-group mb-3 input-tv-form" name='id' id="selectmenu">
                    <?php
                        foreach($resultmenu as &$datamenu){       
                            $select = $datamenu['name'];
                            $id = $datamenu['id'];
                            ?><option value="<?php  echo $id; ?>"><?php echo $select; ?></option><?php
                        }
                    ?>
                </select>

                <script>
                    async function naam (){
                        let id = $( "#selectmenu option:selected" ).val();
                        let result = await(await fetch(`http://localhost/project7/includes/algemeen/selecteer.php?id=${id}&tablename=menus`)).json();
                        //console.log(result);
                        $('#naammenu').val(result.name);
                        $('#beschrijvingmenu').val(result.discription);
                        $('#prijsmenu').val(result.price);
                    }
                    $(document).on("change","#selectmenu",naam)
                    .change();
                    naam();
                </script>
                <input id='naammenu' class="input-group mb-3 input-tv-form" type="text" name="naam" placeholder="Naam"/>
                <input id='beschrijvingmenu'class="input-group mb-3 input-tv-form" type="text" name="beschrijving" placeholder="beschrijving"/>
                <input id='prijsmenu' class="input-group mb-3 input-tv-form" type="text" name="prijs" placeholder="prijs"/>
                <input class="input-group mb-3 submit-tv-form" type="submit" name="verandermenu" value="Verander"/>
            </form>
        </div>
        <!-- einde container -->
    </div>
</div>


<?php include('../algemeen/footer.php'); ?>
<!-- in menu direct de informatie kunnen aanpassen en verwijderen -->