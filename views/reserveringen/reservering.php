<?php
/*Get core*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
//

/*Check if time, date and table is set in get*/
if(!isset($_GET['time']) || !$_GET['time'] || !isset($_GET['date']) || !$_GET['date'] || !isset($_GET['table']) || !$_GET['table']){
    header('Location: /');
}
/*New klanten class*/
$klanten = new Klanten();
$reserveringen = new Reserveringen();

if(!$reservering = $reserveringen->findExt([
    'Datum' => $_GET['date'],
    'Tijd' => $_GET['time'],
    'Tafel' => $_GET['table'],
])){
    header('Location: /');

}
/*Header*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/components/header.php';
/**/
?>

<div class="main">
    <h2>Reservering wijzigen</h2>
    <I class="notice">Je kan geen tafel, datum of tijd aanpassen omdat dit de reservering uniek maakt</I>
    <div id="error"></div>
    <form id="updateReservering">
        <label for="Tafel">Tafel</label><br><input type="text" name="Tafel" disabled id="Tafel" value="<?php echo $reservering['Tafel'];?>"><br>
        <label for="Datum">Datum</label><br><input type="date" name="Datum" disabled id="Datum" value="<?php echo $reservering['Datum'];?>"><br>
        <label for="Tijd">Tijd</label><br><input type="time" name="Tijd" id="Tijd"  disabled value="<?php echo $reservering['Tijd'];?>"><br>
        <label for="Klant-id">Klant</label><br>
        <select name="Klant-id" id="Klant-id">
            <!--Walk through all customers and show them-->
            <?php foreach($klanten->findAll() as $klant){
                /*If the option is currently selected.*/
                if($klant['Klantid'] == $reservering['Klant-id']){
                    ?>
                    <option value="<?php echo $klant['Klantid'];?>" selected><?php echo $klant['Klantnaam'];?></option>
                    <?php
                } else {
                    ?>
                    <option value="<?php echo $klant['Klantid']; ?>"><?php echo $klant['Klantnaam']; ?></option>
                    <?php
                }
            }
            ?>
        </select><br>
        <label for="klantTelefoon">Telefoon</label><br><input type="text" name="klantTelefoon"
                                                              id="klantTelefoon"><br>
        <label for="klantStraat">Straatnaam</label><br><input type="text" name="klantStraat" id="klantStraat"><br>
        <label for="klantHuisnummer">Huisnummer</label><br><input type="text" name="klantHuisnummer"
                                                                  id="klantHuisnummer"><br>
        <label for="klantToevoeging">Toevoeging</label><br><input type="text" name="klantToevoeging"
                                                                  id="klantToevoeging"><br>
        <label for="klantPostcode">Postcode</label><br><input type="text" name="klantPostcode"
                                                              id="klantPostcode"><br>
        <label for="klantWoonplaats">Woonplaats</label><br><input type="text" name="klantWoonplaats"
                                                                  id="klantWoonplaats"><br>
        <label for="klantLand">Land</label><br><input type="text" name="klantLand" id="klantLand"><br>
        <label for="Aantal">Aantal</label><br><input type="text" name="Aantal" id="Aantal"  value="<?php echo $reservering['Aantal'];?>"><br>
        <button type="submit">Opslaan</button>
        <br>
        <br>
    </form>

</div>

<?php
/*Footer*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/components/footer.php';
/**/
?>
<script>
    /*SAVE CURRENT KLANTEN TO JS LIST*/
    var klantenList = {
        <?php foreach ($klanten->findAll() as $klant) {
        ?>
        '<?php echo $klant['Klantid']; ?>': {
            'Klantnaam': '<?php echo $klant['Klantnaam']; ?>',
            'Telefoon': '<?php echo $klant['Telefoon']; ?>',
            'Straat': '<?php echo $klant['Straat']; ?>',
            'Huisnummer': '<?php echo $klant['Huisnummer']; ?>',
            'Toevoeging': '<?php echo $klant['Toevoeging']; ?>',
            'Postcode': '<?php echo $klant['Postcode']; ?>',
            'Woonplaats': '<?php echo $klant['Woonplaats']; ?>',
            'Land': '<?php echo $klant['Land']; ?>',
        },
        <?php
        }
        ?>
    }
</script>
<script src="/assets/js/reserveringen/update.js"></script>
