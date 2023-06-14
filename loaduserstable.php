<?php
require('config.php');
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$adresse= $_POST['adresse'];

$sql="select * from users where nom like '%$nom%' and prenom like '%$prenom%' and email like '%$email%' and  adresse like '%$adresse%'  and role='u'";
$table = $pdo->query($sql);
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

    }}
    echo "</tbody>
    </table>";
?>