<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Modifier Catégorie</title>
</head>
</style>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <h4>Modifier Catégorie</h4>
        <?php
        require_once 'include/database.php';
        $sqlState=$pdo->prepare('SELECT * FROM produit WHERE id=?');
        $id=$_GET['id'];
        $sqlState->execute([$id]);
        $produit = $sqlState->fetch(PDO::FETCH_ASSOC);

        if(isset($_POST['modifier'])){
            $libelle = $_POST['libelle'];
            $prix = $_POST['prix'];
            $discount = $_POST['discount'];
            $description=$_POST['description'];
            $id_categorie = $_POST['categorie'];

            $filename='';
            if(!empty($_FILES['image']['name'])){
                $image=$_FILES['image']['name'];
                $filename = uniqid().$image;
                move_uploaded_file($_FILES['image']['tmp_name'],'upload/produit/' . $filename);
            }

            if(!empty($libelle) && !empty($prix) && !empty($id_categorie)){
                if(!empty($filename)){
                    $query="UPDATE produit SET libelle=? , prix=? ,discount=? ,id_categorie=? ,description=? ,image=? WHERE id=?";
                    $sqlState = $pdo->prepare($query);
                    $updated=$sqlState->execute([$libelle ,$prix ,$discount ,$id_categorie ,$description ,$filename ,$id]);
                }else{
                    $query="UPDATE produit SET libelle=? , prix=? ,discount=? ,id_categorie=? ,description=? WHERE id=?";
                    $sqlState = $pdo->prepare($query);
                    $updated=$sqlState->execute([$libelle ,$prix ,$discount ,$id_categorie ,$description ,$id]);
                }
                if($updated){
                header('location: produits.php');
                }
                ?>
                <div class="alert alert-success" role="alert">
                    La catégorie <?php echo $libelle ?> est bien ajoutée.
                </div>
                <?php
            }else{
                ?>
                <div class="alert alert-danger" role="alert">
                    Libellé, Prix et Catégorie sont obligatoires a saisie.
                </div>
                <?php
            }
        }
        ?>
        
        <form method="post" enctype="multipart/form-data">
            <label class="form-label">Libellé:</label>
            <input type="text" class="form-control" name="libelle" value="<?php echo $produit['libelle']?>">

            <label class="form-label">Prix:</label>
            <input type="number" class="form-control" name="prix" min="0" value="<?php echo $produit['prix']?>">

            <label class="form-label">Discount:</label>
            <input type="text" class="form-control" name="discount" min="0" max="100" value="<?php echo $produit['discount']?>">

            <label class="form-label">Description:</label>
            <textarea class="form-control" name="description"><?php echo $produit['description']?></textarea>

            <label class="form-label">Image:</label>
            <input type="file" class="form-control" name="image">
            <img class="img img-fluid" src="upload/produit/<?php echo $produit['image']?>">
            <br>

            <?php
            $categories=$pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <label class="form-label">Catégorie:</label>
            <select name="categorie" class="form-control">
                <option value=""> Choisissez une Catégorie</option>
                <?php
                    foreach ($categories as $categorie) {
                        if($produit['id_categorie']==$categorie['id']){
                            echo"<option selected value='".$categorie['id']."'>".$categorie['libelle']."</option>" ;
                        }else{
                            echo"<option value='".$categorie['id']."'>".$categorie['libelle']."</option>" ;
                        }
                    }
                ?>

            </select>

            <input type="submit" value="Modifier Catégorie" class="btn btn-primary my-2" name="modifier">
        </form>
    </div>
</body>
</html>