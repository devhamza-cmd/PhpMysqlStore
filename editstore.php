<?php 
require("config.php");
$code=$_POST["codeStore"];
$sql="select * from store where codestore=$code";
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $nom=$row['nom'];
    $logo=$row['image'];
}
?>
<div class="from">
                    <div class="imgcont">
                        <?php echo "<img class='person' src='data:image/jpeg;base64," . base64_encode($logo) . "' alt=''>"?>
                    </div>
                    <div class="inp">
                        <input type="text" <?php echo "value='$nom'"?>>
                        <button <?php echo "value='$code'"?>  class='save'>save</button>
                    </div>
                </div>
                <script>
                    const saveBtn=document.querySelector(".save");
                    let codestore=saveBtn.getAttribute("value");
                    $.ajax({
                        type: "POST",
                        url: "url",
                        data: "data",
                        dataType: "dataType",
                        success: function (response) {
                            
                        }
                    });

                </script>