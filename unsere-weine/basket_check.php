<?
session_start();
require_once("basket.inc");


# MAIN

$checker = new Checker();

if(!isset($_SESSION['articles'])) {
    $checker->error_redirect();
}
elseif(!isset($_POST)) {
    $checker->error_redirect();
}
elseif(count($_POST) < 9) {
    $checker->error_redirect();
}

$p = $_POST;
$_SESSION['shipping_address'] = $p;
unset($_POST);

$checker->check_string($p['fn'], "Vorname", 3);
$checker->check_string($p['ln'], "Nachname", 3);
$checker->check_string($p['str'], "Strasse", 3);
$checker->check_string($p['zip'], "Postleitzahl", 5);
$checker->check_string($p['twn'], "Stadt", 3);
$checker->check_string($p['cnt'], "Land", 11);
$checker->check_on_off('agb', "AGB");
#TODO: Mail-Adresse prüfen
$checker->check_string($p['mail'], "E-Mail-Adresse", 5);
$msg = $checker->get_error_message();


