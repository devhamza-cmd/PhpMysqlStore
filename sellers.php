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
    <script src="app3.js"></script>
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
            <h3 class='ps-5 pt-5 mb-5'>ADMIN PANEL</h3>
            
            <div class="d-flex justify-content-center">
            <nav class='sticky-top first '>
          <div>
            <div class=" nitem"><a class="nav-link" href="admin.php"><i
                  class="fa-brands fa-windows pe-2"></i>DASHBOARD</a></div>
            <div class="nitem"><a class="nav-link" href="users.php"><i class="fa-solid fa-users pe-2"></i>USERS
          
            </div>
            <div class="h p-5 nitem"><a class="nav-link" href="sellers.php"><i
                  class="fa-solid fa-users-between-lines pe-2"></i></i>SELLERS</a></div>
            <div class="nitem"><a class="nav-link" href="adminpost.php"><i class="fa-solid fa-check-to-slot pe-2"></i>POST</a></div>
            <div class="nitem"><a class="nav-link" href="index.php"><i
                  class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
          </div>
        </nav>
            </div>

        </div>
        <div class="two">
            <style>
                .two nav div{
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    justify-content: space-between;
                }
            </style>
            <nav>
                <div >
                <h3 >USERS</h3>
                
                <a class='tobtn' href="searchsellers.php">search</a>
                </div>
            </nav>
            <div class="d-flex  dinfo">
                <div class=" partone ">
                    <div class="moneydiv">
                        <i class="fa-solid fa-users-between-lines"></i>
                        <br>
                        <br>
                        <H5 class='nu' style="opAcity:0.9">SELLERS</H5>
                        
                        <h4>
                            <?php
                            $sql = "SELECT count(*) from users where role='v' ";
                            $table = $pdo->query($sql);
                            while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                                $taotal = $row['count(*)'];
                                echo "<h5 id='value1'>$taotal</h5>";
                            }

                            ?><form action="sellerstable.php" method="post">
                                <button type="submit" name='table' value='all' class='input'>see more</button>
                            </form>
                        </h4>
                    </div>
<div class="moneydiv">

                        <i class="fa-solid fa-users"></i>
                        <br>
                        <br>
                        <H5 class='best' style="opAcity:0.9">AVG PER year</H5>
                        <h4>
                            <?php
                            $sql = "SELECT round(count(*)/12,2) from users where role='v'";
                            $table = $pdo->query($sql);
                            while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                                $taotal = $row['round(count(*)/12,2)'];
                                echo "<h5 id='value2'>$taotal</h5>";
                            }


        ?>
    </h4>
</div>
                    <div class="moneydiv">
                        <i class="fa-solid fa-users"></i>
                        <br>
                        <br>
                        <H5 style="opAcity:0.9">PAID  </H5>
                        <h4>
                            <?php
                            $sql = "SELECT COUNT(DISTINCT codev) from commande c,produit p where c.codepr=p.code";
                            $table = $pdo->query($sql);
                            while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                                $taotal = $row['COUNT(DISTINCT codev)'];
                                echo "<h5 id='value3'>$taotal</h5>";
                            }
                            
                            ?>
                            <form action="sellerstable.php" method="post">
                                <button type="submit" name='table' value='all' class='input2'>see more</button>
                            </form>
                        </h4>
                    </div>
                    <div class="moneydiv">

                        <i class="fa-solid fa-users"></i>
                        <br>
                        <br>
                        <H5 style="opAcity:0.9">NOT PAID </H5>
                        <h4>
                            <?php
                            $sql = "SELECT COUNT(*) from users where role='v' and id not in (SELECT DISTINCT codev from commande c,produit p where c.codepr=p.code)";
                            $table = $pdo->query($sql);
                            while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                                $taotal = $row['COUNT(*)'];
                                echo "<h5 id='value4'>$taotal</h5>";
                            }

                            ?>
                            <form action="sellerstable.php" method="post">
                                <button type="submit" name='table' value='npaid' class='input3'>see more</button>
                            </form>
                        </h4>
                    </div>
                    <div class="moneydiv">

                        <i class="fa-solid fa-users"></i>
                        <br>
                        <br>
                        <H5 class='best2' style="opAcity:0.9">BEST MONTH</H5>
                        <h4>
                            <?php
                            $sql = "SELECT MONTHNAME(date) ,count(id) from users where role='v' GROUP by month(date) ORDER BY `count(id)` DESC limit 1";
                            $table = $pdo->query($sql);
                            while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                                $taotal = $row['MONTHNAME(date)'];
                                echo "<h5 id='value5'>$taotal</h5>";
                            }

                            ?>
                        </h4>
                    </div>
                    
                    

                </div>

            </div>
            <div class="cyear">
                <?php
                $sql = "SELECT month(date) ,count(id) from users where role='v' GROUP by month(date) ORDER BY `count(id)` DESC limit 1


";
                $max = 0;
                $table = $pdo->query($sql);
                while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                    $max = $row['count(id)'];

                }
                ?>
                <div class="year">

                    <?php
                    for ($i = 1; $i < 13; $i++) {
                        if ($i < 10) {
                            $sql = "SELECT count(id) from users where role='v' and date(date) BETWEEN '2023/0$i/01' and '2023/0$i/30' GROUP by month(date)  ORDER BY `count(id)` DESC limit 1";
                        } else {
                            $sql = "SELECT count(id) from users where role='v' and date(date) BETWEEN '2023/$i/01' and '2023/$i/30' GROUP by month(date)  ORDER BY `count(id)` DESC limit 1
";
                        }
                        $x = 0;
                        $table = $pdo->query($sql);
                        while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                            $x = $row['count(id)'];
                        }
                        $height = ($x * 100) / $max;
                        $heightfinal = $height * 310 / 100;
                        $heightfinal++;
                        
                        echo "<div  class='d-flex justify-content-center align-items-end' style='height: $heightfinal" . "px" . ";' ></div>";
                    }

                    ?>

                </div>
                <div class="mounth">
                    <?php
                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jun', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    foreach ($months as $key => $value) {
                        $key++;
                        echo "<div class='month'>
  
    <button  class='m'  value='$key'>$value</button>
  
  
</div>";
                    }
                    ?>

                </div>


            </div>


            <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
                crossorigin="anonymous"></script>
</body>

</html>