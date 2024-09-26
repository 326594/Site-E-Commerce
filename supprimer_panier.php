<?php
session_start();
if(!isset($_SESSION['client'])){
    header("location: connexion.php");
}
$idutilisateur=$_SESSION['client']['id'];

$id = $_POST['id'];
unset($_SESSION['panier'][$idutilisateur][$id]);
header("location:".$_SERVER['HTTP_REFERER']);
?>