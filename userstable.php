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
<style>
		.table {
            width: 81vw;
	border-spacing: 0 15px;
	border-collapse: separate;
}
.table thead tr th,
.table thead tr td,
.table tbody tr th,
.table tbody tr td {
	vertical-align: middle;
	border: none;
}
.table thead tr th:nth-last-child(1),
.table thead tr td:nth-last-child(1),
.table tbody tr th:nth-last-child(1),
.table tbody tr td:nth-last-child(1) {
	text-align: center;
}
.table tbody tr {
	box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
	border-radius: 5px;
}
.table tbody tr td {
	background: #fff;
}
.table tbody tr td:nth-child(1) {
	border-radius: 5px 0 0 5px;
}
.table tbody tr td:nth-last-child(1) {
	border-radius: 0 5px 5px 0;
}

.user-info {
	display: flex;
	align-items: center;
}
.user-info__img img {
	margin-right: 15px;
	height: 55px;
	width: 55px;
	border-radius: 45px;
	border: 3px solid #fff;
	box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.active-circle {
	height: 10px;
	width: 10px;
	border-radius: 10px;
	margin-right: 5px;
	display: inline-block;
}

	</style>
<body>

    <div class="d-flex">
        <div class="sticky-top one">
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
            <h3>table of users</h3>
          </nav>
          <div class="usercontainer">
<?php
$value= $_POST['table'];
echo "<table class='table'>
<thead>
    <tr>
        <th>User</th>
        <th>Fullname</th>
        <th>Email</th>
        <th>Password</th>
        <th>adresse</th>
        <th>Action</th>
        
    </tr>
</thead>
<tbody>";
if($value=='all'){
 $sql = "SELECT * FROM users u where role='u'";
                $table = $pdo->query($sql);
            while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                
                $id = $row['id'];
                $nom = $row['nom'];
                $prenom = $row['prenom'];
                $email = $row['email'];
                $pass = $row['password'];
            
                $imageData = $row['image'];
                $adresse=$row['adresse'];
                if($imageData){
                    echo "<tr>
                    <td>
                        <div class='user-info'>
                            <div class='user-info__img'>
                            <img class='person' src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''>
                            </div>
                            <div class='user-info__basic'>
                                
                            </div>
                        </div>
                    </td>
                    <td>
                        $nom $prenom
                    </td>
                    <td>$email</td>
                    <td>$pass</td>
                    <td>$adresse</td>
                    <td>
                        <form action='userprofile.php' method='post'>
                            <button value='$id' class='btn btn-primary btn-sm' name='id'>profile</button>
                        </form>
                    </td>
                    
                </tr>";

                }
                
            }
} else if (is_numeric($value)){
    if ($value < 10) {
        $value = "0$value";
    }
    $sql = "SELECT * FROM users u where role='u' and  date(date) between '2023-$value-01' and '2023-$value-31'";
    
    $table = $pdo->query($sql);
    while ($row = $table->fetch(PDO::FETCH_BOTH)) {

        $id = $row['id'];
    $nom = $row['nom'];
    $prenom = $row['prenom'];
    $email = $row['email'];
    $pass = $row['password'];

    $imageData = $row['image'];
    $adresse=$row['adresse'];
    if($imageData){
        echo "<tr>
        <td>
            <div class='user-info'>
                <div class='user-info__img'>
                <img class='person' src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''>
                </div>
                <div class='user-info__basic'>
                    
                </div>
            </div>
        </td>
        <td>
            $nom $prenom
        </td>
        <td>$email</td>
        <td>$pass</td>
        <td>$adresse</td>
        <td>
            <form action='userprofile.php' method='post'>
                <button name='id' value='$id' class='btn btn-primary btn-sm'>profile</button>
            </form>
        </td>
        
    </tr>";

        }

    }
} else if ($value == 'paid') {
    $sql = "SELECT * FROM users u where id in (select distinct codeu from commande)  and role='u' ";

    $table = $pdo->query($sql);
    while ($row = $table->fetch(PDO::FETCH_BOTH)) {
        $id = $row['id'];
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $pass = $row['password'];
    
        $imageData = $row['image'];
        $adresse=$row['adresse'];
        if($imageData){
            echo "<tr>
            <td>
                <div class='user-info'>
                    <div class='user-info__img'>
                    <img class='person' src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''>
                    </div>
                    <div class='user-info__basic'>
                        
                    </div>
                </div>
            </td>
            <td>
                $nom $prenom
            </td>
            <td>$email</td>
            <td>$pass</td>
            <td>$adresse</td>
            <td>
                <form action='userprofile.php' method='post'>
                    <button name='id' value='$id' class='btn btn-primary btn-sm'>profile</button>
                </form>
            </td>
            
        </tr>";

        }
    }
} else if(substr($value,0,6)=='pmonth' ){
    $value = substr($value, 6, 8);
    $sql = "SELECT * FROM users u where role='u'  and id  in (select distinct codeu from commande c where   date(c.date) between '2023-$value-01' and '2023-$value-31')";

    $table = $pdo->query($sql);
    while ($row = $table->fetch(PDO::FETCH_BOTH)) {

        $id = $row['id'];
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $pass = $row['password'];
    
        $imageData = $row['image'];
        $adresse=$row['adresse'];
        if($imageData){
            echo "<tr>
            <td>
                <div class='user-info'>
                    <div class='user-info__img'>
                    <img class='person' src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''>
                    </div>
                    <div class='user-info__basic'>
                        
                    </div>
                </div>
            </td>
            <td>
                $nom $prenom
            </td>
            <td>$email</td>
            <td>$pass</td>
            <td>$adresse</td>
            <td>
                <form action='userprofile.php' method='post'>
                    <button name='id' value='$id' class='btn btn-primary btn-sm'>profile</button>
                </form>
            </td>
            
        </tr>";

        }

    }
}
else if(substr($value, 0, 4) == 'pday'){
    $value = substr($value, 4);
    $sql = "SELECT * FROM Users U WHERE u.id in (SELECT DISTINCT codeu from commande where date(date) like '$value')";
    
    $table = $pdo->query($sql);
    while ($row = $table->fetch(PDO::FETCH_BOTH)) {
        $id = $row['id'];
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $pass = $row['password'];
    
        $imageData = $row['image'];
        $adresse=$row['adresse'];
        if($imageData){
            echo "<tr>
            <td>
                <div class='user-info'>
                    <div class='user-info__img'>
                    <img class='person' src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''>
                    </div>
                    <div class='user-info__basic'>
                        
                    </div>
                </div>
            </td>
            <td>
                $nom $prenom
            </td>
            <td>$email</td>
            <td>$pass</td>
            <td>$adresse</td>
            <td>
                <form action='userprofile.php' method='post'>
                    <button name='id' value='$id' class='btn btn-primary btn-sm'>profile</button>
                </form>
            </td>
            
        </tr>";

        }

    }
}else if($value=='npaid'){
    $sql = "SELECT * FROM users u where id not in (select distinct codeu from commande)  and role='u' ";

    $table = $pdo->query($sql);
    while ($row = $table->fetch(PDO::FETCH_BOTH)) {

        $id = $row['id'];
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $pass = $row['password'];
    
        $imageData = $row['image'];
        $adresse=$row['adresse'];
        if($imageData){
            echo "<tr>
            <td>
                <div class='user-info'>
                    <div class='user-info__img'>
                    <img class='person' src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''>
                    </div>
                    <div class='user-info__basic'>
                        
                    </div>
                </div>
            </td>
            <td>
                $nom $prenom
            </td>
            <td>$email</td>
            <td>$pass</td>
            <td>$adresse</td>
            <td>
                <form action='userprofile.php' method='post'>
                    <button name='id' value='$id' class='btn btn-primary btn-sm'>profile</button>
                </form>
            </td>
            
        </tr>";

        }
    }
} else if(substr($value, 0, 7) == 'npmonth'){
    $value = substr($value, 7);
    $sql = "SELECT * FROM users u where id not in (select distinct codeu from commande where date(date) between '2023-$value-01' and '2023-$value-31' )  and role='u' ";

    $table = $pdo->query($sql);
  
    while ($row = $table->fetch(PDO::FETCH_BOTH)) {
        $id = $row['id'];
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $pass = $row['password'];
    
        $imageData = $row['image'];
        $adresse=$row['adresse'];
        if($imageData){
            echo "<tr>
            <td>
                <div class='user-info'>
                    <div class='user-info__img'>
                    <img class='person' src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''>
                    </div>
                    <div class='user-info__basic'>
                        
                    </div>
                </div>
            </td>
            <td>
                $nom $prenom
            </td>
            <td>$email</td>
            <td>$pass</td>
            <td>$adresse</td>
            <td>
                <form action='userprofile.php' method='post'>
                    <button name='id' value='$id' class='btn btn-primary btn-sm'>profile</button>
                </form>
            </td>
            
        </tr>";

        }
    }
}else if(substr($value, 0, 5) == 'npday'){
    $value = substr($value, 5);
    $sql = "SELECT * FROM users u where id not in (select distinct codeu from commande where date(date) like '$value')  and role='u' ";

    $table = $pdo->query($sql);

    while ($row = $table->fetch(PDO::FETCH_BOTH)) {

        $id = $row['id'];
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $pass = $row['password'];
    
        $imageData = $row['image'];
        $adresse=$row['adresse'];
        $id = $row['id'];
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $pass = $row['password'];
    
        $imageData = $row['image'];
        $adresse=$row['adresse'];
        if($imageData){
            echo "<tr>
            <td>
                <div class='user-info'>
                    <div class='user-info__img'>
                    <img class='person' src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''>
                    </div>
                    <div class='user-info__basic'>
                        
                    </div>
                </div>
            </td>
            <td>
                $nom $prenom
            </td>
            <td>$email</td>
            <td>$pass</td>
            <td>$adresse</td>
            <td>
                <form action='userprofile.php' method='post'>
                    <button name='id' value='$id' class='btn btn-primary btn-sm'>profile</button>
                </form>
            </td>
            
        </tr>";

        }}
    
}
else{

    $sql = "SELECT * FROM users u where role='u' and  date(date) like '$value'";

    $table = $pdo->query($sql);
    while ($row = $table->fetch(PDO::FETCH_BOTH)) {
        $id = $row['id'];
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $pass = $row['password'];
    
        $imageData = $row['image'];
        $adresse=$row['adresse'];
        if($imageData){
            echo "<tr>
            <td>
                <div class='user-info'>
                    <div class='user-info__img'>
                    <img class='person' src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''>
                    </div>
                    <div class='user-info__basic'>
                        
                    </div>
                </div>
            </td>
            <td>
                $nom $prenom
            </td>
            <td>$email</td>
            <td>$pass</td>
            <td>$adresse</td>
            <td>
                <form action='userprofile.php' method='post'>
                    <button name='id' value='$id' class='btn btn-primary btn-sm'>profile</button>
                </form>
            </td>
            
        </tr>";

        }

    }
}
echo "</tbody>
</table>";
            ?>
          </div>
            
          
        </div>


            </div>


            <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
                crossorigin="anonymous"></script>
</body>
<?php
echo "<script>
let imgs = document.querySelectorAll('img')
imgs.forEach(element => {
    imgs.forEach(element => {
    if (element.src == 'data:image/jpeg;base64,bm9uZQ==') {
        element.src = 'https://assets.goal.com/v3/assets/bltcc7a7ffd2fbf71f5/bltf7695f98c1f01bd9/62cbfb91c9db8842cf76cb5b/GHP_MESSI-BOOTS_16-9.jpg';
    }
});
});
</script>"
?>
</html>