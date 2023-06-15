<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
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
            <div class="h p-5 nitem"><a class="nav-link" href="vendeur.php"><i
                  class="fa-brands fa-windows pe-2"></i>DASHBOARD</a></div>
            <div class="nitem"><a class="nav-link" href="users.php"><i class="fa-solid fa-registered pe-2"></i>Products
          
            </div>
            <div class="nitem"><a class="nav-link" href="sellers.php"><i
                  class="fa-solid fa-users-between-lines pe-2"></i></i>Orders</a></div>
            <div class="nitem"><a class="nav-link" href="adminpost.php"><i class="fa-solid fa-database pe-2"></i>USERS DATA</a></div>
         
            <div class="nitem"><a class="nav-link" href="index.php"><i
                  class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
          </div>
        </nav>
      </div>
        </div>
        <div class="two">
        <nav>
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
            <!-- total earning -->
              <?php
              $user=$_SESSION['user'];
              $sql = "SELECT sum(total) from venduer v ,produit p ,commande c where v.code=p.codev and c.codepr=p.code and v.code=$user";
              $table = $pdo->query($sql);
              
              while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                $taotal = $row['sum(total)'];
                echo "<h5 id='balance'>$$taotal</h5>";
              }

              ?>
            </h4>
          </div>
          <div class="moneydiv">
            <i class="fa-solid fa-money-bill-transfer"></i>
            <br>
            <br>
            <H5 style="opAcity:0.9" >BALANCE PANIERE</H5>
            <h4>
                <!-- wiating money -->
              <?php
              $sql = "SELECT pr.prix,COUNT(p.codepr), ((pr.prix)*(COUNT(p.codepr))) as 'total' from panier p , produit pr where pr.code=p.codepr and pr.codev=$user GROUP  by p.codepr ";
              $table = $pdo->query($sql);
              $sum=0;
              while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                $total = $row['total'];
                $sum+=$total;
              }echo "<h5 >$$sum</h5>";
              ?>
            </h4>
          </div>
          <div class="moneydiv">
            <i class="fa-solid fa-gauge"></i>
            <br>
            <br>
            <H5 style="opAcity:0.9" >AVG PER MOUNTH</H5>
            <h4>
              <?php
              $avg = $taotal / 12;
              echo "<h5 id='avg'>$$avg</h5>";

              ?>
            </h4>
          </div>
          <div class="moneydiv">
            <i class="fa-solid fa-arrow-trend-up"></i>
            <br>
            <br>
            <H5 id="bm" style="opAcity:0.9">BEST MOUNTH</H5>
            <h4>
              <?php
              $sql = "SELECT monthname(date) ,sum(total) from commande GROUP by month(date) ORDER BY `sum(total)` DESC LIMIT 1
;
";
              $table = $pdo->query($sql);
              while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                $total = $row['monthname(date)'];
                echo "<h5 id='dayname'>$total</h5>";
              }
              ?>
                
            </h4>
          </div>
          <div class="moneydiv">
            <i class="fa-solid fa-arrow-trend-up"></i>
            <br>
            <br>
            <H5 style="opAcity:0.9">BEST BALANCE</H5>
            <h4><div class="table">
              test
            </div>
              <?php
              $sql = "SELECT COUNT(p.codepr), ((pr.prix)*(COUNT(p.codepr))) as 'total' from panier p , produit pr where pr.code=p.codepr and pr.codev=2 GROUP by p.codepr ORDER BY `total` DESC limit 1

;
";
              $table = $pdo->query($sql);
              while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                $total = $row['total'];
                echo "<h5 id='bc'>$$total</h5>";
              }
              ?>
            </h4>
          </div>
        </div>

      </div>
      <div class="cyear">

        <?php
        $sql = "SELECT month(date),sum(total) as 'total' from commande c,produit pr where c.codepr=pr.code and pr.codev=2  GROUP BY month(date) order by total DESC limit 1
";
        $max = 0;
        $table = $pdo->query($sql);
        while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
          $max = $row["total"];

        }
       
        ?>
        <div class="year">

          <?php
          for ($i = 1; $i < 13; $i++) {
            if ($i < 10) {
              $sql = "SELECT SUM(TOTAL) as  'total' FROM commande c,produit p WHERE date BETWEEN '2023/0$i/01' AND '2023/0$i/31' and c.codepr=p.code and p.codev=$user;";
            } else {
              $sql = "SELECT SUM(TOTAL) as  'total' FROM commande c,produit p WHERE date BETWEEN '2023/$i/01' AND '2023/$i/31' and c.codepr=p.code and p.codev=$user";
            }
            $x = 0;
            $table = $pdo->query($sql);
            while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
              $x = $row["total"];
            }
            if ($max>0){
              $height = ($x * 100) / $max;
            $heightfinal = $height * 310/ 100;
            }else{
              $heightfinal=0;
            }
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
    <button type='submit' name='month'  value='$key'>$value</button>
</div>";
          }
          ?>

        </div>

      </div>
        </div>
    </div>
</body>
</html>