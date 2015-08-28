<?
session_start();
require_once("basket.inc");

$_SESSION['shipping_address']['Postleitzahl'] = $_POST['value'];

$basket = new Basket();
$basket_view = $basket->basket_view;

echo $basket_view;

?>