<?php
require('config.php');
$chose=substr($_POST['chose'],0,1);
$id=substr($_POST['chose'],1);
if ($chose ==1){
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
                };
                echo "<style>
                table{
                    width: 48vw;
                }
                tr {
                    height: 60px;
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
                <img class='img' src='data:image/jpeg;base64," . base64_encode($image) . "' alt=''>
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
                     </tbody>
                 </table>
                </div>";
} if($chose==2){
    echo "<style>
    table{
        width: 70vw;
        overflow-y: scroll;
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

<div class='table-container'>
<table>
<tr>
  <th>adresse</th>
  <th>ville</th>
  <th>region</th>
</tr>


";
$sql="SELECT adresse,v.nom,r.nom as'rg' from adresse a,ville v,region r  where user=$id and a.code_ville=v.code and r.code=v.coderg";
                $table = $pdo->query($sql);
                while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                    $adresse=$row['adresse'];
                    $ville=$row['nom'];
                    $region=$row['rg'];
                    echo"<tr>
                    <td>$adresse</td>
                    <td>$ville</td>
                    <td>$region</td>
                    </tr>";
                }
echo "</table></div>";
} if($chose==3){
    
$sql="SELECT DISTINCT codepr,pr.nom,pr.prix,COUNT(codepr),((COUNT(codepr))*(pr.prix)),s.nom as 'snom',s.codestore from panier ,produit pr,venduer v,store s WHERE codeuser=$id  and codepr=pr.code and pr.codev=v.code and v.code=s.codev  GROUP BY panier.codepr";

$table = $pdo->query($sql);
echo "<style>
table{
    width: 73vw;
    overflow-y: scroll;
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

<div class='table-container'>
<table>
<tr>
<th>Produit</th>
<th>Prix</th>
<th>quantite</th>
<th>total</th>
<th>store</th>
</tr>


";
                while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                 $codepr=$row['codepr'];
                 $nom=$row['nom'];
                 $prix=$row['prix'];
                 $q=$row['COUNT(codepr)'];
                 $total=$row['((COUNT(codepr))*(pr.prix))'];
                 $store=$row['snom'];
                 $codes=$row['codestore'];
             
                 echo "<tr>
<td> <form action='adminproduit.php' method='post'>
<button name='code' class='m-2 btn btn-primary btn-sm' value='$codepr'>$nom</button>
</form></td>
<td>$$prix</td>
<td>$q</td>
<td>$total</td>
<td><form action='adminstore.php' method='post'>
<button name='code' class='m-2 btn btn-primary btn-sm' value='$codes'>$store</button></td>
</tr>

";
                }
                echo "</tbody>
                </table>";
} if ($chose==4){
    $sql="SELECT c.codepr,p.nom,p.prix,c.quantite,c.total,c.date,s.nom as 'store',s.codestore FROM commande c,produit p,venduer v,store s WHERE c.codeu=$id and c.codepr=p.code and p.codev=v.code and s.codev=v.code";
    $table = $pdo->query($sql);
echo "<style>
table{
    width: 70vw;
    max-height: 100px;
    overflow-y: scroll;
    
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

<div class='table-container'>
<table>
<tr>
<th>Produit</th>
<th>Prix</th>
<th>quantite</th>
<th>total</th>
<th>date</th>
<th>store</th>
</tr>
";
while ($row = $table->fetch(PDO::FETCH_BOTH)) {
    $codepr=$row['codepr'];
    $nom=$row['nom'];
    $prix=$row['prix'];
    $quantite=$row['quantite'];
    $total=$row['total'];
    $date=$row['date'];
    $store=$row['store'];
    $codestore=$row['codestore'];   
    echo "<tr>
<td> <form action='adminproduit.php' method='post'>
<button type='submit' name='code' class='m-2 btn btn-primary btn-sm' value='$codepr'>$nom</button>
</form></td>
<td>$$prix</td>
<td>$quantite</td>
<td>$$total</td>
<td>$date</td>
<td><form action='adminstore.php' method='post'>
<button name='code' class='m-2 btn btn-primary btn-sm' value='$codestore'>$store</button></td>
</tr>

";
}}if ($chose==5){
    $sql="SELECT v.produit,p.nom,COUNT(v.produit),max(v.date) FROM visitproduit v,produit p WHERE v.produit=p.code and user=$id  GROUP by v.produit order by COUNT(v.produit) desc ";
    $table = $pdo->query($sql);
echo "<style>
table{
    width: 70vw;
    max-height: 100px;
    overflow-y: scroll;
    
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

<div class='table-container'>
<table>
<tr>
<th>Produit</th>
<th>times</th>
<th>Last viste</th>

</tr>
";
while ($row = $table->fetch(PDO::FETCH_BOTH)) {
    $codepr=$row['produit'];
    $nom=$row['nom'];
    $date=$row['max(v.date)'];
    $times=$row['COUNT(v.produit)'];
    echo "<tr>
    <td> <form action='adminproduit.php' method='post'>
    <button type='submit' name='code' class='m-2 btn btn-primary btn-sm' value='$codepr'>$nom</button>
    </form></td>
    <td>$times</td>
    <td>$date</td>
    </tr>
    
    ";
}
}if ($chose==6){
    $sql="SELECT v.store,s.nom,COUNT(v.store),max(v.date) from visitstore v,store s where s.codestore=v.store and user=$id GROUP BY store ORDER BY `COUNT(v.store)` DESC
    ";
    $table = $pdo->query($sql);
    echo "<style>
    table{
        width: 70vw;
        max-height: 100px;
        overflow-y: scroll;
        
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
    
    <div class='table-container'>
    <table>
    <tr>
    <th>store</th>
    <th>times</th>
    <th>Last viste</th>
    
    </tr>
    ";
    while ($row = $table->fetch(PDO::FETCH_BOTH)) {
        $codes=$row['store'];
        $nom=$row['nom'];
        $date=$row['max(v.date)'];
        $times=$row['COUNT(v.store)'];
        echo "<tr>
        <td> <form action='adminstore.php' method='post'>
        <button type='submit' name='code' class='m-2 btn btn-primary btn-sm' value='$codes'>$nom</button>
        </form></td>
        <td>$times</td>
        <td>$date</td>
        </tr>
        
        ";
    }
}
?>
