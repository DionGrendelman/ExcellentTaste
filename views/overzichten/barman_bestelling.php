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
    <h2>Barman bestelling</h2>
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

        <div id="">
            <table>
                <thead>
                <tr>
                    <th>Aantal</th>
                    <th>Product</th>
                </tr>
                </thead>
                <tbody>
                <?php
                /*Walk through all bestellingen.*/
                foreach ($bestelling as $bestel) {
                    /*If the bestelling is a drank, show it.*/
                    if ($menuitems->find($bestel['Menuitemcode'])['Gerechtcode'] == 4) {
                        ?>
                        <tr>
                            <th><?php echo $bestel['Aantal']; ?>x</th>
                            <td><?php echo $menuitems->find($bestel['Menuitemcode'])['Menuitem']; ?></td>
                        </tr>
                        <?php
                    }
                }

                ?>
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
<script src="/assets/js/overzichten/barman_bestelling.js"></script>
