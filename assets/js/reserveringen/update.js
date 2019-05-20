$('#updateReservering').on('submit',function (e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({ //Process the form using $.ajax()
        type: 'POST', //Method type
        url: '/controllers/tables/reserveringen/reservering_update.php', //Your form processing file URL
        data: {
            Tijd: $('#Tijd').val(),
            Datum:$('#Datum').val(),
            Tafel:$('#Tafel').val(),
            Klant:$('#Klant-id').val(),
            Aantal:$('#Aantal').val(),
            KlantValue: 1,
            KlantTelefoon: $('#klantTelefoon').val(),
            KlantStraat: $('#klantStraat').val(),
            KlantHuisnummer: $('#klantHuisnummer').val(),
            KlantToevoeging: $('#klantToevoeging').val(),
            KlantPostcode: $('#klantPostcode').val(),
            KlantWoonplaats: $('#klantWoonplaats').val(),
            KlantLand: $('#klantLand').val(),
        },
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            if (data.status === 'success') {
                window.location.href = '/reserveringen';
                $('#loadReserveringen').load('/controllers/tables/reserveringen/loadReservering.php', function () {
                });
            } else {
                alert('Niet gelukt :(');
            }
        }
    });
});
$(document).ready(function () {
    /*On klantid select field change*/
    $('#Klant-id').on('change', function () {
        /*Show correct data in responding field.*/
        $('#klantTelefoon').val(klantenList[$(this).val()]['Telefoon']);
        $('#klantStraat').val(klantenList[$(this).val()]['Straat']);
        $('#klantHuisnummer').val(klantenList[$(this).val()]['Huisnummer']);
        $('#klantToevoeging').val(klantenList[$(this).val()]['Toevoeging']);
        $('#klantPostcode').val(klantenList[$(this).val()]['Postcode']);
        $('#klantWoonplaats').val(klantenList[$(this).val()]['Woonplaats']);
        $('#klantLand').val(klantenList[$(this).val()]['Land']);
    });

    /*Onload*/
    /*Show correct data in responding field.*/
    $('#klantTelefoon').val(klantenList[$('#Klant-id').val()]['Telefoon']);
    $('#klantStraat').val(klantenList[$('#Klant-id').val()]['Straat']);
    $('#klantHuisnummer').val(klantenList[$('#Klant-id').val()]['Huisnummer']);
    $('#klantToevoeging').val(klantenList[$('#Klant-id').val()]['Toevoeging']);
    $('#klantPostcode').val(klantenList[$('#Klant-id').val()]['Postcode']);
    $('#klantWoonplaats').val(klantenList[$('#Klant-id').val()]['Woonplaats']);
    $('#klantLand').val(klantenList[$('#Klant-id').val()]['Land']);
});