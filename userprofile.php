<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <link rel="stylesheet" href="all.css">
    <script src="app.js"></script>
    <script src='all.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <?php session_start();
    require('config.php') ?>
    <title>Document</title>
</head>

<body>

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
        
        <div class="two">
            <nav>
                <?php
                $id=$_POST['id'];
                $sql="select * from users where id =$id";
                $table = $pdo->query($sql);
                while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                    $id=$row['id'];
                    $image=$row['image'];
                    $nom=$row['nom'];
                    $prenom=$row['prenom'];
                    $email=$row['email'];
                    $adresse=$row['adresse'];
                    $codev=$row['codev'];
                    $coder=$row['coderg'];
                    $password=$row['password'];
                    $date=$row['date'];
                }
                ?>
                <h3>USER INFORMATION</h3></nav>
                <div class='profile ps-5'>
                   <div class='navigation'>
                   <?php
                   
                   echo "<button value='1$id'>Profile</button>
                   <button value='2$id'>Adresse</button>
                   <button value='3$id'>Paniere</button>
                   <button value='4$id'>Commande</button>
                   <button value='5$id'>Product Visted</button>
                   <button value='6$id'>Store Visted</button>"
                   ?>
                   </div>
                   <div class="infoprofile">
                    <?php
                    $sql="SELECT sum(total) FROM commande where codeu=$id";
                    $table = $pdo->query($sql);
                while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                    $sum=$row['sum(total)'];
                }
                    ?>
                   <?php
                   echo "<style>
                   table{
                       width: 48vw;
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
                     
                           </style><div>
                   <img class='img' src='data:image/jpeg;base64," . base64_encode($image) . "'>
                   </div>
                   <div>
                    <h2>$nom $prenom</h2>
                    
                    <table>
                        <tbody>
                            <tr>
                                <td>Full name :</td>
                                <td>$nom $prenom</td>
                                
                            </tr>
                            <tr>
                            <td>Adresse : </td>
                            <td>$adresse</td>
                            </tr>
                            <tr>
                                <td>email :</td>
                                <td>$email</td>
                            </tr>
                            <tr>
                                <td>password :</td>
                                <td>$password</td>
                            </tr>
                            <tr>
                                <td>date inscription :</td>
                                <td>$date</td>
                            </tr>
                            <tr>
                            <td>Balnce :</td>
                            <td>$$sum</td>
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