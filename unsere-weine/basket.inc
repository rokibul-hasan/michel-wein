<?php

require_once("mariadb.inc");

class Basket {

    private $maria;
    public $count_articles, $count_items, $basket_view, $price_wo_shipping, $zips_free_shipping;

    function __construct() {
        $this->zips_free_shipping = array("55116", "55118");

        $this->maria = new MariaDB();
        $this->get_count_articles();
        $this->get_count_items();
        $this->create_shopping_basket();
    }


    # Anzahl der verschiedenen Produkte
    function get_count_articles() {
        if(!isset($_SESSION['articles']) or count($_SESSION['articles']) == 0) {
            $this->count_articles = 0;
        }
        else {
            $this->count_articles = count($_SESSION['articles']);
        }
    }


    # Anzahl der bestellten Einzelteile
    public function get_count_items() {

        $this->get_count_articles();
        $this->count_items = 0;

        if ($this->count_articles == 0) {
            $this->count_items = 0;
        }
        else {
            foreach ($_SESSION['articles'] as $k => $v) {
                $this->count_items = $this->count_items + $v;
            }
        }
    }


    function get_price_nice_format($price) {
        return(number_format($price, 2, ",", "."));
    }


    function get_price_calc_format($price) {
        return(str_replace(',','.',$price));
    }


    function get_product_price($product) {
        $product = $this->maria->get_product($product);

        if(!$product->gebinde_halb == NULL) {
            $price = $product->gebinde_halb;
        }
        elseif(!$product->gebinde_dreiviertel == NULL) {
            $price = $product->gebinde_dreiviertel;
        }
        else {
            $price = $product->gebinde_liter;
        }
        $price = $this->get_price_calc_format($price);
        return $price;
    }

    function get_sub_total_price($price, $quantity) {
       return($price * $quantity);
    }

    private function helper_shipping_costs($remaining_items, $size, $softlimit, $size_price) {
        $v = floor($remaining_items / intval($size));
        $shipping_costs = 0;

        if(floor($v) >= 1.0) {
            $remaining_items = $remaining_items - $v * $size;
            $shipping_costs = $v*$size_price + $shipping_costs;
        }

        if ($remaining_items > $softlimit) {
            $shipping_costs = $shipping_costs + $size_price;
            $remaining_items = 0;
        }



        $result = array($remaining_items, $shipping_costs);
        return($result);

    }

    public function get_shipping_costs() {
        $this->get_count_items();
        $shipping_costs = 0;

        if (in_array($_SESSION['shipping_address']['Postleitzahl'], $this->zips_free_shipping)) {
            $shipping_costs = 0;
        }
        elseif($this->count_items >= 90) {
            $shipping_costs = 0;
        }
        elseif($this->price_wo_shipping >=500) {
            $shipping_costs = 0;
        }
        elseif($this->count_items >= 60 and $this->count_items < 90) {
            $shipping_costs = 19.80;
        }
        elseif($this->count_items < 60) {
            $items = $this->count_items;

            $result = $this->helper_shipping_costs($items, 18, 13, 11.80);
            $shipping_costs = $result[1]+$shipping_costs;

            $result = $this->helper_shipping_costs($result[0], 12, 6, 8.80);
            $shipping_costs = $result[1]+$shipping_costs;

            $result = $this->helper_shipping_costs($result[0], 6, 6, 6.80);
            $shipping_costs = $result[1]+$shipping_costs;

            if ($result[0] > 0) {
                $shipping_costs = $shipping_costs + 6.80;
            }
        }

        $_SESSION['costs']['shipping'] = $shipping_costs;
    }

    function get_price_wo_shipping() {
        $total = 0;

        foreach ($_SESSION['articles'] as $k => $v) {
            $product_price = $this->get_product_price($k);
            $total = $product_price * $v + $total;
        }
        $this->price_wo_shipping = $total;

    }

    function get_complete_price() {
           $this->get_price_wo_shipping();
           $this->get_shipping_costs();
           $total = $this->price_wo_shipping + $_SESSION['costs']['shipping'];
           $_SESSION['costs']['total'] =  $total;

    }


    function get_german_vat($price) {
        $price = $this->get_price_calc_format($price);
        $vat = $price/1.19;
        $vat = $price - $vat;
        $_SESSION['costs']['vat'] = $vat;


    }


