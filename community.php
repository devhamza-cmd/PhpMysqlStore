<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src='all.js'></script>
    
    <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <?php session_start();
    require('config.php') ?>
    <title>Document</title>
</head>

<body>


    <nav class='nbar'></nav>
    
    <div class="d-flex justify-content-between">

    <nav class='sticky-top first '>
      <div>
        <div class=" p-5 nitem"><a class="nav-link"><i class="fa-solid fa-shop pe-2"></i>STORE</a></div>
        <div class="nitem"><a class="nav-link" href="home.php"><i class="fa-solid fa-house pe-2"></i>Home

        </div>

        <div class="nitem"><a class="nav-link" href="panier.php"><i
              class="fa-solid fa-cart-shopping pe-2"></i>panier</a></div>
        <div class="nitem"><a class="nav-link" href="commande.php"><i
              class="fa-solid fa-truck-fast pe-2"></i></i>commande</a></div>
              <div class=" nitem"><a class="nav-link" href="stores.php"><i
              class="fa-sharp  fa-store pe-2"></i></i>stores</a></div>
        <div class="h nitem"><a class="nav-link" href="community.php"><i
              class="fa-sharp  fa-retweet pe-2"></i></i>community</a></div>
        <div class="nitem"><a class="nav-link" href="index.php"><i
              class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
      </div>
    </nav>
        <?php
       
        $user=$_SESSION['user'];
        $sql="select count(*) from notification where codeu=$user and type_ntf in(2,4,5)";
        $table = $pdo->query($sql);
        $defult=0;
        while ($row = $table->fetch(PDO::FETCH_BOTH)) {
            $defult=$row['count(*)'];
        }
        ?>
        
         <style>.ntf,.newntfnbr{
            display: none;
        }</style> 
       
        <div class='ntf'><?php echo $defult;?></div>
        <div class="newntfnbr"><?php echo $defult;?></div>
        <?php
        $sql="select count(*) from post where statu='accept'";
        $table = $pdo->query($sql);
        $postnbr=0;
        while ($row = $table->fetch(PDO::FETCH_BOTH)) {
            $postnbr=$row['count(*)'];
        }
        $_SESSION['postnbr']=$postnbr;
        ?>
        <style>.pnbr{
            display: none;
        }</style>
        <div class='pnbr'><?php echo $postnbr;
        ?>
        

    </div><style>.newpost{
            display: none;
        }</style><div class="newpost"><?php echo $postnbr?></div>
        <div class='two'>
            <div class="d-flex  justify-content-around p-5">
                <a class='navigation home' href="community.php"><i class="s icon3 fa-solid fa-house"></i></a>
                <a class='navigation notification ' href="notification.php"><i class="icon3 fa-solid fa-bell"></i></a>

                
              
                <a class="navigation " href="messages.php"><i class="icon3 fa-solid fa-message"></i></a> 

            </div>
            <style>
                #overlay {
                    position: fixed;
                    top: 0;
                    left: 0%;
                    width: 100vw;
                    height: 100%;
                    z-index: 99999;
                    background-color: rgba(0, 0, 0, 0.5);
                    background-size: cover;
                    background-position: center;
                    display: none;
                    align-items: center;
                    justify-content: center;
                }

                #form-container {
                    margin-left: 200px;
                    background-color: white;
                    width: 500px;

                }
            </style>
            <style>
                .loader {
                    width: 48px;
                    height: 48px;
                    border: 5px solid #257DF8;
                    border-bottom-color: transparent;
                    border-radius: 50%;
                    display: inline-block;
                    box-sizing: border-box;

                    animation: rotation 1s linear infinite;
                }

                #form-container2 {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    width: 80vw;

                }

                #overlay2 {
                    position: fixed;
                    top: 0;
                    display: none;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    background-size: cover;
                    background-position: center;

                    align-items: center;
                    justify-content: center;
                }

                @keyframes rotation {
                    0% {
                        transform: rotate(0deg);
                    }

                    100% {
                        transform: rotate(360deg);
                    }

                }
            </style>
            <div class="zip">

            </div>

            <div id="overlay2" class='overlay2'>

                <div id="form-container2">

                    <span class="loader"></span>
                </div>

            </div>
            <style>
                .loader {
                    width: 48px;
                    height: 48px;
                    border: 5px solid #257DF8;
                    border-bottom-color: transparent;
                    border-radius: 50%;
                    display: inline-block;
                    box-sizing: border-box;

                    animation: rotation 1s linear infinite;
                }

                #form-container4 {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    width: 80vw;

                }

                #overlay4 {
                    position: fixed;
                    top: 0;
                    display: none;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    background-size: cover;
                    background-position: center;

                    align-items: center;
                    justify-content: center;
                }

                @keyframes rotation {
                    0% {
                        transform: rotate(0deg);
                    }

                    100% {
                        transform: rotate(360deg);
                    }

                }
            </style>
                <div class='nwcmnt'></div>

            <div id="overlay4" class='overlay4'>

                <div id="form-container4">

                    <span class="loader"></span>
                </div>

            </div>
            
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
                    width: 500px;
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

                .cmnts {

                    height: 100%;
                    width: 100%;
                    padding: 10px;
                    overflow-y: auto;
                }

                table {
                    margin-bottom: 20px;
                    width: 100%;
                }

                .cmntaction {
                    background-color: green;

                    width: 100%;
                }

                @keyframes rotation {
                    0% {
                        transform: rotate(0deg);
                    }

                    100% {
                        transform: rotate(360deg);
                    }

                }
            </style>
            <div id="overlay3" class='overlay3'>

                <div id="form-container3">
                    <div class='cmnts'>

                    </div>

                    <button class='close more'><i class='fa-solid fa-arrow-left'></i></button>
                </div>

            </div>
            <style>
                /* .nnn{
                    display: none;
                } */
            </style>
            <div class='nnn'></div>
            <!-- <script>document.body.style.overflow = 'hidden';</script> -->
            <div class='cf'>
                <div class="formpost  ">
                    <img src="https://assets-fr.imgfoot.com/media/cache/1200x1200/lionel-messi-2223-4.jpg" alt="">
                    <button class='publish'>add a post</button>

                </div>

                <div class="test2">

                </div>
                <div id="overlay">
                    <div id="form-container">



                        <div class='pcontent'>

                            <input type="text" placeholder="write your p.publishost here limited 60 caractere" name=""
                                id="posttext" maxlength="60">
                        </div>
                        <br>

                        <input type="file" accept="image/*" name="uploadfile" id="img" style="display:none;" />
                        <label for="img" id='imgin'><i class="fa-solid fa-image"></i></label>

                        <div class='cp'>
                            <button id="close-btn">Close</button>
                            <button class='posti'>Post</button>
                        </div>
                    </div>
                    <script>
                        const imageFileInput = document.getElementById('img');
                        const imageContainer = document.getElementById('imgin');
                        imageFileInput.addEventListener('change', function (event) {
                            const file = event.target.files[0];
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                const imageData = e.target.result;
                                imageContainer.style.backgroundImage = `url('${imageData}')`;
                            };
                            reader.readAsDataURL(file);
                        });
                    </script>

                </div>
            </div>
            <style>
                .post {
                    border: 1px solid #dbdbdb;
                    border-radius: 3px;
                    margin: 10px auto;
                    max-width: 600px;
                }

                .post-header {
                    display: flex;
                    align-items: center;
                    padding: 10px;
                }

                .profile-picture {
                    width: 30px;
                    height: 30px;
                    border-radius: 50%;
                    margin-right: 10px;
                }

                .username {
                    font-weight: bold;
                    margin-right: 10px;
                }

                .follow-button {
                    flex-grow: 1;
                    margin-left: auto;
                    padding: 5px 10px;
                    background-color: #3897f0;
                    color: white;
                    border: none;
                    border-radius: 3px;
                }

                .post-image {
                    width: 100%;
                }

                .post-actions {
                    display: flex;
                    justify-content: space-between;
                    padding: 10px;
                }

                .like-button,
                .comment-button,
                .share-button,
                .save-button {
                    background: none;
                    border: none;
                    padding: 0;
                    cursor: pointer;
                    outline: none;
                }

                [statu='no'] {
                    font-size: 30px;
                    color: #257DF8;
                    width: 24px;
                    height: 24px;
                    transition: 0.2s;
                }

                [statu='no']:hover {
                    color: red;
                }

                [statu='yes'] {
                    font-size: 30px;
                    color: red;
                    width: 24px;
                    height: 24px;
                    transition: 0.2s;

                }

                [statu='yes']:hover {
                    color: #257DF8;
                }

                .comment-button {
                    background-image: url('comment_icon.png');
                    background-size: contain;
                    background-repeat: no-repeat;
                    width: 24px;
                    height: 24px;
                }

                .share-button {
                    background-image: url('share_icon.png');
                    background-size: contain;
                    background-repeat: no-repeat;
                    width: 24px;
                    height: 24px;
                }

                .save-button {
                    background-image: url('save_icon.png');
                    background-size: contain;
                    background-repeat: no-repeat;
                    width: 24px;
                    height: 24px;
                }

                .likes {
                    display: flex;
                    align-items: center;
                    padding: 10px;
                }

                .likes img {
                    width: 16px;
                    height: 16px;
                    margin-right: 5px;
                }

                .caption {
                    padding: 10px;
                }

                .caption .username {
                    font-weight: bold;
                    margin-right: 5px;
                }

                .comments {
                    padding: 10px;
                }

                .comment {
                    margin-bottom: 5px;
                }

                .comment-username {
                    font-weight: bold;
                    margin-right: 5px;
                }

                .view-all-comments {
                    color: #999;
                    display: block;
                    margin-top: 5px;
                }

                .post-time {
                    color: #999;
                    font-size: 12px;
                    padding: 10px;
                }

                .add-comment {
                    display: flex;
                    align-items: center;
                    padding: 10px;
                }

                .comment-input {
                    flex-grow: 1;
                    padding: 5px;
                    margin-right: 5px;
                    border: 1px solid #dbdbdb;
                    border-radius: 3px;
                }

                .post-comment {
                    padding: 5px 10px;
                    background-color: #3897f0;
                    color: white;
                    border: none;
                    border-radius: 3px;
                    cursor: pointer;
                }
            </style>
            <style>
                /* Style for the comments overlay */
                .comments-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 9999;
                }

                /* Style for the comments container */
                .comments-container {
                    width: 80%;
                    max-width: 800px;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                }

                /* Style for the close button */
                .close-button {
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    cursor: pointer;
                    font-weight: bold;
                    font-size: 18px;
                    color: #999;
                }

                [statu='yes'] {
                    color: red;
                }

                [statu='yes']
            </style>
            <div class="test">
           
            
                <?php
                $user = $_SESSION['user'];
                $sql = "SELECT p.codep ,u.image as 'pf' ,u.id,u.nom ,u.prenom,p.image,p.date,p.text FROM post p, users u where p.codeu=u.id and p.statu='accept' ORDER BY p.date DESC";
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
                    $id=$row['id'];
                    $sqla = "SELECT COUNT(*) from likes where codep=$codep";
                    $tablea = $pdo->query($sqla);
                    while ($rowa = $tablea->fetch(PDO::FETCH_BOTH)) {
                        $likes = $rowa['COUNT(*)'];
                    }
                    echo " <div class='post' codep=$codep user=$id>
                    <style>
                    .likenbr,.newlikenbr{
                        display:none;
                    }
                    </style>
                    <div class='likenbr'>
                    $likes
</div>
<div class='newlikenbr' custom=$codep>
$likes
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
            <input type='text' placeholder='Add a comment...' class=' comment-input' id='$codep'>
            <button class='post-comment' value='$codep'>Post</button>
        </div>
    </div>";

                }
                ?>


            </div>

        </div>
    </div>



    <script></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>

</html>