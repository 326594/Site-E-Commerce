<?php
require_once 'include/database.php';
$id=$_GET['id'];
$sqlState=$pdo->prepare('DELETE FROM produit WHERE id=?');
$supprimer = $sqlState->execute([$id]);
if($supprimer){
    header('location: produits.php');
}else{
    ?>
    <div class="alert alert-danger" role="alert">
        Ul y'a un erreur lors de la suppression.
    </div>                    
    <?php
}
?>