<?php 
require("config.php");
$code=$_POST["codeStore"];
$sql="select * from store where codestore=$code";
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $nom=$row['nom'];
    $logo=$row['image'];
}
?><button class="m-5 btn btn-primary closewBtn">
                    <span class="material-symbols-outlined">

                        close
                    </span>
                </button>
<div class="from">

                    <div class="imgcont">
                        
                        <?php echo "<img class='person' src='data:image/jpeg;base64," . base64_encode($logo) . "' alt=''>"?>
                    </div>
                    <div class="inp">
                        <input type="text" class='edit' <?php echo "value='$nom'"?>>
                        <button <?php echo "value='$code'"?>  class='save'>save</button>
                    </div>
                </div>
                <script>
                    let cls=document.querySelector(".closewBtn");
                    cls.addEventListener('click',()=>{
                        document.querySelector(".editcontainer").style.display='none';
                    })
                    const saveBtn=document.querySelector(".save");
                    let codestore=saveBtn.getAttribute("value");
                    
                    saveBtn.addEventListener('click',()=>{
                        let newname=document.querySelector(".edit").value;
                        $.ajax({
                        type: "POST",
                        url: "saveditstore.php",
                        data: {codestore:codestore,newname:newname},
                        success: function (response) {
                            document.querySelector(".editcontainer").style.display='none';
                            $.ajax({
                                type: "POST",
                                url: "loadstores.php",
                                success: function (response) {
                                   $(".listofstores").html(response);
                                }
                            });
                        }
                    }); 
                    })

                </script>
<style>
    .closewBtn{
        position: absolute;
        bottom: 80%;
        right: 90%;
    }
</style>