<?
session_start();
require_once("mariadb.inc");
require_once("basket.inc");


# Main

$cnt = basket_count_articles();
$sa = shipping_address();

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
<title>Weinhaus Michel – Online-Bestellung</title>
<link href="../style/default.css" rel="stylesheet" type="text/css" />
<link href="../favicon.ico" rel="shortcut icon" />
<script charset="utf-8" type="text/javascript" src="../script/ga_anonym.js"></script>
<script charset="utf-8" type="text/javascript" src="../script/tinyfader.js"></script>
<!-- InstanceParam name="active_nav" type="text" value="unsereweine" -->
<!-- InstanceParam name="active_subnav" type="text" value="onlinebestellung" -->
<!-- InstanceParam name="title" type="text" value="Online-Bestellung" -->
<!-- InstanceBeginEditable name="head" -->
<script charset="utf-8" type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script>
$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
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
			<!-- InstanceBeginEditable name="topic" --><img src="../weinpersoenlichkeiten/images/bestellung_01.jpg" alt="Stefan Michel bereitet sich für eine Weinprobe vor." border="0" /><!-- InstanceEndEditable -->
		</div>
	<div class="paging"><!-- InstanceBeginEditable name="seitenscroller" --><!-- InstanceEndEditable --></div></div>
	
  <div id="content"><!-- InstanceBeginEditable name="content" -->
    <h1>Bequem online bestellen</h1>
	<ul class="tabs">
		<li><a href="#tab1">Artikel</a></li>
        <? if(!$cnt == 0) { ?>
		<li><a href="#tab2">Versandadresse</a></li>
		<!-- <li><a href="#tab3">Rechnungsadresse</a></li> -->
        <? } ?>
    </ul>
      <p>
      <br /><a href="weinliste_shop.php">Unsere Weine</a>
      </p>
    <form id="form2" name="form2" method="post" action="basket_sent.php">
	<div class="tab_container">
    	<div id="tab1" class="tab_content">
    		<h2>Artikel<a href="../unsere_weine/beispielbilder/Anja Witczak.vcf"></a></h2>
    		<table width="100%" border="0" cellspacing="4" cellpadding="4">
    			<tr>
    				<th>Nr.</th>
    				<th>Name</th>
    				<th>Einzelpreis</th>
    				<th>Anzahl</th>
                    <th>Pos. Zwischensumme</th>
                    <th>Löschen</th>
    			</tr>
                <? create_shopping_basket(); ?>
    			</table>
            <form>
            <? if(!$cnt == 0) { ?>
            <div class="formfield_input">
                <label for="senden">&nbsp;</label>
                <input type="submit" name="senden" id="senden" value="Kostenpflichtig Bestellen" />
            </div>
            <? } ?>
            </form>
    		<h2>&nbsp;</h2>
    		</div>
    	
    	<div id="tab2" class="tab_content">
    		<h2>Versandadresse</h2>
    		<div class="formfield_input">
				<label for="anrede">Anrede</label>
				<select name="">
					<option>Anrede</option>
					<option value="Herr">Herr</option>
					<option value="Frau">Frau</option>
				</select>
			</div>
			<div class="formfield_input">
				<label for="vorname">Vorname*</label>
				<input type="text" name="vorname" id="vorname" value="<? echo $sa['fn']; ?>"/>
				</div>
			<div class="formfield_input">
				<label for="nachname">Nachname*</label>
				<input type="text" name="nachname" id="nachname" />
				</div>
			<div class="formfield_input">
				<label for="adresse">Straße, Hausnr.*</label>
				<input type="text"  name="adresse" id="adresse"></textarea>
				</div>
				<div class="formfield_input">
				<label for="plz">PLZ*</label>
				<input type="text"  name="plz" id="plz"></textarea>
				</div>
				<div class="formfield_input">
				<label for="ort">Ort*</label>
				<input type="text"  name="ort" id="ort"></textarea>
				</div>
                <div class="formfield_input">
                <label for="ort">Land</label>
                <select name="Land">
                    <option>Deutschland</option>
                </select>
				</div>
                <div class="formfield_input">
				<label for="telefon">Telefonnummer</label>
				<input type="text"  name="telefon" id="telefon"></textarea>
				</div>
				<div class="formfield_input">
				<label for="email">E-Mail*</label>
				<input type="text"  name="email" id="email"></textarea>
				</div>
				<div class="formfield_input">
				<label for="nachricht">Möchten Sie uns noch etwas mitteilen?</label>
				<textarea  name="nachricht" id="nachricht"></textarea>
				</div>
                <div class="formfield_input">
                    <label for="agb">Ich akzeptiere die AGB, Datenschutzrichtline und den bestelle noch 100 Waschmaschinen!</label>
                    <input type="checkbox" />
                </div>
			<div class="formfield_input">
				<label for="senden">&nbsp;</label>
				<input type="submit" name="senden" id="senden" value="Kostenpflichtig Bestellen" />
			</div>
		<p>Die mit * gekennzeichnet Felder sind Pflichtfelder</p>
		</div>
            <!--
			<div id="tab3" class="tab_content">
    		<h2>Rechnungsadresse</h2>
            <p><b>(Wenn abweichend von der Lieferadresse)</b></p>
    		
    			<div class="formfield_input">
    				<label for="anrede">Anrede</label>
    				<select name="">
    					<option>Anrede</option>
    					<option value="Herr">Herr</option>
    					<option value="Frau">Frau</option>
    				</select>
				</div>
    			<div class="formfield_input">
    				<label for="vorname">Vorname*</label>
    				<input type="text" name="vorname" id="vorname" />
    				</div>
    			<div class="formfield_input">
    				<label for="nachname">Nachname*</label>
    				<input type="text" name="nachname" id="nachname" />
    				</div>
    			<div class="formfield_input">
    				<label for="adresse">Straße, Hausnr.*</label>
    				<input type="text"  name="adresse" id="adresse"></textarea>
    				</div>
					<div class="formfield_input">
    				<label for="plz">PLZ*</label>
    				<input type="text"  name="plz" id="plz"></textarea>
    				</div>
					<div class="formfield_input">
    				<label for="ort">Ort*</label>
    				<input type="text"  name="ort" id="ort"></textarea>
    				</div>
    			    <div class="formfield_input">
    				<label for="senden">&nbsp;</label>
    				<input type="submit" name="senden" id="senden" value="Kostenpflichtig Bestellen" />
    				</div>
    		<p>Die mit * gekennzeichnet Felder sind Pflichtfelder</p>
			</div></div></form>
			-->
    <br clear="all" />
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
