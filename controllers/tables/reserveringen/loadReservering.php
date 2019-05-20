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

/*Loop trough reserveringen*/
foreach ($reserveringen->findAll() as $reservering) {
    /*Show reservering*/
    ?>
    <tr data-date="<?php echo $reservering['Datum']; ?>" data-time="<?php echo $reservering['Tijd']; ?>"
        data-table="<?php echo $reservering['Tafel']; ?>">
        <td class="trClick"><?php echo $reservering['Datum']; ?></td>
        <td class="trClick"><?php echo $reservering['Tijd']; ?></td>
        <td class="trClick"><?php echo $reservering['Tafel']; ?></td>
        <td class="trClick"><?php echo $klanten->find($reservering['Klant-id'])['Klantnaam']; ?></td>
        <td class="trClick"><?php echo $klanten->find($reservering['Klant-id'])['Telefoon']; ?></td>
        <td class="trClick"><?php echo $reservering['Aantal']; ?></td>
        <td class="trClick">
            <!--RESERVERING CHECK-->
            <?php
            echo $bestellingen->bestellingUsed(
                $reservering['Tafel'],
                $reservering['Tijd'],
                $reservering['Datum'])
            ?>
        </td>
        <td><i class="fa fa-trash delete"></i> <i class="fa fa-pen edit"></i></td>
    </tr>
    <?php
}
?>
<script>
    /*ALERT!*/
    /*Javascript is loaded inline, because this code is being loaded with jquery.*/

    /*On row click*/
    $('.trClick').on('click', function () {
        /*Send to bestellingen*/
        window.location.href = '/bestellingen'
    });

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
        window.location.href = '/reserveringen/reservering?time='+time+'&date='+date+'&table='+table;

    });

</script>
