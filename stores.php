<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="all.css">
    <script src='all.js'></script>
    <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <?php require('config.php')?>
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

        <div class="nitem"><a class="nav-link" href="panier.php"><i
              class="fa-solid fa-cart-shopping pe-2"></i>panier</a></div>
        <div class="nitem"><a class="nav-link" href="commande.php"><i
              class="fa-solid fa-truck-fast pe-2"></i></i>commande</a></div>
              <div class="h  nitem"><a class="nav-link" href="stores.php"><i
              class="fa-sharp  fa-store pe-2"></i></i>stores</a></div>
        <div class="nitem"><a class="nav-link" href="community.php"><i
              class="fa-sharp  fa-retweet pe-2"></i></i>community</a></div>
        <div class="nitem"><a class="nav-link" href="index.php"><i
              class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
      </div>
    </nav></nav>
        </div>
        <div class="two p-5">
            <h3>Stores</h3>
            
            <div class='str container mt-3 d-flex justify-content-center flex-wrap'>
                <?php
                $sql="select * from store";
                $table= $pdo->query($sql);
    while($row = $table->fetch(PDO::FETCH_BOTH)){
        $nom=$row['nom'];
        $code=$row['codestore'];
        echo "<div> <img src='https://arribat-center.ma/storage/2022/06/MArjane-1000_1000-1.jpg' alt=''><br> <form action='store.php' method='post'>
            <button class='mt-2 more' value='$code' name='store' type='submit'>$nom</button></div>";
    }
                ?>
                <!-- <form action='#' method='post'><input type='submit' class='mt-2 more' value='$nom' name='store'></form> -->
                
                
             
            </div>
        </div>
    </form>
    </div>
   

    <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>