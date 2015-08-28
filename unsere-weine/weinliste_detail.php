<?php
error_reporting(E_ALL);
function get_article() {
	
	
	
	$db = @new mysqli( 'localhost', 'root', '#6d1f80=Purple', 'www.michel-wein.de' );
	if (mysqli_connect_errno() != 0) {
	    echo 'Die Datenbank konnte nicht erreicht werden. Folgender Fehler trat auf: <strong>' .mysqli_connect_errno(). ' : ' .mysqli_connect_error(). '</strong>';
		exit(0);
	}
	$db->query("SET NAMES 'utf8'");
	$db->query("SET CHARACTER SET 'utf8'");

	if(!isset($_GET['artikel'])) {
		$artikel = "101";
	}
	else {
		$artikel = $_GET['artikel'];
	}
	
	$sql = "SELECT artikelnummer FROM `produkte`";
	$ergebnis = $db->query($sql);
	$result = array();
	while($row = $ergebnis->fetch_row()) {
		$result[]=$row[0];
	}
	
	if(!in_array($artikel,$result)) {
		$artikel = "101";
	}

	$sql = "SELECT * FROM `produkte` WHERE `artikelnummer` = \"$artikel\" LIMIT 1";
	$ergebnis = $db->query($sql);

	if($ergebnis->num_rows == 0) {
		$ergebnis = False;
	}
	
	$db->close();
	return $ergebnis;
}

$result = get_article();

if($result == False) {
	$_GET['artikel'] = "101";
	$result = get_article();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>

<body>
        <div class="detailviewdiv">
			<? 
			$z = $result->fetch_object();
			$files = array();
			$pattern = "weinliste_images/{$z->artikelnummer}_72_medium_*.jpg";
			$files = glob("$pattern",GLOB_BRACE);
			?>
			
        	<img class="detailviewimg" src="<? echo $files['0']; ?>" height="450" border="0"/>
        	
            <h1><? echo $z->produkt; ?> | <? echo $z->rebsorte; ?></h1>
			
			<ul>
			<li>Artikelnummer: <? echo $z->artikelnummer; ?> </li>
			<li class="jahrgang"><? echo $z->jahrgang; ?> | <? echo $z->geschmacksrichtung; ?></li>
        	<li class="qualität"><? echo $z->qualitaet; ?></li>
			<h2>Meine inneren Werte:</h2>
			<li>Alkoholgehalt: <? echo $z->alkohol; ?> % Volumen</li>
			<li>Fruchts&auml;ure: <? echo $z->fruchtsaeure; ?> g/l</li>
			<li>Rests&uuml;&szlig;e: <? echo $z->restsuesse; ?> g/l</li>
            </ul>
			<p><? echo $z->beschreibung; ?><br />
			<? echo $z->speisen; ?></p>
			<p>Empfohlene Trinktemperatur: <? echo $z->trinktemperatur; ?></p>
			<? if(!$z->gebinde_halb == NULL) {?>
				<li class="preis"><? echo $z->gebinde_halb; ?> &euro; pro 0,50 Liter Flasche</li>
			<? } ?>
			
        	<? if(!$z->gebinde_dreiviertel == NULL) {?>
				<li class="preis"><? echo $z->gebinde_dreiviertel; ?> &euro; pro 0,75 Liter Flasche</li>
			<? } ?>
			
			<? if(!$z->gebinde_liter == NULL) {?>
				<li class="preis"><? echo $z->gebinde_liter; ?> &euro; pro 1,00 Liter Flasche</li>
			<? } ?>
			
        	<li class="literpreis">(<? echo $z->preis_liter; ?> &euro; / Liter)</li>
			
        </div>
	</div>
</body>
<!-- InstanceEnd --></html>
