<!-- de navigatie -->
<?php include('../algemeen/header.php');
?>
<link rel="stylesheet" href="../../css/headerfooter.css">

    <!-- de Php code -->
<?php
    require_once "../../includes/klant/klant.inc.php";
?>
    <br/>
    <div class="col-md-12 text-center">
        <form method="POST" action="klant.php">
            <button class="btn btn-warning " type="submit">overzicht</button>
        </form>   
    </div>
    <div class= " row justify-content-center">
        <div class="w-50 p-3">
        <div>
        <h5>Klant aanpassen</h5>
        <div>
            <!-- Formulier voor verander -->
            <form method="POST" formaction="../../includes/klant/klant.inc.php">
                <select class="input-group mb-3 input-tv-form" name='id' id="selecteten">
                    <?php
                        foreach($result as &$data){       
                            $select = $data['email'];
                            $id = $data['id'];
                            ?><option value="<?php  echo $id; ?>"><?php echo $select; ?></option><?php
                        }
                    ?>
                </select>
                
                <script>
                    async function naam (){
                        let id = $( "#selecteten option:selected" ).val();
                        let result = await(await fetch(`http://localhost/project7/includes/algemeen/selecteer.php?id=${id}&tablename=users`)).json();
                        console.log(result);
                        $('#firstname').val(result.firstname);
                        $('#lastname').val(result.lastname);
                        $('#userlevel').val(result.userlevel);
                        $('#email').val(result.email);
                        $('#phone').val(result.phone);
                        $('#address').val(result.address);
                        $('#zipcode').val(result.zipcode);
                        $('#city').val(result.city);
                    }
                    $(document).on("change","#selecteten",naam)
                    .change();
                    naam();
                </script>

                <!-- de input -->
                <input id='firstname' class="input-group mb-3 input-tv-form" type="text" name="firstname" />
                <input id='lastname'class="input-group mb-3 input-tv-form" type="text" name="lastname" />
                <input id='userlevel'class="input-group mb-3 input-tv-form" type="text" name="userlevel"/>
                <input id='email'class="input-group mb-3 input-tv-form" type="text" name="email"/>
                <input id='phone'class="input-group mb-3 input-tv-form" type="text" name="phone"/>
                <input id='address'class="input-group mb-3 input-tv-form" type="text" name="address"/>
                <input id='zipcode'class="input-group mb-3 input-tv-form" type="text" name="zipcode"/>
                <input id='city'class="input-group mb-3 input-tv-form" type="text" name="city"/>
                <input class="input-group mb-3 submit-tv-form" type="submit" name="verander" value="Verander"/>
            </form>
        </div>
        <!-- einde container -->
    </div>
</div>


<?php include('../algemeen/footer.php'); ?>