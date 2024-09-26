<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">

    <title>Modifier Catégorie</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <h4>Ajouter Catégorie</h4>
        <?php
        require_once 'include/database.php';
        $sqlState=$pdo->prepare('SELECT * FROM categorie WHERE id=?');
        $id=$_GET['id'];
        $sqlState->execute([$id]);
        $categorie = $sqlState->fetch(PDO::FETCH_ASSOC);

        if(isset($_POST['modifier'])){
            $libelle = $_POST['libelle'];
            $description = $_POST['description'];
            $icone=$_POST['icone'];
            if(!empty($libelle)){
                $sqlState = $pdo->prepare('UPDATE categorie SET libelle=? , description=? , icone=? WHERE id=?');
                $sqlState->execute([$libelle ,$description ,$icone ,$id]);
                header('location: categories.php');
                ?>
                <div class="alert alert-success" role="alert">
                    La catégorie <?php echo $libelle ?> est bien ajoutée.
                </div>
                <?php
            }else{
                ?>
                <div class="alert alert-danger" role="alert">
                    Libellé et Description sont obligatoires.
                </div>
                <?php
            }
        }
        ?>
        
        <form method="post">
            <input type="hidden" class="form-control" name="id" value="<?php echo $categorie['id']?>">
        
            <label class="form-label">Libellé:</label>
            <input type="text" class="form-control" name="libelle" value="<?php echo $categorie['libelle']?>">

            <label class="form-label">Description:</label>
            <textarea class="form-control" name="description"><?php echo $categorie['description']?></textarea>

            <label class="form-label">Icône:</label>
            <input type="text" class="form-control" name="icone" value="<?php echo $categorie['icone']?>">

            <input type="submit" value="Modifier Catégorie" class="btn btn-primary my-2" name="modifier">
        </form>
    </div>
</body>
</html>