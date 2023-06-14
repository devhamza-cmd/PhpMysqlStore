<?php
require('config.php');
session_start();
$codepr=$_POST['codepr'];
$user=$_SESSION['user'];
$sql="delete from panier where codepr=$codepr and codeuser=$user";
$r=$pdo->prepare($sql);

$r->execute();
?>
  <?php
                    
                    $user = $_SESSION['user'];
                    $sql = "SELECT codeuser,codepr,count(codepr) from panier where codeuser='$user' GROUP BY codepr";
                    $table = $pdo->query($sql);
                    $total = 0;
                    while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
                        $codep = $row['codepr'];
                        $sql2 = "select * from produit where code='$codep' ";
                        $table2 = $pdo->query($sql2);
                        while ($row2 = $table2->fetch(PDO::FETCH_ASSOC)) {
                            $pnom = $row2['nom'];
                            $title = $row2['title'];
                            $prix = $row2['prix'];
                            $codepr = $row['codepr'];
                            $count = $row['count(codepr)'];
                            $tp = $prix * $count;
                            $total += $tp;
                            $tt = "$$prix*$count=$$tp";
                            echo "<div class='pr mb-3 me-5 '>
            <img src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cHJvZHVjdHN8ZW58MHx8MHx8fDA%3D&w=1000&q=80' ></img>
    <p>$pnom</p>
    <p>$tt</p>
    <form action='produit.php' method='post'><button type='submit' name='ajt' class='more'  value='$codepr'> more detail</button><br><br></form>
    ";
                            echo "

";
                            $sql4 = "SELECT pr.code,pr.qtr,count(pn.codep),(pr.qtr -count(pn.codep) )
        c from produit pr,panier pn where pr.code=pn.codepr and pn.codepr=$codepr  GROUP BY pr.code";
                            $table4 = $pdo->query($sql4);
                            $sql3 = "select count(codep) from panier where codepr=$codepr";
                            $table3 = $pdo->query($sql3);
                            $isempty = 0;
                            while ($row3 = $table3->fetch(PDO::FETCH_ASSOC)) {
                                $isempty = $row3['count(codep)'];

                            }
                        }
                        $statu = -1;
                        if ($isempty != 0) {
                            while ($row4 = $table4->fetch(PDO::FETCH_ASSOC)) {
                                if ($row4['c'] > 0) {
                                    $statu = 0;

                                }
                            }
                        } else {
                            $statu = 0;
                        }
                        if ($statu == -1) {
                            echo "<button statu='able' type='submit' name='m' value='$codepr'  class='m'><i class='fa-solid fa-minus'></i></button>
         <label class='items'  name='label' value='$codepr' for='$prix'>$count</label>
         <button type='submit' name='p' disabled value='$codepr'  class='p'><i class='fa-solid fa-plus'></i></button>
         </label>
         <br>
         <br>
         <button type='submit' name='sup' value='$codepr'  class=' btn btn-primary'>supprimer</button>
    ";
                        } else {
                            echo "<button statu='able' class='m'type='submit' name='m' value='$codepr'><i class='fa-solid fa-minus'></i></button>
         <label class='items'  name='label' value='$codepr' for='$prix'>$count</label>
         <button class='p' type='submit'statu='able' name='p' value='$codepr'><i class='fa-solid fa-plus'></i></button>
         </label>
         <br>
          <br>
         <button type='submit' name='sup' value='$codepr' class='more me-3'>supprimer</button>
    ";
                        }
                        // here
                        echo "</div>
        
        </div>";
                    }
                    echo "<p class='price'>TOTAL :$$total</p>";

                    ?>
                    <?php
                    if (!empty($_POST['com'])) {

                        $codem = 1;
                        if (file_exists('codecom.txt')) {
                            $codem = unserialize(file_get_contents('codecom.txt'));
                        } else {
                            file_put_contents('codecom.txt', serialize($codem));
                        }
                        $user = $_SESSION['user'];
                        $codead = $_POST['adresse'];
                        $sql = "
SELECT p.codepr,COUNT(p.codep) as 'quantite',(SELECT pr.prix from produit pr where pr.code=p.codepr GROUP BY pr.prix ),((SELECT pr.prix from produit pr where pr.code=p.codepr GROUP BY pr.prix )*COUNT(p.codep) ) as 'total' from panier p WHERE p.codeuser=$user GROUP BY p.codepr";
                        $table = $pdo->query($sql);
                        while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                            $codepr = $row['codepr'];
                            $quantite = $row['quantite'];
                            $date = date('Y-m-d H:i:s');
                            $total = $row['total'];
                            $sql = "insert into commande values('$codem',$codepr,$user,$codead,$quantite,$total,'$date')";
                            $requete = $pdo->prepare($sql);
                            $requete->execute();
                            $codem++;
                            file_put_contents('codecom.txt', serialize($codem));
                            $sqldelete = "delete from panier where codeuser=$user";
                            $requete2 = $pdo->prepare($sqldelete);
                            $requete2->execute();
                            $sqlupdate = "update produit set qtr=qtr-$quantite , qtv=$quantite where code=$codepr";
                            $requete3 = $pdo->prepare($sqlupdate);
                            $requete3->execute();
                            
                        }
                    }
                    ?>
                    <form action="#" method="post">
                        <?php
                        $user = $_SESSION['user'];
                        $sql = "SELECT a.code ,r.nom,v.nom,a.adresse from region r,ville v,adresse a where r.code=v.coderg and a.code_ville=v.code and user='$user'";
                        $table = $pdo->query($sql);
                        while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                            $codead = $row[0];
                            $adresse = $row[3];
                            $ville = $row[2];
                            $region = $row[1];
                            echo "
        <input class='ms-2' type='radio' value='$codead' name='adresse' required>
        <label for='adresse' ><p><i class='fa-solid fa-location-dot'></i> $adresse | $ville | $region</p></label>";
                            $row[0];
                            echo "<br>";
                        }
                        ?>
                        <input class='ms-2 btn btn-primary' type="submit" class='btn btn-primary' name='com'
                            value='confirmer'>

                    </form>
                    <script src="plusmoins.js"></script>