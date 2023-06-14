<?php
require("config.php");
session_start();
                $user = $_SESSION['user'];
                $sql = "SELECT p.codep ,u.image as 'pf' ,u.nom ,u.prenom,p.image,p.date,p.text FROM post p, users u where p.codeu=u.id and p.statu='accept' ORDER BY p.dateaction DESC";
                $table = $pdo->query($sql);
                while ($row = $table->fetch(PDO::FETCH_BOTH)) {
                    $count2 = 0;
                    $count2++;
                    $pfimage = $row['pf'];
                    $fullname = $row['nom'] . " " . $row['prenom'];
                    $psimage = $row['image'];
                    $date = $row['date'];
                    $text = $row['text'];
                    $codep = $row[0];
                    $sqla = "SELECT COUNT(*) from likes where codep=$codep";
                    $tablea = $pdo->query($sqla);
                    while ($rowa = $tablea->fetch(PDO::FETCH_BOTH)) {
                        $likes = $rowa['COUNT(*)'];
                    }
                    echo " <div class='post'>
                    <style>
                    .likenbr,.newlikenbr{
                        display:none;
                    }
                    </style>
                    <div class='likenbr'>
                    $likes
</div>
<div class='newlikenbr' custom=$codep>

</div>
        <div class='post-header'>
        <img class='profile-picture' src='data:image/jpeg;base64," . base64_encode($pfimage) . "' alt=''>
            <span class='username'>$fullname</span>
           
        </div>
        <img src='data:image/jpeg;base64," . base64_encode($psimage) . "' alt='Post Image' class='post-image'>
        
        <div class='post-actions'>";
                    $sql4 = "select COUNT(*) from likes where codeu=$user and codep=$codep";
                    $table4 = $pdo->query($sql4);
                    while ($row4 = $table4->fetch(PDO::FETCH_BOTH)) {
                        $statu = $row4['COUNT(*)'];
                    }

                    if ($statu != 0) {
                        echo "<button value='l$codep' class='like-button' statu='yes'><i class='fa-solid fa-heart'></i></button>
            <button class='comment-button'></button>
            <button class='share-button'></button>
            <button class='save-button'></button>
        </div>
        <div class='likes'>
            
            <span class='span$codep'>$likes likes</span>
        </div>
        <div class='caption'>
            <span class='username'>$fullname</span>
            <span class='caption-text'>$text.</span>
        </div><div class='comments'>
        
";
                    } else {
                        echo "<button  value='l$codep' class='like-button' statu='no'><i class='fa-solid fa-heart'></i></button>
            <button class='comment-button'></button>
            <button class='share-button'></button>
            <button class='save-button'></button>
        </div>
        <div class='likes'>
            
            <span class='span$codep'>$likes likes</span>
        </div>
        <div class='caption'>
            <span class='username'>$fullname</span>
            <span class='caption-text'>$text.</span>
        </div><div class='comments'>
        
";
                    }

                    $sql2 = "SELECT p.*,c.*,u.nom,u.prenom  FROM post p,comment c,users u where p.codep=c.codep and u.id=c.codeu and c.codep=$codep  limit 2";
                    $table2 = $pdo->query($sql2);
                    $table2 = $pdo->query($sql2);
                    $count = 0;

                    while ($row2 = $table2->fetch(PDO::FETCH_BOTH)) {
                        $cmnt2 = $row2['comnt'];
                        $fullname = $row2['nom'] . " " . $row2['prenom'];
                        $count++;

                        echo "<div class='comment'>
                    
                </div>";
                    }

                    echo " <button style='border:none' class='view-all-comments' value='$codep'>View all comments</button>        
</div>
    
        <div class='add-comment'>
        <script>
          $(document).ready(function () {
    $('.post-comment [value='$codep']').click(function(){
        
        var id=$(this).val();
        const input =$(`#\${id}`);
        $.ajax({
            url: 'cmntaction.php',
        method: 'POST', 
        data: {codep:id,cmnt:input.val()}, 
        success: function(response) {
          
            $('.test').html(response);
        },
        error: function(xhr, status, error) {
          
            console.log('Error:', error);
        }
        })
    })
})
    </script>
            <input type='text' placeholder='Add a comment...' class=' comment-input' id='$codep'>
            <button class='post-comment' value='$codep'>Post</button>
        </div>
    </div>";

                }
                ?>
