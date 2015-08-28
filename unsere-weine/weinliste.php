<?php
error_reporting(E_ALL);

function get_products() {
	$db = @new mysqli( 'localhost', 'michel', 'RRBSe9Npem6eCNps', 'www.michel-wein.de' );
	if (mysqli_connect_errno() != 0) {
	    echo 'Die Datenbank konnte nicht erreicht werden. Folgender Fehler trat auf: <strong>' .mysqli_connect_errno(). ' : ' .mysqli_connect_error(). '</strong>';
		exit(0);
	}
	$db->query("SET NAMES 'utf8'");
	$db->query("SET CHARACTER SET 'utf8'");

	if(!isset($_GET['kategorie'])) {
		$kategorie = "rotwein";
	}
	else {
		$kategorie = $_GET['kategorie'];
	}

	$sql = "SELECT artikelnummer, produkt, jahrgang, qualitaet, geschmacksrichtung, rebsorte, preis_liter, gebinde_halb, gebinde_dreiviertel, gebinde_liter FROM `produkte` WHERE `kategorie` = ? and `active`='1' ";
	$stmt = $db -> prepare($sql);
	$stmt -> bind_param("s", $kategorie);
	$stmt -> execute();
	$stmt -> bind_result($artikelnummer, $produkt, $jahrgang, $qualitaet, $geschmacksrichtung, $rebsorte, $preis_liter, $gebinde_halb, $gebinde_dreiviertel, $gebinde_liter);
	
	$results = array();
	$result = array();
	while($stmt -> fetch()) {
		$result['artikelnummer'] = $artikelnummer;
		$result['produkt'] = $produkt;
		$result['jahrgang'] = $jahrgang;
		$result['qualitaet'] = $qualitaet;
		$result['geschmacksrichtung'] = $geschmacksrichtung;
		$result['rebsorte'] = $rebsorte;
		$result['preis_liter'] = $preis_liter;
		$result['gebinde_halb'] = $gebinde_halb;
		$result['gebinde_dreiviertel'] = $gebinde_dreiviertel;
		$result['gebinde_liter'] = $gebinde_liter;
					
		$results[] = $result;
		$result = array();	
	}
	
	if(count($results) == 0) {
		$results = False;
	}
	
	$stmt -> free_result();
	$db->close();
	
	return $results;
}	


$results = get_products();

