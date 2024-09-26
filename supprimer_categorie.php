<?php
require_once 'include/database.php';
$id=$_GET['id'];
$sqlState=$pdo->prepare('DELETE FROM categorie WHERE id=?');
$supprimer = $sqlState->execute([$id]);
if($supprimer){
    header('location: categories.php');
}else{
    ?>
    <div class="alert alert-danger" role="alert">
        Ul y'a un erreur lors de la suppression.
    </div>                    
    <?php
}
?>