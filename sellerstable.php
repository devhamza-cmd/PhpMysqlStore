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
        <div class="sticky-top one">
            <h3 class='ps-5 pt-5 mb-5'>ADMIN PANEL</h3>
            
            <div class="d-flex justify-content-center">
                <nav class='sticky-top first '>
                    <div>
                        <div class=" nitem"><a class="nav-link" href="admin.php"><i
                                    class="fa-brands fa-windows pe-2"></i>DASHBOARD</a></div>
                        <div class="nitem"><a class="nav-link" href="users.php"><i
                                    class="fa-solid fa-users pe-2"></i>USERS
                                </a></div>
                        <div class="h p-5 nitem"><a class="nav-link" href="sellers.php"><i class="fa-solid fa-users-between-lines pe-2"></i>SELLERS</a></div>
                        <div class="nitem"><a class="nav-link" href=""><i
                                    class="fa-solid fa-cart-shopping pe-2"></i>PRODUCTS</a></div>
                        <div class="nitem"><a class="nav-link" href="index.php"><i
                                    class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
                    </div>
                </nav>
            </div>

        </div>
        <div class="two">
            <nav>
                <h3>SELLERS</h3>
            </nav>
            <div class="usercontainer">
                <table class="table">
                    <thead>
                        <tr>
                            <th>seller</th>
                            <th>fullname</th>
                            <th>email</th>
                            <th>password</th>
                            <th>adresse</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $value= $_POST['table'];
                        if($value=='all'){
                            $sql="SELECT u.image,u.nom,u.prenom,u.email,u.password,u.adresse,u.id from users u where role='v'";
                        }else if ($value=='paid'){
                            $sql="SELECT u.* from users u,produit where produit.codev=u.id GROUP by u.id";
                        }else if($value=='npaid'){
                            $sql="SELECT u.* from users u,produit where u.id not in (SELECT DISTINCT codev from produit) and role='v' GROUP BY u.id";
                        }else  if (is_numeric($value)){
                            if ($value < 10) {
                                $value = "0$value";
                            }
                            $sql = "SELECT * FROM users u where role='v' and  date(date) between '2023-$value-01' and '2023-$value-31'";
                        }else if(substr($value,0,6)=='pmonth' ){
                            $value = substr($value, 6, 8);
                            $sql = "SELECT u.* from commande c,produit p,users u where c.codepr=p.code and u.id=p.codev and date(c.date) between '2023-$value-01' and '2023-$value-31'";
                        }else if(substr($value, 0, 7) == 'npmonth'){
                            $value = substr($value, 7);
                            $sql="SELECT u.* from users u where role='v' and id not in (SELECT DISTINCT codev from commande c,produit p where c.codepr=p.code AND date(c.date) BETWEEN '2023/$value/01' and '2023/$value/31' )  and role='v'";
                        }
                        else if(substr($value, 0, 4) == 'pday'){
                            $value = substr($value, 4);
                            $sql="SELECT u.* from commande c,produit p,users u where c.codepr=p.code and p.codev=u.id and date(c.date) like '$value'";
                        }else if(substr($value, 0, 5) == 'npday'){
                            $value = substr($value, 5);
                            $sql = "SELECT u.* from users u where role='v' and id not in (SELECT DISTINCT codev from commande c,produit p where c.codepr=p.code AND date(c.date) like '$value' )  and role='v'";
                        }
                        else{
                            $sql="SELECT * FROM users where date(date) like '$value' and role='v'";
                        }
                        $table = $pdo->query($sql);
                        while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                
                            $id = $row['id'];
                            $nom = $row['nom'];
                            $prenom = $row['prenom'];
                            $email = $row['email'];
                            $pass = $row['password'];
                        
                            $imageData = $row['image'];
                            $adresse=$row['adresse'];
                            echo "<tr>
                            <td>
                                <div class='user-info__img'>
                                <img class='person' src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''>
                                </div>
                            </td>
                            <td>$nom $prenom</td>
                            <td>$email</td>
                            <td>$pass</td>
                            <td>$adresse</td>
                            <td>
                                <form action='sellerprofile.php' method='post'>
                                    <button value='' class='btn btn-primary btn-sm' name='id'>seller</button>
                                </form>
                            </td>
                        </tr>";

                        }

                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
</div>
</div>
</body>
</html>