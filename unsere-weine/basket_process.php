<?php
require_once("mariadb.inc");
session_start();

$maria = new MariaDB();

$serialize = serialize($_SESSION);
var_dump($serialize);

var_dump(unserialize($serialize));




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
<title>Weinhaus Michel – Bestellung</title>
<link href="../style/default.css" rel="stylesheet" type="text/css" />
<link href="../favicon.ico" rel="shortcut icon" />
<script charset="utf-8" type="text/javascript" src="../script/ga_anonym.js"></script>
<script charset="utf-8" type="text/javascript" src="../script/tinyfader.js"></script>
<!-- InstanceParam name="active_nav" type="text" value="bestellung" -->
<!-- InstanceParam name="active_subnav" type="text" value="" -->
<!-- InstanceParam name="title" type="text" value="Bestellung" -->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->

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
     <li><a href="weinliste.php" class="inactive">Unsere Weine</a></li>
    <li><a href="../weinpersoenlichkeiten/michels-weine.html" class="inactive">Weinpersönlichkeiten</a>
      	<ul class="inactive">
        <li><a href="../weinpersoenlichkeiten/rotweine.html" class="inactive">Rotweine</a></li>
        <li><a href="../weinpersoenlichkeiten/weisswein.html" class="inactive">Weißweine</a></li>
        <li><a href="../weinpersoenlichkeiten/kraeutertrunk.html" class="inactive">Kräutertrunk</a></li>
        <li><a href="../weinpersoenlichkeiten/verfuehrer.html" class="inactive">Andere Verführer</a></li>
        <li><a href="../weinpersoenlichkeiten/praesente.html" class="inactive">Präsente</a></li>
        
      </ul>
     </li>
     <li><a href="bestellung.html" class="active">Bestellung / AGB</a></li>
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
            <h1><a href="download/Weinbestllung_2012-13.pdf" target="_blank"><img src="../ueber-uns/images/bestellbutton.png" title="Bestellliste als PDF downloaden!" width="320" height="112" alt="Bestellliste downloaden!" /></a></h1>
            <h1>Ihre Bestellung – der einfache Weg zum perfekten Genuss …</h1>
            <p>Vielen Dank für Ihre Bestellung. Wir werden diese schnellstmöglich bearbeiten und Ihnen dann eine Auftragsbestätigung senden.</p>
            <p>Bitte geben Sie uns hierfür ein bis zwei Werktage Zeit.</p>
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
