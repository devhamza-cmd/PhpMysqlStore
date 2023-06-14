<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php session_start();
    require('config.php') ?>
     <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <link rel="stylesheet" href="all.css">
    <script src="app.js"></script>
    <script src='all.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="test"></div>
<div class=" d-flex">
    
        <div class="one">
            <h3 class='ps-5 pt-5 mb-5'>ADMIN PANEL</h3>
            
            <div class="d-flex justify-content-center">
                <nav class=' first '>
                    <div>
                        <div class=" nitem"><a class="nav-link" href="admin.php"><i
                                    class="fa-brands fa-windows pe-2"></i>DASHBOARD</a></div>
                        <div class="p-5 h nitem"><a class="nav-link" href="users.php"><i
                                    class="fa-solid fa-users pe-2"></i>USERS
                                </a></div>
                        <div class="nitem"><a class="nav-link" href="home.php"><i
                                    class="fa-solid fa-users-between-lines pe-2"></i></i>SELLERS</a></div>
                        <div class="nitem"><a class="nav-link" href="home.php"><i
                                    class="fa-solid fa-cart-shopping pe-2"></i>PRODUCTS</a></div>
                        <div class="nitem"><a class="nav-link" href="index.php"><i
                                    class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
                    </div>
                </nav>
            </div>

        </div>
        <style>
        .two nav{
            background-image: url('https://png.pngtree.com/thumb_back/fh260/back_pic/03/62/13/0557a99c8559fd2.jpg') ;
            background-repeat: no-repeat;
            background-size: 100%;
            height: 110px;
            
        }
        .two nav img{
            height: 120px;
            margin-top: 40px;
            width: 120px;
        }
        .two nav h4{
            padding: 20px ;
            color: blue;
        }
        .two nav div{
            width: 200px;
            position: relative;
            left: 70px;
            bottom: 70px;
            align-items: center;
            text-align: center;
           
            
        }
        .two nav button{
            background-color: transparent;
            color: blue;
            border: none;
        }
        </style>
        <?php
        $codestore= $_POST['code'];
        $sql="SELECT s.codestore,s.nom as 's',u.nom,u.prenom,u.id from store s,venduer v,users u where v.code=s.codev and u.id=v.codeu and codestore=$codestore ";
        $table = $pdo->query($sql);
        while ($row = $table->fetch(PDO::FETCH_BOTH)) {
            $scode=$row['codestore'];
            $id=$row['id'];
            $nom=$row['s'];
            $vendeur=$row['nom']." ".$row['prenom'];
            
        }
        
        ?>
        <div class="two">
            <nav><img src="https://www.yelo.ma/img/ma/k/1655376271-34-wafasalaf-marjane-sale.png" alt="">
                <div >
                <?php echo "<h4>$nom</h4>"?></div>
            
            </nav>
           
                           <div class='pa  ps-5'>
                           
                   <div class='navigation2'>
                   <?php
                   
                   echo "<button value='1$scode'>information</button>
                   <button value='2$scode'>Customers</button>
                   <button value='3$scode'>Produit</button>
                   <button value='4$scode'>Commande</button>
                   "
                   ?>
                   </div>
                   <div class="infoprofile">
                    <?php
                    $sql="SELECT s.nom,s.date as'd1',u.nom as 'vendeur',u.prenom,u.email,u.password,u.date from  store s,venduer v,users u where s.codev=v.code and u.id=v.code and s.codestore=$scode";
                    $table = $pdo->query($sql);
                while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                    $nom=$row['nom'];
                    $date1=$row['d1'];
                    $vendeur=$row['vendeur']." ".$row['prenom'];
                    $email=$row['email'];
                    $pass=$row['password'];
                    $d2=$row['date'];

                }
                $sql="SELECT sum(total) from commande c,produit p,store s,venduer v where c.codepr=p.code and p.codev=v.code and v.code=s.codev  and s.codestore=$scode";
                    $table = $pdo->query($sql);
                while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                    $total=$row['sum(total)'];
                    

                }
                    ?>
                   <?php
                   echo "<style>
                   table{
                       width: 70vw;
                       
                   }
                   tr {
                       height: 50px;
                       font-size: 18px;
                       font-weight: bolder;
                   }
                   
                   tr:nth-child(even) td {
                      background-color:#599dfd;
                       color: white;
                     }
                     
                     tr:nth-child(odd) td {
                       color:white;
                       background-color:#257df8;
                     }
                     
                           </style>
                   <div>
                   
                    
                    <table>
                        <tbody>
                            <tr>
                                <td>Store name :</td>
                                <td>$nom</td>
                                
                            </tr>
                            <tr>
                            <td>Date creation</td>
                            <td>$date1</td>
                            </tr>
                            <tr>
                                <td>Owner:</td>
                                <td>$vendeur</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>$email</td>
                            </tr>
                            <tr>
                                <td>password:</td>
                                <td>$pass</td>
                            </tr>
                            
                            <tr>
                            
                            <td>Date creation</td>
                            <td>$d2</td>
                            </tr>
                            <tr>
                            
                            <td>total</td>
                            <td>$$total</td>
                            </tr>
                        </tbody>
                    </table>
                   </div>"
                   ?>
                   </div>
                </div>
        </div>
        </div>
        
        <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
                crossorigin="anonymous"></script>
</body>
</html>