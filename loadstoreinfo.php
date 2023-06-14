<?php
require('config.php');
$chose=substr($_POST['chose'],0,1);
$scode=substr($_POST['chose'],1);
if($chose==1){
    $sql="SELECT s.nom,s.date as'd1',u.nom as 'vendeur',u.prenom,u.email,u.password,u.date from  store s,venduer v,users u where s.codev=v.code and u.id=v.code and s.codestore=$scode";
    $table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_BOTH)) {
    $nom=$row['nom'];
    $date1=$row['d1'];
    $vendeur=$row['vendeur']." ".$row['prenom'];
    $email=$row['email'];
    $pass=$row['password'];
    $d2=$row['date'];

}
$sql="SELECT sum(total) from commande c,produit p,store s,venduer v where c.codepr=p.code and p.codev=v.code and v.code=s.codev  and s.codestore=$scode";
    $table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_BOTH)) {
    $total=$row['sum(total)'];
    

}
    ?>
   <?php
   echo "<style>
   table{
       width: 70vw;
       
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
   <div>
   
    
    <table>
        <tbody>
            <tr>
                <td>Store name :</td>
                <td>$nom</td>
                
            </tr>
            <tr>
            <td>Date creation</td>
            <td>$date1</td>
            </tr>
            <tr>
                <td>Owner:</td>
                <td>$vendeur</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>$email</td>
            </tr>
            <tr>
                <td>password:</td>
                <td>$pass</td>
            </tr>
            
            <tr>
            
            <td>Date creation</td>
            <td>$d2</td>
            </tr>
            <tr>
            
            <td>total</td>
            <td>$$total</td>
            </tr>
        </tbody>
    </table>
   </div>";
}
if($chose==2){
$sql="SELECT  DISTINCT c.codeu,u.id,u.nom,u.prenom,u.email  FROM commande c,produit p,venduer v,store s,users u where c.codepr=p.code and p.codev=v.code and v.code=s.codev and u.id=c.codeu  and s.codestore=$scode";
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
<th>nom</th>
<th>prenom</th>
<th>email</th>
<th>action</th>
</tr>


";
    $table = $pdo->query($sql);
    while ($row = $table->fetch(PDO::FETCH_BOTH)) {
        $id=$row['id'];
        $nom=$row['nom'];
        $prenom=$row['prenom'];
        $email=$row['email'];
      echo "<tr>
<td>$nom</td>
<td>$prenom</td>
<td>$email</td>
<td><form action='userprofile.php' method='post'>
<button name='id'  class='m-2 btn btn-primary btn-sm' value='$id'>profile</button></form></td>
</tr>

";
    
    }echo "</tbody>
    </table>";
}
if($chose==3){
   $sql="SELECT  DISTINCT p.code,p.nom,p.prix ,p.qtv,p.qtr,((p.qtv)*(p.prix))  FROM produit p,venduer v,store s,users u where  p.codev=v.code and v.code=s.codev and  s.codestore=$scode
   ";
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
   <th>nom</th>
   <th>prix</th>
   <th>vendu</th>
   <th>reste</th>
   <th>balance</th>
   <th>action</th>
   </tr>
   
   
   ";
   $table = $pdo->query($sql);
    while ($row = $table->fetch(PDO::FETCH_BOTH)) {
        $code=$row['code'];
        $nom=$row['nom'];
        $prix=$row['prix'];
        $qtv=$row['qtv'];
        $qtr=$row['qtr'];
        $frac=$row['((p.qtv)*(p.prix))'];
        echo "<tr>
<td>$nom</td>
<td>$$prix</td>
<td>$qtv</td>
<td>$qtr</td>
<td>$$frac</td>
<td><form action='adminproduit.php' method='post'>
<button name='code'  class='m-2 btn btn-primary btn-sm' value='$code'>produit</button></form></td>
</tr>

";
    }
}
if($chose==4){
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
   <th>nom</th>
   <th>prix</th>
   <th>quantite</th>
   <th>prix</th>
   <th>total</th>
   <th>date</th>
   <th>action</th>
   <th>action</th>
   </tr>
   
   
   ";
   $sql="SELECT p.code,p.nom,p.prix,c.quantite,c.total,c.date,c.codeu from commande c,produit p,venduer v,store s where c.codepr=p.code and p.codev=v.code and v.code=s.codev and s.codestore=$scode";
   $table = $pdo->query($sql);
    while ($row = $table->fetch(PDO::FETCH_BOTH)) {
        $codepr=$row['code'];
        $codeu=$row['codeu'];
        $nom=$row['nom'];
        $prix=$row['prix'];
        $q=$row['quantite'];
        $total=$row['total'];
        $date=$row['date'];
        echo "<tr>
<td>$nom</td>
<td>$$prix</td>
<td>$q</td>
<td>$$prix</td>
<td>$$total</td>
<td>$date</td>
<td><form action='adminproduit.php' method='post'>
<button name='code'  class='m-2 btn btn-primary btn-sm' value='$codepr'>produit</button></form></td>
<td><form action='userprofile.php' method='post'>
<button name='id'  class='m-2 btn btn-primary btn-sm' value='$codeu'>profile</button></form></td>


</tr>

";
}

    }
?>