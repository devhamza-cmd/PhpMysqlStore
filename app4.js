$(document).ready(function () {
    let buttons=document.querySelectorAll(".month button")
    buttons.forEach(element => {
        element.addEventListener('click',function () { 
           var month =element.value;
           var name=element.name;
           $.ajax({
            url: "sellermonth.php",
            method: "POST", 
            data: {name:name,month:month}, 
            success: function(response) {
              
                $(".table").html(response);
            },
            error: function(xhr, status, error) {
              
                console.log("Error:", error);
            }
        });
         })
    });
        })
