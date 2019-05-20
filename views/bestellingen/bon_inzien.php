<?php
/*Get core*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
//
/*Check if time, date and table is set in get*/
if (!isset($_GET['time']) || !$_GET['time'] || !isset($_GET['date']) || !$_GET['date'] || !isset($_GET['table']) || !$_GET['table']) {
    header('Location: /');
}
/*Nieuwe class bestelinnge*/
$reserveringen = new Reserveringen();
/*New klanten class*/
$klanten = new Klanten();
/*New bestellingen class*/
$bestellingen = new Bestellingen();
/*New MenuItem class*/
$menuitems = new MenuItems();


if (!$reservering = $reserveringen->findExt([
    'Datum' => $_GET['date'],
    'Tijd' => $_GET['time'],
    'Tafel' => $_GET['table'],
])) {
    header('Location: /');

}

/*Header*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/components/header.php';
/**/
?>

<div class="main">
    <h2>Bon</h2>

    <?php
    if (!$bestelling = $bestellingen->findExt([
        'Datum' => $_GET['date'],
        'Tijd' => $_GET['time'],
        'Tafel' => $_GET['table'],
    ])) {
        ?>
        <h4>Deze klant heeft nog geen bestellingen gedaan.</h4>
        <?php
    } else {
        ?>
        <button onclick="window.location.href= '/bestellingen/bon/pdf?time=<?php echo $_GET['time'];?>&date=<?php echo $_GET['date'];?>&table=<?php echo $_GET['table'];?>';">PDF</button>

        <div id="bon">
            <table>
                <thead>
                <tr>
                    <th>Aantal</th>
                    <th>Product</th>
                    <th>Prijs</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $price = 0;
                foreach($bestelling as $bestel){
                    $price = $price + $bestel['Prijs'];
               ?>
                    <tr>
                        <th><?php echo $bestel['Aantal'];?>x</th>
                        <td><?php echo $menuitems->find($bestel['Menuitemcode'])['Menuitem'];?></td>
                        <td><?php echo $bestel['Prijs'];?></td>
                    </tr>
                <?php
                }

                ?>
                <tr>
                    <th></th>
                    <td></td>
                    <td>-----</td>
                </tr>
                <tr>
                    <th>Totaal</th>
                    <td></td>
                    <td><?php echo $price;?></td>
                </tr>
                <tr>
                    <th>Betaald</th>
                    <td></td>
                    <td>?</td>
                </tr>
                <tr>
                    <th>Terug</th>
                    <td></td>
                    <td>?</td>
                </tr>
                </tbody>
            </table>
            <br>
        </div>
        <br><br>
        <?php
    }
    ?>
</div>

<?php

/*Footer*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/components/footer.php';
/**/
?>
<script src="/assets/js/bestellingen/bon_inzien.js"></script>