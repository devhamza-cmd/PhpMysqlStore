<?php
require("config.php");
$codep=$_POST['codep'];
$sql="SELECT u.image,u.nom,u.prenom,c.comnt,c.date from users u ,comment c where u.id=c.codeu and c.codep=$codep order by c.date desc;
";
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_BOTH)) {
    $img=$row['image'];
    $fullname=$row['nom']." ".$row['prenom']; 
    $txt=$row['comnt'];
    $date=$row['date'];
    echo "
    <table>
        <tr>
            <td><img class='profile-picture' src='data:image/jpeg;base64," . base64_encode($img) . "' alt=''>$fullname</td>
            

        </tr>
        <tr class='txt'><td>$txt</td></tr>
    </table>
    
    
";
}

?>
<style>
                .loader3 {
                    width: 48px;
                    height: 48px;
                    border: 5px solid #257DF8;
                    border-bottom-color: transparent;
                    border-radius: 50%;
                    display: inline-block;
                    box-sizing: border-box;

                    animation: rotation 1s linear infinite;
                }

                #form-container3 {
                    
                    
                    height: 500px;
                    width:500px;
                    background-color: white;
                    position: fixed;
                    left: 40%;
                    top: 10%;

                }

                #overlay3 {
                    position: fixed;
                    top: 0;
                    display: none;
                    z-index: 1;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    background-size: cover;
                    background-position: center;

                   
                }
                .cmnts{
                  
                    height: 100%;
                    width:100%;
                    padding: 10px;
                    overflow-y: auto;
                }
                table{
                    margin-bottom: 20px;
                    width: 60%;
                }
                .cmntaction{
                    background-color: green;
                    
                    width:100%;
                }
                
                @keyframes rotation {
                    0% {
                        transform: rotate(0deg);
                    }

                    100% {
                        transform: rotate(360deg);
                    }

                }</style>