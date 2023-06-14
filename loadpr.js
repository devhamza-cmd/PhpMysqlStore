$(document).ready(function () {
    $("[name='homemarque']").click(function(){
        
        var codemr=$(this).val();
        $.ajax({
            url: "loadproducts.php",
        method: "POST", 
        data: {codemr:codemr}, 
        success: function(response) {
          
            $("#all").html(response);
        },
        error: function(xhr, status, error) {
          
            console.log("Error:", error);
        }
        })
    })
})
