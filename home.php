<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="all.css">
  <script src='all.js'></script>
  <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <?php session_start();
  require('config.php') ?>
  <title>document</title>
</head>

<body>
  <style>
    .page-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); 
  z-index: 9999; 
  
  justify-content: center;
  align-items: center;
  display: none;
}

.loader {
  width: 50px;
  height: 50px; 
  border: 5px solid #fff; 
  border-top-color: transparent;
  border-radius: 50%;
  animation: spin 1s infinite linear;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

  </style>
<div class="page-overlay">
  <div class="loader"></div>
</div>

  <div class="d-none" id='general'>
    <nav class='sticky-top first '>
      <div>
        <div class=" p-5 nitem"><a class="nav-link"><i class="fa-solid fa-shop pe-2"></i>STORE</a></div>
        <div class="h nitem"><a class="nav-link" href="home.php"><i class="fa-solid fa-house pe-2"></i>Home

        </div>

        <div class="nitem"><a class="nav-link" href="panier.php"><i
              class="fa-solid fa-cart-shopping pe-2"></i>panier</a></div>
        <div class="nitem"><a class="nav-link" href="commande.php"><i
              class="fa-solid fa-truck-fast pe-2"></i></i>commande</a></div>
              <div class="nitem"><a class="nav-link" href="stores.php"><i
              class="fa-sharp  fa-store pe-2"></i></i>stores</a></div>
        <div class="nitem"><a class="nav-link" href="community.php"><i
              class="fa-sharp  fa-retweet pe-2"></i></i>community</a></div>
              <div class="nitem"><a class="nav-link" href="compte.php"><i
              class="fa-solid fa-user pe-2"></i></i>Account</a></div>
        <div class="nitem"><a class="nav-link" href="index.php"><i
              class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
      </div>
    </nav>
    <div class='two'>
      <div class="d-flex  justify-content-between ">
        <nav class='scrollable-container sticky-top ps-5 me-5' id='navmr'>
          <div class='cat 'class='animate__animated animate__flipInX m-2'>
            
            <button class='b' name='homemarque' value='all'><i class="fa-solid fa-bars"></i>All</button>
            <?php
            $sql = "SELECT mr.logo,mr.code,mr.nom,count(pr.code) as'n' FROM produit pr,marque mr WHERE pr.codemr=mr.code GROUP by mr.nom
";
            $table = $pdo->query($sql);
            while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
              $nom = $row['nom'];
              $code = $row['code'];
              $nbr = $row['n'];
              $logo = $row['logo'];
              echo "
            <div class='cat'>
            <button class='b'type='submit' value='$code' name='homemarque'><i class='$logo'></i>$nom</button>
            </div>
            
            
            ";
            }
            ?>
          </div>
        </nav>
      </div>

      <div  class=" container mt-3 d-flex justify-content-center flex-wrap" id='all'>
        <?php
        $sql = "select * from produit";
        $table = $pdo->query($sql);
        echo "</form>";
        while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
          $code = $row['code'];
          $prix = $row['prix'];
          $nom = $row['nom'];
          $title = $row['title'];
          echo "<form action='produit.php' class='animate__animated animate__flipInX m-2' method='post'>
            <div class='card' style='width: 15rem; height: 320px; display: flex; flex-direction: column; justify-content: space-between;'>
  <img src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cHJvZHVjdHN8ZW58MHx8MHx8fDA%3D&amp;w=1000&amp;q=80' class='card-img-top' alt='...'>
  <div class='card-body'>
    <h5 class='card-title'>$nom</h5>
    <p class='card-text'>$ $prix</p>
  </div>
  <button type='submit' name='ajt' class='more' value='$code' control-id='ControlID-10'>more detail</button>
</div>


    
</form>";
        }
        ?>
      </div>
      <div class="container d-flex d-flex justify-content-center flex-wrap">
        <?php

        $user = $_SESSION['user'];
        ?>
        <form action="#" method="post">
          <?php
          if (!empty($_POST['marque'])) {
            $codemr = $_POST['marque'];

            $sql = "select * from produit where codemr='$codemr'";
            $table = $pdo->query($sql);
            echo "</form>";
            while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
              $code = $row['code'];
              $prix = $row['prix'];
              $nom = $row['nom'];
              echo "<script>let all = document.getElementById('all')
all.remove()</script>";
              echo "<form action='produit.php' class='m-2' method='post'>
            <div class='card' style='width: 15rem; height: 320px; display: flex; flex-direction: column; justify-content: space-between;'>
  <img src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cHJvZHVjdHN8ZW58MHx8MHx8fDA%3D&amp;w=1000&amp;q=80' class='card-img-top' alt='...'>
  <div class='card-body'>
    <h5 class='card-title'>$nom</h5>
    <p class='card-text'>$ $prix</p>
  </div>
  <button type='submit' name='ajt' class='more' value='$code' control-id='ControlID-10'>more detail</button>
</div>

    
</form>";
            }

          }
          ?>
      </div>

    </div>
  </div>




  <script>
document.querySelector(".page-overlay").style.display='flex';
document.body.style.overflow='hidden';
setTimeout(() => {
  document.querySelector(".page-overlay").style.display='none';
document.body.style.overflow='auto';
document.querySelector("#general").setAttribute("class","d-flex justify-content-between")
}, 1000);

</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="loadpr.js"></script>
</body>

</html>