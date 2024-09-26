<?php
session_start();
if(!isset($_SESSION['client'])){
    header("location: connexion.php");
}
$id=$_POST['id'];
$qty=$_POST['qty'];
$idutilisateur=$_SESSION['client']['id'];
    if(!isset($_SESSION['panier'][$idutilisateur])){
        $_SESSION['panier'][$idutilisateur]=[];
    }
    if($qty==0){
        unset($_SESSION['panier'][$idutilisateur][$id]);
    }else{
        $_SESSION['panier'][$idutilisateur][$id]=$qty;
    }
    
header("location:".$_SERVER['HTTP_REFERER']);

?>