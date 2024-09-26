<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Listes des Produits</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <h2>Listes des Produits:</h2>
        <a href="ajouter_produits.php" class="btn btn-primary">Ajouter Produit</a>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#ID</th>
                    <th>Image</th>
                    <th>Libellé</th>
                    <th>Prix origine</th>
                    <th>Discount</th>
                    <th>Prix de vente</th>
                    <th>ID Catégorie</th>
                    <th>Date Creation</th>
                    <th>Opération</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                require_once 'include/database.php';
                $produits = $pdo->query("SELECT produit.*,categorie.libelle as 'categorie_libelle' FROM produit INNER JOIN categorie ON produit.id_categorie = categorie.id")->fetchAll(PDO::FETCH_ASSOC);
                foreach($produits as $produit){
                    $prix = $produit['prix'];
                    $discount = $produit['discount'];
                    $prixfinal = $prix-(($prix*$discount)/100);
                    ?>
                <tr>
                    <td><?php echo $produit['id']?></td>
                    <td><img style="max-width:50px; max-hight:70px;" class="img img-fluid" width="90" src="upload/produit/<?php echo $produit['image']?>"></td>
                    <td><?php echo $produit['libelle']?></td>
                    <td><?php echo $produit['prix'] .' MAD'?></td>
                    <td><?php echo $produit['discount'].'%'?></td>
                    <td><?php echo $prixfinal.' MAD'?></td>
                    <td><?php echo $produit['categorie_libelle']?></td>
                    <td><?php echo $produit['date_creation']?></td>
                    <td>
                        <a href="modifier_produit.php?id=<?php echo $produit['id'] ?>" class="btn btn-primary">Modifier</a>
                        <a href="supprimer_produit.php?id=<?php echo $produit['id'] ?>"onclick="return confirm('Voulez-vous supprimer le Produit <?php echo $produit['libelle']?>?')" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
                    <?php
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>