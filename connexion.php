<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/connexion.css">
    <title>Connexion</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container fadeInDown">
        <?php
             if(isset($_POST['connexion'])){
                $login    = $_POST['login'];
                $password = $_POST['password'];
                if(!empty($login) && !empty($password)){
                    require_once 'include/database.php';
                    $sqlState = $pdo->prepare('SELECT * FROM utilisateur WHERE login=? AND password=?');
                    $sqlState->execute([$login,$password]);
                    $sqlStatec = $pdo->prepare('SELECT * FROM client WHERE login=? AND password=?');
                    $sqlStatec->execute([$login,$password]);
                    if($sqlState->rowCount()>=1){
                        $_SESSION['utilisateur']=$sqlState->fetch();
                        header('location: admin.php');
                    }
                    else{
                        if($sqlStatec->rowCount()>=1){
                            $_SESSION['client']=$sqlStatec->fetch();
                            header('location: admin_client.php');
                        }else{
                            ?>
                        <div class="alert alert-danger" role="alert">
                            Login ou Password est incorrect.
                        </div>
                        <?php
                        } 
                    }
                }
                else{
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Remplir tous les cases.
                    </div>
                    <?php
                }
            }
        ?>
        <div id="page">
            <h2 class="active"><a class="active" href="connexion.php">Connexion</a></h2>
            <h2 class="inactive underlineHover"><a class="inactive underlineHover" href="inscription_client.php">Ajouter utilisateur</a></h2>

            <div class="fadeIn first">
                <img src="upload/produit/icone-utilisateur.png" id="icon" style="width:30%;" alt="User Icon" />
            </div>

            <form method="post">
                <input type="email" id="login" class="fadeIn second" name="login" placeholder="Login"><br>

                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password"><br>

                <input type="submit" value="Connexion" class="fadeIn fourth" name="connexion">
            </form>
        </div>
    </div>
</body>
</html>