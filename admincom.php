<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="all.css">
  <script src='all.js'></script>
    
    <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
    <?php session_start(); require('config.php')?>
    
    <title></title>
</head>
<body>
    
     <div class="d-flex">
        <div class="one">
            <h3 class='ps-5 pt-5 mb-5'>ADMIN<i class="fa-duotone fa-bars"></i> PANEL</h3>
            <div class="d-flex justify-content-center">
                <nav class='sticky-top first '>
    <div>
      <div class="h p-5 nitem"><a class="nav-link" href="admin.php"><i class="fa-brands fa-windows pe-2"></i>DASHBOARD</a></div>
      <div class="nitem" ><a class="nav-link" href="users.php"><i class="fa-solid fa-users pe-2"></i>USERS</a></div>
      <div class="nitem"><a class="nav-link" href="home.php"><i class="fa-solid fa-users-between-lines pe-2"></i></i>SELLERS</a></div>
      <div class="nitem"><a class="nav-link" href="home.php"><i class="fa-solid fa-cart-shopping pe-2"></i>PRODUCTS</a></div>
      <div class="nitem"><a class="nav-link" href="index.php"><i class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
    </div>
  </nav>
            </div>
        </div>
        <div class="two">
            <nav >
                <h3>DASHBOARD</h3>
            </nav>
            <div class="d-flex  dinfo  ">
                
                <div class=" partone ">
                <div class="moneydiv">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                    <br>
                    <br>
                    <H5 style="opAcity:0.9">BALANCE</H5>
                    <h4>
                        <?php
                        $month=$_POST['month'];
                if ($month<10){
                    $month="0$month";
                }
                        $sql="SELECT SUM(total) as 'total' FROM `commande` where DATE(date) between '2023/$month/01' and '2023/$month/30' ";
                         $table= $pdo->query($sql);
                        while($row = $table->fetch(PDO::FETCH_ASSOC)){
                            $total=$row['total'];
                            echo "<h5>$$total</h5>";
                        }

                        ?>
                    </h4>
                </div>
                
                <div  class="moneydiv">
                    <i class="fa-solid fa-gauge"></i>
                    <br>
                    <br>
                    <H5 style="opAcity:0.9">AVG PER DAY</H5>
                    <h4>
                        <?php
                        
                        $avg=$total/30;
                            echo "<h5>$$avg</h5>";
                        
                        ?>
                    </h4>
                </div>
                <div  class="moneydiv">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    <br>
                    <br>
                    <H5 style="opAcity:0.9">BEST DAY</H5>
                    <h4>
                        <?php
                        $sql="SELECT DAY(date) as 'total',sum(total) from commande WHERE date(date) BETWEEN '2023/$month/01' and '2023/$month/30' GROUP by DAY(date(date) ) ORDER BY `sum(total)` DESC LIMIT 1
;
";
                        $table= $pdo->query($sql);
                        while($row = $table->fetch(PDO::FETCH_ASSOC)){
                            $total=$row['total'];
                            echo "<h5>$total</h5>";
                        }
                        ?>
                    </h4>
                </div>
                <div  class="moneydiv">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    <br>
                    <br>
                    <H5 style="opAcity:0.9">BEST BALANCE</H5>
                    <h4>
                        <?php
                        $sql="SELECT day(date) as 'total',sum(total) from commande WHERE date(date) BETWEEN '2023/$month/01' and '2023/$month/30'  GROUP by day(date(date)) ORDER BY `sum(total)` DESC LIMIT 1
;
";
                        $table= $pdo->query($sql);
                        while($row = $table->fetch(PDO::FETCH_ASSOC)){
                            $total=$row['sum(total)'];
                            echo "<h5>$$total</h5>";
                        }
                        ?>
                    </h4>
                </div>
                </div>
                
            </div>
            <div class="cyear" >
                    
                <?php
                
                
                $sql="select sum(total)as 'total' from commande where date between '2023-$month-1' and '2023-$month-30' GROUP by date ORDER BY `total` DESC limit 1
";
                $max=0;
                $table= $pdo->query($sql);
                
                while($row = $table->fetch(PDO::FETCH_ASSOC)){
                    $max=$row["total"];

                }
                ?>
              <div class="year">
                
                  <?php 
                  for($i=1;$i<31;$i++){
                    if ($i<10){
                         $sql="SELECT SUM(TOTAL) as  'total' FROM `commande` WHERE date(date) like '2023-$month-0$i';
                  ";
                  $x=0;
                  $table= $pdo->query($sql);
             
                while($row = $table->fetch(PDO::FETCH_ASSOC)){
                    $x=$row["total"];

                    
                }
                $height=($x*100)/$max;
                $heightfinal=($height*330/100)+0.5;
                echo "<div  class='d-flex justify-content-center align-items-end' style='height: $heightfinal"."px".";' ></div>";
                    } else{
                          $sql="SELECT SUM(TOTAL) as  'total' FROM `commande` WHERE date(date) like '2023-$month-$i';
                  ";
                  $x=0;
                  $table= $pdo->query($sql);
                
                while($row = $table->fetch(PDO::FETCH_ASSOC)){
                    $x=$row["total"];

                    
                }
                $height=($x*100)/$max;
                $heightfinal=($height*330/100)+0.5;
                echo "<div  class='d-flex justify-content-center align-items-end' style='height: $heightfinal"."px".";' ></div>";
                    }
                   
                
                
                  }
                  
                
                
                
                  ?>
                    
                

               
                
              </div>
            <div class="mounth">
                <?php
                for ($i=1;$i<31;$i++){
                    echo "<div class='month'>
  
<form action='adminday.php' method='post'>
    <button type='submit' name='day'  value='2023-$month-$i'>$i</button>
  </form>
  </div>";
                }
                ?>

                </div>
            
            </div>
        </div>
    </div>
    <script src="app2.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>