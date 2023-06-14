<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('config.php') ?>
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src='all.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body style=' background-color: rgb(236, 236, 236);'>
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
        <div class="one">
        <nav class='sticky-top first '>
      <div>
        <div class=" p-5 nitem"><a class="nav-link"><i class="fa-solid fa-shop pe-2"></i>STORE</a></div>
        <div class="nitem"><a class="nav-link" href="home.php"><i class="fa-solid fa-house pe-2"></i>Home

        </div>

        <div class="h nitem"><a class="nav-link" href="panier.php"><i
              class="fa-solid fa-cart-shopping pe-2"></i>panier</a></div>
        <div class="nitem"><a class="nav-link" href="commande.php"><i
              class="fa-solid fa-truck-fast pe-2"></i></i>commande</a></div>
              <div class=" nitem"><a class="nav-link" href="stores.php"><i
              class="fa-sharp  fa-store pe-2"></i></i>stores</a></div>
        <div class="nitem"><a class="nav-link" href="community.php"><i
              class="fa-sharp  fa-retweet pe-2"></i></i>community</a></div>
        <div class="nitem"><a class="nav-link" href="index.php"><i
              class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
      </div>
    </nav>
        </div>
        <div class="ps-5 pt-5 two">
            <h2>Panier</h2>
            <div class='panierpr'>
                <div>
                    <?php
                    session_start();
                    $user = $_SESSION['user'];
                    $sql = "SELECT codeuser,codepr,count(codepr) from panier where codeuser='$user' GROUP BY codepr";
                    $table = $pdo->query($sql);
                    $total = 0;
                    while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                        $codep = $row['codepr'];
                        $sql2 = "select * from produit where code='$codep' ";
                        $table2 = $pdo->query($sql2);
                        while ($row2 = $table2->fetch(PDO::FETCH_ASSOC)) {
                            $pnom = $row2['nom'];
                            $title = $row2['title'];
                            $prix = $row2['prix'];
                            $codepr = $row['codepr'];
                            $count = $row['count(codepr)'];
                            $tp = $prix * $count;
                            $total += $tp;
                            $tt = "$$prix*$count=$$tp";
                            echo "<div class='pr mb-3 me-5 animate__animated animate__zoomIn'>
            <img src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cHJvZHVjdHN8ZW58MHx8MHx8fDA%3D&w=1000&q=80' ></img>
    <p>$pnom</p>
    <p>$tt</p>
    <form action='produit.php' method='post'><button type='submit' name='ajt' class='more'  value='$codepr'> more detail</button><br><br></form>
    ";
                            echo "

";
                            $sql4 = "SELECT pr.code,pr.qtr,count(pn.codep),(pr.qtr -count(pn.codep) )
        c from produit pr,panier pn where pr.code=pn.codepr and pn.codepr=$codepr  GROUP BY pr.code";
                            $table4 = $pdo->query($sql4);
                            $sql3 = "select count(codep) from panier where codepr=$codepr";
                            $table3 = $pdo->query($sql3);
                            $isempty = 0;
                            while ($row3 = $table3->fetch(PDO::FETCH_ASSOC)) {
                                $isempty = $row3['count(codep)'];

                            }
                        }
                        $statu = -1;
                        if ($isempty != 0) {
                            while ($row4 = $table4->fetch(PDO::FETCH_ASSOC)) {
                                if ($row4['c'] > 0) {
                                    $statu = 0;

                                }
                            }
                        } else {
                            $statu = 0;
                        }
                        if ($statu == -1) {
                            echo "<button statu='able' type='submit' name='m' value='$codepr'  class='m'><i class='fa-solid fa-minus'></i></button>
         <label class='items'  name='label' value='$codepr' for='$prix'>$count</label>
         <button type='submit' name='p' disabled value='$codepr'  class='p'><i class='fa-solid fa-plus'></i></button>
         </label>
         <br>
         <br>
         <button type='submit' name='sup' value='$codepr'  class=' btn btn-primary'>supprimer</button>
    ";
                        } else {
                            echo "<button statu='able' class='m'type='submit' name='m' value='$codepr'><i class='fa-solid fa-minus'></i></button>
         <label class='items'  name='label' value='$codepr' for='$prix'>$count</label>
         <button class='p' type='submit'statu='able' name='p' value='$codepr'><i class='fa-solid fa-plus'></i></button>
         </label>
         <br>
          <br>
         <button type='submit' name='sup' value='$codepr' class='more me-3'>supprimer</button>
    ";
                        }
                        // here
                        echo "</div>
        
        ";
                    }
                    echo "<p class='price'>TOTAL :$$total</p>";

                    ?>
                    <?php
                    if (!empty($_POST['com'])) {

                        $codem = 1;
                        if (file_exists('codecom.txt')) {
                            $codem = unserialize(file_get_contents('codecom.txt'));
                        } else {
                            file_put_contents('codecom.txt', serialize($codem));
                        }
                        $user = $_SESSION['user'];
                        $codead = $_POST['adresse'];
                        $sql = "
SELECT p.codepr,COUNT(p.codep) as 'quantite',(SELECT pr.prix from produit pr where pr.code=p.codepr GROUP BY pr.prix ),((SELECT pr.prix from produit pr where pr.code=p.codepr GROUP BY pr.prix )*COUNT(p.codep) ) as 'total' from panier p WHERE p.codeuser=$user GROUP BY p.codepr";
                        $table = $pdo->query($sql);
                        while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                            $codepr = $row['codepr'];
                            $quantite = $row['quantite'];
                            $date = date('Y-m-d H:i:s');
                            $total = $row['total'];
                            $sql = "insert into commande values('$codem',$codepr,$user,$codead,$quantite,$total,'$date')";
                            $requete = $pdo->prepare($sql);
                            $requete->execute();
                            $codem++;
                            file_put_contents('codecom.txt', serialize($codem));
                            $sqldelete = "delete from panier where codeuser=$user";
                            $requete2 = $pdo->prepare($sqldelete);
                            $requete2->execute();
                            $sqlupdate = "update produit set qtr=qtr-$quantite , qtv=$quantite where code=$codepr";
                            $requete3 = $pdo->prepare($sqlupdate);
                            $requete3->execute();
                          
                            
                        }
                    }
                    ?>
                    <form action="#" method="post">
                        <?php
                        $user = $_SESSION['user'];
                        $sql = "SELECT a.code ,r.nom,v.nom,a.adresse from region r,ville v,adresse a where r.code=v.coderg and a.code_ville=v.code and user='$user'";
                        $table = $pdo->query($sql);
                        while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                            $codead = $row[0];
                            $adresse = $row[3];
                            $ville = $row[2];
                            $region = $row[1];
                            echo "
        <input class='ms-2' type='radio' value='$codead' name='adresse' required>
        <label for='adresse' ><p><i class='fa-solid fa-location-dot'></i> $adresse | $ville | $region</p></label>";
                            $row[0];
                            echo "<br>";
                        }
                        ?>
                        <input class='ms-2 btn btn-primary' type="submit" class='btn btn-primary' name='com'
                            value='confirmer'>

                    </form>
                </div>
            </div>

        </div>

    </div>

    </div>

    </div>



    <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script>
        document.querySelector(".page-overlay").style.display = 'flex';
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            document.querySelector(".page-overlay").style.display = 'none';
            document.body.style.overflow = 'auto';
            document.querySelector("#general").setAttribute("class", "d-flex justify-content-between")
        }, 1000);

    </script>
    <script src="plusmoins.js"></script>
</body>

</html>