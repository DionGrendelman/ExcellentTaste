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

if (!isset($_POST['KlantValue']) || !$_POST['KlantValue']) {
    $error .= 'Geen geldige Klant Waarde meegegeven<br>';
} else {
    if ($_POST['KlantValue'] == '1') {
        $klantvalue = 1;
        if (!isset($_POST['Klant']) || !$_POST['Klant']) {
            $error .= 'Geen geldige klant meegegeven<br>';
        }
    } else {
        $error .= 'Geen geldige Klant Waarde meegegeven<br>';
    }
}



if ($error == '') {
    /*Check if table has been posted*/
    if (isset($_POST['Klant']) && $_POST['Klant'] || isset($_POST['Aantal']) && $_POST['Aantal'] || isset($_POST['Opmerkingen']) && $_POST['Opmerkingen']) {
        /*Check if aantal has value*/
        if($_POST['Aantal']){
            $aantal = $_POST['Aantal'];
        } else {
            $aantal = '';
        }

        if($_POST['Opmerkingen']){
            $opmerkingen = $_POST['Opmerkingen'];
        } else {
            $opmerkingen = '';
        }
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
            /*Update the reservering*/
            if ($reserveringen->update($_POST['Datum'], $_POST['Tijd'], $_POST['Tafel'], $_POST['Klant'], $aantal,$opmerkingen)) {
                return_data('success', 'Aangepast!');
            } else {
                return_data('error', 'Oeps!');
            }
        } else {
            /*Could not add klant*/
            return_data('error', 'Oeps klant niet geupdate!');
        }


    } else {
        return_data('success', 'Geen veranderingen!');
    }
} else{
    return_data('error', 'Oeps!');
}