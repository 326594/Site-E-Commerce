<?php
    session_start();
    $connect = false;
    if(isset($_SESSION['client'])){
      $connect=true;
    }
?>
<style> <?php include '../assets/css/nav.css';?> </style>
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
      $currentpage = $_SERVER['PHP_SELF']; 
        if($connect){
      ?>
        <li class="nav-item">
          <a class="nav-link <?php if($currentpage == '/myphp/Project/index_front.php') echo 'active' ?>" aria-current="page" href="index_front.php"><i class="fa-solid fa-layer-group"></i>Liste des catégories </a>
        </li>
     <?php
        }
        if (!isset($_SESSION['panier'])) {
          $_SESSION['panier'] = array();
      }
      $idutilisateur = $_SESSION['client']['id'];
      $panierUtilisateur = $_SESSION['panier'][$idutilisateur] ?? array();
      
      $nombreProduitsDansPanier = count($panierUtilisateur);
      ?>
      </ul>
     
    </div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
  <li class="nav-item">
    <a class="nav-link <?php if($currentpage == '/myphp/Project/panier.php') echo 'active' ?> float-end" href="panier.php"><i class="fa-solid fa-cart-shopping"></i> Panier(<?php echo $nombreProduitsDansPanier; ?>)</a>
  </li>
  <li class="nav-item">
          <?php
          $idutilisateur = $_SESSION['client']['id'];
          ?> 
          <a class="nav-link <?php if($currentpage == '/myphp/Project/deconnexion.php') echo 'active' ?>" aria-current="page" href="deconnexion.php"><i class="fa-solid fa-right-from-bracket"></i>Déconnexion</a>
        </li>
    </ul>
    
  </div>
</nav>