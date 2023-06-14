<?php
require('config.php');
$codemr=$_POST['codemr'];
if ($codemr=='all'){
  
        $sql = "select * from produit";
        $table = $pdo->query($sql);
        echo "</form>";
        while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
          $code = $row['code'];
          $prix = $row['prix'];
          $nom = $row['nom'];
          $title = $row['title'];
          echo "<form action='produit.php' class='animate__animated animate__flipInX m-2' method='post'>
            <div class='card' style='width: 15rem; height: 320px; display: flex; flex-direction: column; justify-content: space-between;'>
  <img src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cHJvZHVjdHN8ZW58MHx8MHx8fDA%3D&amp;w=1000&amp;q=80' class='card-img-top' alt='...'>
  <div class='card-body'>
    <h5 class='card-title'>$nom</h5>
    <p class='card-text'>$ $prix</p>
  </div>
  <button type='submit' name='ajt' class='more' value='$code' control-id='ControlID-10'>more detail</button>
</div>


    
</form>";
        }
     
}else{

    
    $sql = "select * from produit where codemr=$codemr";
    $table = $pdo->query($sql);
    echo "</form>";
    while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
      $code = $row['code'];
      $prix = $row['prix'];
      $nom = $row['nom'];
      $title = $row['title'];
      echo "<form action='produit.php' class='animate__animated animate__flipInX m-2' method='post'>
        <div class='card' style='width: 15rem; height: 320px; display: flex; flex-direction: column; justify-content: space-between;'>
<img src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cHJvZHVjdHN8ZW58MHx8MHx8fDA%3D&amp;w=1000&amp;q=80' class='card-img-top' alt='...'>
<div class='card-body'>
<h5 class='card-title'>$nom</h5>
<p class='card-text'>$ $prix</p>
</div>
<button type='submit' name='ajt' class='more' value='$code' control-id='ControlID-10'>more detail</button>
</div>



</form>";}
}
?>