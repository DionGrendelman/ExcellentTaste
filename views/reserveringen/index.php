<?php
/*Get core*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
//
/*Header*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/components/header.php';
/**/
?>

<div class="main">
    <h2>Reserveringen</h2>
    <button id="newReservering">Nieuwe reservering</button>
    <table class="table">
        <thead>
        <tr>
            <th>Datum</th>
            <th>Tijd</th>
            <th>Tafel</th>
            <th>Naam</th>
            <th>Telefoon</th>
            <th>Aantal personen</th>
            <th>Reservering gebruikt</th>
            <th>Acties</th>
        </tr>
        </thead>
        <tbody id="loadReserveringen">

        </tbody>
    </table>
</div>

<?php
/*Footer*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/components/footer.php';
/**/
?>
<script src="/assets/js/reserveringen/main.js"></script>
