<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/connexion.css">
    <title> Inscription</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container fadeInDown">
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
                    $sqlState = $pdo->prepare('INSERT INTO client VALUES(null,?,?,?,?,?)');
                    $sqlState->execute([$nom,$prenom,$login,$password,$date]);
                    header('location: connexion.php');
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
        <div id="page">
            <h2 class="inactive underlineHover"><a class="inactive underlineHover" href="connexion.php">Connexion</a></h2>
            <h2 class="active"><a class="active" href="inscription_client.php">Ajouter utilisateur</a></h2>

            

            <form method="post">
            
                <input type="text" id="Fname" class="fadeIn second" name="nom" placeholder="Nom">
                    
                <input type="text" id="Lname" class="fadeIn third" name="prenom" placeholder="Prénom">
                    
                <input type="email" id="login" class="fadeIn fourth" name="login" placeholder="Email">

                <input type="password" id="password" class="fadeIn fifth" name="password" placeholder="Mot de passe">

                <input type="submit" value="Inscrivez-vous" class="fadeIn sixth" name="ajouter">
            </form>
        </div>
    </div>
</body>
</html>