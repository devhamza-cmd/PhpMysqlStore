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
    <audio id='myAudio'>
        <source src='sound.mp3' type='audio/mpeg'>
        Your browser does not support the audio element.
    </audio>
    <nav class='nbar'></nav>
    <div class="d-flex justify-content-between">

        <nav class='sticky-top first '>
            <div>
                <div class=" p-5 nitem"><a class="nav-link"><i class="fa-solid fa-shop pe-2"></i>STORE X</a></div>
                <div class=" nitem"><a class="nav-link" href="home.php"><i class="fa-solid fa-house pe-2"></i>Home

                </div>

                <div class="nitem"><a class="nav-link" href="panier.php"><i
                            class="fa-solid fa-cart-shopping pe-2"></i>panier</a></div>
                <div class=" nitem"><a class="nav-link" href="commande.php"><i
                            class="fa-solid fa-truck-fast pe-2"></i></i>commande</a></div>
                <div class="h nitem"><a class="nav-link" href="community.php"><i
                            class="fa-sharp  fa-retweet pe-2"></i></i>community</a></div>
                <div class="nitem"><a class="nav-link" href="index.php"><i
                            class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
            </div>
        </nav>
        <div class='two'>
            <div class="d-flex  justify-content-around p-5">
            <a class='navigation home' href="community.php"><i class=" icon3 fa-solid fa-house"></i></a>
            <a class='navigation notification 'href="notification.php"><i class="s icon3 fa-solid fa-bell"></i></a>
                
       
                <a class="navigation " href="messages.php"><i class="icon3 fa-solid fa-message"></i></a> 
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
                  
                    height: 550PX;
                    width:500PX;
                    position: fixed;
                    left: 39%;
                    top: 10%;
                    
                    background-color: white;
                    

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
                .imgpost img{
                    height: 420px;
                    width: 100%;
                    margin-top: 15px;
                }
                .person2{
                    height: 50px;
                    width: 50PX;
                    margin: 10px 10px 0 10px;
                    border-radius: 50%;
                }
                
                .intraction svg {
                    font-size: 40px;
                   padding: 0 10px ;
                   cursor: pointer;
                }
                .intraction svg:hover{
                    color: #599dfd;
                   
                }
                #cancel{
                    margin-left: 1110px;
                    margin-top: 50px;
                    background-color: #599dfd;
                    color: white;
                    padding: 12px;
                    border-radius: 20px;
                    border: none;
                }
                .text{
                    padding-top: 5px;
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
                <div id="overlay2">
                    <button id='cancel'>
                    
                    <i class="fa-solid fa-left-long"></i>
                    </button>
                    <div id="form-container2">
                       <div class="title">
                       <img class='person2' src="https://upload.wikimedia.org/wikipedia/commons/b/b4/Lionel-Messi-Argentina-2022-FIFA-World-Cup_%28cropped%29.jpg" alt="">
                       da3bota bihnsis
                       </div>
                       <div class='text'>
                       The quick brown fox jumps over the lazy dog's back, yielding a zesty victory!
                       </div>
                       <div class="imgpost">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b4/Lionel-Messi-Argentina-2022-FIFA-World-Cup_%28cropped%29.jpg" alt="">
                       </div>
                       <!-- <div class='intraction'>
                       <i class="fa-solid fa-heart"></i>
                       <i class="fa-solid fa-comment"></i>
                       </div> -->
                    </div>
                    
                </div>
            </div>
            
            <div class='nn'>
                <?php
                $user=$_SESSION['user'];
                $sql="SELECT n.*,p.image,p.codep FROM notification n,post p WHERE n.codep=p.codep and p.codeu=$user ORDER BY n.date DESC";
                $table= $pdo->query($sql);
                while($row = $table->fetch(PDO::FETCH_BOTH)){
                    $text=$row['text'];
                    $date=$row['date'];
                    $codep=$row['codep'];
                    $pattern = '/#(\d+)/';
                    preg_match($pattern, $text, $matches);
                    $number = $matches[1];
                    $imageData = $row['image'];
                    echo "<div class='nchild'>
                    <table>
                        <tr>
                            <td><img  src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''></td>
                            <td>$text</td>
                            <td>$date</td>
                            <td>
                                <button class='npost more' value='$codep'>view the post</button>
                            </td>
                        </tr>
                    </table>
                  
                </div>";

                }
                ?>
                
            
            </div>
            
            <div class="test"></div>
        </div>
    </div>



    <script></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="tt.js"></script>
</body>

</html>