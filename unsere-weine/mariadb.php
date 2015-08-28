<?

class MariaDB {


    public $db = "";

    function __construct() {
        $this->db = @new mysqli( 'localhost', 'michel', '', 'www.michel-wein.de' );
        if (mysqli_connect_errno() != 0) {
            echo 'Die Datenbank konnte nicht erreicht werden. Folgender Fehler trat auf: <strong>' .mysqli_connect_errno(). ' : ' .mysqli_connect_error(). '</strong>';
            exit(0);
        }
        $this->db->query("SET NAMES 'utf8'");
        $this->db->query("SET CHARACTER SET 'utf8'");
    }

    function __destruct() {
        $this->db->close();
    }

   public function get_product($artikelnummer) {
       if(!is_numeric($artikelnummer)) {
           exit(-1);
       }

       $sql = "SELECT  produkt, gebinde_halb, gebinde_dreiviertel, gebinde_liter FROM produkte WHERE artikelnummer='$artikelnummer' LIMIT 1;";
       $query = $this->db->query($sql);
       if($query->num_rows == 0) {
           exit(-2);
       }
       else {
        $product = $query->fetch_object();
        #var_dump($product);
        return $product;
       }
   }



}


?>
