<?php   
    $idutilisateur = $_SESSION['client']['id'];
    $qty = $_SESSION['panier'][$idutilisateur][$idproduit] ?? 0;
    $button = $qty == 0 ? 'Ajouter au panier' : 'Modifier le panier';
?>
<div >
    <form method="post" class="counter d-flex " action="ajouter_panier.php">
        <button onclick="return false;" class="btn btn-primary mx-2 counter-moins">-</button>
        <input type="hidden" name="id" value="<?php echo $idproduit ?>">
        <input type="number" style="width:90px;" class="form-control" value="<?php echo $qty ?>" name="qty" id="qty" max="99" min="0" >
        <button onclick="return false;" class="btn btn-primary mx-1 counter-plus">+</button>
                <button type="submit" class="btn btn-success mx-1" name="modifier">
                    <i class="fa-solid fa-pen"></i>
                </button>
        <?php
        if($qty != 0){
            ?>
            <form action="supprimer_panier.php" method="post">
                <button formaction="supprimer_panier.php" type="submit" class="btn btn-danger mx-1" name="supprimer">
                    <i class="fa fa-duotone fa-trash"></i>
                </button>
            </form>

            <?php
        }
        ?>
        
    </form>
</div>
<script src="assets/js/produit/counter.js"></script>