    function create_shopping_basket() {
        $this->basket_view = "<table width='100%' border='0' cellspacing='4' cellpadding='4''>";
        $this->basket_view .= "<tr><th>Nr.</th><th>Name</th><th>Einzelpreis</th><th>Anzahl</th><th>Pos. Zwischensumme</th><th>Löschen</th></tr>";

        if($this->count_articles == 0) {
            $this->basket_view = "<tr class=\"even\"><td colspan='5'>Ihr Warenkorb ist leer.</td>";
        }
        else {
            foreach($_SESSION['articles'] as $k => $v) {
                $product = $this->maria->get_product($k);
                $price = $this->get_product_price($k);
                $sub_total = $this->get_sub_total_price($price, $v);
                $sub_total = $this->get_price_nice_format($sub_total);
                $price = $this->get_price_nice_format($price);
                $this->basket_view .= "<tr class=\"even\"><td>$k</td><td>{$product->produkt}</td><td align=\"right\">$price €</td><td align=\"right\">$v</td><td align=\"right\">$sub_total €</td></td><td><a href=\"basket_delete_product.php?id=$k\">Löschen</a></td></tr>";
            }

            #$this->get_shipping_costs();



            $this->get_complete_price();
            $this->get_german_vat($_SESSION['costs']['total']);

            $_SESSION['costs']['total'] = $this->get_price_nice_format($_SESSION['costs']['total']) ;
            $_SESSION['costs']['vat'] = $this->get_price_nice_format($_SESSION['costs']['vat']);
            $_SESSION['costs']['shipping'] = $this->get_price_nice_format($_SESSION['costs']['shipping']);


            $this->basket_view .= "<tr><td colspan='6' align=\"right\">Versandkosten: {$_SESSION['costs']['shipping']} €</td></tr>";
            $this->basket_view .= "<tr><td colspan=\"6\" align=\"right\"><b>Gesamtpreis: {$_SESSION['costs']['total']} € ({$_SESSION['costs']['vat']} € enthaltene MwSt.)</b></td>";
            $this->basket_view .= "</table>";
        }

    }


}

class Session {

    public function create_shipping_address() {
        $_SESSION['shipping_address'] = array();
        $_SESSION['shipping_address']['Anrede'] = "";
        $_SESSION['shipping_address']['Vorname'] = "";
        $_SESSION['shipping_address']['Firma'] = "";
        $_SESSION['shipping_address']['Nachname'] = "";
        $_SESSION['shipping_address']['Strasse'] = "";
        $_SESSION['shipping_address']['Postleitzahl'] = "";
        $_SESSION['shipping_address']['Stadt'] = "";
        $_SESSION['shipping_address']['Telefon'] = "";
        $_SESSION['shipping_address']['Mail'] = "";
        $_SESSION['shipping_address']['Stadt'] = "";
        $_SESSION['shipping_address']['Nachricht'] = "";
        $_SESSION['shipping_address']['AGB'] = "off";
    }


    public function create_costs_values() {
        $_SESSION['costs'] = array();
        $_SESSION['costs']['complete_price'] = 0;
        $_SESSION['costs']['vat'] = 0;
        $_SESSION['costs']['shipping'] = 0;
    }

    public function unset_tl_array($aname) {
        unset($_SESSION[$aname]);
    }

}

class Checker {

    private $error_fields = array();

    public function error_redirect() {
        header("Location: basket.php");
        exit(0);
    }

    function prevent_sql_injection($k, $v, $mthod) {
        $bad_words_l1 = array("SELECT", "CREATE", "DATABASE", "CURSOR", "EXIT", "WHILE", "FROM", "WHERE", "LIKE", "DROP", "SHOW", "ORDER", "INSERT", "TABLE", "OR", ",", "--", ";", "*");
        $bad_words_l2 = array("UNION");

        foreach($bad_words_l1 as $bad_word) {
            $tmp = $v;
            $v = str_ireplace($bad_word, "", $v);
            if($tmp != $v) {
                array_push($this->error_fields, $k);
            }
        }

        return $v;
    }

    public function check_string($sub_value, $sub_name, $min_length) {
        if(strlen($sub_value) < $min_length) {
            array_push($this->error_fields, $sub_name);
        }
    }

    public function get_error_message() {
            $msg = "";
            $i = 0;

            if(count($this->error_fields) == 0) {
                echo $msg;
                exit(0);
            }

            foreach($this->error_fields as $v) {
                if (!$i == 0) {
                    $msg .= ":";
                }
                $msg .= "$v";
                $i += 1;
            }
            echo $msg;
            exit(0);
    }

    public function check_on_off($sub_value, $sub_name) {
        if(!isset($_SESSION['shipping_address']['AGB'])) {
            array_push($this->error_fields, $sub_name);
        }
        elseif (!$sub_value == "on") {
            array_push($this->error_fields, $sub_name);
        }
    }
}



?>
