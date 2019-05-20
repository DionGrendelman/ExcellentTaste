<?php
/*Get core*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
//

/*Nieuwe class bestelinnge*/
$reserveringen = new Reserveringen();
/*New klanten class*/
$klanten = new Klanten();
/*Header*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/components/header.php';
/**/
?>

<div class="main">
    <h2>Bon maken</h2>
    <select id="bon_selector">
        <option disabled selected value>Kies een reservering</option>
        <?php
        /*Walk trough all reserveringen.*/
        foreach($reserveringen->findAll() as $reservering){
            ?>
            <option data-date="<?php echo $reservering['Datum']; ?>" data-time="<?php echo $reservering['Tijd']; ?>"
                    data-table="<?php echo $reservering['Tafel']; ?>"><?php echo $reservering['Datum']; ?> | <?php echo $reservering['Tijd']; ?> | <?php echo $reservering['Tafel']; ?> | <?php echo $klanten->find($reservering['Klant-id'])['Klantnaam']; ?></option>
            <?php
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
<script src="/assets/js/bestellingen/bon.js"></script>
