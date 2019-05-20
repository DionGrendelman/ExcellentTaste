<?php
/*Get core*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
//
/*New klanten class*/
$klanten = new Klanten();

/*Header*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/components/header.php';
/**/
?>

<div class="main">
    <h2>Reservering toevoegen</h2>
    <div id="error"></div>
    <form id="addReservering">
        <label for="Tafel">Tafel</label><br><input type="text" name="Tafel" id="Tafel"><br>
        <label for="Datum">Datum</label><br><input type="date" name="Datum" id="Datum"><br>
        <label for="Tijd">Tijd</label><br><input type="time" name="Tijd" id="Tijd"><br>
        <label for="Klant-id">Klant</label><br>
        <select name="Klant-id" id="Klant-id">
            <!--Walk through all customers and show them-->
            <?php foreach ($klanten->findAll() as $klant) {
                ?>
                <option value="<?php echo $klant['Klantid']; ?>"><?php echo $klant['Klantnaam']; ?></option>

                <?php
            }
            ?>
        </select> <i class="fas fa-user-plus" id="addKlant"></i><br>
        <div class="oldKlantField">
            <i>Informatie voor bestaande klant.</i><br>
            <label for="oldKlantTelefoon">Telefoon</label><br><input type="text" name="oldKlantTelefoon"
                                                                  id="oldKlantTelefoon"><br>
            <label for="oldKlantStraat">Straatnaam</label><br><input type="text" name="oldKlantStraat" id="oldKlantStraat"><br>
            <label for="oldKlantHuisnummer">Huisnummer</label><br><input type="text" name="oldKlantHuisnummer"
                                                                      id="oldKlantHuisnummer"><br>
            <label for="oldKlantToevoeging">Toevoeging</label><br><input type="text" name="oldKlantToevoeging"
                                                                      id="oldKlantToevoeging"><br>
            <label for="oldKlantPostcode">Postcode</label><br><input type="text" name="oldKlantPostcode"
                                                                  id="oldKlantPostcode"><br>
            <label for="oldKlantWoonplaats">Woonplaats</label><br><input type="text" name="oldKlantWoonplaats"
                                                                      id="oldKlantWoonplaats"><br>
            <label for="oldKlantLand">Land</label><br><input type="text" name="oldKlantLand" id="oldKlantLand"><br>
        </div>
        <input type="hidden" value="1" id="klantValue"/>
        <div class="klantField">
            <i>Informatie voor nieuwe klant.</i><br>
            <label for="klantNaam">Naam</label><br><input type="text" name="klantNaam" id="klantNaam"><br>
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
        </div>
        <label for="Aantal">Aantal</label><br><input type="text" name="Aantal" id="Aantal"><br>
        <button type="submit">Opslaan</button>
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
<script src="/assets/js/reserveringen/add.js"></script>
