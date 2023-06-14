
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('config.php')?>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="all.css">
  <script src='all.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="d-flex justify-content-between">
  <div class="one">
  <nav class='sticky-top first '>
      <div>
        <div class=" p-5 nitem"><a class="nav-link"><i class="fa-solid fa-shop pe-2"></i>STORE</a></div>
        <div class="nitem"><a class="nav-link" href="home.php"><i class="fa-solid fa-house pe-2"></i>Home

        </div>

        <div class=" nitem"><a class="nav-link" href="panier.php"><i
              class="fa-solid fa-cart-shopping pe-2"></i>panier</a></div>
        <div class="h nitem"><a class="nav-link" href="commande.php"><i
              class="fa-solid fa-truck-fast pe-2"></i></i>commande</a></div>
              <div class=" nitem"><a class="nav-link" href="stores.php"><i
              class="fa-sharp  fa-store pe-2"></i></i>stores</a></div>
        <div class="nitem"><a class="nav-link" href="community.php"><i
              class="fa-sharp  fa-retweet pe-2"></i></i>community</a></div>
              <div class="nitem"><a class="nav-link" href="compte.php"><i
              class="fa-solid fa-user pe-2"></i></i>Account</a></div>
        <div class="nitem"><a class="nav-link" href="index.php"><i
              class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
      </div>
    </nav>
  </div>
  <div class="two ps-5 pt-5">
    <h2 class='pb-2'>Commande</h2>
       <?php
    session_start();
    $user=$_SESSION['user'];
    $sql="SELECT p.code,p.nom,prix,quantite ,a.adresse,v.nom as 'ville',r.nom as 'reg' from region r ,ville v,commande c,produit p,adresse a where c.codeadrs=a.code and c.codepr=p.code and codeu=$user and v.code=a.code_ville and v.coderg=r.code;
";
    $table= $pdo->query($sql);
    
    $total=0;
    while($row = $table->fetch(PDO::FETCH_BOTH)){
      $codepr=$row['code'];
      $pnom=$row['nom'];
      $prix=$row['prix'];
      $q=$row['quantite'];
      $ville=$row['ville'];
      $reg=$row['reg'];
      $adresse=$row['adresse'];
      $T=$prix*$q;
      $tt="$$prix*$q=$$T";
     echo"<div class='pr m-2 pe-2 me-5'>
            <img src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cHJvZHVjdHN8ZW58MHx8MHx8fDA%3D&w=1000&q=80' ></img>
    <p>$pnom</p>
    <p>$tt</p>
    <p>$adresse|$ville|$reg</p>
    <form action='produit.php' method='post'><button type='submit' name='ajt' class='more'  value='$codepr'> more detail</button><br><br></form>
    </div>";
       }
   ;?>
    
  </div>
</div>
   
  
    
                <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<script src="app4.js"></script>
</body>
</html>