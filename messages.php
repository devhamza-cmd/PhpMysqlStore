<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src='all.js'></script>

    <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <?php session_start();
    require('config.php') ?>
    <title>Document</title>
</head>

<body>


    <nav class='nbar'></nav>

    <div class="d-flex justify-content-between">

        <nav class='sticky-top first '>
            <div class='ntfcont animate__animated animate__fadeInRight'>test</div>
            <div>
                <div class=" p-5 nitem"><a class="nav-link"><i class="fa-solid fa-shop pe-2"></i>STORE X</a></div>
                <div class=" nitem"><a class="nav-link" href="home.php"><i class="fa-solid fa-house pe-2"></i>Home

                </div>

                <div class="nitem"><a class="nav-link" href="panier.php"><i
                            class="fa-solid fa-cart-shopping pe-2"></i>panier</a></div>
                <div class=" nitem"><a class="nav-link" href="commande.php"><i
                            class="fa-solid fa-truck-fast pe-2"></i></i>commande</a></div>
                <div class="h nitem"><a class="nav-link" href="community.php"><i
                            class="fa-sharp  fa-retweet pe-2"></i></i>community</a></div>
                <div class="nitem"><a class="nav-link" href="index.php"><i
                            class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
            </div>

        </nav>
        <?php

        $user = $_SESSION['user'];
        $sql = "select count(*) from notification where codeu=$user and type_ntf in(2,4,5)";
        $table = $pdo->query($sql);
        $defult = 0;
        while ($row = $table->fetch(PDO::FETCH_BOTH)) {
            $defult = $row['count(*)'];
        }
        ?>

        <style>
            .ntf,
            .newntfnbr {
                display: none;
            }
        </style>

        <div class='ntf'>
            <?php echo $defult; ?>
        </div>
        <div class="newntfnbr">
            <?php echo $defult; ?>
        </div>
        <?php
        $sql = "select count(*) from post where statu='accept'";
        $table = $pdo->query($sql);
        $postnbr = 0;
        while ($row = $table->fetch(PDO::FETCH_BOTH)) {
            $postnbr = $row['count(*)'];
        }
        $_SESSION['postnbr'] = $postnbr;
        ?>
        <style>
            .pnbr {
                display: none;
            }
        </style>
        <div class='pnbr'>
            <?php echo $postnbr;
            ?>


        </div>
        <style>
            .newpost {
                display: none;
            }
        </style>
        <div class="newpost">
            <?php echo $postnbr ?>
        </div>
        <div class='two'>
            <div class="d-flex  justify-content-around pt-5 ps-5 pb-4">
                <a class='navigation home' href="community.php"><i class=" icon3 fa-solid fa-house"></i></a>
                <a class='navigation notification ' href="notification.php"><i class="icon3 fa-solid fa-bell"></i></a>



                <a class="navigation " href="messages.php"><i class="s icon3 fa-solid fa-message"></i></a>

            </div>
            <div class="d-flex">
                <div class="listf">

                    <?php
                    $sql = "SELECT * from users where id not like $user";
                    $table = $pdo->query($sql);

                    while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                        $id=$row["id"];
                        $fullname = $row['nom'] . " " . $row['prenom'];
                        $imageData = $row['image'];
                        echo "<div class='friend' >
    <button class='select' id='$id'><img class='person' src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''>
    <h6>$fullname</h6></button>
</div>";
                    }
                    ?>
                    <script>
                        let imgs = document.querySelectorAll(".person")
                        imgs.forEach(element => {
                            if (element.src = "data:image/jpeg;base64,ZW1wdHk=") {
                                element.setAttribute('src', 'https://static.vecteezy.com/system/resources/previews/008/442/086/original/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg')
                            }
                        });
                    </script>
                </div>
                <div class="message animate__fadeIn">
                    <style>
                        .count,.count2{
                            display: none;
                        }
                        
                    </style>
                    <div class="count"></div>
                    <div class="count2"></div>
                    <div class="o">
                        
                        <div class='test'>
                           
                           
                        </div>
                    </div>
                    <div class="t">
                        <div class="contms">
                        <input class='msTxt' type="text" placeholder="write something here">
                        <button class='sendbtn'><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="message.js"></script>
</body>

</html>