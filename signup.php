<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <?php require("config.php")?>
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 720px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding:0 10px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}
select{
    color:white;
    background-color: black;
    padding:10px;
        display: block;
    height: 50px;
    width: 100%;
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    s
    <form action="#" method='post'>
        <?php
        $statu=-1;
        session_start();
    $codeuser=21;
    if (file_exists("codeuser.txt")){
        $codeuser=unserialize(file_get_contents("codeuser.txt"));
    } else{
        file_put_contents("codeuser.txt",serialize($codeuser));
    }
    if(!empty($_POST['login'])){
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $email=$_POST['email'];
        $pass=$_POST['password'];
        $role= $_POST['role'];
        $date = date('Y-m-d H:i:s');
        try {
            $sql ="INSERT INTO users(`role`, `nom`, `prenom`, `id`, `email`, `password`, `image`,`date`) VALUES ('$role','$nom','$prenom',$codeuser,'$email','$pass','none','$date')";
            $r2 = $pdo->prepare($sql);
            $r=$pdo->prepare($sql);
            
            $r->execute();
            $_SESSION['user']=$codeuser;
            $codeuser++;
            file_put_contents("codeuser.txt",serialize($codeuser));
            $statu=0;
            header("location:home.php");
        } catch(PDOException $e){print_r($r2);
                echo $e;
                
            $statu=-1;
        }
          
         }
          
    
    ?>
        <h3>Sign Up</h3>
        <label for="email">Nom</label> 
        <input type="text" placeholder="nom" name="nom" required>
        <label for="email">Preom</label> 
        <input type="text" placeholder="prenom" name="prenom" required>
        <label for="emial">Email</label>
        <input type="email" placeholder="Email" name="email" required>
        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" required> 
        <select name="role" required>
            <option value="">choisir le type de compte</option>
            <option value="u">user</option>
            <option value="v">venduer</option>
        </select>
        <label for="password"><a href="index.php">Login In</a></label>
        <?php
         if (!empty($_POST['login'])){

             if ($statu==-1){
                echo "<label for='password'>EMAIL ALREADY USED</label>";
            echo "<script>
           let input = document.querySelectorAll('input');
let arrays = ['$nom', '$prenom', '', '$pass', 'REGISTER'];

input.forEach((element, index) => {
  element.value = arrays[index] || ''; 
});
            </script>";
        }
         }
        
        ?>
        <input type="submit" name='login' value='REGISTRE'>
    </form>
    <script src="app.js"></script>
</body>
</html>
