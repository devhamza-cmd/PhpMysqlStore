<?php
require('config.php');
$value=$_POST['code'];
$code=substr($value,1);
$chose=substr($value,0,1);
$coden=0;
$date=date('Y-m-d H:i:s');
$sql="SELECT codeu FROM post where codep=$code";

   $table = $pdo->query($sql);
   while ($row = $table->fetch(PDO::FETCH_BOTH)) {
    $codeu=$row['codeu'];
    }

if(file_exists('coden.txt')){
        $coden=unserialize(file_get_contents('coden.txt'));
    } else{
        file_put_contents('coden.txt',serialize($coden));
    }
if ($chose=='a'){
    
   $sql="update post set statu='accept',dateaction='$date' where codep=$code ";
   $r=$pdo->prepare($sql);
   $r->execute();
   $coden++;
 $sql="insert into notification values($coden,$codeu,$code,'your post #$code is accepted by the admin','$date',2)";
   $r=$pdo->prepare($sql);
   $r->execute();
   
   file_put_contents('coden.txt',serialize($coden));
}else {

  

}

?>
<?php
        $sql="select count(*) from post where statu='pending'";
        $table = $pdo->query($sql);
        $postnbr=0;
        while ($row = $table->fetch(PDO::FETCH_BOTH)) {
            $postnbr=$row['count(*)'];

        }
        echo "<script>$('.pnbr').text('$postnbr')</script>"
        ?>
<script>
$.ajax({
    url: 'loadeafultpostadmin.php',
    method: 'POST',
    success: function(response) {
        $('.nn').html(response);
    },
    error: function(xhr, status, error) {
        console.log('Error:', error);
    }
});
</script>
<script>
    setInterval(() => {
    if($(".newpnbr").text()>$(".pnbr").text()){
    console.log('sdfsd')
        $(".pnbr").text($(".newpnbr").text())
        $.ajax({
            url: "loadeafultpostadmin.php",
        method: "POST", 
        success: function(response) {
            
            $(".nn").html(response);
        },
        error: function(xhr, status, error) {
            
            console.log("Error:", error);
        }
        })  
    }
}, 500);
</script>