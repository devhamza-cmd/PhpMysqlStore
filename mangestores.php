<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <link rel="stylesheet" href="all.css">
    <script src="app4.js"></script>
    <script src='all.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <?php session_start();
    require('config.php') ?>
    <title>Document</title>
</head>

<body>
    <div class="d-flex">
        <div class="one">
            <h3 class='ps-5 pt-5 mb-5'>SELLER PANEL</h3>
            <div class="d-flex justify-content-center">
                <nav class='sticky-top first '>
                    <div>
                        <div class="nitem"><a class="nav-link" href="vendeur.php"><i
                                    class="fa-brands fa-windows pe-2"></i>DASHBOARD</a></div>
                        <div class="h p-5 nitem"><a class="nav-link" href="mangestores.php"><i
                                    class="fa-solid fa-store pe-2"></i>MANAGE STORES

                        </div>
                        <div class="nitem"><a class="nav-link" href="sellers.php"><i
                                    class="fa-solid fa-users-between-lines pe-2"></i></i>Orders</a></div>
                        <div class="nitem"><a class="nav-link" href="adminpost.php"><i
                                    class="fa-solid fa-database pe-2"></i>CUSTOMERS DATA</a></div>

                        <div class="nitem"><a class="nav-link" href="index.php"><i
                                    class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="two">
            <div class="addcontainer">

                <button class="m-5 btn btn-primary closeBtn">
                    <span class="material-symbols-outlined">

                        close
                    </span>
                </button>
                <dssiv class="upload">
                    <img class="" src="https://cdn-icons-png.flaticon.com/512/2697/2697432.png" alt="" srcset="">
                </dssiv>
                <div class="center">

                    <input type="text" class='storename'>
                    <?php
                    $user=$_SESSION["user"];
                    echo "<button value='$user' class='create btn btn-primary'>CREATE</button>"; 
                    ?>
                    
                    <span><i class="cstn fa-solid fa-upload"></i></span>
                    <input value="2697432.png" class="upimg" type="file" accept="image/*" name="uploadfile" id="img" />
                    
                </div><p class="get"></p>
            </div>
            <nav>
                <h3>MANAGE STORES</h3>
            </nav>
            <div class="ps-3 d-flex justify-content-center justify-content-between">
                <button role='add' id='add' class="ctsmbtn">
                    <H5 style="opAcity:0.9"><i class="fa-solid fa-plus"></i> ADD STORE</H5>
                </button>
                <button role='mod' class="ctsmbtn">
                    <H5 style="opAcity:0.9"><i class="fa-solid fa-pen-to-square"></i> MODIFY STORE</H5>
                </button>
                <button role='sup' id='remove' class="ctsmbtn">
                    <H5 style="opAcity:0.9"><i class="fa-solid fa-trash"></i> REMOVE STORE</H5>
                </button>
            </div>
        </div>
    </div>
</body>

</html>