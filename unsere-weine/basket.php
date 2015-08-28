<?php
session_start();
require_once("basket.inc");

if (isset($_SESSION['shipping_address'])) {
    $sa = $_SESSION['shipping_address'];
}
else {
    $session = new session();
    $session->create_shipping_address();
    $sa = $_SESSION['shipping_address'];
    $session->create_costs_values();
}

$basket = new Basket();
$cnt = $basket->count_articles;
$basket_view = $basket->basket_view;



function create_anrede() {
    global $sa;
    $anreden = array("Anrede", "Herr", "Frau");
    $options = "";

    foreach($anreden as $anrede) {
        if(isset($sa['anr']) and $sa['anr'] == $anrede) {
            $options .= "<option selected value=\"$anrede\">$anrede</option>";
        }
        else {
            $options .= "<option value=\"$anrede\">$anrede</option>";
        }
    }

    return $options;
}

function create_agb() {
    global $sa;
    if(isset($sa['AGB']) and $sa['AGB'] == "on" ) {
      $agb = "checked";
    }
    else {
      $agb = "";
    }
    return $agb;

}

$anrede = create_anrede();
$agb = create_agb();
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
<!-- <script charset="utf-8" type="text/javascript" src="../script/jquery-1.4.4.min.js"></script> -->

<script src="../static/js/jquery-1.10.1.min.js"></script>
<script src="../static/js/jquery-migrate-1.2.1.min.js"></script>

<!-- Panes -->
<link href="../static/css/overview.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../static/js/jquery.tools.min.js"></script>
<!-- /Panes -->

<script language="javascript">
    $(document).ready(function(){
        $("ul.tabs").tabs("div.panes > div");

        $('#form2').submit(function(e) {
            e.preventDefault();
            $.post("basket_ajax.php", $("#form2").serialize(),
                function(data, status){
                    len = data.length;

                    $("#form2 input").each(function(e) {
                        $(this).css('border-color', '#DDDFE1');
                    });

                    if (len == 0) {
                        window.location.href = "basket_process.php";
                    }
                    else {
                        //alert(data);
                        test = data.split(":");
                        var i = 0;
                        var tmp = "";
                        var len = test.length;
                        var msg = "";

                        for (i = 0; i < len; ++i) {
                            tmp = "#"+test[i];
                            $(tmp).css('border-color','red');
                            if(i == 0) {
                                msg = test[i];
                            }
                            else {
                                msg = msg+", "+test[i];
                            }
                        }
                        if(len == 1) {
                            msg = "Bitte überprüfen Sie folgende Eingabe: " + msg + ".";
                        }
                        else {
                            msg = "Bitte überprüfen Sie folgende Eingaben: " + msg + ".";
                        }
                        msg = "<strong>" + msg + "</strong>";
                        $("#shop_message").html(msg).css("color", "red");
                    }
            });
        });

        $("#Postleitzahl").change(function(e){
            $.post("basket_zip_ajax.php",
            {
                name: this.name,
                value: this.value
            },
            function(data,status) {
                //alert("Data: " + data + "\nStatus: " + status);
                $("#basket_view").html(data);
            });
        });
    });
</script>
<!-- Panes -->
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
<!-- /Panes -->


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

      <!-- the tabs -->
      <ul id="unsereweine">
          <li><a href="weinliste_shop.php?kategorie=rotwein">Rotweine</a></li>
          <li><a href="weinliste_shop.php?kategorie=weisswein">Wei&szlig;weine</a></li>
          <li><a href="weinliste_shop.php?kategorie=andere">Andere Verf&uuml;hrer</a></li>
          <li><a href="#">Warenkorb</a></li>
      </ul>

      <!-- tab "panes" -->
<div class="panes">


    <form id="form2" name="form2" method="post" action="">
    		<h2>Ihre Artikelauswahl</h2>
            <div id="basket_view">
                    <? echo $basket_view; ?>
            </div>

            <? if(!$cnt == 0) { ?>

    		<h2>Versandadresse</h2>
            <div id="shop_message">&nbsp;</div>
    		<div class="formfield_input">
				<label for="anr">Anrede</label>
				<select name="anr">
                    <?php echo $anrede; ?>
				</select>
			</div>
             <div class="formfield_input">
                <label for="Firma">Firma</label>
                <input type="text" name="Firma" id="Firma" value="<? echo $sa['Firma']; ?>"/>
             </div>
			<div class="formfield_input">
				<label for="vorname">Vorname*</label>
				<input type="text" name="Vorname" id="Vorname" value="<? echo $sa['Vorname']; ?>"/>
			</div>
			<div class="formfield_input">
				<label for="nachname">Nachname*</label>
				<input type="text" name="Nachname" id="Nachname" value="<? echo $sa['Nachname']; ?>" />
				</div>
			<div class="formfield_input">
				<label for="Strasse">Straße, Hausnr.*</label>
				<input type="text"  name="Strasse" id="Strasse" value="<? echo $sa['Strasse']; ?>" />
				</div>
				<div class="formfield_input">
				<label for="plz">PLZ*</label>
				<input type="text"  name="Postleitzahl" id="Postleitzahl" maxlength="5" value="<? echo $sa['Postleitzahl']; ?>" />
				</div>
				<div class="formfield_input">
				<label for="Ort">Ort*</label>
				<input type="text"  name="Stadt" id="Stadt" value="<? echo $sa['Stadt']; ?>" />
				</div>
                <div class="formfield_input">
                <label for="Land">Land</label>
                <select name="Land" id="Land">
                    <option>Deutschland</option>
                </select>
				</div>
                <div class="formfield_input">
				<label for="Telefon">Telefonnummer</label>
				<input type="text"  name="Telefon" id="Telefon" value="<? echo $sa['Telefon']; ?>" />
				</div>
				<div class="formfield_input">
				<label for="email">Mail*</label>
				<input type="text"  name="Mail" id="Mail" value="<? echo $sa['Mail']; ?>" />
				</div>
				<div class="formfield_input">
				<label for="Nachricht">Möchten Sie uns noch etwas mitteilen?</label>
				<textarea  name="Nachricht" id="Nachricht"><? echo $sa['Nachricht']; ?></textarea>
				</div>
                <div class="formfield_input">
                    <label for="AGB">Ich akzeptiere die AGBs.</label>
                    <input type="checkbox" name="AGB" id="AGB" <?php echo $agb; ?> />
                </div>
			<div class="formfield_input">
				<label for="senden">&nbsp;</label>
				<input type="submit" name="submit" id="submit" value="Kostenpflichtig Bestellen" />
			</div>

        <p>Die mit * gekennzeichnet Felder sind Pflichtfelder</p>
        <?php } ?>
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
        </form>


      <br clear="all" />
      <p>&nbsp;</p>

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
