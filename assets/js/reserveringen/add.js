$('#addReservering').on('submit', function (e) {
    e.preventDefault();

    if ($('#klantValue').val() == '1') {
        var postData = {
            Tijd: $('#Tijd').val(),
            Datum: $('#Datum').val(),
            Tafel: $('#Tafel').val(),
            Klant: $('#Klant-id').val(),
            Aantal: $('#Aantal').val(),
            KlantValue: $('#klantValue').val(),
            KlantTelefoon: $('#oldKlantTelefoon').val(),
            KlantStraat: $('#oldKlantStraat').val(),
            KlantHuisnummer: $('#oldKlantHuisnummer').val(),
            KlantToevoeging: $('#oldKlantToevoeging').val(),
            KlantPostcode: $('#oldKlantPostcode').val(),
            KlantWoonplaats: $('#oldKlantWoonplaats').val(),
            KlantLand: $('#oldKlantLand').val(),
        };
    } else {
        var postData = {
            Tijd: $('#Tijd').val(),
            Datum: $('#Datum').val(),
            Tafel: $('#Tafel').val(),
            Aantal: $('#Aantal').val(),
            KlantValue: $('#klantValue').val(),
            KlantNaam: $('#klantNaam').val(),
            KlantTelefoon: $('#klantTelefoon').val(),
            KlantStraat: $('#klantStraat').val(),
            KlantHuisnummer: $('#klantHuisnummer').val(),
            KlantToevoeging: $('#klantToevoeging').val(),
            KlantPostcode: $('#klantPostcode').val(),
            KlantWoonplaats: $('#klantWoonplaats').val(),
            KlantLand: $('#klantLand').val(),
        };
    }
    $.ajax({ //Process the form using $.ajax()
        type: 'POST', //Method type
        url: '/controllers/tables/reserveringen/reservering_save.php', //Your form processing file URL
        data: postData,
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            if (data.status === 'success') {
                window.location.href = '/reserveringen';
                $('#loadReserveringen').load('/controllers/tables/reserveringen/loadReservering.php', function () {
                });
            } else {
                $('#error').html(data.message);
            }
        }
    });
});

$(document).ready(function () {
    $('#addKlant').on('click', function () {
        //Check if a new klant is already open.
        if ($('#klantValue').val() == '1') {
            /*Change value to open.*/
            $('#klantValue').val('2');
            /*Show klant field.*/
            $('.klantField').show();
            /*Hide old klant field.*/
            $('.oldKlantField').hide();
            /*Add disabled attribute.*/
            $('#Klant-id').attr("disabled", true);
            /*Change icon*/
            $('#addKlant').removeClass('fa-user-plus');
            $('#addKlant').addClass('fa-user-times');
        } else if ($('#klantValue').val() == '2') {
            /*Change value to closed.*/
            $('#klantValue').val('1');
            /*Hide klant field.*/
            $('.klantField').hide();
            /*Show old klant field.*/
            $('.oldKlantField').show();
            /*Remove disabled attribute.*/
            $('#Klant-id').attr("disabled", false);
            /*Change icon*/
            $('#addKlant').addClass('fa-user-plus');
            $('#addKlant').removeClass('fa-user-times');
        }
    });
    /*On klantid select field change*/
    $('#Klant-id').on('change', function () {
        /*Show correct data in responding field.*/
        $('#oldKlantTelefoon').val(klantenList[$(this).val()]['Telefoon']);
        $('#oldKlantStraat').val(klantenList[$(this).val()]['Straat']);
        $('#oldKlantHuisnummer').val(klantenList[$(this).val()]['Huisnummer']);
        $('#oldKlantToevoeging').val(klantenList[$(this).val()]['Toevoeging']);
        $('#oldKlantPostcode').val(klantenList[$(this).val()]['Postcode']);
        $('#oldKlantWoonplaats').val(klantenList[$(this).val()]['Woonplaats']);
        $('#oldKlantLand').val(klantenList[$(this).val()]['Land']);
    });

    /*Onload*/
    /*Show correct data in responding field.*/
    $('#oldKlantTelefoon').val(klantenList[$('#Klant-id').val()]['Telefoon']);
    $('#oldKlantStraat').val(klantenList[$('#Klant-id').val()]['Straat']);
    $('#oldKlantHuisnummer').val(klantenList[$('#Klant-id').val()]['Huisnummer']);
    $('#oldKlantToevoeging').val(klantenList[$('#Klant-id').val()]['Toevoeging']);
    $('#oldKlantPostcode').val(klantenList[$('#Klant-id').val()]['Postcode']);
    $('#oldKlantWoonplaats').val(klantenList[$('#Klant-id').val()]['Woonplaats']);
    $('#oldKlantLand').val(klantenList[$('#Klant-id').val()]['Land']);
});