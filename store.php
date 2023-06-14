<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="all.css">
  <script src='all.js'></script>
    <?php require('config.php') ;session_start();?>
    <title>Document</title>
</head>
<?php
$codestore=$_POST['store'];
$user=$_SESSION['user'];
$date=date('Y-m-d H:i:s');
$sql="INSERT INTO `visitstore`(`user`, `store`, `date`) VALUES ($user,$codestore,'$date')";
$r = $pdo->prepare($sql);
$r->execute();
?>
<body style=' background-color: rgb(236, 236, 236);'>
   <div class="d-flex justify-content-between">
    <div class="one">
    <nav class='sticky-top first '>
      <div>
        <div class=" p-5 nitem"><a class="nav-link"><i class="fa-solid fa-shop pe-2"></i>STORE</a></div>
        <div class=" nitem"><a class="nav-link" href="home.php"><i class="fa-solid fa-house pe-2"></i>Home

        </div>

        <div class="nitem"><a class="nav-link" href="panier.php"><i
              class="fa-solid fa-cart-shopping pe-2"></i>panier</a></div>
        <div class="nitem"><a class="nav-link" href="commande.php"><i
              class="fa-solid fa-truck-fast pe-2"></i></i>commande</a></div>
              <div class="h nitem"><a class="nav-link" href="stores.php"><i
              class="fa-sharp  fa-store pe-2"></i></i>stores</a></div>
        <div class="nitem"><a class="nav-link" href="community.php"><i
              class="fa-sharp  fa-retweet pe-2"></i></i>community</a></div>
        <div class="nitem"><a class="nav-link" href="index.php"><i
              class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
      </div>
    </nav>
    </div>
    <div class=" two">
     
      <div>
        <div class="ps-5 bg d-flex">
          <img src="https://arribat-center.ma/storage/2022/06/MArjane-1000_1000-1.jpg" alt="">
          <?php
          
          if(!empty($_POST['store'])){
            $codestore=$_POST['store'];
            $_SESSION['store']=$codestore;
          }
         $codestore=$_SESSION['store'];
    
    $sql="select * from store  where codestore=$codestore ";
    $table= $pdo->query($sql);
    while($row = $table->fetch(PDO::FETCH_BOTH)){
        $noms=$row['nom'];
        echo"<h3 class='container '> $noms Store <i class='fa-solid fa-circle-check';></i></h3>";
    }
?>

        </div><div  class='sd d-flex'>
          <?php
          
          ?>
          <div>Pr Vendus
            <br>
            <br>
            <div><?php
            $sql2="SELECT sum(c.quantite) as's',count(c.codepr) FROM commande c,produit p,venduer v,store s WHERE c.codepr=p.code and p.codev=v.code and v.code=s.codev and s.codestore=$codestore GROUP BY s.nom;
;

";
            $table= $pdo->query($sql2);
           while($row = $table->fetch(PDO::FETCH_BOTH)){
            echo $row['s'];
           }
            ?></div>
          </div>
          <div>Customrs
            <br>
            <br>
            <?php
            $sql="SELECT  count(DISTINCT c.codeu) FROM commande c ,produit p,venduer v,store s WHERE c.codepr=p.code and p.codev=v.code and s.codestore=v.code and s.codestore=$codestore";
            
            $table= $pdo->query($sql);
            
           while($row = $table->fetch(PDO::FETCH_BOTH)){
            echo $row[0];
           }
            ?>
          </div>
          <div>Marque Dispo
            <br>
            <br>
            <?php
            $sql="SELECT  count(DISTINCT m.code) FROM produit p,marque m,venduer v,store s WHERE p.codemr=m.code and p.codev=v.code and s.codev=v.code and s.codestore=$codestore";
          
             $table= $pdo->query($sql);
           while($row = $table->fetch(PDO::FETCH_BOTH)){
            echo $row[0];
           }
            ?>
          </div>
</div>
      </div>
      <nav class='scrollable-container sticky-top ms-5 me-5 '>
        <div class='cat'>
            <a href=""><button class='b'value='$code' name='marque'><i class="fa-solid fa-bars"></i>All</button></a>
            
            </div>
    <?php
        $sql="SELECT
    mr.logo,
    mr.code,
    mr.nom,
    count(pr.code) as 'n'
FROM produit pr, marque mr,venduer v,store s
WHERE pr.codemr = mr.code and pr.codev=v.code and v.code=s.codestore and s.codestore=$codestore
GROUP by mr.nom
";
        $table= $pdo->query($sql);
        while($row = $table->fetch(PDO::FETCH_ASSOC)){
            $nom= $row['nom'];
            $code= $row['code'];
            $nbr=$row['n'];
            $logo=$row['logo'];
            echo "
            <form  action='#' class='cat'  method='post'>
            <button class='b'type='submit' value='$code' name='marque'><i class='$logo'></i>$nom</button>
            
            </form>";
        }
    ?>
  
</nav>
<div class="container d-flex d-flex justify-content-center flex-wrap" >
    <form action="#" method="post" >
      <?php
      $sql="select pr.code,pr.prix,pr.nom from produit pr,marque m,store s,venduer v where pr.codemr=m.code and pr.codev=v.code and v.code=s.codestore and s.codestore='$codestore'  ";
            $table= $pdo->query($sql);
            echo "</form>";
            while($row = $table->fetch(PDO::FETCH_ASSOC)){
              
            $code=$row['code'];
            $prix=$row['prix'];
            $nom= $row['nom'];
            echo "<form action='produit.php' class='m-2' method='post' >
            <div class='card' style='width: 15rem; height: 320px; display: flex; flex-direction: column; justify-content: space-between;'>
  <img src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cHJvZHVjdHN8ZW58MHx8MHx8fDA%3D&amp;w=1000&amp;q=80' class='card-img-top' alt='...'>
  <div class='card-body'>
    <h5 class='card-title'>$nom</h5>
    <p class='card-text'>$ $prix</p>
  </div>
  <button type='submit' name='ajt' class='more' value='$code' control-id='ControlID-10'>more detail</button>
</div>

    
</form>";};
      ?>
        <?php
        if (!empty($_POST['marque'])){
            $codemr=$_POST['marque'];
            
            $sql="select pr.code,pr.prix,pr.nom from produit pr,marque m,store s,venduer v where pr.codemr=m.code and pr.codev=v.code and v.code=s.codestore and s.codestore='$codestore' and m.code=$codemr";
            $table= $pdo->query($sql);
            echo "</form>";
            while($row = $table->fetch(PDO::FETCH_ASSOC)){
            $code=$row['code'];
            $prix=$row['prix'];
            $nom= $row['nom'];
            echo "<script>let p = document.querySelectorAll('.m-2')

p.forEach(element => {
    element.remove()
});</script>";
            echo "<form action='produit.php' class='m-2' method='post' id='all'>
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



    
                    <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<script src="app.js"></script>
</body>
</html>