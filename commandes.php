<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Listes des Commandes</title>
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
                require_once 'include/database.php';
                $commandes = $pdo->query('SELECT commande.* , client.prenom , client.nom FROM commande INNER JOIN client ON commande.id_client = client.id ORDER BY commande.date_creation DESC')->fetchAll(PDO::FETCH_ASSOC);
                foreach($commandes as $commande){
                    ?>
                <tr>
                    <td><?php echo $commande['id']?></td>
                    <td><?php echo $commande['prenom'].' '.$commande['nom']?></td>
                    <td><?php echo $commande['total']?>MAD</td>
                    <td><?php echo $commande['date_creation']?></td>
                    <td><a class="btn btn-primary btn-sm" href="commande.php?id=<?php echo $commande['id']?>">Afficher Détails</a></td>
                </tr>
                    <?php
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>