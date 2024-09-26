<?php 
    require_once 'include/database.php';
    $id=$_GET['id'];
    $sqlState = $pdo->prepare('SELECT * FROM produit WHERE id=?');
    $sqlState->execute([$id]);
    $produit = $sqlState->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
    <!--<link href="assets/css/produit.css" rel="stylesheet" type="text/css">-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>produit | <?php echo $produit['libelle']?></title>
</head>
<body>
    <?php include 'include/nav_front.php' ?>
    <div class="container py-2">
        <h4><?php echo $produit['libelle']?>: </h4>
        <div class="row">
            <div class="col-md-6">
                <img style="width: 500px; height: 500px;" src="upload/produit/<?php echo $produit['image']?>" alt="<?php echo $produit['libelle']?>">
            </div>
            <div class="col-md-6">
                
                <div class="d-flex align-items-center">
                <h1 class="w-100"><?php echo $produit['libelle']?></h1>
                <?php 
                    if(!empty($produit['discount'])){
                    ?>
                        <span class="badge text-bg-success float-end">-<?php echo $produit['discount']?>%</span>
                
                    <?php
                    }
                    ?>
                </div>
                <hr>
                <?php 
                $discount=$produit['discount'];
                $prix=$produit['prix'];
                if(!empty($discount)){
                    $total=$prix-(($prix*$discount)/100);
                    ?>
                    <h5>
                    <span class="badge text-bg-danger"><strike style="color:gris">
                    <?php echo $produit['prix']?>MAD  
                    </strike></span></h5>
                    <h5>
                    <span class="badge text-bg-success">    <?php echo $total?>MAD    </span></h5>
                    <?php
                }else{
                    $total=$prix;
                    ?>
                    <h5>
                    <span class="badge text-bg-success"><?php echo $total?>MAD  </span></h5>
                    <?php
                }
                ?>
                
                <div>
                      
                </div>
                <hr>
                <p>
                    <div style="max-width: 600px;max-height: 200px;overflow: auto;">
                        <p class="card-text"><?php echo $produit['description']?></p>
                    </div>
                </p>
                <hr>
                <?php
                $idproduit=$produit['id'];
                $idutilisateur = $_SESSION['client']['id'];
                $qty = $_SESSION['panier'][$idutilisateur][$idproduit] ?? 0;
                $button = $qty == 0 ? 'Ajouter au panier' : 'Modifier le panier';
                ?>
                <div >
                    <form method="post" class="counter d-flex mx-auto" action="ajouter_panier.php">
                        <button onclick="return false;" class="btn btn-primary mx-2 counter-moins">-</button>
                        <input type="hidden" name="id" value="<?php echo $idproduit ?>">
                        <input type="number" class="form-control" value="<?php echo $qty ?>" name="qty" id="qty" max="99" min="0" >
                        <button onclick="return false;" class="btn btn-primary mx-2 counter-plus">+</button>
                        <hr>
                        <input type="submit" class="btn btn-primary" value="<?php echo $button ?>" name="ajouter">
                    </form>
                </div>
                
                
                
            </div>
        </div>
    </div>
    <script src="assets/js/produit/counter.js"></script>
</body>
</html>