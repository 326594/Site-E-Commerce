<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Aouter Produit</title>
</head>
<body>
    <?php require_once 'include/database.php';
    include 'include/nav.php' ?>
    <div class="container py-2">
        <h4>Ajouter Produit</h4>
        <?php
            if(isset($_POST['ajouter'])){
                $libelle=$_POST['libelle'];
                $prix=$_POST['prix'];
                $discount=$_POST['discount'];
                $categorie=$_POST['categorie'];
                $description=$_POST['description'];
                $date = date('Y-m-d');

                $filename='produit.png';
                if(!empty($_FILES['image']['name'])){
                    $image=$_FILES['image']['name'];
                    $filename = uniqid().$image;
                    move_uploaded_file($_FILES['image']['tmp_name'],'upload/produit/' . $filename);
                }

                if(!empty($libelle) && !empty($prix) && !empty($categorie)){
                    $sqlState=$pdo->prepare('INSERT INTO produit VALUES(null,?,?,?,?,?,?,?)');
                    $sqlState->execute([$libelle,$prix,$discount,$categorie,$date,$description,$filename]);
                    header('location: produits.php');
                    ?>
                    <div class="alert alert-success" role="alert">
                    les données sont saisie correctement.
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="alert alert-danger" role="alert">
                    Remlir tous les cases.
                    </div>                    
                    <?php
                }
            }
        ?> 
        <form method="post" enctype="multipart/form-data">
            <label class="form-label">Libellé:</label>
            <input type="text" class="form-control" name="libelle">

            <label class="form-label">Prix:</label>
            <input type="number" class="form-control" step="0.1" name="prix" min="0">
            
            <label class="form-label">Discount:</label>
            <input type="number" class="form-control" name="discount" min="0" max="100">

            <label class="form-label">Description:</label>
            <textarea class="form-control" name="description"></textarea>

            <label class="form-label">Image:</label>
            <input type="file" class="form-control" name="image">

            <?php
            $categorie=$pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <label class="form-label">Catégorie:</label>
            <select name="categorie" class="form-control" my-2>
                <option value="">Choisissez une Catégorie</option>
                <?php
                foreach ($categorie as $categorie){
                    echo"<option value='".$categorie['id']."'>".$categorie['libelle']."</option>";
                }
                ?>
            </select>

            <input type="submit" value="Ajouter Produit" class="btn btn-primary my-2" name="ajouter">
        </form>
    </div>
</body>
</html>