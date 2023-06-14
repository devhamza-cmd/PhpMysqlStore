$(document).ready(function () {
    $("button").one("click", function () { 
        var value = $(this).val();
        $(".m").remove();
        $(".year").remove();
        $(".mounth").remove();
        $.ajax({
            url: "sellersmonth.php",
            method: "POST", 
            data: {value: value}, 
            success: function(response) {
              
                $(".cyear").html(response);
            },
            error: function(xhr, status, error) {
              
                console.log("Error:", error);
            }
        });
    });
 });