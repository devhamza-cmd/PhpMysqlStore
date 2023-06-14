<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="all.css">
  <script src='all.js'></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <?php session_start();
  require('config.php') ?>
  <title>Document</title>
</head>

<body style="background-color:#d1d1d1 ;">
  <div class="d-flex">
    <div class="one">
      <h3 class='ps-5 pt-5 mb-5'>ADMIN PANEL</h3>
      <div class="d-flex justify-content-center">
        <nav class='sticky-top first '>
          <div>
            <div class="h p-5 nitem"><a class="nav-link" href="admin.php"><i
                  class="fa-brands fa-windows pe-2"></i>DASHBOARD</a></div>
            <div class="nitem"><a class="nav-link" href="users.php"><i class="fa-solid fa-users pe-2"></i>USERS
          
            </div>
            <div class="nitem"><a class="nav-link" href="sellers.php"><i
                  class="fa-solid fa-users-between-lines pe-2"></i></i>SELLERS</a></div>
            <div class="nitem"><a class="nav-link" href="adminpost.php"><i class="fa-solid fa-check-to-slot pe-2"></i>POST</a></div>
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
              <?php
              $sql = "SELECT SUM(total) as 'total' FROM `commande` ";
              $table = $pdo->query($sql);
              while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                $taotal = $row['total'];
                echo "<h5>$$taotal</h5>";
              }

              ?>
            </h4>
          </div>
          <div class="moneydiv">
            <i class="fa-solid fa-money-bill-transfer"></i>
            <br>
            <br>
            <H5 style="opAcity:0.9">BALANCE PANIERE</H5>
            <h4>
              <?php
              $sql = "SELECT sum(pr.prix)as 'total' from panier p ,produit pr where p.codepr=pr.code ";
              $table = $pdo->query($sql);
              while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                $total = $row['total'];
                echo "<h5>$$total</h5>";
              }
              ?>
            </h4>
          </div>
          <div class="moneydiv">
            <i class="fa-solid fa-gauge"></i>
            <br>
            <br>
            <H5 style="opAcity:0.9">AVG PER MOUNTH</H5>
            <h4>
              <?php
              $avg = $taotal / 12;
              echo "<h5>$$avg</h5>";

              ?>
            </h4>
          </div>
          <div class="moneydiv">
            <i class="fa-solid fa-arrow-trend-up"></i>
            <br>
            <br>
            <H5 style="opAcity:0.9">BEST MOUNTH</H5>
            <h4>
              <?php
              $sql = "SELECT monthname(date) as 'total',sum(total) from commande GROUP by month(date) ORDER BY `sum(total)` DESC LIMIT 1
;
";
              $table = $pdo->query($sql);
              while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                $total = $row['total'];
                echo "<h5>$total</h5>";
              }
              ?>
            </h4>
          </div>
          <div class="moneydiv">
            <i class="fa-solid fa-arrow-trend-up"></i>
            <br>
            <br>
            <H5 style="opAcity:0.9">BEST BALANCE</H5>
            <h4>
              <?php
              $sql = "SELECT month(date) as 'total',sum(total) from commande GROUP by month(date) ORDER BY `sum(total)` DESC LIMIT 1
;
";
              $table = $pdo->query($sql);
              while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                $total = $row['sum(total)'];
                echo "<h5>$$total</h5>";
              }
              ?>
            </h4>
          </div>
        </div>

      </div>
      <div class="cyear">

        <?php
        $sql = "select month(date),sum(total)as 'total' from commande GROUP by month(date) ORDER BY `total` DESC LIMIT 1

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
              $sql = "SELECT SUM(TOTAL) as  'total' FROM `commande` WHERE date BETWEEN '2023/0$i/01' AND '2023/0$i/31';
                  ";
            } else {
              $sql = "SELECT SUM(TOTAL) as  'total' FROM `commande` WHERE date BETWEEN '2023/$i/01' AND '2023/$i/31'";
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
  <form action='adminmonth.php' method='post'>
    <button type='submit' name='month'  value='$key'>$value</button>
  </form>
  
</div>";
          }
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