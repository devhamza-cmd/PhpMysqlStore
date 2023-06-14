
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('config.php')?>
    <link rel="stylesheet" href="style5.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
   <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="#">Ecommerce</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="home.php"><i class="fa-solid fa-house"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="compte.php"><i class="fa-solid fa-user"></i> Compte</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="commande.php"><i class="fa-solid fa-truck-fast"></i> Commande</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link active" href="panier.php"><i class="fa-solid fa-cart-plus"></i> panier</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    <?php
    session_start();
    $user=$_SESSION['user'];
    $sql="SELECT pr.codepr,p.nom,p.title,p.prix,COUNT(pr.codepr),(COUNT(pr.codepr)*p.prix) FROM panier pr,produit p where pr.codepr=p.code and pr.codeuser=$user GROUP BY pr.codepr 
";
$table= $pdo->query($sql);
    while($row = $table->fetch(PDO::FETCH_BOTH)){
      $codepr=$row[0];
        $nom=$row['nom'];
        $title=$row['title'];
        $quantite=$row[3];
        $prix=$row['prix'];
        $total=$row[4];
        echo"  <div class='card'>

  <div class='card-body'>
  <p class='card-text'>$nom</p>
    <p class='card-text'>$title</p>
    <p class='card-text'>$$prix*$quantite=$$total</p>
    <p class='card-text'></p>
    <form action='produit.php' method='post'><button type='submit' name='ajt' class='btn btn-warning'  value='$codepr'> more detail</button><br><br></form>
    </div></div>";


    }
    ?>
    <form action="#" method="post">
<?php
    $user=$_SESSION['user'];
    $sql="SELECT a.code ,r.nom,v.nom,a.adresse from region r,ville v,adresse a where r.code=v.coderg and a.code_ville=v.code and user='$user'";
    $table= $pdo->query($sql);
    while($row = $table->fetch(PDO::FETCH_BOTH)){
        $codead=$row[0];
        $adresse=$row[3];
        $ville=$row[2];
        $region=$row[1];
        echo "
        <input class='ms-2' type='radio' value='$codead' name='adresse' required>
        <label for='adresse' ><p><i class='fa-solid fa-location-dot'></i> $adresse | $ville | $region</p></label>";
        $row[0];
        echo"<br>";
    }
    ?>
    <input class='ms-2 btn btn-primary' type="submit" class='btn btn-primary' name='com' value='confirmer'>
    <?php
    if (!empty($_POST['com'])){
        
        $codem=1;
        if(file_exists('codecom.txt')){
            $codem=unserialize(file_get_contents('codecom.txt'));
        } else {
            file_put_contents('codecom.txt',serialize($codem));
        }
        $user=$_SESSION['user'];
        $codead=$_POST['adresse'];
        $sql="
SELECT p.codepr,COUNT(p.codep) as 'quantite',(SELECT pr.prix from produit pr where pr.code=p.codepr GROUP BY pr.prix ),((SELECT pr.prix from produit pr where pr.code=p.codepr GROUP BY pr.prix )*COUNT(p.codep) ) as 'total' from panier p WHERE p.codeuser=$user GROUP BY p.codepr";
$table= $pdo->query($sql);
    while($row = $table->fetch(PDO::FETCH_BOTH)){
        $codepr=$row['codepr'];
        $quantite=$row['quantite'];
        
        $total=$row['total'];
        $sql="insert into commande values('$codem',$codepr,$user,$codead,$quantite,$total)";
        $requete=$pdo->prepare($sql);
        $requete->execute();
        $codem++;
        file_put_contents('codecom.txt',serialize($codem));
        $sqldelete="delete from panier where codeuser=$user";
        $requete2=$pdo->prepare($sqldelete);
        $requete2->execute();
        $sqlupdate="update produit set qtr=qtr-$quantite , qtv=$quantite where code=$codepr";
        $requete3=$pdo->prepare($sqlupdate);
        $requete3->execute();
        header('location:commande.php');
    }
    }
    ?>
    </form>
    
                <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<script src="app4.js"></script>
</body>
</html>