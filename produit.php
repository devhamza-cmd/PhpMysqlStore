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
    <?php require('config.php');session_start();?>
    <title>Document</title>
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
  <?php 
  if(!empty($_POST['ajt'])){
    $_SESSION['pr']=$_POST['ajt'];
  }
  $produit=$_SESSION['pr'];
  $user=$_SESSION['user'];
  $date=date('Y-m-d H:i:s');
  $sql = "INSERT INTO visitproduit (user, produit, date) VALUES ($user, $produit, '$date')";
$r = $pdo->prepare($sql);
$r->execute();

  ?>
<div class="d-none" id='general'>
    <div class="one">
<div class="one">
<nav class='sticky-top first '>
      <div>
        <div class=" p-5 nitem"><a class="nav-link"><i class="fa-solid fa-shop pe-2"></i>STORE</a></div>
        <div class=" nitem"><a class="nav-link" href="home.php"><i class="fa-solid fa-house pe-2"></i>Home

        </div>

        <div class="h nitem"><a class="nav-link" href="panier.php"><i
              class="fa-solid fa-cart-shopping pe-2"></i>panier</a></div>
        <div class="nitem"><a class="nav-link" href="commande.php"><i
              class="fa-solid fa-truck-fast pe-2"></i></i>commande</a></div>
        <div class="nitem"><a class="nav-link" href="community.php"><i
              class="fa-sharp  fa-retweet pe-2"></i></i>community</a></div>
        <div class="nitem"><a class="nav-link" href="index.php"><i
              class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
      </div>
    </nav>
    </div>
    </div>
    <div class="two ps-5 ">
      <?php
    
    $code=0;
    $sql="select * from produit pr,marque mr where pr.codemr=mr.code and pr.code =$code";
    if (!empty($_POST['ajt'])){
    $code=$_POST['ajt'];
    $_SESSION['pr']=$code;
    $sql="select * from produit pr,marque mr,store s where pr.codemr=mr.code and pr.codev=s.codev and pr.code=$code";
    }
    $code=$_SESSION['pr'];
    $table= $pdo->query($sql);
    $isempty=0;
    while($row = $table->fetch(PDO::FETCH_BOTH)){
        $name=$row[1];
        $title=$row[2];
        $price=$row[3];
        $marque=$row[9];
        $store=$row['nom'];
        $codestore=$row['codestore'];
        echo"  
        <div class='d-flex  produit me-5'>
         <img src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cHJvZHVjdHN8ZW58MHx8MHx8fDA%3D&w=1000&q=80' alt=''>
        <div class='p-5'>
          <h3>$name</h3>
          <p class='price'>$$price</p>
          <p class='para' >$title</p>
          <div class='d-flex '>
            <form class='m-2' action='#' method='post'>
            <button class='more' name='ajot' value='$code' >AJOUTER</button>
            
          </form>
          <form class='m-2' action='store.php' method='post'>
            <button value='$codestore' name='store' class='more'>$store</button>
          </form>
          </div>
        </div>
      </div>
";
        

        $sql2="SELECT pr.code,pr.qtr,count(pn.codep),(pr.qtr -count(pn.codep) )
        c from produit pr,panier pn where pr.code=pn.codepr and pn.codepr=$code  GROUP BY pr.code";
        $table2= $pdo->query($sql2);
        $sql3="select count(codep) from panier where codepr=$code";
        $table3= $pdo->query($sql3);
        $isempty=0;
        while($row3 = $table3->fetch(PDO::FETCH_ASSOC)){
            $isempty= $row3['count(codep)'];

    }}
    $statu=-1;
    if ($isempty!=0){
        while($row2 = $table2->fetch(PDO::FETCH_ASSOC)){
            if ($row2['c']>0){
                $statu=0;
                
        }
    } }else{
        $statu=0;
    }
    $sql4="select qtr from produit where code=$code";
    $table4= $pdo->query($sql4);
        while($row4 = $table4->fetch(PDO::FETCH_ASSOC)){
            if ($row4['qtr']==0){
                $statu=-1;
            }
        }
    if ($statu==-1){
        echo"<script>var button = document.querySelector('[name=ajot]');
button.disabled = true;
button.textContent='Out Stock';
var buttonacht = document.querySelector('[name=acht]');
buttonacht.disabled = true</script>";
            }

    ?>
    </div>
</div>
    
            <?php

        if (!empty($_POST['ajot'])){
            $code=1;
            if (file_exists('codeajt.txt')){
                $code=unserialize(file_get_contents('codeajt.txt'));
            }
            $codeuser=$_SESSION['user'];
            $codep=$_POST['ajot'];
            $sql="insert into panier values ('$code','$codep','$codeuser')";
            $requete=$pdo->prepare($sql);
            $requete->execute();
            $code++;
            file_put_contents('codeajt.txt',serialize($code));
            header('location:panier.php');
        }
        ?>
          <script>
document.querySelector(".page-overlay").style.display='flex';
document.body.style.overflow='hidden';
setTimeout(() => {
  document.querySelector(".page-overlay").style.display='none';
document.body.style.overflow='auto';
document.querySelector("#general").setAttribute("class","d-flex justify-content-between")
}, 1000);

</script>
        <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="app4 .js"></script>
</body>
</html>