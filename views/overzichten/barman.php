<?php
/*Get core*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
//

/*Nieuwe class reserveringen*/
$reserveringen = new Reserveringen();
/*Nieuwe class Bestellingen*/
$bestellingen = new Bestellingen();
/*New klanten class*/
$klanten = new Klanten();
/*New MenuItem class*/
$menuitems = new MenuItems();

/*Header*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/components/header.php';
/**/
?>

<div class="main">
    <h2>Bestelling kiezen (Barman)</h2>
    <i style="font-size:12px;">Alleen reserveringen met bestelling met dranken worden getoond</i><br>
    <select id="bon_selector">
        <option disabled selected value>Kies een reservering</option>
        <?php
        /*Walk though all reserveringen.*/
        foreach($reserveringen->findAll() as $reservering){
            /*If the reservering has bestellingen.*/
            if($bestel = $bestellingen->findExt([
                'Datum' => $reservering['Datum'],
                'Tijd' => $reservering['Tijd'],
                'Tafel' => $reservering['Tafel'],
            ])){
                /*Set default value for bestelling with dranken.*/
              $bestelDrank = false;

              /*Check every bestel that belongs to reservering.*/
                foreach ($bestel as $item) {
                    /*If the bestel has dranken set besteldrank tot true.*/
                    if ($menuitems->find($item['Menuitemcode'])['Gerechtcode'] == 4) {
                        $bestelDrank = true;
                    }
                }
                /*If besteldrank is true show reservering.*/
                if ($bestelDrank) {
                    ?>
                    <option data-date="<?php echo $reservering['Datum']; ?>" data-time="<?php echo $reservering['Tijd']; ?>"
                            data-table="<?php echo $reservering['Tafel']; ?>"><?php echo $reservering['Datum']; ?> | <?php echo $reservering['Tijd']; ?> | <?php echo $reservering['Tafel']; ?> | <?php echo $klanten->find($reservering['Klant-id'])['Klantnaam']; ?></option>
                    <?php
                }
            }



        }
        ?>

    </select>
    <br><br>
</div>

<?php
/*Footer*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/components/footer.php';
/**/
?>
<script src="/assets/js/overzichten/barman.js"></script>

