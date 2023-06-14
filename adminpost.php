<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="all.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script><script src='tt.js'></script>
    <script src='all.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <?php session_start();
    require('config.php') ?>
    <title>Document</title>
</head>

<body style="background-color:#d1d1d1 ;">
    <div class="d-flex">
    <style>.pnbr{
            display: none;
        }</style>
        <div class="pnbr">
<?php 
 $sql="select count(*) from post where statu='pending'";
 $table = $pdo->query($sql);
 $postnbr=0;
 while ($row = $table->fetch(PDO::FETCH_BOTH)) {
     $postnbr=$row['count(*)'];
 }
 echo $postnbr;
?>
        </div>
        <style>.newpnbr{
            display: none;
        }</style>
        <div class="newpnbr">
<?php echo $postnbr;?>
        </div>
        <div class="sticky-top one">
        <?php
        $sql="select count(*) from post where statu='pending'";
        $table = $pdo->query($sql);
        $postnbr=0;
        while ($row = $table->fetch(PDO::FETCH_BOTH)) {
            $postnbr=$row['count(*)'];
        }
        $_SESSION['postnbradmin']=$postnbr;
        ?>
        <style>.pnbradmin{
            display: none;
        }</style>
        <div class='pnbradmin'><?php echo $postnbr;?></div>
       
            <h3 class='ps-5 pt-5 mb-5'>ADMIN PANEL</h3>
            <div class="d-flex justify-content-center">
                <nav class='sticky-top first '>
                    <div>
                        <div class="  nitem"><a class="nav-link" href="admin.php"><i
                                    class="fa-brands fa-windows pe-2"></i>DASHBOARD</a></div>
                        <div class="nitem"><a class="nav-link" href="users.php"><i
                                    class="fa-solid fa-users pe-2"></i>USERS

                        </div>
                        <div class="nitem"><a class="nav-link" href="sellers.php"><i
                                    class="fa-solid fa-users-between-lines pe-2"></i></i>SELLERS</a></div>
                        <div class="h p-5 nitem"><a class="nav-link" href="adminpost.php"><i
                                    class="fa-solid fa-check-to-slot pe-2"></i>POST</a></div>
                        <div class="nitem"><a class="nav-link" href="index.php"><i
                                    class="fa-solid fa-right-to-bracket pe-2"></i>EXIT</a></div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="two">
            <nav>
                <h3>POST</h3>
            </nav>
            <div>
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
                  
                    height: 650PX;
                    width:500PX;
                    position: fixed;
                    left: 39%;
                    top: 2%;
                    
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
                
                .intraction {
                   display: flex;
                }
                #cancel{
                    margin-left: 1000px;
                    margin-top: 20px;
                    background-color: #599dfd;
                    color: white;
                    padding: 12px;
                    border-radius: 20px;
                    border: none;
                }
                .text{
                    padding-top: 5px;
                }
                .ar{
                    background-color: rgb(37, 125, 248);
                    color:white;
                    width: 50%;
                    font-size: 20px;
                    text-transform: uppercase;
                    border:none;
                    height: 110px;
                    transition: 0.4s;
                }
                .ar:hover{
                    background-color:rgb(37, 125, 248,0.8) ;
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
                <div class="test"></div>
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
            <div class='nn'>
                <?php
                
                $sql="SELECT n.*,p.image,p.codep FROM notification n,post p WHERE n.codep=p.codep and p.statu ='pending'  ORDER BY n.date DESC";
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
                            <button class='npost more'value='a$codep'>view the post</button>
                            </td>
                        </tr>
                    </table>
                  
                </div>";

                }
                ?>
                
            
            </div>
            </div>
        </div>
    </div>
    <script>
        
    </script>
    <script src="https://kit.fontawesome.com/356b310998.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    
</body>

</html>