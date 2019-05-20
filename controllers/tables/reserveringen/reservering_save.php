<?php
/*Get core*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
/**/

/*New reservering class*/
$reserveringen = new Reserveringen();
/*New klanten class*/
$klanten = new Klanten();

/*Set error empty*/
$error = '';

/*Function to return a failed or succes message.*/
function return_data($status, $message, $error = null)
{
    if ($status === 'error') {
        $return =
            [
                "status" => "error",
                "class" => "alert-danger",
                "message" => $message,
                "error" => $error,
            ];
        echo json_encode($return);
        exit();

    }

    if ($status === 'success') {
        $return =
            [
                "status" => "success",
                "class" => "alert-success",
                "message" => $message,
                "error" => $error,
            ];
        echo json_encode($return);
        exit();
    }

    $return =
        [
            "status" => "unkown",
            "class" => "alert-warning",
            "message" => $message,
            "error" => $error,
        ];
    echo json_encode($return);
    exit();
}

/*Check if time has been posted.*/
if (!isset($_POST['Tijd']) || !$_POST['Tijd']) {
    $error .= 'Geen geldige Tijd meegegeven<br>';
}

/*Check if date has been posted*/
if (!isset($_POST['Datum']) || !$_POST['Datum']) {
    $error .= 'Geen geldige Datum meegegeven<br>';
}

/*Check if table has been posted*/
if (!isset($_POST['Tafel']) || !$_POST['Tafel']) {
    $error .= 'Geen geldige Tafel meegegeven<br>';
}

/*Check if table has been posted*/
if (!isset($_POST['Aantal']) || !$_POST['Aantal']) {
    $error .= 'Geen geldige Aantal meegegeven<br>';
}
if (!isset($_POST['KlantValue']) || !$_POST['KlantValue']) {
    $error .= 'Geen geldige Klant Waarde meegegeven<br>';
} else {
    if ($_POST['KlantValue'] == '1') {
        $klantvalue = 1;
        if (!isset($_POST['Klant']) || !$_POST['Klant']) {
            $error .= 'Geen geldige klant meegegeven<br>';
        }
    } elseif ($_POST['KlantValue'] == '2') {
        $klantvalue = 2;
        if (!isset($_POST['KlantNaam']) || !$_POST['KlantNaam']) {
            $error .= 'Geen geldige klant naam meegegeven<br>';
        }
        if (!isset($_POST['KlantTelefoon']) || !$_POST['KlantTelefoon']) {
            $error .= 'Geen geldige klant telefoon meegegeven<br>';
        }
        if (!isset($_POST['KlantStraat']) || !$_POST['KlantStraat']) {
            $error .= 'Geen geldige klant straat meegegeven<br>';
        }
        if (!isset($_POST['KlantHuisnummer']) || !$_POST['KlantHuisnummer']) {
            $error .= 'Geen geldige klant huisnummer meegegeven<br>';
        }
        if (!isset($_POST['KlantToevoeging']) || !$_POST['KlantToevoeging']) {
            $error .= 'Geen geldige klant toevoeging meegegeven<br>';
        }
        if (!isset($_POST['KlantPostcode']) || !$_POST['KlantPostcode']) {
            $error .= 'Geen geldige klant postcode meegegeven<br>';
        }
        if (!isset($_POST['KlantWoonplaats']) || !$_POST['KlantWoonplaats']) {
            $error .= 'Geen geldige klant woonplaats meegegeven<br>';
        }
        if (!isset($_POST['KlantLand']) || !$_POST['KlantLand']) {
            $error .= 'Geen geldige klantland meegegeven<br>';
        }
    } else {
        $error .= 'Geen geldige Klant Waarde meegegeven<br>';
    }
}


/*If error is empty*/
if ($error == '') {
    /*Check if it is new klant or excisting*/
    if ($klantvalue == 2) {
        /*Create new klant.*/
        if ($klanten->create(
            $_POST['KlantNaam'],
            $_POST['KlantTelefoon'],
            $_POST['KlantStraat'],
            $_POST['KlantHuisnummer'],
            $_POST['KlantToevoeging'],
            $_POST['KlantPostcode'],
            $_POST['KlantWoonplaats'],
            $_POST['KlantLand']
        )) {
            /*Save reservering with new klant.*/
            if ($reserveringen->create($_POST['Datum'], $_POST['Tijd'], $_POST['Tafel'], $klanten->db->id(), $_POST['Aantal'])) {
                return_data('success', 'Gelukt!');
            } else {
                return_data('error', 'Oeps!');
            }
        } else {
            /*Could not add klant*/
            return_data('error', 'Oeps klant niet toegevoegd!');
        }
    } else {
        if ($klanten->update(
            $_POST['Klant'],
            $_POST['KlantTelefoon'],
            $_POST['KlantStraat'],
            $_POST['KlantHuisnummer'],
            $_POST['KlantToevoeging'],
            $_POST['KlantPostcode'],
            $_POST['KlantWoonplaats'],
            $_POST['KlantLand']
        )) {
            /*Adding reservering with excisting klant.*/
            if ($reserveringen->create($_POST['Datum'], $_POST['Tijd'], $_POST['Tafel'], $_POST['Klant'], $_POST['Aantal'])) {
                return_data('success', 'Gelukt!');
            } else {
                return_data('error', 'Er is al een reservering op deze datum, tijdstip en tafel.');
            }
        } else {
            /*Could not add klant*/
            return_data('error', 'Oeps klant niet geupdate!');
        }
    }
} else {
    return_data('error', $error);
}