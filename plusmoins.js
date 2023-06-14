$(document).ready(function () {
    $("[statu='able']").click(function(){
        var chose =$(this).attr('class')
        var codepr=$(this).val();
        $.ajax({
            url: "plusmoins.php",
        method: "POST", 
        data: {codepr:codepr,chose:chose}, 
        success: function(response) {
            
            $(".panierpr").html(response);
        },
        error: function(xhr, status, error) {
            
            console.log("Error:", error);
        }
        })
    })
  })
  $(document).ready(function () {
    $("[name='sup']").click(function(){
        var codepr=$(this).val();
        $.ajax({
            url: "suppaniere.php",
        method: "POST", 
        data: {codepr:codepr}, 
        success: function(response) {
            
            $(".panierpr").html(response);
        },
        error: function(xhr, status, error) {
            
            console.log("Error:", error);
        }
        })
    })
  })
  