<?php
require("config.php");
session_start();
$user=$_SESSION['user']; 
$codes=$_POST['codes'];
$sql="delete from store where codestore=$codes";
$r=$pdo->prepare($sql);
$r->execute();
?>
<div class='zaba'></div>
                <div class="storechild">
                    <table>
                        <thead>
                            <td>logo</td>
                            <td>Name</td>
                            <td>N..Profit</td>
                            <td>Creation date</td>
                            <td>action</td>
                            
                        </thead>
                        <tbody>

                            <?php
                            $sql = "select * from store where codev=$user";
                            $table = $pdo->query($sql);
                            while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                                $codes = $row["codestore"];
                                $logo = $row['image'];
                                $nom = $row['nom'];
                                $date = $row["date"];
                                $sql2 = "SELECT sum(total) from commande c ,produit p where c.codepr=p.code and p.codev=$codes";
                                $table2 = $pdo->query($sql2);
                                $sum = 0;
                                while ($row2 = $table2->fetch(PDO::FETCH_BOTH)) {
                                    $sum = $row2["sum(total)"];
                                }
                                if (!$sum) {
                                    $sum = 0;
                                }
                                echo "
                             <tr>
                                <td><img class='person' src='data:image/jpeg;base64," . base64_encode($logo) . "' alt=''></td>
                                <td>$nom</td>
                                <td>$$sum</td>
                                <td>$date</td>
                                
                                <td><i delete='$codes' class='delete fa-solid fa-trash'></i></td>
                            </tr> ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <script>
                    $(document).ready(function () {
    const deleteBtn=$(".delete");
    deleteBtn.on('click',function () {
        var codes=$(this).attr('delete');
        var result = confirm("Do you want to proceed?");
        if (result) {
          $.ajax({
            type: "POST",
            url: "deletestore.php",
            data: {codes:codes},
            success: function (response) {
                $('.listofstores').html(response);
            }
          });
        } 
    });
});
                </script>