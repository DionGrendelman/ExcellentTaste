<?php


/*Get core*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
/**/

/*New reservering class*/
$reserveringen = new Reserveringen();
/*New klanten class*/
$klanten = new Klanten();
/*New bestellingen class*/
$bestellingen = new Bestellingen();

/*New reservering class*/
$bon = new Bon();

$totalprice = 0;


if ($bon->findAll()) {
    /*Loop trough reserveringen*/
    foreach ($bon->findAll() as $bo) {

        $timestamp = strtotime($bo['Datum']);
        $oneweekago = strtotime("-1 week");
        if ($oneweekago <= $timestamp) {
            $thisprice = $bestellingen->calculateBestelling($bo['Tafel'], $bo['Tijd'], $bo['Datum']);
            $totalprice = $totalprice + $thisprice;
            ?>
            <tr data-date="<?php echo $bo['Datum']; ?>" data-time="<?php echo $bo['Tijd']; ?>"
                data-table="<?php echo $bo['Tafel']; ?>">
                <td class="trClick"><?php echo $bo['Datum']; ?></td>
                <td class="trClick"><?php echo $bo['Tijd']; ?></td>
                <td class="trClick"><?php echo $bo['Tafel']; ?></td>
                <td class="trClick"><?php echo ucfirst($bo['Wijze van betaling']); ?></td>
                <td class="trClick">
                    €<?php echo $thisprice ?></td>
            </tr>
            <?php
        }

    }

    ?>
    <tr data-date="0" data-time="0"
        data-table="0">
        <td class="trClick"></td>
        <td class="trClick"></td>
        <td class="trClick"></td>
        <td class="trClick"><b>Totaal:</b></td>
        <td class="trClick">
            €<?php echo $totalprice ?></td>
    </tr>
    <?php
} else {
    ?>
    <tr data-date="0" data-time="0"
        data-table="0">
        <td class="trClick">Oeps geen resultaten</td>
        <td class="trClick"></td>
        <td class="trClick"></td>
        <td class="trClick"></td>
        <td class="trClick"></td>
    </tr>
    <?php
}
?>
<script>
    /*ALERT!*/
    /*Javascript is loaded inline, because this code is being loaded with jquery.*/

    /*On row click*/

    /*On row delete*/
    $('.delete').on('click', function () {
        /*Safe data from reservering*/
        var time = $(this).parent().parent().data('time');
        var date = $(this).parent().parent().data('date');
        var table = $(this).parent().parent().data('table');
        /*Ask for confirmation*/
        var question = confirm('Weet je het zeker?');
        if (question) {
            $.ajax({ //Process the form using $.ajax()
                type: 'POST', //Method type
                url: '/controllers/tables/reserveringen/reservering_delete.php', //The url
                data: {'time': time, 'date': date, 'table': table}, //Form data
                success: function (data) {
                    data = JSON.parse(data);
                    console.log(data);
                    /*On succes*/
                    if (data.status === 'success') {
                        alert('Gelukt!');
                        $('#loadReserveringen').load('/controllers/tables/reserveringen/loadReservering.php', function () {
                        });
                    } else {
                        /*On error*/
                        alert(data.message);
                    }
                }
            });
        }
    });
    /*On edit click*/
    $('.edit').on('click', function () {
        /*Save reservartion data*/
        var time = $(this).parent().parent().data('time');
        var date = $(this).parent().parent().data('date');
        var table = $(this).parent().parent().data('table');

        /*Redirect to reservering*/
        window.location.href = '/reserveringen/reservering?time=' + time + '&date=' + date + '&table=' + table;

    });

</script>
