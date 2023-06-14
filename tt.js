$(document).ready(function () {
  $(".npost").click(function(){
      
      var code=$(this).val();
        $.ajax({
            url: "loadattpost.php",
        method: "POST", 
        data: {code:code}, 
        success: function(response) {
            
            $("#overlay2").html(response);
        },
        error: function(xhr, status, error) {
            
            console.log("Error:", error);
        }
        })
  })
})


setInterval(() => {
    $.ajax({
        url: "checkpostsadmin.php",
    method: "POST", 
    success: function(response) {
        
        $(".newpnbr").html(response);
    },
    error: function(xhr, status, error) {
        
        console.log("Error:", error);
    }
    })  
}, 500);
$(document).ready(function () {
    
})
setInterval(() => {
    
    if($(".newpnbr").text()!=$(".pnbr").text()){
    
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