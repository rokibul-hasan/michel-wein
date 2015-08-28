<?
session_start();

$error = 0;

if(!isset($_GET['id'])) {
   $error = 1;
}
elseif(!is_numeric($_GET['id'])) {
    $error = 2;
}
elseif(!isset($_SESSION['articles'][$_GET['id']])) {
    $error = 3;
}



if($error == 1) {
    #echo("error $error");
    header("Location: basket.php");
    exit(0);
}
else {
    #echo("DEL");
    unset($_SESSION['articles'][$_GET['id']]);
    header("Location: basket.php");
    exit(0);
}


?>
