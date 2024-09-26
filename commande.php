<?php 
require_once 'include/database.php';
$idcommande = $_GET['id'];
$sqlState = $pdo->prepare('SELECT commande.* , client.prenom , client.nom FROM commande INNER JOIN client ON commande.id_client = client.id WHERE commande.id = ? ORDER BY commande.date_creation DESC');
$sqlState->execute([$idcommande]);
$commande = $sqlState->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Commande | Numéro <?php echo $commande['id']?></title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <h2>Listes des Commandes:</h2>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#ID</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Opérations</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $sqlStateCommande = $pdo->prepare('SELECT ligne_commande.* , produit.libelle , produit.image FROM ligne_commande INNER JOIN produit ON ligne_commande.id_produit = produit.id WHERE id_commande = ?');
                $sqlStateCommande->execute([$idcommande]);
                $lignecommande = $sqlStateCommande->fetchAll(PDO::FETCH_ASSOC);

                    ?>
                <tr>
                    <td><?php echo $commande['id']?></td>
                    <td><?php echo $commande['prenom'].' '.$commande['nom']?></td>
                    <td><?php echo $commande['total']?></td>
                    <td><?php echo $commande['date_creation']?></td>
                    <td><?php 
                    if($commande['valide'] == 0){
                        ?><a href="valider.php?id=<?php echo $commande['id']?>&etat=1"class="btn btn-success btn-sm"><i class="fa-solid fa-square-check"></i> Valider la commande</a><?php
                    }else{
                        ?><a href="valider.php?id=<?php echo $commande['id']?>&etat=0"class="btn btn-danger btn-sm"><i class="fa-solid fa-square-xmark"></i> Annuler la Commande</a><?php
                    }
                    ?></td>
                </tr>
                    <?php
            ?>
            </tbody>
        </table>
        <hr>
        <h2>Produit:</h2>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#ID</th>
                    <th>Produit</th>
                    <th>Prix Unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($lignecommande as $commande){
                    ?>
                <tr>
                    <td><?php echo $commande['id']?></td>
                    <td><?php echo $commande['libelle']?></td>
                    <td><?php echo $commande['prix']?> MAD</td>
                    <td><?php echo $commande['quantite']?></td>
                    <td><?php echo $commande['total']?> MAD</td>
                    <td>
                        
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