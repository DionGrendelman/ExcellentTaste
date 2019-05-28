<?php
/*Get core*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
//
/*Header*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/components/header.php';
/**/

$ddate =date("Y-m-d");
$duedt = explode("-", $ddate);
$date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
$week  = (int)date('W', $date);
?>

<div class="main">
    <h2>Weekomzet (week: <?php echo $week;?>)</h2>
    <I class="notice">Alleen bestellingen van de afgelopen 7 dagen worden weergegeven.</I>
    <table class="table">
        <thead>
        <tr>
            <th>Datum</th>
            <th>Tijd</th>
            <th>Tafel</th>
            <th>Betalingmethode</th>
            <th>Totaal bedrag:</th>
        </tr>
        </thead>
        <tbody id="loadWeekomzet">

        </tbody>
    </table>
</div>

<?php
/*Footer*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/components/footer.php';
/**/
?>
<script src="/assets/js/overzichten/weekomzet.js"></script>
