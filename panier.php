<?php 
    require_once 'include/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/produit.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>Panier</title>
</head>
<body>
    <?php include 'include/nav_front.php' ?>
    <div class="container py-2">
    <?php
        if (!isset($_SESSION['panier'])) {
          $_SESSION['panier'] = array();
      }
      $idutilisateur = $_SESSION['client']['id'];
      $panierUtilisateur = $_SESSION['panier'][$idutilisateur] ?? array();
      
      if (isset($panierUtilisateur)) {
        $nombreProduitsDansPanier = count($panierUtilisateur);
        }else {
        $nombreProduitsDansPanier = 0;
        }
      ?>
      <?php
        if(isset($_POST['vider'])){
            $_SESSION['panier'][$idutilisateur]=[];
            header('location: panier.php');
        }

        $idutilisateur = $_SESSION['client']['id'];
        if (isset($_SESSION['panier'][$idutilisateur])) {
            $panier = $_SESSION['panier'][$idutilisateur];
        } else {
            $panier = array();
        }

        if(!empty($panier)){
            $idproduit= array_keys($panier);
            $idproduit=implode(',',$idproduit);          
            $produits= $pdo->query("SELECT * FROM produit WHERE id IN ($idproduit)")->fetchAll(PDO::FETCH_ASSOC);
        }
        
        if(isset($_POST['valider'])){
            $sql = 'INSERT INTO ligne_commande(id_produit,id_commande,prix,quantite,total) VALUES';
            $total=0;
            $prixproduits = [];
            foreach($produits as $produit){
                $idproduit=$produit['id'];
                $qty = $panier[$idproduit];
                $prix = $produit['prix'];
                $total+=$prix*$qty;
                $prixproduits[$idproduit] = [
                    'id' => $idproduit,
                    'prix' => $prix,
                    'total' => $qty*$prix,
                    'qty' => $qty
                ];
            }

            $sqlStateCommande = $pdo->prepare('INSERT INTO commande(id_client,total) VALUES(?,?)');
            $sqlStateCommande->execute([$idutilisateur,$total]);
            $idcommande = $pdo->lastInsertId();
            $args = [];
            foreach($prixproduits as $produit){
                $id = $produit['id'];
                $sql.= "(:id$id,'$idcommande',:prix$id,:qty$id,:total$id),";
            }

            $sql = substr($sql,0,-1);
            $sqlState = $pdo->prepare($sql);
            foreach($prixproduits as $produit){
                $id = $produit['id'];
                $sqlState->bindParam(':id'.$id , $produit['id']);
                $sqlState->bindParam(':prix'.$id , $produit['prix']);
                $sqlState->bindParam(':qty'.$id , $produit['qty']);
                $sqlState->bindParam(':total'.$id , $produit['total']);
            }
            $inserted = $sqlState->execute();
            if($inserted){
                $_SESSION['panier'][$idutilisateur] = [];
                ?>
                <div class="alert alert-success" role="alert">
                       Votre commande aver le montant '<?= $total ?>MAD' est bien ajoutée. 
                    </div>
                <?php
            }

        }
        ?>
        <h4>Panier (<?php echo $nombreProduitsDansPanier; ?>)</h4>
        <div class="row">
            <?php
            
            if(empty($panier)){
                ?>
                    <div class="alert alert-warning" role="alert">
                       Aucune produits dans le panier pour l'instant. 
                    </div>
                    <?php
            }else{
                
                ?>
                
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Image</th>
                            <th>Libellé</th>
                            <th>Quantité</th>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                $total=0;
            foreach ($produits as $produit) {
                $idproduit=$produit['id'];
                $totalproduit= $produit['prix']*$panier[$idproduit];
                $total = $totalproduit + $total;
                ?>
                <tr>
                    <td><?php echo $produit['id'] ?></td>
                    <td><img style="max-width:50px; max-hight:70px;" src="upload/produit/<?php echo $produit['image'] ?>"></td>
                    <td><?php echo $produit['libelle'] ?></td>
                    <td><?php echo $panier[$produit['id']] ?></td>
                    <td style="width: 150px;"><?php include 'include/front/counter.php' ?></td>
                    <td><?php echo $produit['prix'] ?> MAD</td>
                    <td><?php echo $totalproduit ?> MAD</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6">TOTAL:</th>
                <th><?php echo $total ?> MAD</th>
            </tr>
            <tr>
                <td colspan="7" align="right">
                    
                    <form method="post">
                        <input type="submit" class="btn btn-success" name="valider" value="Valider la commande">
                        <input onclick="return confirm('Voulez-vous vraiment vider le panier?')" type="submit" class="btn btn-danger" name="vider" value="Vider le panier">
                    </form>
                </td>
            </tr>
        </tfoot>
        </table>
        <?php
            }
            ?>
            
        </div>
    </div>
    
</body>
</html>