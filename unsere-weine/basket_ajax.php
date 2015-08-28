<?
session_start();
require_once("basket.inc");

# MAIN

$checker = new Checker();
$p = array();

$session = new Session();
$session->unset_tl_array("shipping_address");
$session->create_shipping_address();

foreach($_POST as $k => $v) {
     $p[$k] = $checker->prevent_sql_injection($k, $v);
}

foreach ($_SESSION['shipping_address'] as $k => $v) {
    if(isset($p[$k])) {
        $_SESSION['shipping_address'][$k] = $p[$k];
    }
}

//var_dump($p);
//exit(0);

$_SESSION['shipping_address'] = $p;
unset($_POST);

$checker->check_string($p['Vorname'], "Vorname", 3);
$checker->check_string($p['Nachname'], "Nachname", 3);
$checker->check_string($p['Strasse'], "Strasse", 3);
$checker->check_string($p['Postleitzahl'], "Postleitzahl", 5);
$checker->check_string($p['Stadt'], "Stadt", 3);
$checker->check_string($p['Land'], "Land", 11);
$checker->check_on_off('AGB', "AGB");
#TODO: Mail-Adresse prüfen
$checker->check_string($p['Mail'], "Mail", 5);

$checker->get_error_message();

?>