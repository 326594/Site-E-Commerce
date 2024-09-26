<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Listes des Catégories</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <h2>Listes des Catégories:</h2>
        <a href="ajouter_categorie.php" class="btn btn-primary">Ajouter Catégorie</a>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#ID</th>
                    <th>Libellé</th>
                    <th>Description</th>
                    <th>Icône</th>
                    <th>Date de creation</th>
                    <th>Opération</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                require_once 'include/database.php';
                $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
                foreach($categories as $categorie){
                    ?>
                <tr>
                    <td><?php echo $categorie['id']?></td>
                    <td><?php echo $categorie['libelle']?></td>
                    <td><?php echo $categorie['description']?></td>
                    <td><i class="fa <?php echo $categorie['icone'] ?>"></i></td>
                    <td><?php echo $categorie['date_creation']?></td>
                    <td>
                        <a href="modifier_categorie.php?id=<?php echo $categorie['id'] ?>" class="btn btn-primary">Modifier</a>
                        <a href="supprimer_categorie.php?id=<?php echo $categorie['id'] ?>"onclick="return confirm('Voulez-vous supprimer la Catégorie <?php echo $categorie['libelle']?>.')" class="btn btn-danger">Supprimer</a>
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