if($results == False) {
	$_GET['kategorie'] = "rotwein";
	$results = get_products();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/default.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Das Weinhaus Michel ist eine gemütliche Weinstube mit Gewölbekeller und Straßenterrasse mitten in der Altstadt von Mainz." />
<meta name="keywords" content="Weinhaus, Weinstube, Michel, Stefan, Weingut in Weinolsheim, Mainz, Altstadt, Weinanbau, Weinverkauf, Essen und Trinken, Warme K&uuml;che, Rheinhessische Spezialit&auml;ten, Gew&ouml;lbekeller, Veranstaltungen, Gesellschaften, Stra&szlig;enlokal, Terrasse, Raummiete, Weihnachtsfeier, Reservierungen, Weinbestellung, Fastnacht" />
<meta name="robots" content="index,follow" />
<meta name="language" content="de" />
<meta name="city" content="Mainz" />
<meta name="country" content="DE, Deutschland, Germany" />
<title>Weinhaus Michel – Seitentitel</title>
<link href="../style/default.css" rel="stylesheet" type="text/css" />
<link href="../favicon.ico" rel="shortcut icon" />
<script charset="utf-8" type="text/javascript" src="../script/ga_anonym.js"></script>
<script charset="utf-8" type="text/javascript" src="../script/tinyfader.js"></script>
<!-- InstanceParam name="active_nav" type="text" value="unsereweine" -->
<!-- InstanceParam name="active_subnav" type="text" value="" -->
<!-- InstanceParam name="title" type="text" value="Seitentitel" -->
<!-- InstanceBeginEditable name="head" -->

<link href="../static/css/overview.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="../static/js/jquery.tools.min.js"></script>

<script language="javascript">
$(document).ready(function() {
 	$("ul.tabs").tabs("div.panes > div");
});
</script>

<script language="javascript">
$(function() {

    // if the function argument is given to overlay,
    // it is assumed to be the onBeforeLoad event listener
    
	$("a[rel]").overlay({

		

        mask: 'black',
        effect: 'apple',
		top: '5%',
		left: '15%',

        onBeforeLoad: function() {

            // grab wrapper element inside content
            var wrap = this.getOverlay().find(".contentWrap");

            // load the page specified in the trigger
            wrap.load(this.getTrigger().attr("href"));
			
			
        }

    });
});
</script>

<!-- InstanceEndEditable -->

</head>

<body>
<div id="wrapper">
<div id="logo"><a href="../index.html"><span id="logoback">Weinhaus Michel</span></a></div>
<div id="navigation">
  <ul>
    <li><a href="../index.html" class="inactive">Aktuelles</a>
      <ul class="inactive">
        <li><a href="../ueber-uns/ueber-uns.html" class="inactive">Über uns</a></li>
        <li><a href="../ueber-uns/team.html" class="inactive"> Michels  Team</a></li>
      </ul>
      </li>
	<li><a href="../weinstube/weinstube.html" class="inactive">Weinstube</a>
      <ul class="inactive">
        <li><a href="../weinstube/weinstube.html" class="inactive">Drinnen, draußen und unten</a></li>
        <li><a href="../weinstube/speisekarte.html" class="inactive">Speisekarte</a></li>
        <li><a href="../weinstube/feiernimkeller.html" class="inactive">Feiern im Keller</a></li>
      </ul>
    </li>
    <li><a href="../weinberge/weinberge.html" class="inactive">Weinberge</a>
    	<ul class="inactive">
        <li><a href="../weinberge/weinberge.html" class="inactive">Unsere Weinberge</a></li>
        <li><a href="../weinberge/philosophie.html" class="inactive">Unsere Philosophie</a></li>
      </ul>
     </li>
     <li><a href="weinliste.php" class="active">Unsere Weine</a></li>
    <li><a href="../weinpersoenlichkeiten/michels-weine.html" class="inactive">Weinpersönlichkeiten</a>
      	<ul class="inactive">
        <li><a href="../weinpersoenlichkeiten/rotweine.html" class="inactive">Rotweine</a></li>
        <li><a href="../weinpersoenlichkeiten/weisswein.html" class="inactive">Weißweine</a></li>
        <li><a href="../weinpersoenlichkeiten/kraeutertrunk.html" class="inactive">Kräutertrunk</a></li>
        <li><a href="../weinpersoenlichkeiten/verfuehrer.html" class="inactive">Andere Verführer</a></li>
        <li><a href="../weinpersoenlichkeiten/praesente.html" class="inactive">Präsente</a></li>
        
      </ul>
     </li>
     <li><a href="bestellung.html" class="inactive">Bestellung / AGB</a></li>
    <li><a href="../weintermine/weintermine.html" class="inactive">Wein-Termine</a>
    <ul class="inactive">
    <li><a href="../weintermine/stamweg.html" class="inactive">STAM-Weg</a></li>
    </ul></li>
    <li><a href="../presse/presse.html" class="inactive">Die Presse über uns</a></li>
    <!--<li><a href="../impressionen/impressionen.html" class="inactive">Impressionen</a></li>-->
    <li><a href="../kontakt-impressum/kontakt.html" class="inactive">Kontakt &amp; Anfahrt</a></li>
    <li><a href="../kontakt-impressum/impressum.html" class="inactive">Impressum</a></li>
    <li><a href="https://www.facebook.com/WeinhausMichel" target="_blank"><br />
      <img src="../style/images/facebook.png" width="33" height="33" alt="Besuchen Sie uns auf Facebook" /></a>&nbsp;&nbsp;<a href="http://www.qype.com/place/7697-Weinhaus-Michel-Mainz" target="_blank"><img src="../style/images/qype.png" width="33" height="33" alt="Bewerten Sie uns auf qype" /></a><!--&nbsp;&nbsp;<img src="../style/images/google_+.png" width="33" height="33" alt="Besuchen Sie uns auf google+" />-->&nbsp;&nbsp;<a href="http://www.tripadvisor.de/Restaurant_Review-g187393-d2056808-Reviews-Weinhaus_Michel-Mainz_Rhineland_Palatinate.html" target="_blank"><img src="../style/images/tripadvisor.png" width="33" height="33" alt="Bewerten Sie uns auf Tripadvisor" /></a></li>
    </ul>
</div>

<div id="content_wrapper">
<div id="toplevelnavigation"><a href="../kontakt-impressum/kontakt.html">Kontakt &amp; Anfahrt</a> | <a href="../kontakt-impressum/impressum.html">Impressum</a></div>
<div id="toppic"><div>
			<!-- InstanceBeginEditable name="topic" -->

<ul id="slides">
<li><img src="../weinpersoenlichkeiten/images/unsereweine.jpg" alt="Weine" width="702" height="366" /></li>


			<!-- InstanceEndEditable -->
		</div>
	<div class="paging"><!-- InstanceBeginEditable name="seitenscroller" --><ul id="pagination" class="pagination">
		
	</ul><!-- InstanceEndEditable --></div></div>
	
  <div id="content"><!-- InstanceBeginEditable name="content" -->
  <h1>Unsere Weine</h1>
 
  
  <!-- the tabs -->
	<ul id="unsereweine">
	  <li><a href="<? echo $_SERVER['PHP_SELF']; ?>?kategorie=rotwein">Rotweine</a></li>
	  <li><a href="<? echo $_SERVER['PHP_SELF']; ?>?kategorie=weisswein">Wei&szlig;weine</a></li>
	  <li><a href="<? echo $_SERVER['PHP_SELF']; ?>?kategorie=andere">Andere Verf&uuml;hrer</a></li>
	  </ul>
 
<!-- tab "panes" -->
<div class="panes">
		
			<?
			$id = 101;
			foreach($results as $k => $v) 
		    {
			$id += 1;
			$files = array();
			$pattern = "weinliste_images/{$v['artikelnummer']}_72_thumb_*.jpg";
			$files = glob("$pattern",GLOB_BRACE);
			
			?>
				<a href="weinliste_detail.php?artikel=<? echo $v['artikelnummer']; ?>" rel="#overlay" style="text-decoration:none">    
		        <div class="overviewdiv" id="<? echo $id; ?>">
		        	<img class="overviewimg" src="<? echo $files['0']; ?>" border="0"/>
		        	<ul>
		            <li class="weinname"><h3><? echo $v['produkt']; ?></h3></li>
		        	<li class="jahrgang"><? echo $v['jahrgang']; ?> | <? echo $v['geschmacksrichtung']; ?></li>
		        	<li class="qualität"><? echo $v['rebsorte'] ?></li>
					<li class="qualität"><? echo $v['qualitaet'] ?></li>
		
					<? if(!$v['gebinde_halb'] == NULL) { 
				
					?>
		        			<li class="preis"><? echo $v['gebinde_halb']; ?> &euro;</li>
					<? 
						}
						elseif(!$v['gebinde_dreiviertel'] == NULL) {
					?>
							<li class="preis"><? echo $v['gebinde_dreiviertel']; ?> &euro;</li>
					<?
					  	}
						elseif(!$v['gebinde_liter'] == NULL) {
					?>
							<li class="preis"><? echo $v['gebinde_liter']; ?> &euro;</li>
					<? } ?>
					<li class="literpreis">(<? echo $v['preis_liter']; ?> &euro;/ Liter)</li>
		            </ul>
		        </div>
		        </a>
		    <?
			}
			?>
        
<br clear="all" />    
</div>
<div id="overlay" class="apple_overlay" style="position: fixed; z-index: 9999; background-image: none; display: none; width: 70%;">
  <!-- the external content is loaded inside this tag -->
  <div class="contentWrap"></div>
</div>
  <!-- InstanceEndEditable --></div>
  <div id="stempel"></div>
  <div id="flaschenback"></div>
</div>
<div id="footer">Jakobsbergstraße 8 | 55116 Mainz | Tel.&nbsp;06131&nbsp;233283<br />
  <a href="mailto:info@michel-wein.de">info@michel-wein.de</a>
  <div id="footerpic"></div>
  <br />
  Öffnungszeiten: täglich ab 16.00 Uhr</div>
</div>

<script type="text/javascript">
var slideshow=new TINY.fader.fade('slideshow',{
	id:'slides',
	auto:3,
	resume:true,
	navid:'pagination',
	activeclass:'current',
	visible:true,
	position:0
});
</script>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">
if( gaanonym.switcher.isActive() ) {
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-6249569-1']);
  _gaq.push(['_gat._anonymizeIp']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
      '.google-analytics.com/ga.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
}
</script>

</body>
<!-- InstanceEnd --></html>
