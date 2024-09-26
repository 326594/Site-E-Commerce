<?php 
    require_once 'include/database.php';
    $id=$_GET['id'];
    $sqlState = $pdo->prepare('SELECT * FROM categorie WHERE id=?');
    $sqlState->execute([$id]);
    $categorie = $sqlState->fetch(PDO::FETCH_ASSOC);

    $sqlState = $pdo->prepare('SELECT * FROM produit WHERE id_categorie=?');
    $sqlState->execute([$id]);
    $produits=$sqlState->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Catégorie | <?php echo $categorie['libelle']?></title>
</head>
<body>
    <?php include 'include/nav_front.php' ?>
    <div class="container py-2">
        <h1>Les produits de <?php echo $categorie['libelle']?> <i class="fa <?php echo $categorie['icone'] ?>"></i>: </h1>
        
        
        <?php 
            require_once 'include/database.php';
            $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="nav-container">
            <ul class="nav">
                <?php
                foreach ($categories as $categorie) {
                    ?><li class="active">
                        <a href="categorie.php?id=<?php echo $categorie['id']?>" class="btn btn-light">
                        <span class="icon"><i class="fa <?php echo $categorie['icone'] ?>"></i></span> <span class="text"><?php echo $categorie['libelle']?></span>
                        </a>
                        </li>
                <?php
                }
                ?>
            </ul>
        </div>


        <div class="row row-cols-1 row-cols-md-4 g-2">
            <?php
            foreach($produits as $produit){
                ?>
                <div class="col">
                <div class="card">
                <img src="upload/produit/<?php echo $produit['image']?>" class="card-img-top" height="350px">
                <div class="card-body">
                    <a href="produit.php?id=<?php echo $produit['id']?>" class="btn stretched-link"></a>
                    <h5 class="card-title"><?php echo $produit['libelle']?></h5>
                    <div style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <p class="card-text"><?php echo $produit['description']?></p>
                    </div>
                    
                    <p class="card-text"><?php echo $produit['prix'].' MAD'?></p>
                    <p class="card-text"><small class="text-body-secondary">Ajouter le: <?php echo date_format(date_create($produit['date_creation']),'Y/m/d') ?></small></p>
                </div>
                </div>
            </div>
            <?php
            }
            if(empty($produits)){
                ?>
                    <div class="alert alert-info" role="alert">
                       Aucune produits dans la catégorie <?php echo $categorie['libelle'] ?> pour l'instant. 
                    </div>
                    <?php
            }
            ?>
            
        </div>
    </div>
    <script src="assets/js/produit/sidebar.js">
</script>
</body>
</html>