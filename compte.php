<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="all.css">
  <script src='all.js'></script>
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <?php session_start(); require('config.php')?>
</head>
 <?php
  if (!empty($_POST['sup'])){
   $codead=$_POST['sup'];
   $sql="delete from adresse where code=$codead";
   $r=$pdo->prepare($sql);
   try{
    
   $r->execute();
   header("location:compte.php");
   } catch(PDOException $e){

 
    echo "<span>you cannot remove the adresse </span>";
   }
   
   
  }
  ?>
    
<?php
 $user=$_SESSION['user'];
 $codeadressse=28;
 if(file_exists("codeadresse.txt")){
  $codeadressse=unserialize(file_get_contents('codeadresse.txt'));
 } else {
  file_put_contents('codeadresse.txt',serialize($codeadressse));
 }
     if (!empty($_POST['ajouteradrs'])){
      $ville=$_POST['city'];
      $adresse=$_POST['address'];
      $sql="insert into adresse values($codeadressse,'$adresse',$ville,$user)";
      $r=$pdo->prepare($sql);
     $r->execute();
     $codeadressse++;
      file_put_contents('codeadresse.txt',serialize($codeadressse));
      header("location:compte.php");
  
     }
     
     ?>
<?php
    if(!empty($_POST['annuler'])){
      header('location:compte.php');
    }
    if(!empty($_POST['save'])){
$id = $_SESSION['user'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$pass = $_POST['pass'];

 $sql="update users set nom='$nom' , prenom='$prenom',email='$email',password='$pass' where id=$id ";
$r = $pdo->prepare($sql);
$r->execute();
header('location:compte.php');


    }
    ?>
 <?php
    if(!empty($_POST['upload'])){
    $image = $_FILES['image']['tmp_name'];
$imageData = file_get_contents($image);
$id = $_SESSION['user'];
$sql = "UPDATE users SET   image=:image WHERE id=:id";
$r = $pdo->prepare($sql);
$r->bindParam(':image', $imageData, PDO::PARAM_LOB);
$r->bindParam(':id', $id);
$r->execute();
header('location:compte.php');
    }
    ?>
<body style='background-color:rgb(236, 236, 236)'>
  <div class="d-flex justify-content-between">
    <div class="onee">
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
    <div class="two ">
      <div class='p-5 infoacc d-flex align-content-center'>
        <div>
  <?php
  $codeuser=$_SESSION['user'];
  $sql = "SELECT image FROM users WHERE id = $codeuser";
  $r = $pdo->query($sql);
  $row = $r->fetch(PDO::FETCH_ASSOC);
  
  if ($row && !empty($row['image'])) {
    $imageData = $row['image'];
    echo "<img class='person' src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''>";
  } else {
    // Display a default image if no image is found in the database
    echo "<img class='person' src='path/to/default/lionel-messi-psg-2223-1.webp' alt=''>";
  }
  ?>
</div>

<?php
     $codeuser=$_SESSION['user'];
    $sql="select * from users where id=$codeuser ";
    $table= $pdo->query($sql);
    echo "<div>";
    while($row = $table->fetch(PDO::FETCH_BOTH)){
        $nom=$row[1]." ".$row[2];
        $email=$row['email'];
        echo "<div class='p-2'><h4>Hello $nom</h4><span>$email</span></div>";
      }
     ?>
      </div>
      
     
     <div class='info  d-felx'>
      <?php
      $sql="SELECT sum(total),COUNT(code) FROM `commande` where  codeu=$codeuser";
      $table= $pdo->query($sql);
    while($row = $table->fetch(PDO::FETCH_BOTH)){
      $total=$row[0];
      $t2=$row[1];
    }
    $sql2="SELECT COUNT(codepr),prix,(prix*COUNT(codepr)) FROM panier,produit p  WHERE panier.codepr=p.code and codeuser=$codeuser GROUP BY p.code";
    $table2= $pdo->query($sql2);
    $total2=0;
    $t22=0;
    while($row2 = $table2->fetch(PDO::FETCH_BOTH)){
      $total2+=$row2[0];
      $t22+=$row2[1]*$row2[0];
    }
      ?>
      <span>TATAL COMMANDE :<?php echo $t2?></span>
      <BR></BR>
      <span>$<?php echo $total?></span>
     </div>
     <div class='info'>
     <span>TOTAL PANIERE : <?php echo $total2?></span>
      <BR></BR>
      <span>$<?php echo $t22?></span>
     </div>
    </div>
    <div class="w ps-2 d-flex">
      <div class='ps-2 adrs'>
        <h5 class='mt-5'>Your adresses :</h5>
     
    
    <?php


     $sql="SELECT a.code ,r.nom,v.nom,a.adresse from region r,ville v,adresse a where r.code=v.coderg and a.code_ville=v.code and user='$codeuser'";
    $table= $pdo->query($sql);
    while($row = $table->fetch(PDO::FETCH_BOTH)){
      $code=$row[0];
        $nom=$row[1]." ".$row[2]." ".$row[3];
        echo "<h6 class='mt-5'><i class='fa-solid fa-location-dot'></i> $nom<form action='#' method='post'>
      <button type='submit' value='$code' name='sup' class='btn'><i class='fa-solid fa-trash'></i></button>
    </form></h6>";
    }
    ?>
      </div>
    
      <div class="adrs  p-4">
        <H5 >Ajouter une adresse</H5>
  <form action="#" method="post">
  <select required name="region" id="region-select">
    <option  value="">choisir une région</option>
    <?php
    $sql = "SELECT * FROM region";
    $table = $pdo->query($sql);
    while ($row = $table->fetch(PDO::FETCH_BOTH)) {
      $nom = $row['nom'];
      $code = $row['code'];
      echo "<option value='$code'>$nom</option>";
    }
    ?>
  </select>
  <br><div id="result-container"></div>
  
  
</form>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

  $('#region-select').change(function() {
    var selectedRegion = $(this).val();

    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: { region: selectedRegion },
      success: function(response) {
        $('#result-container').html(response);
      }
    });
  });
});
</script>
 

      </div>
      <div class="adrs    p-4">
        <h5>modifier votre information</h5>
         
   
    <form action="#" method="post" enctype="multipart/form-data">
      image :<input type='file' name='image' accept='image/*' required>
      <input type="submit" class='p-2 more' name='upload' value="upload">

    </form>
        <form action="#" method='post'  ><?php
    $user=$_SESSION['user'];
    $sql="select * from users where id =$user";
    $table= $pdo->query($sql);
    while($row = $table->fetch(PDO::FETCH_BOTH)){
      $nom=$row['nom'];
      $prenom=$row['prenom'];
      $email=$row['email'];
      $pass=$row['password'];
      echo "
      
      nom : <input type='text' name='nom' required  value='$nom'>
    <br>
    <br>
    prenom : <input type='text' name='prenom' required  value='$prenom'>
    <br>
    <br>
    email : <input type='email' name='email' required  value='$email'>
    <br>
    <br>
    password : <input type='text' name='pass' required value='$pass'>
    <br>
    <br>
    <input class='p-2 more' type='submit' value='save' name='save'>
    <input class='p-2 more' type='submit' value='anuler' name='annuler'>
    ";

    }
    ?> </form>
   
      </div>
    </div>
    
  </div>
  <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>