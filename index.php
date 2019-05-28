<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

switch ($request_uri[0]) {
        /*Bestellingen*/
    case '/bestellingen' :
        require_once __DIR__ . '/views/bestellingen/index.php';
        break;
    case '/bestellingen/bon' :
        require_once __DIR__ . '/views/bestellingen/bon.php';
        break;
    case '/bestellingen/bon/inzien' :
        require_once __DIR__ . '/views/bestellingen/bon_inzien.php';
        break;
    case '/bestellingen/bon/pdf' :
        require_once __DIR__ . '/views/bestellingen/bon_pdf.php';
        break;

        /*Reserveringen*/
    case '/reserveringen' :
        require_once __DIR__ . '/views/reserveringen/index.php';
        break;
    case '/reserveringen/reservering' :
        require_once __DIR__ . '/views/reserveringen/reservering.php';
        break;
    case '/reserveringen/nieuw' :
        require_once __DIR__ . '/views/reserveringen/new.php';
        break;

    /*Overzichten*/
    case '/overzichten' :
        require_once __DIR__ . '/views/overzichten/index.php';
        break;
    case '/overzichten/barman' :
        require_once __DIR__ . '/views/overzichten/barman.php';
        break;
    case '/overzichten/barman/' :
        require_once __DIR__ . '/views/overzichten/barman_bestelling.php';
        break;
    case '/overzichten/weekomzet' :
        require_once __DIR__ . '/views/overzichten/weekomzet.php';
        break;

        /*Algemeen*/
    case '/' :
        require_once __DIR__ . '/views/home/index.php';
        break;
    case '' :
        require_once __DIR__ . '/views/home/index.php';
        break;
    case '/404' :
        require_once __DIR__ . '/views/error/404.php';
        break;
    default:
        require_once __DIR__ . '/views/error/404.php';
        break;
}
?>
