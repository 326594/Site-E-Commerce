<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <title> Inscription</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <?php 
            if(isset($_POST['ajouter'])){
                $nom=$_POST['nom'];
                $prenom=$_POST['prenom'];
                $login=$_POST['login'];
                $password=$_POST['password'];

                echo"Hello $prenom $nom dans notre site: $login $password";

                if(!empty($nom) && !empty($prenom) && !empty($login) && !empty($password)){
                    require_once 'include/database.php';
                    $date=date('Y-m-d');
                    $sqlState = $pdo->prepare('INSERT INTO utilisateur VALUES(null,?,?,?,?,?)');
                    $sqlState->execute([$nom,$prenom,$login,$password,$date]);
                    header('location: index.php');
                }
                else{
                    ?>
                    <div class="alert alert-danger" role="alert">
                    Remlir tous les cases.
                    </div>
                    <?php
                }
            }
        ?>
        <form method="post">
            <label class="form-label">Nom:</label>
            <input type="text" class="form-control" name="nom">

            <label class="form-label">Prenom:</label>
            <input type="text" class="form-control" name="prenom">

            <label class="form-label">Login:</label>
            <input type="text" class="form-control" name="login">

            <label class="form-label">Password:</label>
            <input type="password" class="form-control" name="password">

            <input type="submit" value="Inscrivez-vous" class="btn btn-primary my-2" name="ajouter">
        </form>
    </div>
</body>
</html>