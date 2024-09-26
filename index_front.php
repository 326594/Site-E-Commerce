<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Liste des categories</title>
</head>
<body>
    <?php include 'include/nav_front.php' ?>
    <div class="container py-2">
        <h4>La liste des catégories</h4>
        <?php 
            require_once 'include/database.php';
            $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <ul class="list-group">
            <?php
            foreach ($categories as $categorie) {
                ?><li class="list-group-item">
                    <a href="categorie.php?id=<?php echo $categorie['id']?>" class="btn btn-light">
                    <i class="fa <?php echo $categorie['icone'] ?>"></i> <?php echo $categorie['libelle']?>
                    </a>
                    </li>
            <?php
            }
            ?>
        </ul>
    </div>
</body>
</html>