<?php
require('config.php');
session_start();
$img = $_POST['img'];
$text = $_POST['text'];
$img = str_replace('data:image/jpeg;base64,', '', $img);
$imageData = base64_decode($img);
$codeuser = $_SESSION['user'];
$codem = 1;

if (file_exists('codepost.txt')) {
    $codem = unserialize(file_get_contents('codepost.txt'));
} else {
    file_put_contents('codepost.txt', serialize($codem));
}
$date=date('Y-m-d H:i:s');
$sql = "INSERT INTO post VALUES (?, ?, ?, ?, 'pending',?,'')";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $codem);
$stmt->bindValue(2, $codeuser);
$stmt->bindValue(3, $text);
$stmt->bindValue(4, $imageData, PDO::PARAM_LOB);
$stmt->bindValue(5, $date);
$stmt->execute();


$coden = 2;

if (file_exists('coden.txt')) {
    $coden = unserialize(file_get_contents('coden.txt'));
} else {
    file_put_contents('coden.txt', serialize($coden));
}
$codem++;$coden++;
$sql="insert into notification values($coden,$codeuser,$codem,'your post #$codem are seding  are in review','$date',1)";
$r=$pdo->prepare($sql);
$r->execute();


file_put_contents('codepost.txt', serialize($codem));
file_put_contents('coden.txt', serialize($coden));
;
    
?>
<script>
document.querySelector(".ntfcont").innerHTML="your post are in review check ";
   document.querySelector(".ntfcont").style.cssText="display: flex; justify-content: center;align-items: center;"
    document.querySelector("#overlay2").style.display="block";
    setTimeout(() => {
        document.querySelector("#overlay2").style.display="none";
        document.querySelector(".ntfcont").style.display="none";
        document.querySelector(".ntfcont").innerHTML="";
    }, 4000);
    
    $.ajax({
            url: "loadposts.php",

        success: function(response) {
          
            $(".test").html(response);
        },
        error: function(xhr, status, error) {
          
            console.log("Error:", error);
        }
        })
</script>
