<script>
    document.querySelector("#overlay2").style.display='block';
    
</script>
<?php
require('config.php');
session_start();
$code=$_POST['code'];
$user=$_SESSION['user'];
$sql="SELECT u.image as 'pf' ,u.nom ,u.prenom,p.image,p.date,p.text FROM post p, users u where p.codeu=u.id  and p.codeu=$user and p.codep=$code";
if (substr($code,0,1)=='a'){
    $code=substr($code,1);
    $sql="SELECT u.image as 'pf' ,u.nom ,u.prenom,p.image,p.date,p.text FROM post p, users u where p.codeu=u.id and p.statu='pending' and p.codep=$code";
    $table= $pdo->query($sql);
while($row = $table->fetch(PDO::FETCH_BOTH)){
    $pfimage=$row['pf'];
    $fullname=$row['nom']." ".$row['prenom']; 
    $psimage=$row['image'];
    $date=$row['date'];
    $text=$row['text'];
    echo "<button id='cancel'>
                    
    <i class='fa-solid fa-left-long'></i>
    </button>
    <div id='form-container2'>
       <div class='title'>
       <img class='person2' src='data:image/jpeg;base64," . base64_encode($pfimage) . "' alt=''>
       $fullname
       </div>
       <div class='text'>
       $text
       </div>
       <div class='imgpost'>
       <img  src='data:image/jpeg;base64," . base64_encode($psimage) . "' alt=''>
       </div>
       $date
       <div class='intraction'>
       <button value='a$code' id='accept' class='ar' >accepte</button>
       <button id='refuse' value='r$code' class='ar'>refuse</button>
       </div> 
    </div><script>
    document.querySelector('#cancel').addEventListener('click',()=>{
        document.querySelector('#overlay2').style.display='none';
    })
</script><script>$(document).ready(function () {
    $('.ar').click(function(){
        
        var code=$(this).val();
        $.ajax({
        url: 'accref.php',
        method: 'POST', 
        data: {code:code}, 
        success: function(response) {
            $('.test').html(response);
            $('#cancel').click();
        },
        error: function(xhr, status, error) {
          
            console.log('Error:', error);
        }
        })
    })
  })</script>";
}
} else{
    $table= $pdo->query($sql);
    while($row = $table->fetch(PDO::FETCH_BOTH)){
        $pfimage=$row['pf'];
        $fullname=$row['nom']." ".$row['prenom']; 
        $psimage=$row['image'];
        $date=$row['date'];
        $text=$row['text'];
        echo "<button id='cancel'>
                        
        <i class='fa-solid fa-left-long'></i>
        </button>
        <div id='form-container2'>
           <div class='title'>
           <img class='person2' src='data:image/jpeg;base64," . base64_encode($pfimage) . "' alt=''>
           $fullname
           </div>
           <div class='text'>
           $text
           </div>
           <div class='imgpost'>
           <img  src='data:image/jpeg;base64," . base64_encode($psimage) . "' alt=''>
           </div>
           $date
           <!-- <div class='intraction'>
           <i class='fa-solid fa-heart'></i>
           <i class='fa-solid fa-comment'></i>
           </div> -->
        </div><script>
        document.querySelector('#cancel').addEventListener('click',()=>{
            document.querySelector('#overlay2').style.display='none';
        })
    </script>";
    }
}

?>