<?php
/*Get core*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
/**/

/*New reservering class*/
$reserveringen = new Reserveringen();

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
if (!isset($_POST['time']) && !$_POST['time']) {
    $error .= 'Geen geldige tijd meegegeven<br>';
}

/*Check if date has been posted*/
if (!isset($_POST['date']) && !$_POST['date']) {
    $error .= 'Geen geldige datum meegegeven<br>';
}

/*Check if table has been posted*/
if (!isset($_POST['table']) && !$_POST['table']) {
    $error .= 'Geen geldige tafel meegegeven<br>';
}


/*If error is empty*/
if ($error == '') {
    /*Delete the reservering*/
    if ($reserveringen->delete($_POST['date'], $_POST['time'], $_POST['table'])) {
        return_data('success', 'Gelukt!');
    } else {
        return_data('error', 'Oeps er ging iets mis met het verwijderen!');
    }

} else {
    return_data('error', '$error');
}