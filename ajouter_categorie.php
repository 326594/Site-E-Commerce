<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Ajouter Catégorie</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <h4>Ajouter Catégorie</h4>
        <?php
            if(isset($_POST['ajouter'])){
                $libelle = $_POST['libelle'];
                $description = $_POST['description'];
                $icone= $_POST['icone'];

                if(!empty($libelle)){
                    require_once 'include/database.php';
                    $sqlState = $pdo->prepare('INSERT INTO categorie(libelle,description,icone) VALUES(?,?,?)');
                    $sqlState->execute([$libelle ,$description ,$icone]);
                    header('location: categories.php');
                    ?>
                    <div class="alert alert-success" role="alert">
                        La catégorie <?php echo $libelle ?> est bien ajoutée.
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Libellé est obligatoire.
                    </div>
                    <?php
                }
            }
        ?>
        
        <form method="post">
            <label class="form-label">Libellé:</label>
            <input type="text" class="form-control" name="libelle">

            <label class="form-label">Description:</label>
            <textarea class="form-control" name="description"></textarea>

            <label class="form-label">Icône:</label>
            <input type="text" class="form-control" name="icone">

            <input type="submit" value="Ajouter Catégorie" class="btn btn-primary my-2" name="ajouter">
        </form>
    </div>
</body>
</html>