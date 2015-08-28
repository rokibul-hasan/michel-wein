<?
session_start();

$methods = array("add-change", "delete");
$now = date(DATE_RFC822);

if (!isset($_SESSION['articles'])) {
	$_SESSION['articles'] = array();
}

if (!isset($_POST["method"]) or !isset($_POST['article']) or !isset($_POST['quantity'])) {
    echo("Fehler 1: Fehlender Wert");
    exit(-1);
}
elseif(!in_array($_POST["method"], $methods)) {
    echo("Fehler 2: Falsche Methode");
    exit(-2);
}
elseif(!is_numeric($_POST['quantity']) or !is_numeric($_POST['article'])) {
    echo("Fehler 3: Falsche Menge oder Artikel");
    exit(-3);
}
else {

    $method = $_POST["method"];
    $article = $_POST["article"];
    $quantity = $_POST["quantity"];

    $datei_handle=fopen("/tmp/log.txt", "a");

    if($method == "add-change") {

        if ($quantity == 0) {
            unset($_SESSION['articles'][$article]);

            if (count($_SESSION['articles']) == 0) {
                unset($_SESSION['articles']);
            }

            $msg = "<b>Artikel $article aus Warenkorb gelöscht.</b>";
        }
        else {
            if(!isset($_SESSION['articles'][$article])) {
                $msg = "<b>Artikel $article: $quantity Flasche(n) in den Warenkorb hinzugefügt.</b>";
            }
            elseif($_SESSION['articles'][$article] < $quantity) {
                $msg = "<b>Artikel $article: Menge auf $quantity Flasche(n) im Warenkorb erhöht.</b>";
            }
            elseif($_SESSION['articles'][$article] > $quantity) {
                $msg = "<b>Artikel $article: Menge auf $quantity Flasche(n) im Warenkorb verringert.</b>";

            }

            $_SESSION['articles'][$article] = $quantity;
        }

        fwrite($datei_handle, $now." Article: ".$article." Quantity: ".$quantity." Method: ".$method."\n");
        $dump = serialize($_SESSION);
        fwrite($datei_handle, $now." ".$dump."\n");

    }

    fclose($datei_handle);
    echo $msg;

}



exit(0);
?>
