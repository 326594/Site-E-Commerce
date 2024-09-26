<?php
    session_start();
    $connect = false;
    if(isset($_SESSION['utilisateur'])){
        $connect = true;
    }
?>
<style> <?php include '../assets/css/nav.css';?> </style>
<?php if($connect){ ?>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(8, 57, 102);">
  <div class="container px-4">
    <a class="navbar-brand" href="#">
      <i class="fa-solid fa-shop"></i> 
      <span style="color:#ffffff; font-size:26px; font-weight:bold; letter-spacing: 1px;">Shop-Her</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php 
    $currentpage = $_SERVER['PHP_SELF'];
    ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        
        <?php
            
            
                ?>
                <li class="nav-item">
                  <a class="nav-link <?php if($currentpage == '/myphp/Project/index.php') echo 'active' ?>" aria-current="page" href="index.php"><i class="fa-solid fa-user-plus"></i>Ajouter Admin</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if($currentpage == '/myphp/Project/categories.php') echo 'active' ?>" aria-current="page" href="categories.php"><i class="fa-solid fa-layer-group"></i>Listes des Catégories</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if($currentpage == '/myphp/Project/produits.php') echo 'active' ?>" aria-current="page" href="produits.php"><i class="fa-solid fa-table-cells"></i>Listes des Produits</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if($currentpage == '/myphp/Project/commandes.php') echo 'active' ?>" aria-current="page" href="commandes.php"><i class="fa-sharp fa-solid fa-barcode"></i>Listes des Commandes</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if($currentpage == '/myphp/Project/deconnexion.php') echo 'active' ?>" aria-current="page" href="deconnexion.php"><i class="fa-solid fa-right-from-bracket"></i>Déconnexion</a>
                </li>
                <?php
            }
        ?>
      </ul>
    </div>
  </div>
</nav>