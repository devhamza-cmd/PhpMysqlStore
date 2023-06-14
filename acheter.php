<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('config.php')?>
    <title>Document</title>
    <link rel="stylesheet" href="style5.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
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
    $code
    $user=$_SESSION['user'];
    $sql="SELECT codeuser,codepr,count(codepr) from panier where codeuser='$user' GROUP BY codepr";
    $table= $pdo->query($sql);
    $total=0;
    while($row = $table->fetch(PDO::FETCH_ASSOC)){
        $codep=$row['codepr'];
        $sql2="select * from produit where code='$codep' ";
        $table2= $pdo->query($sql2);
        while($row2 = $table2->fetch(PDO::FETCH_ASSOC)){
            $pnom=$row2['nom'];
            $title=$row2['title'];
            $prix=$row2['prix'];
            $codepr=$row['codepr'];
            $count=$row['count(codepr)'];
            $tp=$prix*$count;
            $total+=$tp;
            $tt="$$prix*$count=$$tp";
            echo"<div class='card'>

  <div class='card-body'>
    <h5 class='card-title'>$pnom</h5>
    <p class='card-text'>$title</p>
    <p class='card-text'>$tt</p>
    <form action='produit.php' method='post'><button type='submit' name='ajt' class='btn btn-warning'  value='$codepr'> more detail</button><br><br></form>
    ";
             echo "<form action='#' method='post'>

";
        $sql4="SELECT pr.code,pr.qtr,count(pn.codep),(pr.qtr -count(pn.codep) )
        c from produit pr,panier pn where pr.code=pn.codepr and pn.codepr=$codepr  GROUP BY pr.code";
        $table4= $pdo->query($sql4);
        $sql3="select count(codep) from panier where codepr=$codepr";
        $table3= $pdo->query($sql3);
        $isempty=0;
        while($row3 = $table3->fetch(PDO::FETCH_ASSOC)){
            $isempty= $row3['count(codep)'];

    }}
    $statu=-1;
    if ($isempty!=0){
        while($row4 = $table4->fetch(PDO::FETCH_ASSOC)){
            if ($row4['c']>0){
                $statu=0;
                
        }
    } }else{
        $statu=0;
    }
     if ($statu==-1){
         echo "<button type='submit' name='m' value='$codepr'  class=' btn btn-primary'>-</button>
         <label class='items'  name='label' value='$codepr' for='$prix'>$count</label>
         <button type='submit' name='p' disabled value='$codepr'  class=' btn btn-primary'>+</button>
         </label>
         <br>
         <br>
         <button type='submit' name='sup' value='$codepr'  class=' btn btn-primary'>supprimer</button>
    </form>";
            } else{
                echo "<button  class=' btn btn-primary' type='submit' name='m' value='$codepr'>-</button>
         <label class='items'  name='label' value='$codepr' for='$prix'>$count</label>
         <button class=' btn btn-primary' type='submit' name='p' value='$codepr'>+</button>
         </label>
         <br>
          <br>
         <button type='submit' name='sup' value='$codepr' class=' btn btn-primary'>supprimer</button>
    </form>";
            }
        // here
        echo "</div></div>";
        }
        $_SESSION['total']=$total;
        
    
    ?>
    <?php
    if (!empty($_POST['p'])){
         $code=1;
            if (file_exists('codeajt.txt')){
                $code=unserialize(file_get_contents('codeajt.txt'));
            }
            $codeuser=$_SESSION['user'];
            $codep=$_POST['p'];
            $sql2="SELECT pr.code,pr.qtr,count(pn.codep),(pr.qtr -count(pn.codep) )
            c from produit pr,panier pn where pr.code=pn.codepr and codeuser=$codeuser GROUP BY pr.code";
            $table= $pdo->query($sql2);
            $statu=-1;
            while($row = $table->fetch(PDO::FETCH_ASSOC)){
                if ($row['c']>0){
                    $statu=0;
                }
            }
            if ($statu==0){
                $sql="insert into panier values ('$code','$codep','$codeuser')";
            $requete=$pdo->prepare($sql);
            $requete->execute();
            $code++;
            file_put_contents('codeajt.txt',serialize($code));
            header('location:panier.php');
            } else {
                echo "<h1>stock out</h1>";
            }
            
        
    }
    ?>
 
   <?php
    if (!empty($_POST['m'])){
        $codeuser=$_SESSION['user'];
        $code=$_POST['m'];
        $sql="delete from panier where codepr='$code' and codeuser='$codeuser' limit 1";
        $requete=$pdo->prepare($sql);
        $requete->execute();
        header('location:panier.php');
    }
    
     if (!empty($_POST['sup'])){
        $code=$_POST['sup'];
        
        $sql="delete from panier where codepr='$code'  ";
        $requete=$pdo->prepare($sql);
        $requete->execute();
        header('location:panier.php');
    }
    ?>
       <form class="ms-3" action="commander.php" method="post">
        <label class="total"></label>
        <br>
        <label name=""><?php echo "<p>TOTAL:".$_SESSION['total']."$</p>"?></label>
        <br>
        <button type='submit' name='commander' class='commander btn btn-primary' >commander</button>
    </form>
            <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<script src="app4.js"></script>
</body>
</html>